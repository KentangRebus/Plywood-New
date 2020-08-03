<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <style>
        body {
            font-size: 12px;
        }
        .p-3 {
            padding: 1rem !important; }
        .mt-2,
        .my-2 {
            margin-top: 0.5rem !important; }
        .my-2 {
            margin-bottom: 0.5rem !important; }
        .w-40 {
            width: 40% !important; }
        .mt-3{
            margin-top: 1rem !important; }
        .font-weight-bold {
            font-weight: 700 !important; }

        .table {
            border-collapse: collapse !important;
            border: 1px solid black;
        }
        .table td,
        .table th {
            background-color: #ffffff !important;
            text-align: left;
            border: 1px solid black;
            padding: .3rem}

    </style>
</head>
<body class="p-3">
<div>
    <h2 style="margin-bottom: 1rem">PT Sinar Karunia Adi Jaya</h2>
    <div class="" style="font-size: 10px">Jl. Caman Raya no. 60, RT. 07 /  RW. 01, Jati Bening <br> Pondok Gede, Bekasi Kota, Jawa Barat, Indonesia</div>
    <div class="mt-1" style="font-size: 10px">Telp: (021) 2284 5271 / 2284 5278</div>
</div>
<hr>
<div class="mt-2">
    <div class="row" style="">
        <h3>{{$category}}</h3>
    </div>
    <table class="table" style="table-layout: fixed; width: 100%;">
        <thead>
        <tr>
            <th class="w-40 font-weight-bold">Nama Produk</th>
            <th class="font-weight-bold">Persediaan</th>
            <th class="font-weight-bold">Harga Modal</th>
            <th class="font-weight-bold">Harga Jual</th>
            <th class="font-weight-bold">Total Biaya Aset</th>
        </tr>
        </thead>
        <tbody>
            @foreach($data as $d)
                <tr>
                    <td>
                        {{json_decode($d->name)->code}}
                        {{json_decode($d->name)->name}}
                        {{json_decode($d->name)->type}}
                        {{json_decode($d->name)->unit}}
                        {{json_decode($d->name)->brand}}
                        {{json_decode($d->name)->description}}
                    </td>
                    <td>{{$d->stock}} {{json_decode($d->name)->unit}}</td>
                    <td>Rp. {{number_format($d->buy_price)}}</td>
                    <td>Rp. {{number_format($d->sell_price)}}</td>
                    <td>Rp. {{number_format($d->stock*$d->buy_price)}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>