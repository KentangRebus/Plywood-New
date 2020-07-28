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
    <h1>PT Sinar Karunia Adi Jaya</h1>
    <div class="mt-2">Jl. Caman Raya no. 60, RT. 07 /  RW. 01, Jati Bening <br> Pondok Gede, Bekasi Kota, Jawa Barat, Indonesia</div>
    <div class="mt-3">Telp: (021) 2284 5271 / 2284 5278</div>
</div>
<hr>
<div class="mt-3">
    <div class="row" style="margin-bottom: 1.5rem;">
            <div class="my-2">Kode Transaksi: {{$data->id}}</div>
            <div class="my-2">Kode Faktur: {{$data->id}}</div>
            <div class="my-2">Tanggal Transaksi: {{$data->created_at}}</div>
            <div class="my-2">Status Pembayaran: {{$data->is_done == 1 ? "Lunas" : "Hutang"}}</div>
        @if($data->is_done == 0)
            <div class="my-2">Jatuh Tempo: {{$data->due_date}}</div>
            <div class="my-2">Kekurangan: Rp. {{number_format($data->needs)}}</div>
        @endif
    </div>
    <table class="table" style="table-layout: fixed; width: 100%;">
        <thead>
            <tr>
                <th class="w-40 font-weight-bold">Name</th>
                <th class="font-weight-bold">Quantity</th>
                <th class="font-weight-bold">Price</th>
                <th class="font-weight-bold">Subtotal</th>
            </tr>
        </thead>
        <tbody>
        @foreach($data->details as $d)
            <tr>
                <td>
                    {{json_decode($d->productDetail->name)->name}}
                    {{json_decode($d->productDetail->name)->code}}
                    {{json_decode($d->productDetail->name)->color}}
                    {{json_decode($d->productDetail->name)->type}}
                    {{json_decode($d->productDetail->name)->unit}}
                </td>
                <td>{{$d->quantity}} {{json_decode($d->productDetail->name)->unit}}</td>
                <td>Rp. {{ number_format($d->price)}}</td>
                <td>Rp. {{ number_format($d->price * $d->quantity)}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="font-weight-bold" style="font-size: 18px; text-align: right; margin-top: 2rem; margin-right: 3rem;">
            Grand Total: Rp. {{number_format($total)}}
    </div>
</div>

</body>
</html>