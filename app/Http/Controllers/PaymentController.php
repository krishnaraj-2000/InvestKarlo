<?php

namespace App\Http\Controllers;
use App\Models\Payment;
use Illuminate\Http\Request;
use Omnipay\Omnipay;
use Illuminate\Support\Facades\Auth;

//require_once('vendor/autoload.php');
class PaymentController extends Controller
{
    //
   
    public function paynow()
    {
        return view('pay_now');
    }

    public function openpay(Request $request)
    {
        $payment_token = $this->openpay_helper($request->input('amount'));
        return view('payment_page',["amount" => $request->input('amount') ])->with('payment_token', $payment_token) ;
    }
    
    /**
     * @throws GuzzleException
     */

    public function openpay_helper($amount)
    {
        $client = new \GuzzleHttp\Client();
        $id = config('payment.OPEN_CLIENT_ID') ;
        $secret = config('payment.OPEN_CLIENT_SECRET');
        $bytes = random_bytes(20);
        $response = $client->request('POST', 'https://sandbox-icp-api.bankopen.co/api/payment_token', [
            'body' => json_encode([
                "amount" => $amount ,
                "contact_number" => "7567662274",
                "email_id" => Auth::user()->email ,
                "currency" => "INR",
                "mtx" => bin2hex($bytes)
            ]),
        'headers' => [
            'Authorization' => 'Bearer '.$id.':'.$secret,
            'accept' => 'application/json',
            'content-type' => 'application/json',
        ],
        ]);
       // dd($response);
        $responseData = json_decode($response->getBody()->getContents());
        //dd($responseData);
        return $responseData->id;
    }


    // ** Paypal payment gateway  **  
    private $gateway ;
    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true);

    }
    public function pay(Request $request)
    {
        try
        {
            $response = $this->gateway->purchase( array(
                'amount' => $request->amount , 
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => url('success'),
                'cancelUrl' => url('error')
            ) )->send();
            print_r($response);
            if ($response->isRedirect()) {
                // redirect to offsite payment gateway
                $response->redirect();
            } else {
                // payment failed: display message to customer
                return $response->getMessage();
            }
        }
        catch(\Throwable $th )
        {
            return $th->getMessage();
        }
    }

    public function success(Request $request)
    {
        if($request->input('paymentId') && $request->input('PayerID')  )
        {
            $transaction = $this->gateway->completePurchase( array( 'payer_id' => $request->input('PayerID') , 
                'transactionReference' => $request->input('paymentId')    
            ) );
            $response = $transaction->send();
            if($response->isSuccessful())
            {
                $arr = $response->getData();
                $payment = new Payment() ;
                $payment->payment_id = $arr['id'] ;
                $payment->payer_id = $arr['payer']['payer_info']['payer_id'];
                $payment->payer_email = $arr['payer']['payer_info']['email'];
                $payment->amount = $arr['transactions'][0]['amount']['total'];
                $payment->payment_status = $arr['state'];
                $payment->currency = env('PAYPAL_CURRENCY');
                $payment->save();
                return "Your payment was successfull";
            }
            else 
            {
                return $response->getMessage();
            }
        }
        else 
        {
            return "Payment Declined!";
        }
    }

    public function error()
    {
        return "User declined the payment !!";
    }


}
