<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
</head>

<body>

    <h1>{{ $title }}</h1>
    <p>Kode Booking : {{ $datas->kode_booking }}</p>
    <p>Nama : {{ $datas->name }}</p>
    <p>Email : {{ $datas->email }}</p>
    <p>Telpon : {{ $datas->telp }}</p>
    <p>Jumlah Hari : {{ $datas->jml_hari }}</p>
    <p>Jumlah Orang : {{ $datas->jml_orang }}</p>
    <p>Paket yang Diambil : {{ $datas->paket->nama_paket }}</p>
    <p>Status : Belum Bayar</p>
    <p>Tanggal Perjalanan : {{ $datas->tanggal_perjalanan }}</p>
    <p>Tagihan : {{ $datas->total_biaya }}</p>
</body>

</html>
