
@extends('layout.default_layout')

@section('title', 'Category')

@section('content')

    <div class="page-header">
        <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                      <i class="mdi mdi-account-multiple"></i>
                    </span> Perbaharui Kategori </h3>
    </div>
    <div class="card">
        <div class="card-body">
            <form class="forms-sample" method="post" action="{{route('category-update', ['id'=>$data->id])}}">
                @csrf
                <div class="form-group">
                    <label for="inputName">Nama</label>
                    <input name="name" type="text" class="form-control" id="inputName" placeholder="Nama" required value="{{$data->name}}">
                </div>

                <button type="submit" class="btn btn-gradient-primary mr-2">Update</button>
            </form>
        </div>
    </div>

@endsection

