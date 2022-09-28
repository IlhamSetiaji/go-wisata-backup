<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Laravel QR Code Example</title>
</head>
<body>

<div class="text-center" style="margin-top: 50px;">
    <h1 class="mb-3">QR-CODE TIKET</h1>

    {!! QrCode::size(500)->generate($kode); !!}

    
</div>

</body>
</html>