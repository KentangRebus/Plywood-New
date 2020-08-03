
@extends('layout.default_layout')

@section('title', 'Purchase')

@section('content')

    <div class="page-header">
        <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                      <i class="mdi mdi-barcode"></i>
                    </span> Laporan </h3>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="">
                <h3>Laporan Barang Bulanan</h3>
                <hr>
                <a href="{{route('report-stock-monthly')}}">
                    <button class="btn btn-success" onclick="monthlyStockReport()">
                        Generate and Print
                    </button>
                </a>
                <div id="loading" class="my-1 w-100">

                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('js/download.js')}}"></script>
    <script !src="">
        function monthlyStockReport() {
            $.ajax({
                method: 'GET',
                url: "{{route('report-stock-monthly')}}",
                beforeSend: function() {
                    $('#loading').html('<img src="{{asset('images/loadingdots.gif')}}" style="width: 8vw">')
                },
                success: function(data) {
                    $('#loading').html('<div class="text-center text-success"> Laporan sudah tergenerate dan terdownload </div>')
                },
                error: function(xhr) { // if error occured
                    $('#loading').html('<div class="text-center text-danger"> Terjadi kasalahan silahkan coba ulang atau refresh halaman </div>')
                }
            })
        }
    </script>

@endsection

