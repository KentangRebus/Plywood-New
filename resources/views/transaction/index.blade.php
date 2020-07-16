
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
            admin
            <a href="{{route('purchase-insert-view')}}"><button class="btn btn-gradient-success">+ Add Purchase</button></a>

            <div class="mt-3">
                <table class="table table-hover" style="table-layout: fixed;">
                    <thead>
                    <tr>
                        <th>Time</th>
                        <th class="w-25">Code</th>
                        <th>Status</th>
                        <th>Need</th>
                        <th>Due Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

