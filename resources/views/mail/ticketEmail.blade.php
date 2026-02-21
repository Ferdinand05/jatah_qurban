<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Informasi Tiket</title>

    <style>
        .main {
            padding: 8px;
            text-align: left
        }
    </style>

</head>

<body>
    <div class="main">
        <h4>Halo, {{ $ticket->household->kepala_keluarga }}</h4>
        <p>Berikut tiket(qrcode) anda untuk pengambilan distribusi {{ $distribusi }}. Berlaku sampai
            {{ $date_expired }}</p>
        <p>Mohon Bawa dan scan saat pengambilan. Untuk bantuan & pertanyaan silahkan hubungi pengurus terkait</p>
        <p>Terima Kasih!</p>
    </div>
</body>

</html>
