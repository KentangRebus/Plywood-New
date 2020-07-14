
@extends('layout.default_layout')

@section('title', 'Product')

@section('content')
    <div class="page-header">
        <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                      <i class="mdi mdi-cube"></i>
                    </span> Update Product </h3>
    </div>
    <div class="card">
        <div class="card-body">
            <form class="forms-sample" action="" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputCode">Code</label>
                            <input name="code" type="text" class="form-control" id="inputCode" placeholder="Code" value="{{$data->name->code}}">
                        </div>
                        <div class="form-group">
                            <label for="inputName">Name</label>
                            <input name="name" type="text" class="form-control" id="inputName" placeholder="Name" required value="{{$data->name->name}}">
                        </div>
                        <div class="form-group">
                            <label for="inputType">Type</label>
                            <input name="type" type="text" class="form-control" id="inputType" placeholder="Type" value="{{$data->name->type}}">
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputUnit">Unit</label>
                            <input name="unit" type="text" class="form-control" id="inputUnit" placeholder="Unit" value="{{$data->name->unit}}">
                        </div>
                        <div class="form-group">
                            <label for="inputColor">Color</label>
                            <input name="color" type="text" class="form-control" id="inputColor" placeholder="Color" value="{{$data->name->color}}">
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <label for="inputStock">Stock</label>
                    <input name="stock" min="1" type="number" class="form-control" id="inputStock" placeholder="Number of Stocks" required value="{{$data->stock}}">
                </div>

                <div class="form-group">
                    <label for="inputMinStock">Minimum Stock</label>
                    <input name="minStock" min="1" type="number" class="form-control" id="inputMinStock" placeholder="Minimum Stock" required value="{{$data->min_stock}}">
                </div>

                <div class="form-group">
                    <label for="inputBuy">Buy Price</label>
                    <input name="buyPrice" min="0" type="number" class="form-control" id="inputBuy" placeholder="Rp." required value="{{$data->buy_price}}">
                </div>

                <div class="form-group">
                    <label for="inputSell">Sell Price</label>
                    <input name="sellPrice" min="0" type="number" class="form-control" id="inputSell" placeholder="Rp." required value="{{$data->sell_price}}">
                </div>

                <button type="submit" class="btn btn-gradient-primary mr-2">Update</button>
            </form>
        </div>
    </div>

@endsection

