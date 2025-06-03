<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>
</head>

<body>

    <div class="container mt-5 p-4 card mx-auto d-flex justify-center w-50">
        <form action="/login" method="post">
            @csrf
            <h4 class="text-center">Login Form</h4>

            @if (isset($message))
                <span class="text-center text-success fw-bold">{{ $message }}</span>
            @endif

            @if (session('message'))
                <div class="alert alert-warning">
                    {{ session('message') }}
                </div>
            @endif

            <div class="form-group mb-2">
                <label for="">Email</label>
                <input type="email" class="form-control" name="email">
            </div>
            @if ($errors->get('email'))
                <div class="text-sm text-danger">{{ $errors->first('email') }}</div>
            @endif

            <div class="form-group mb-2">
                <label for="">Password</label>
                <input type="password" class="form-control" name="password">
            </div>

            @if ($errors->get('password'))
                <div class="text-sm text-danger">{{ $errors->first('password') }}</div>
            @endif

            <div class="my-2"><a href="/forgot" class="text-decoration-none text-primary">Forgot Password ? </a></div>

            <button class="btn btn-outline-success">Login</button>
        </form>

    </div>
</body>

</html>
