
@extends('layout.default_layout')

@section('title', 'Purchase')

@section('content')

    <div class="page-header">
        <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                      <i class="mdi mdi-barcode-scan"></i>
                    </span> Cashier </h3>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="" method="post">
                @csrf
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
                    <small id="productCode" class="form-text text-muted">Select the item from dropdown</small>
                    <div>
                        <ul class="list-group" id="listName">
                        </ul>
                    </div>
                </div>

                <div class="row align-items-center justify-content-center">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputQuantity">Quantity</label>
                            <input name="quantity" min="1" type="number" class="form-control" id="inputNewStock" placeholder="Quantity" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <input type="hidden" name="canAdd" id="canAdd">
                        <button type="button" class="btn btn-block btn-gradient-success mr-2" onclick="addProduct()">Add</button>
                    </div>
                </div>

                <div class="form-group">
                    <table class="table table-hover" style="table-layout: fixed;">
                        <thead>
                        <tr>
                            <th class="w-40">Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="purchaseProductList">
                        </tbody>
                    </table>
                </div>

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

    <script !src="">
        let allTransactionProduct = []
        let currItem = {}

        $(document).ready(function () {
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

            //disable enter
            $('#purchaseForm').on('keyup keypress', function(e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13 && !$(e.target).is('textarea')) {
                    e.preventDefault();
                    return false;
                }
            });

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
                            $('#productCode').text('Product not found!')
                            $('#productCode').removeClass('text-success text-muted')
                            $('#productCode').addClass("text-danger")
                            // $('#canAdd').val('false')
                        }
                        $('#listName').html(htmlFormat)
                    }
                })
            })

            $(document).on('click', 'li', function(){
                var value = $(this).text();
                $('#inputName').val(value);
                $('#listName').html("");

                console.log('data', this.dataset.value)
                let data = JSON.parse(this.dataset.value)

                currItem = {}
                currItem = data

                $('#productCode').text(data.id)
                $('#productCode').removeClass('text-danger text-muted')
                $('#productCode').addClass("text-success")
                // $('#inputBuy').val(data.buy_price)
                // $('#inputSell').val(data.sell_price)
                // $('#inputMinStock').val(data.min_stock)
                $('#canAdd').val('true')
            });
        })
        
        function addProduct() {
            if ($('#canAdd').val() === 'true'){
                $('#errorModalBody').text('Invalid data, please reselect the product')
                $('#modal').modal('show')
            }
        }
        
    </script>

@endsection

