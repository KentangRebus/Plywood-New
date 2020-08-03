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
    <h2>PT Sinar Karunia Adi Jaya</h2>
    <div class="" style="font-size: 10px">Jl. Caman Raya no. 60, RT. 07 /  RW. 01, Jati Bening <br> Pondok Gede, Bekasi Kota, Jawa Barat, Indonesia</div>
    <div class="mt-1" style="font-size: 10px">Telp: (021) 2284 5271 / 2284 5278</div>
</div>
<hr>
<div class="mt-2">
    <div class="row" style="margin-bottom: 1.5rem;">
            <div class="my-1" style="font-size: 11px">Kode Transaksi: {{$data->id}}</div>
            <div class="my-1" style="font-size: 11px">Kode Faktur: {{$data->invoice_number}}</div>
            <div class="my-1" style="font-size: 11px">Tanggal Transaksi: {{$data->created_at}}</div>
            <div class="mt-2" style="font-size: 11px">Nama Customer: {{$data->customer->name}}</div>
            <div class="my-1" style="font-size: 11px">Status Pembayaran: {{$data->is_done == 1 ? "Lunas" : "Hutang"}}</div>
        @if($data->is_done == 0)
            <div class="my-1" style="font-size: 11px">Jatuh Tempo: {{$data->due_date}}</div>
            <div class="my-1" style="font-size: 11px">Kekurangan: Rp. {{number_format($data->needs)}}</div>
        @endif

    </div>
    <table class="table" style="table-layout: fixed; width: 100%;">
        <thead>
            <tr>
                <th class="w-40 font-weight-bold">Nama Produk</th>
                <th class="font-weight-bold">Jumlah</th>
                <th class="font-weight-bold">Harga</th>
                <th class="font-weight-bold">Subtotal</th>
            </tr>
        </thead>
        <tbody>
        @foreach($data->details as $d)
            <tr>
                <td>
                    {{json_decode($d->productDetail->name)->code}}
                    {{json_decode($d->productDetail->name)->name}}
                    {{json_decode($d->productDetail->name)->type}}
                    {{json_decode($d->productDetail->name)->unit}}
                    {{json_decode($d->productDetail->name)->brand}}
                    {{json_decode($d->productDetail->name)->description}}
                </td>
                <td>{{$d->quantity}} {{json_decode($d->productDetail->name)->unit}}</td>
                <td>Rp. {{ number_format($d->price)}}</td>
                <td>Rp. {{ number_format($d->price * $d->quantity)}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
{{--    <div class="font-weight-bold" style="font-size: 18px; text-align: right; margin-top: 2rem; margin-right: 3rem;">--}}
{{--        Jumlah Netto: Rp. {{number_format($total)}}--}}
{{--    </div>--}}
{{--    <div class="font-weight-bold" style="font-size: 18px; text-align: right; margin-top: 2rem; margin-right: 3rem;">--}}
{{--        PPN (10%): Rp. {{number_format($total * 10/100)}}--}}
{{--    </div>--}}
    <div class="font-weight-bold mt-2" style="font-size: 12px">
        Jumlah Tagihan (sudah termasuk ppn 10%): Rp. {{number_format($total)}}
    </div>
</div>

</body>
</html>