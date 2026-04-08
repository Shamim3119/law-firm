<!DOCTYPE html>
<html>
<head>
    <title>Client Management</title>
    @livewireStyles
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="body">
    <div class="container mt-5">
       {{ $slot }}
    </div>

    @livewireScripts
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
 