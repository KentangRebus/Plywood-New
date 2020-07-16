
@extends('layout.default_layout')

@section('title', 'Purchase')

@section('content')

    <div class="page-header">
        <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                      <i class="mdi mdi-archive"></i>
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

            </form>
        </div>
    </div>

    <script !src="">
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
        })
    </script>

@endsection

