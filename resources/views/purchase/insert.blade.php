
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
            <form class="forms-sample" method="post" action="">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputPaymentStatus">Payment Status</label>
                            <select name="paymentStatus" class="form-control" id="inputPaymentStatus">
                                <option value="1">Lunas</option>
                                <option value="0">Hutang</option>
                            </select>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputDueDate">Due Date</label>
                            <input name="dueDate" type="date" class="form-control" id="inputDueDate" placeholder="Due Date">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputStock">Name</label>
                    <input name="stock" min="1" type="text" class="form-control" id="inputName" placeholder="Product Name" >
                    <div>
                        <ul class="list-group" id="listName">
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputStock">Stock</label>
                            <input name="stock" min="1" type="number" class="form-control" id="inputStock" placeholder="Number of stock">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputBuy">Buy Price</label>
                            <input name="buyPrice" min="0" type="number" class="form-control" id="inputBuy" placeholder="Rp.">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <table class="table table-hover" style="table-layout: fixed;">
                        <thead>
                        <tr>
                            <th class="w-40">Name</th>
                            <th>Stock</th>
                            <th>Buy Price</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <button type="button" class="btn btn-gradient-danger btn-rounded btn-icon" data-toggle="modal" data-target="#modal">
                                        <i class="mdi mdi-close"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
            </form>
        </div>
    </div>

    <script !src="">
        $(document).ready(function () {
            $('#inputName').on('keyup', function () {
                let query = $(this).val()

                $.ajax({
                    url: "{{route('product-autocomplete')}}",
                    type: "POST",
                    data: {
                        "_token": "{{csrf_token()}}",
                        "query": query
                    },
                    success: function (data) {
                        console.log('Search Data', data)
                        let htmlFormat = ''
                        data.forEach(function (item) {
                            htmlFormat += "<li class=\"list-group-item cursor-pointer\" id="+item.id+" onclick='console.log(this.id)'>"+item.name+"</li>"
                        })
                        $('#listName').html(htmlFormat)
                    }
                })
            })

            $(document).on('click', 'li', function(){
                var value = $(this).text();
                $('#inputName').val(value);
                $('#listName').html("");
            });
        })
    </script>
@endsection

