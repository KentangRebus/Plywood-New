
@extends('layout.default_layout')

@section('title', 'Category')

@section('content')

    <div class="page-header">
        <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                      <i class="mdi mdi-account-multiple"></i>
                    </span> Pengaturan Kategori </h3>
    </div>
    <div class="card">
        <div class="card-body">
            <div>
                @if (session()->has('msg'))
                    <div class="alert alert-success">
                        {{ session()->get('msg') }}
                    </div>
                @endif
            </div>
            <div>
                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif
            </div>
            <div>
                <a href="{{route('category-insert-view')}}"><button class="btn btn-gradient-success">+ Tambah Kategori</button></a>
            </div>
            <table class="table table-hover" style="table-layout: fixed;">
                <thead>
                <tr>
                    <th>Nama</th>
                    <th class="w-30">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $d)
                    <tr>
                        <td>{{$d->name}}</td>
                        <td class="row">
                            <div class="mx-2">
                                <a href="{{route('category-update-view', ['id'=>$d->id])}}">
                                    <button type="submit" class="btn btn-gradient-info btn-rounded btn-icon">
                                        <i class="mdi mdi-lead-pencil"></i>
                                    </button>
                                </a>
                            </div>
                            <form action="{{route('category-delete', ['id'=>$d->id])}}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-gradient-danger btn-rounded btn-icon" data-toggle="modal" data-target="#modal">
                                    <i class="mdi mdi-close"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div>
                {{$data->links()}}
            </div>
        </div>
    </div>

@endsection

