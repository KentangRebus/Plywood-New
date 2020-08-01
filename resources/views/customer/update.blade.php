
@extends('layout.default_layout')

@section('title', 'Customer')

@section('content')

    <div class="page-header">
        <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                      <i class="mdi mdi-account-multiple"></i>
                    </span> Perbaharui Data Customer </h3>
    </div>
    <div class="card">
        <div class="card-body">
            <form class="forms-sample" method="post" action="{{route('customer-update', ['id'=>$data->id])}}">
                @csrf
                <div class="form-group">
                    <label for="inputName">Nama</label>
                    <input name="name" type="text" class="form-control" id="inputName" placeholder="Nama" required value="{{$data->name}}">
                </div>

                <div class="form-group">
                    <label for="inputAddress">Alamat</label>
                    <textarea class="form-control" name="address" id="inputAddress" cols="30" rows="10" placeholder="Alamat">{{$data->address ?? ''}}
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="inputNIK">NIK (Optional)</label>
                    <input name="nik" type="text" class="form-control" id="inputNIK" placeholder="NIK" value="{{$data->nik ?? ''}}">
                </div>

                <div class="form-group">
                    <label for="inputNPWP">NPWP (Optional)</label>
                    <input name="npwp" type="text" class="form-control" id="inputNPWP" placeholder="NPWP" value="{{$data->npwp ?? ''}}">
                </div>

                <button type="submit" class="btn btn-gradient-primary mr-2">Update</button>
            </form>
        </div>
    </div>

@endsection

