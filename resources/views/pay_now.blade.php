<!DOCTYPE html>
<html>
<head>
    <title>Custom Auth in Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script id="context" type="text/javascript" 
            src="https://sandbox-payments.open.money/layer">
    </script>
</head>
<body>
        
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header text-center">ICICI Mutual Funds Investment amount</h3>
                    <div class="card-body">
                        <form method="POST" action="{{ route('payment_begin') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" id="amount" class="form-control" name="amount" required
                                    autofocus>
                            </div>
                            
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-dark btn-block">Add amount</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>