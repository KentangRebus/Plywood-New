
@extends('layout.default_layout')

@section('title', 'Product')

@section('content')

    <div class="page-header">
        <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                      <i class="mdi mdi-cube"></i>
                    </span> Manage Products </h3>
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
            <div class="d-flex justify-content-between mb-3">
                <a href="{{route('product-insert-view')}}"><button class="btn btn-gradient-success">+ Add Products</button></a>
                <form action="{{route('product-search')}}" method="post">
                    @csrf
                    <div class="input-group">
                        @if(!empty($query))
                            <input name="query" type="text" class="form-control" placeholder="Product Name" aria-label="Product Name" aria-describedby="basic-addon2" value="{{$query}}">
                        @else
                            <input name="query" type="text" class="form-control" placeholder="Product Name" aria-label="Product Name" aria-describedby="basic-addon2">
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
                    <th class="w-40">Name</th>
                    <th>Stock</th>
                    <th>Buy Price</th>
                    <th>Sell Price</th>
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
                        <td >{{$d->stock}}</td>
                        <td>Rp. {{$d->buy_price}}</td>
                        <td>Rp. {{$d->sell_price}}</td>
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

