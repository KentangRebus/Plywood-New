
@extends('layout.default_layout')

@section('title', 'Purchase')

@section('content')

    <div class="page-header">
        <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                      <i class="mdi mdi-barcode"></i>
                    </span> Manage Transaction </h3>
    </div>
    <div class="card">
        <div class="card-body">
            <div>
                <table class="table table-hover" style="table-layout: fixed;">
                    <thead>
                    <tr>
                        <th>Time</th>
                        <th class="w-30">Code</th>
{{--                        <th>Status</th>--}}
                        <th>Need</th>
                        <th>Due Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $d)
                        @if($d->is_done == 0 && Carbon\Carbon::now()->add(3, 'day')->gte($d->due_date))
                            <tr class="table-danger cursor-pointer">
                        @else
                            <tr class="cursor-pointer">
                        @endif
                            <td class="text-truncate" title="{{$d->created_at}}">{{$d->created_at}}</td>
                            <td class="text-truncate" title="{{$d->id}}">{{$d->id}}</td>
                            @if($d->is_done == 0) {{-- status payment hutang--}}
{{--                                <td>Hutang</td>--}}
                                <td class="text-truncate text-danger" title="Rp. {{number_format($d->needs)}}">Rp. {{number_format($d->needs)}}</td>
                                <td class="text-truncate" title="{{$d->due_date}}">{{$d->due_date}}</td>
                                @else
{{--                                <td>Lunas</td>--}}
                                <td> - </td>
                                <td> - </td>
                            @endif
                                <td class="row">
                                    <div class="mx-2">
                                        <a href="{{route('transaction-detail',['id'=>$d->id])}}">
                                            <button type="submit" class="btn btn-gradient-dark btn-rounded btn-icon">
                                                <i class="mdi mdi-information-variant"></i>
                                            </button>
                                        </a>
                                    </div>
                                    <button type="button" class="btn btn-gradient-danger btn-rounded btn-icon" data-toggle="modal" data-target="#modal" onclick="deletePurchaseData('{{$d->id}}')">
                                        <i class="mdi mdi-close"></i>
                                    </button>
                                </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div>
                    {{$data->links()}}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Delete this transaction?</h4>
                </div>
                <form id="deleteForm" action="{{route('transaction-delete')}}" method="post">
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
        function deletePurchaseData(id) {
            $('#inputId').val('');
            $('#inputId').val(id);
        }
    </script>

@endsection

