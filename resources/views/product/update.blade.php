
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
            <form class="forms-sample">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputCode">Code</label>
                            <input name="code" type="text" class="form-control" id="inputCode" placeholder="Code">
                        </div>
                        <div class="form-group">
                            <label for="inputName">Name</label>
                            <input name="name" type="text" class="form-control" id="inputName" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <label for="inputType">Type</label>
                            <input name="type" type="text" class="form-control" id="inputType" placeholder="Type">
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputUnit">Unit</label>
                            <input name="unit" type="text" class="form-control" id="inputUnit" placeholder="Unit">
                        </div>
                        <div class="form-group">
                            <label for="inputColor">Color</label>
                            <input name="color" type="text" class="form-control" id="inputColor" placeholder="Color">
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <label for="inputStock">Stock</label>
                    <input name="stock" min="1" type="number" class="form-control" id="inputStock" placeholder="Number of Stocks" required>
                </div>

                <div class="form-group">
                    <label for="inputBuy">Buy Price</label>
                    <input name="buyPrice" min="0" type="number" class="form-control" id="inputBuy" placeholder="Rp." required>
                </div>

                <div class="form-group">
                    <label for="inputSell">Sell Price</label>
                    <input name="sellPrice" min="0" type="number" class="form-control" id="inputSell" placeholder="Rp." required>
                </div>

                <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
            </form>
        </div>
    </div>

@endsection

