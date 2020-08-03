
@extends('layout.default_layout')

@section('title', 'Purchase')

@section('content')

    <div class="page-header">
        <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                      <i class="mdi mdi-barcode-scan"></i>
                    </span> Transaction </h3>
    </div>
    <div class="card">
        <div class="card-body">
            <div>
                @if (session()->has('msg'))
                    <div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    {{ session()->get('msg') }}
                                </div>
                                <div class="modal-body" id="errorModalBody">
                                    Print Faktur Transaction?
                                </div>
                                <div class="modal-footer">
                                    <form action="{{route('transaction-print', ['id'=>session()->get('print_id')])}}" method="get">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Print</button>
                                    </form>
{{--                                    <a href="{{route('transaction-print', ['id'=>session()->get('print_id')])}}" onclick="openModal()">--}}
{{--                                    </a>--}}
                                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">No</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <form action="{{route('transaction-insert')}}" method="post">
                @csrf

                <div class="form-group">
                    <label for="inputStock">Nama Customer</label>
                    <input type="text" class="form-control" id="inputCustomerName" placeholder="Nama Customer" >
                    <input type="hidden" name="customerId" id="customerId" value="">
                    <div>
                        <ul class="list-group" id="listCustomerName">
                        </ul>
                    </div>
                    <small id="memberCode" class="form-text text-muted">silahkan pilih nama customer yang tersedia</small>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="inputTransactionDate">Tanggal Transaksi</label>
                        <input name="createdAt" type="date" class="form-control" id="inputTransactionDate" placeholder="Tanggal Transaksi" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputInvoiceNumber">Nomor Faktur</label>
                        <input name="invoiceNumber" type="text" class="form-control" id="inputInvoiceNumber" placeholder="Nomor Faktur" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputPaymentStatus">Status Pembayaran</label>
                            <select name="paymentStatus" class="form-control" id="inputPaymentStatus">
                                <option value="Lunas">Lunas</option>
                                <option value="Hutang">Hutang</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputDueDate">Jatuh Tempo</label>
                            <input disabled="true" name="dueDate" type="date" class="form-control" id="inputDueDate" placeholder="Jatuh Tempo" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputStock">Kekurangan</label>
                    <input disabled="true" name="need" min="1" type="number" class="form-control" id="inputNeed" placeholder="Rp." required>
                </div>

                <hr>

                <div class="form-group">
                    <label for="inputStock">Nama Produk</label>
                    <input type="text" class="form-control" id="inputName" placeholder="Product Name" >
                    <small id="productCode" class="form-text text-muted">Silahkan pilih produk yang tersedia</small>
                    <div>
                        <ul class="list-group" id="listProductName">
                        </ul>
                    </div>
                </div>

                <div class="row align-items-center justify-content-center">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputQuantity">Jumlah Pembelian</label>
                            <input name="quantity" min="1" max="10" type="number" class="form-control" id="inputQuantity" placeholder="Quantity">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <input type="hidden" name="canAdd" id="canAdd" value="false">
                        <button type="button" class="btn btn-block btn-gradient-success mr-2" onclick="addProduct()">Tambah</button>
                    </div>
                </div>

                <div class="form-group">
                    <table class="table table-hover" style="table-layout: fixed;">
                        <thead>
                        <tr>
                            <th class="w-40">Nama Produk</th>
                            <th>Jumlah Pembelian</th>
                            <th>Harga Satuan</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="transactionProductList">

                        </tbody>
                    </table>
                </div>
                <div class="form-group">
{{--                    <h5>Jumlah Netto: Rp.<span id="total"> 90,000 </span></h5>--}}
{{--                    <h5>PPN (10%): Rp. <span id="ppn"> 9,000 </span></h5>--}}
                    <input type="hidden" name="totals" value="0" id="totals">
                    <h4 class="font-weight-bold">Total Tagihan: Rp. <span id="grandTotal"> </span></h4>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" id="productList" name="productList" value="">
                        <button type="submit" class="btn btn-block btn-gradient-primary mr-2" onclick="addFormData()">Submit</button>
                    </div>
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
        let grandTotal = 0

        $(document).ready(function () {
            $('#inputCustomerName').on('keyup', function () {
                let query = $(this).val()
                //ajax for auto complete
                $.ajax({
                    url: "{{route('customer-autocomplete')}}",
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
                                htmlFormat += "<li class=\"list-group-item cursor-pointer customerList\" data-value='"+JSON.stringify(item)+"' onclick='console.log(this.id)'>"+item.name+"</li>"
                            })
                        }
                        else {
                            $('#memberCode').text('Nama Customer tidak ditemukan silahkan coba ulang')
                            $('#memberCode').removeClass('text-success text-muted')
                            $('#memberCode').addClass("text-danger")
                        }
                        $('#listCustomerName').html(htmlFormat)
                    }
                })
            })

            $(document).on('click', '.customerList', function(){
                var value = $(this).text();
                $('#inputCustomerName').val(value);
                $('#listCustomerName').html("");

                console.log('data', this.dataset.value)
                let data = JSON.parse(this.dataset.value)

                $('#customerId').val(data.id);
                $('#memberCode').text(data.id)
                $('#memberCode').removeClass('text-danger text-muted')
                $('#memberCode').addClass("text-success")
            });

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
                let keyCode = e.keyCode || e.which;
                if (keyCode === 13 && !$(e.target).is('textarea')) {
                    e.preventDefault()
                    return false
                }
            })

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
                                htmlFormat += "<li class=\"list-group-item cursor-pointer productList\" data-value='"+JSON.stringify(item)+"' onclick='console.log(this.id)'>"+item.name+"</li>"
                            })
                        }
                        else {
                            $('#productCode').text('Product not found!')
                            $('#productCode').removeClass('text-success text-muted')
                            $('#productCode').addClass("text-danger")
                            // $('#canAdd').val('false')
                        }
                        $('#listProductName').html(htmlFormat)
                    }
                })
            })

            if ($('#printModal') !== undefined || $('#printModal') !== null )
                $('#printModal').modal('show')

            $(document).on('click', '.productList', function(){
                var value = $(this).text();
                $('#inputName').val(value);
                $('#listProductName').html("");

                // console.log('data', this.dataset.value)
                let data = JSON.parse(this.dataset.value)

                currItem = {}
                currItem = data

                $('#productCode').text(data.id)
                $('#productCode').removeClass('text-danger text-muted')
                $('#productCode').addClass("text-success")

                $('#canAdd').val('true')
            })

            setGrandTotal(0)

        })
        
        function addProduct() {
            if ($('#canAdd').val() === 'false'){
                $('#errorModalBody').text('Invalid data, please reselect the product')
                $('#modal').modal('show')
            }
            else if($('#inputQuantity').val() < 0 || $('#inputQuantity').val() < 0){
                $('#errorModalBody').text('Please fill the quantity')
                $('#modal').modal('show')
            }
            else if ($('#inputQuantity').val() > currItem.stock) {
                $('#errorModalBody').text('The maximum quantity is ' + currItem.stock)
                $('#modal').modal('show')
            }
            else {
                allTransactionProduct.push({
                    'data': currItem,
                    'quantity': $('#inputQuantity').val()
                })
                console.log('data', currItem)
                $('#transactionProductList').append("\
                <tr id='row"+currItem.id+"'>\
                    <td>"+currItem.name+"</td>\
                    <td>"+$('#inputQuantity').val()+"</td>\
                    <td>Rp. "+currItem.sell_price.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+"</td>\
                    <td> Rp. "+(currItem.sell_price * $('#inputQuantity').val()).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+"</td>\
                    <td>\
                        <button type=\"button\" class=\"btn btn-gradient-danger btn-rounded btn-icon\" onclick=\"removeFromTable('"+currItem.id+"', '"+currItem.sell_price * $('#inputQuantity').val()+"')\">\
                            <i class=\"mdi mdi-close\"></i>\
                        </button>\
                    </td>\
                </tr>\
                ")

                setGrandTotal(currItem.sell_price * $('#inputQuantity').val())
                $('#canAdd').val('false')
                $('#inputQuantity').val('')
                $('#inputName').val('')
            }
        }

        function removeFromTable(id, subtotal) {
            allTransactionProduct.filter(function (item) {
                return item.data.id === id
            })
            $('#row'+id).remove()
            console.log('removeItem', this)
            setGrandTotal(-subtotal)
        }

        function addFormData() {
            $('#productList').val(JSON.stringify(allTransactionProduct))
        }
        
        function openModal() {
            $('#printModal').modal('show');
        }
        
        function setGrandTotal(price) {
            grandTotal += price
            $('#grandTotal').text(grandTotal.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"))
            $('#totals').val(grandTotal)
        }
    </script>

@endsection

