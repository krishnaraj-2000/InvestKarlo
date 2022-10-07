<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use userProfile ;
use App\Http\Requests\StorePostRequest ;
//use App\Helper\userProfile as userDetail ;
class CustomAuthController extends Controller
{
    //
    public function login()
    {
        return view('auth.login');
    }

    public function customLogin( StorePostRequest $req )
    {
        try 
        {
            $credentials = $req->only( 'email' , 'password' );
            $user = userProfile::userDetail($req->email);
            if($user)
            {
                $userEmail = $user->email;
                $userPassword = $user->password ;
                //dd($user);
                if($req->password == Crypt::decryptString($userPassword));
                {
                    Auth::login($user);
                    return redirect()->intended('payment');
                }
            }
            else 
            {
                return redirect('login')->withSuccess("User does not exist");
            }
            
        }
        catch(DecryptException $e)
        {
            redirect('login')->withSuccess($e);
        }
    }

    public function register()
    {
        return view('auth.registration');
    }

    public function customRegister(Request $req)
    {
        $req->validate([ 'email' => 'required|email|unique:users' , 'password' => 'required|min:6' , 'name' => 'required' ]);
        $data = $req->all();
        $result = User::create( [ 
            'name' => $data['name'] ,
            'email' => $data['email'] ,
            'password' => Crypt::encryptString($data['password']),
            //'password' => Hash::make($data['password'])
         ]  );
        Auth::login($result);
        return redirect('payment')
                ->with('Welcome! Your account has been successfully created!');
        return redirect('login')->withSuccess('failed registration');
        
        // return "register failed" ; 
        //  if (Auth::attempt($req->only('email', 'password'))) {
        //     dd(Auth::user()) ;
        //     return redirect()
        //         ->route('payment')
        //         ->with('Welcome! Your account has been successfully created!');
        // }
         //return response()->json(['message' => 'registration successful'  ]);
    }

    public function dashboard()
    {
        if( Auth::check() )
        {
            
            return response()->json(['message' => 'dashboard successful'  ]);
            //return view('dashboard' , [ "welcome" => $name ] );
        }
        return redirect("login")->withSuccess('Login not allowed');
    }

    public function signOut()
    {
        Session::flush() ;
        Auth::logout();
        return redirect('login');
    }
}
