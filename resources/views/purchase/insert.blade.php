
@extends('layout.default_layout')

@section('title', 'Purchase')

@section('content')
    <div class="page-header">
        <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                      <i class="mdi mdi-archive"></i>
                    </span> Add Purchase Transaction</h3>
    </div>
    <div class="card">
        <div class="card-body">
            <form id="purchaseForm" class="forms-sample" method="post" action="{{route('purchase-insert')}}">
                @csrf
                <input type="hidden" name="formData" id="formData">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputPaymentStatus">Payment Status</label>
                            <select name="paymentStatus" class="form-control" id="inputPaymentStatus">
                                <option value="Lunas">Lunas</option>
                                <option value="Hutang">Hutang</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputDueDate">Due Date</label>
                            <input disabled="true" name="dueDate" type="date" class="form-control" id="inputDueDate" placeholder="Due Date">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputStock">Need to Pay</label>
                    <input disabled="true" name="need" min="1" type="number" class="form-control" id="inputNeed" placeholder="Need to Pay" >

                </div>
                <hr>
                <div class="form-group">
                    <label for="inputStock">Name</label>
                    <input type="text" class="form-control" id="inputName" placeholder="Product Name" >
                    <small id="productCode" class="form-text text-muted">Silahkan memilih produk yang tersedia</small>
                    <div>
                        <ul class="list-group" id="listName">
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="inputStock">Added Stock</label>
                            <input name="stock" min="1" type="number" class="form-control" id="inputStock" placeholder="Number of stock">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="inputMinStock">Minimum Stock</label>
                            <input disabled name="minStock" min="1" type="number" class="form-control" id="inputMinStock" placeholder="Minimum stock">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="inputBuy">Buy Price</label>
                            <input disabled name="buyPrice" min="0" type="number" class="form-control" id="inputBuy" placeholder="Rp.">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="inputSell">Sell Price</label>
                            <input disabled name="sellPrice" min="0" type="number" class="form-control" id="inputSell" placeholder="Rp.">
                        </div>
                    </div>
                    <div class="col-md-2 align-self-center justify-content-center">
                        <input type="hidden" name="canAdd" id="canAdd">
                        <button type="button" class="btn btn-block btn-gradient-success mr-2" onclick="addExistingProduct()">Add</button>
                    </div>
                </div>

                <div class="form-group">
                    <button type="button" class="btn btn-block btn-gradient-primary" data-toggle="modal" data-target="#modalNewProduct">+ Add New Product</button>
                </div>

                <div class="form-group">
                    <table class="table table-hover" style="table-layout: fixed;">
                        <thead>
                        <tr>
                            <th class="w-40">Name</th>
                            <th>Added Stock</th>
                            <th>Buy Price</th>
                            <th>Sell Price</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="purchaseProductList">
                        </tbody>
                    </table>
                </div>

                <button type="submit" class="btn btn-gradient-primary mr-2" onclick="addFormData()">Submit</button>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body" id="errorModalBody">
                    Error Message
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalNewProduct" tabindex="-1" role="dialog" aria-labelledby="modalNewProduct" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalNewProduct">Add New Product</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputCode">Kode</label>
                                <input name="code" type="text" class="form-control" id="inputNewCode" placeholder="Kode">
                            </div>
                            <div class="form-group">
                                <label for="inputName">Nama</label>
                                <input name="name" type="text" class="form-control" id="inputNewName" placeholder="Nama" required>
                            </div>
                            <div class="form-group">
                                <label for="inputType">Tipe</label>
                                <input name="type" type="text" class="form-control" id="inputNewType" placeholder="Tipe">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputUnit">Unit</label>
                                <input name="unit" type="text" class="form-control" id="inputNewUnit" placeholder="Unit">
                            </div>
                            <div class="form-group">
                                <label for="inputBrand">Merek</label>
                                <input name="brand" type="text" class="form-control" id="inputNewBrand" placeholder="Merel">
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Deskripsi</label>
                                <input name="description" type="text" class="form-control" id="inputNewDescription" placeholder="Deskripsi">
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputCategory">Kategori</label>
                        <select class="form-control" id="inputNewCategory" name="category">
                            @foreach($categories as $c)
                                <option value="{{$c->id}}">{{$c->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="inputStock">Persediaan</label>
                        <input name="stock" min="1" type="number" class="form-control" id="inputNewStock" placeholder="Jumlah Persediaan" required>
                    </div>

                    <div class="form-group">
                        <label for="inputMinStock">Persediaan Minimum</label>
                        <input name="minStock" min="1" type="number" class="form-control" id="inputNewMinStock" placeholder="Persediaan Minimum" required>
                    </div>

                    <div class="form-group">
                        <label for="inputBuy">Harga Modal</label>
                        <input name="buyPrice" min="0" type="number" class="form-control" id="inputNewBuy" placeholder="Rp." required>
                    </div>

                    <div class="form-group">
                        <label for="inputSell">Harga Jual</label>
                        <input name="sellPrice" min="0" type="number" class="form-control" id="inputNewSell" placeholder="Rp." required>
                    </div>
                    <div id="errorText" class="form-group text-danger">

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" onclick="addNewProduct()">Add</button>
                </div>
            </div>
        </div>
    </div>

    <script !src="">
        let allPurchaseData = []

        $(document).ready(function () {
            $('#inputName').on('keyup', function () {
                let query = $(this).val()
                //ajax for auto complete
                $.ajax({
                    url: "{{route('product-autocomplete')}}",
                    type: "POST",
                    data: {
                        "_token": "{{csrf_token()}}",
                        "query": query
                    },
                    success: function (data) {
                        // console.log('Search Data', data)
                        let htmlFormat = ''
                        if (data.length > 0) {
                            data.forEach(function (item) {
                                htmlFormat += "<li class=\"list-group-item cursor-pointer\" data-value='"+JSON.stringify(item)+"' onclick='console.log(this.id)'>"+item.name+"</li>"
                            })
                        }
                        else {
                            $('#productCode').text('Product code not found! Please select \"Insert New Product\" below')
                            $('#productCode').removeClass('text-success text-muted')
                            $('#productCode').addClass("text-danger")
                            $('#canAdd').val('false')
                        }
                        $('#listName').html(htmlFormat)
                    }
                })
            })

            $('#inputPaymentStatus').change(function () {
                if (this.value === "Hutang") {
                    $('#inputNeed').prop( "disabled", false );
                    $('#inputDueDate').prop( "disabled", false );
                }
                else {
                    $('#inputNeed').prop( "disabled", true );
                    $('#inputDueDate').prop( "disabled", true );
                }
            })

            $(document).on('click', 'li', function(){
                var value = $(this).text();
                $('#inputName').val(value);
                $('#listName').html("");

                console.log('data', this.dataset.value)
                let data = JSON.parse(this.dataset.value)

                $('#productCode').text(data.id)
                $('#productCode').removeClass('text-danger text-muted')
                $('#productCode').addClass("text-success")
                $('#inputBuy').val(data.buy_price)
                $('#inputSell').val(data.sell_price)
                $('#inputMinStock').val(data.min_stock)
                $('#canAdd').val('true')
            });

            //disable enter
            $('#purchaseForm').on('keyup keypress', function(e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13 && !$(e.target).is('textarea')) {
                    e.preventDefault();
                    return false;
                }
            });
        })
        
        function addExistingProduct() {
            let inputStock = $('#inputStock')
            let inputBuy = $('#inputBuy')
            let canAdd = $('#canAdd')

            if (inputStock.val() < 1 || inputStock.val() === undefined){
                $('#errorModalBody').text('Stock must be more than 0')
                $('#modal').modal('show')
            }
            else if (inputBuy.val() < 1 || inputBuy.val() === undefined){
                $('#errorModalBody').text('Buy Price must be more than 0')
                $('#modal').modal('show')
            }
            else if (canAdd.val() === 'false'){
                $('#errorModalBody').text('Please check your product name')
                $('#modal').modal('show')
            }
            else {
                let data = {
                    "id" : $('#productCode').text(),
                    "name": $('#inputName').val(),
                    "stock": inputStock.val(),
                    "buyPrice": inputBuy.val(),
                    "sellPrice": $('#inputSell').val()
                }
                
                if (allPurchaseData.length > 0) {
                    allPurchaseData.forEach(function (item) {
                        if (item.id === data.id && item.name === data.name) {
                            $('#errorModalBody').text('Current product already listed!')
                            $('#modal').modal('show')
                            return
                        }
                    }) 
                }
                allPurchaseData.push(data)
                $('#purchaseProductList').append("\
                    <tr id='row"+data.id+"'>\
                        <td>"+data.name+"</td>\
                        <td class='text-success'> <i class=\"mdi mdi-arrow-up   \"></i> "+data.stock+"</td>\
                        <td>Rp. "+data.buyPrice+"</td>\
                        <td>Rp. "+data.sellPrice+"</td>\
                        <td>\
                            <button type=\"button\" class=\"btn btn-gradient-danger btn-rounded btn-icon\" onclick=\"removeFromTable('"+data.id+"', '"+data.name+"')\">\
                                <i class=\"mdi mdi-close\"></i>\
                            </button>\
                        </td>\
                    </tr>"
                )

                inputBuy.val('')
                inputStock.val('')
                canAdd.val('')
                $('#inputName').val('')
                $('#inputSell').val('')
                $('#inputMinStock').val('')
            }
        }

        function removeFromTable(id, name) {
            allPurchaseData.filter(function (item) {
                return item.id === id && item.name === name
            })

            $('#row'+id).remove()
        }

        function addNewProduct() {
            let data = {
                "id" : '',
                "code": '',
                "name": '',
                "type": '',
                "unit": '',
                "brand": '',
                "description": '',
                "category": '',
                "stock": '',
                "minStock": '',
                "buyPrice": '',
                "sellPrice": ''
            }

            let name = $('#inputNewName').val()
            let stock = $('#inputNewStock').val()
            let minStock = $('#inputNewMinStock').val()
            let buyPrice = $('#inputNewBuy').val()
            let sellPrice = $('#inputNewSell').val()

            let errorTxt = ''
            $('#errorText').text(errorTxt)

            if (name === "") errorTxt += "Name must be filled <br>"
            if (stock === "" || stock < 1) errorTxt += "Stock must be filled<br>"
            if (minStock === "" || minStock < 1) errorTxt += "Minimum Stock must be filled<br>"
            if (buyPrice === "" || buyPrice < 1) errorTxt += "Buy Price must be filled<br>"
            if (sellPrice === "" || sellPrice < 1) errorTxt += "Sell Price must be filled<br>"
            $('#errorText').html(errorTxt)
            
            if (errorTxt === '') {
                data.code = $('#inputNewCode').val()
                data.name = name
                data.type = $('#inputNewType').val()
                data.unit = $('#inputNewType').val()
                data.brand = $('#inputNewBrand').val()
                data.description = $('#inputNewDescription').val()
                data.category = $('#inputNewCategory').val()
                data.stock = stock
                data.minStock = minStock
                data.sellPrice = sellPrice
                data.buyPrice = buyPrice
                console.log(data)
                allPurchaseData.push(data)
                $('#purchaseProductList').append("\
                    <tr id='row"+data.id+"'>\
                        <td>"+data.name+"</td>\
                        <td class='text-success'> <i class=\"mdi mdi-arrow-up   \"></i> "+data.stock+"</td>\
                        <td>Rp. "+data.buyPrice+"</td>\
                        <td>Rp. "+data.sellPrice+"</td>\
                        <td>\
                            <button type=\"button\" class=\"btn btn-gradient-danger btn-rounded btn-icon\" onclick=\"removeFromTable('"+data.id+"', '"+data.name+"')\">\
                                <i class=\"mdi mdi-close\"></i>\
                            </button>\
                        </td>\
                    </tr>"
                )

                $('#inputNewName').val('')
                $('#inputNewStock').val('')
                $('#inputNewMinStock').val('')
                $('#inputNewBuy').val('')
                $('#inputNewSell').val('')
                $('#inputNewCode').val('')
                $('#inputNewColor').val('')
                $('#inputNewType').val('')
                $('#inputNewUnit').val('')

                $('#modalNewProduct').modal('hide')
            }
        }

        function addFormData() {
            if (allPurchaseData.length < 1) {
                $("form").submit(function(e){
                    e.preventDefault();
                });
                $('#errorModalBody').text('Please input the purchase data first')
                $('#modal').modal('show')
                return false
            }
            else {
                $('#formData').val(JSON.stringify(allPurchaseData))
            }
        }

    </script>
@endsection

