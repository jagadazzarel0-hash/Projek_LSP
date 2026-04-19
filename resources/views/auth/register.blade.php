<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">

<div class="card p-4" style="width:300px;">
    <h4 class="mb-3">Register</h4>

    <form method="POST" action="/register">
        @csrf

        <input type="text" name="name" class="form-control mb-2" placeholder="Nama">
        <input type="email" name="email" class="form-control mb-2" placeholder="Email">
        <input type="password" name="password" class="form-control mb-2" placeholder="Password">

        <button class="btn btn-success w-100">Register</button>
    </form>

    <a href="/login" class="d-block mt-2 text-center">Sudah punya akun? Login</a>
</div>

</body>
</html>
