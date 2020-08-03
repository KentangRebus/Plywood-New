
@extends('layout.default_layout')

@section('title', 'Product')

@section('content')

    <div class="page-header">
        <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                      <i class="mdi mdi-cube"></i>
                    </span> Pengaturan Produk </h3>
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
            <div class="row mb-3">
                <div class="col-md-6">
                    <a href="{{route('product-insert-view')}}"><button class="btn btn-gradient-success">+ Tambah Produk</button></a>
                </div>
                <form action="{{route('product-search')}}" method="post" class="row col-md-6">
                    <div class="input-group col-md-5">
                        <select name="searchCategory" id="" class="w-100 form-control">
                            <option value="">Semua</option>
                            @foreach($categories as $c)
                                <option value="{{$c->id}}">{{$c->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @csrf
                    <div class="input-group col-md-7">
                        @if(!empty($query))
                            <input name="query" type="text" class="form-control" placeholder="Nama Produk" aria-label="Product Name" aria-describedby="basic-addon2" value="{{$query}}">
                        @else
                            <input name="query" type="text" class="form-control" placeholder="Nama Produk" aria-label="Product Name" aria-describedby="basic-addon2">
                        @endif
                        <div class="input-group-append">
                            <button class="btn btn-sm btn-gradient-primary" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>

            <table class="table table-hover" style="table-layout: fixed;">
                <thead>
                <tr>
                    <th class="w-35">Nama</th>
                    <th>Kategori</th>
                    <th>Persediaan</th>
                    <th>Harga Modal</th>
                    <th>Harga Jual</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $d)
                    @if($d->stock <= $d->min_stock)
                        <tr class="table-danger">
                    @else
                        <tr>
                    @endif
                        <td class="text-truncate" title="{{$d->name}}">{{$d->name}}</td>
                        <td>{{$d->category->name}}</td>
                        <td >{{$d->stock}}</td>
                        <td>Rp. {{number_format($d->buy_price,0)}}</td>
                        <td>Rp. {{number_format($d->sell_price,0)}}</td>
                        <td class="row">
                            <form action="{{route('product-update-view', ['id'=>$d->id])}}" method="get" class="mx-2">
                                <button type="submit" class="btn btn-gradient-info btn-rounded btn-icon">
                                    <i class="mdi mdi-lead-pencil"></i>
                                </button>
                            </form>
                            <div>
                                <button type="button" class="btn btn-gradient-danger btn-rounded btn-icon" data-toggle="modal" data-target="#modal" onclick="onclickModal({{$d}})">
                                    <i class="mdi mdi-close"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div>
                {{$data->links()}}
            </div>
            <div>
                <form action="{{route('product-print')}}" method="post">
                    <input type="hidden" name="category" value="{{$categoryQuery ?? ''}}">
                    <input type="hidden" name="query" value="{{$query ?? ''}}">
                    @csrf
                    <button type="submit" class="btn btn-gradient-primary">
                        Print
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Delete this product?</h4>
                </div>
                <div class="modal-body">

                </div>
                <form id="deleteForm" action="" method="post">
                    @csrf
                    <input id="inputId" type="hidden" name="id" value="">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script !src="">
        function onclickModal(obj) {
            console.log('Object to delete', obj)
            $('.modal-body').text(obj.name)
            $('#inputId').val(obj.id)
            $('#deleteForm').attr('action', '{{route('product-delete')}}');
        }
    </script>
    @endsection

