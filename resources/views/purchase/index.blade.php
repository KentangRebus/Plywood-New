
@extends('layout.default_layout')

@section('title', 'Purchase')

@section('content')

    <div class="page-header">
        <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                      <i class="mdi mdi-archive"></i>
                    </span> Manage Purchase </h3>
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

            <a href="{{route('purchase-insert-view')}}"><button class="btn btn-gradient-success">+ Add Purchase</button></a>

            <div class="mt-3">
                <table class="table table-hover" style="table-layout: fixed;">
                    <thead>
                    <tr>
                        <th>Time</th>
                        <th>Code</th>
                        <th>Status</th>
                        <th>Need</th>
                        <th>Due Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="" title=""></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="row">
                                <button type="submit" class="btn btn-gradient-dark btn-rounded btn-icon">
                                    <i class="mdi mdi-information-variant"></i>
                                </button>
                                <button type="button" class="btn btn-gradient-danger btn-rounded btn-icon" data-toggle="modal" data-target="#modal">
                                    <i class="mdi mdi-close"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    @endsection

