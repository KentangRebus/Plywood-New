
@extends('layout.default_layout')

@section('title', 'Purchase')

@section('content')

    <div class="page-header">
        <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                      <i class="mdi mdi-archive"></i>
                    </span> Pengaturan Pembelian </h3>
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

            <a href="{{route('purchase-insert-view')}}"><button class="btn btn-gradient-success">+ Tambah Pembelian</button></a>

            <div class="mt-3">
                <table class="table table-hover" style="table-layout: fixed;">
                    <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th class="w-25">Kode</th>
                        <th>Status</th>
                        <th>Kekurangan</th>
                        <th>Jatuh Tempo</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $d)
                        @if(\Carbon\Carbon::now()->add(3, 'day')->gte($d->due_date) && $d->is_done == 0)
                        <tr class="table-danger">
                        @else
                        <tr>
                        @endif
                            <td>{{$d->created_at}}</td>
                            <td class="text-truncate">{{$d->id}}</td>
                            <td>
                                @if($d->is_done == 1)
                                    <label class="badge badge-success">Lunas</label>
                                @else
                                    <label class="badge badge-danger">Hutang</label>
                                @endif
                            </td>
                            <td>
                                @if($d->is_done == 1)
                                    <div class="text-success">
                                    -
                                    </div>
                                @else
                                    <div class="text-danger">
                                        - Rp. {{$d->needs}}
                                    </div>
                                @endif
                            </td>
                            <td>
                                @if($d->is_done == 1)
                                    <div class="text-success">
                                        -
                                    </div>
                                @else
                                    <div class="text-danger">
                                        {{$d->due_date}}
                                    </div>
                                @endif
                            </td>
                            <td class="row">
                                <div class="mx-2">
                                    <a href="{{route('purchase-detail-view', ['id' => $d->id])}}">
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
                <form id="deleteForm" action="{{route('purchase-delete')}}" method="post">
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

