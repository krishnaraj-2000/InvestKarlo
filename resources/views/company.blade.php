
<!DOCTYPE html>
<html>
<head>
    <title>Custom Auth in Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
        <div class="container">
            <a class="navbar-brand mr-auto" href="#"> ICICI Mutual fund </a>
            <form action = "{{ route('createCompany.custom') }}" method = "POST" >
                @csrf
                <input type="text" name ="name" value = "" >
                <button type="submit">Add Company</button>
            </form>
        </div>
</body>
</html>


