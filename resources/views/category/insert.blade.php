
@extends('layout.default_layout')

@section('title', 'Category')

@section('content')

    <div class="page-header">
        <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                      <i class="mdi mdi-account-multiple"></i>
                    </span> Tambah Kategori </h3>
    </div>
    <div class="card">
        <div class="card-body">
            <form class="forms-sample" method="post" action="{{route('category-insert')}}">
                @csrf
                <div class="form-group">
                    <label for="inputName">Nama Kategori</label>
                    <input name="name" type="text" class="form-control" id="inputName" placeholder="Nama Kategori" required>
                </div>

                <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
            </form>
        </div>
    </div>

@endsection

