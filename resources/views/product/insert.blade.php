
@extends('layout.default_layout')

@section('title', 'Product')

@section('content')
    <div class="page-header">
        <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                      <i class="mdi mdi-cube"></i>
                    </span> Add New Product </h3>
    </div>
    <div class="card">
        <div class="card-body">
            <form class="forms-sample" method="post" action="{{route('product-insert')}}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputCode">Kode</label>
                            <input name="code" type="text" class="form-control" id="inputCode" placeholder="Kode">
                        </div>
                        <div class="form-group">
                            <label for="inputName">Nama</label>
                            <input name="name" type="text" class="form-control" id="inputName" placeholder="Nama" required>
                        </div>
                        <div class="form-group">
                            <label for="inputType">Tipe</label>
                            <input name="type" type="text" class="form-control" id="inputType" placeholder="Tipe">
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputUnit">Unit</label>
                            <input name="unit" type="text" class="form-control" id="inputUnit" placeholder="Unit">
                        </div>
                        <div class="form-group">
                            <label for="inputBrand">Merek</label>
                            <input name="brand" type="text" class="form-control" id="inputBrand" placeholder="Merel">
                        </div>
                        <div class="form-group">
                            <label for="inputDescription">Deskripsi</label>
                            <input name="description" type="text" class="form-control" id="inputDescription" placeholder="Deskripsi">
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <label for="inputCategory">Kategori</label>
                    <select class="form-control" id="inputCategory" name="category">
                        @foreach($categories as $c)
                            <option value="{{$c->id}}">{{$c->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="inputStock">Persediaan</label>
                    <input name="stock" min="1" type="number" class="form-control" id="inputStock" placeholder="Jumlah Persediaan" required>
                </div>

                <div class="form-group">
                    <label for="inputMinStock">Persediaan Minimum</label>
                    <input name="minStock" min="1" type="number" class="form-control" id="inputMinStock" placeholder="Persediaan Minimum" required>
                </div>

                <div class="form-group">
                    <label for="inputBuy">Harga Modal</label>
                    <input name="buyPrice" min="0" type="number" class="form-control" id="inputBuy" placeholder="Rp." required>
                </div>

                <div class="form-group">
                    <label for="inputSell">Harga Jual</label>
                    <input name="sellPrice" min="0" type="number" class="form-control" id="inputSell" placeholder="Rp." required>
                </div>

                <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
            </form>
        </div>
    </div>

@endsection

