
@extends('layout.default_layout')

@section('title', 'Customer')

@section('content')

    <div class="page-header">
        <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                      <i class="mdi mdi-account-multiple"></i>
                    </span> Detail Data Customer </h3>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <div class="mb-2 font-weight-bold">
                    Nama:
                </div>
                {{$data->name}}
            </div>
            <div class="form-group">
                <div class="mb-2 font-weight-bold">
                    Alamat:
                </div>
                {{$data->address}}
            </div>
            <div class="form-group">
                <div class="mb-2 font-weight-bold">
                    Nomor Telepon:
                </div>
                {{$data->phone ?? '-'}}
            </div>
            <div class="row form-group">
                <div class="col-md-6">
                    <div class="mb-2 font-weight-bold">
                        NIK:
                    </div>
                    {{$data->nik ?? '-'}}
                </div>
                <div class="col-md-6">
                    <div class="mb-2 font-weight-bold">
                        NPWP:
                    </div>
                    {{$data->npwp ?? '-'}}
                </div>
            </div>
            <div class="form-group">
                <div class="mb-2 font-weight-bold">
                    Total Transaksi Hutang:
                </div>
                {{$data->debt ?? '-'}}
            </div>

            <div>
                <table class="table table-hover" style="table-layout: fixed;">
                    <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nomor Faktur</th>
                        <th>Status</th>
                        <th>Jatuh Tempo</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($data->transactions as $transaction)
                            <tr>
                                <td>{{$transaction->created_at}}</td>
                                <td>{{$transaction->invoice_number}}</td>
                                <td>
                                    @if($transaction->is_done == 1)
                                        <label class="badge badge-success">Lunas</label>
                                    @else
                                        <label class="badge badge-danger">Hutang</label>
                                    @endif
                                </td>
                                <td>{{$transaction->due_date ?? '-'}}</td>
                                <td>
                                    <a href="{{route('transaction-detail',['id'=>$transaction->id])}}">
                                        <button type="submit" class="btn btn-gradient-dark btn-rounded btn-icon">
                                            <i class="mdi mdi-information-variant"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection

