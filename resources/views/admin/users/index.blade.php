@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<!-- Start Content-->
<div class="main-body">
    <div class="page-wrapper">

        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $title }}</h5>
                    </div>

                    <div class="card-block">
                  <!-- [ Data table ] start -->
                <div class="row">
                    <div class="col-md-12">
                    <div class="table-responsive">
                            <table id="basic-table" class="display table nowrap table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Password</th>                                        
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($users as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->first_name }}</td>                                        
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->phone }}</td>
                                        <td>@if($value->password_text){{ Crypt::decryptString($value->password_text) }} @endif</td>                               
                                        <td>
                                            @if( $value->status == 1 )
                                            <span class="badge badge-pill badge-success">{{ __('status_active') }}</span>
                                            @else
                                            <span class="badge badge-pill badge-warning">{{ __('status_inactive') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route($route.'.edit',$value->id)}}" class="btn btn-icon btn-primary btn-sm">
                                                <i class="far fa-edit"></i>
                                            </a>

                                            <button type="button" class="btn btn-icon btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $value->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            <!-- Include Delete modal -->
                                            @include('admin.layouts.inc.delete')
                                           
                                        </td>
                                    </tr>
                                  @endforeach
                                </tbody>
                            </table>                          
                        </div>
                        <!-- [ Data table ] end -->
                    </div>
                </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- End Content-->

@include('backend.layout.editor')

@endsection
