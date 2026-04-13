<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    @livewireStyles

    <link rel="stylesheet" href="{{ asset('login/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="d-flex justify-content-center align-items-center" style="height:100vh;">
 
            {{ $slot }}
      
    </div>

    @livewireScripts
    <link rel="javascript" href="{{ asset('login/form-utils.js') }}">
    <link rel="javascript" href="{{ asset('login/script.js') }}">
</body>
</html>