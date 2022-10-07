
<!DOCTYPE html>
<html>
<head>
    <title>Custom Auth in Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script id="context" type="text/javascript" 
            src="https://sandbox-payments.open.money/layer">
    </script>    
    <META HTTP-EQUIV="REFRESH" CONTENT="csrf_timeout_in_seconds">
</head>
<body>
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <form action = "{{ route('payment_begin') }}" method = "get" >
                            @csrf
                            <h3 class="card-header text-center">Add {{$amount}}</h3>
                            <button type="button" id = "payment" class="text-center" value="{{$payment_token}}" >Pay now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


</html>
<script> 
document.getElementById("payment").addEventListener("click", function() {
    var payment_token = this.value;
    PayNow(payment_token);
}, false);
</script>
<script src="{{url('js/paymentPage.js')}}"></script>



