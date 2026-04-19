<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">

<div class="card p-4" style="width:300px;">
    <h4 class="mb-3">Login</h4>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <input type="email" name="email" class="form-control mb-2" placeholder="Email">
        <input type="password" name="password" class="form-control mb-2" placeholder="Password">

        <button class="btn btn-primary w-100">Login</button>
        <a href="/register" class="d-block mt-2 text-center">Belum punya akun? Register</a>
    </form>
</div>

</body>
</html>
