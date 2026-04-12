<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="d-flex justify-content-center align-items-center" style="height:100vh;">
        <div class="card p-4 shadow" style="width:400px;">
            {{ $slot }}
        </div>
    </div>

    @livewireScripts
</body>
</html>