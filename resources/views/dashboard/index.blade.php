
@extends('layout.default_layout')

@section('title', 'Dashboard')

@section('content')
    <div class="page-header">
        <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                      <i class="mdi mdi-home"></i>
                    </span> Dashboard </h3>
    </div>
    <div class="row">
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                    <img src="{{asset('images/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Pemasukan Hari Ini<i class="mdi mdi-currency-usd mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">Rp. {{number_format($data['income'])}}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                    <img src="{{asset('images/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Jumlah Transaksi<i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">{{number_format($data['transaction'])}}</h2>
                </div>
            </div>
        </div>
        @if(\Illuminate\Support\Facades\Auth::user()->role == "admin")
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                    <img src="{{asset('images/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Keuntungan Hari ini<i class="mdi mdi-currency-usd mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">Rp. {{number_format($data['daily_profit'])}}</h2>
                </div>
            </div>
        </div>
        @endif
    </div>
    @if(\Illuminate\Support\Facades\Auth::user()->role == "admin")
    <div class="row">

        <div class="col-md-6 stretch-card grid-margin">
            <div class="card bg-gradient-primary card-img-holder text-white">
                <div class="card-body">
                    <img src="{{asset('images/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Keuntungan Mingguan<i class="mdi mdi-currency-usd mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">Rp. {{number_format($data['weekly_profit'])}}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-6 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                    <img src="{{asset('images/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Keuntungan Bulanan<i class="mdi mdi-currency-usd mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">Rp. {{number_format($data['monthly_profit'])}}</h2>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection

