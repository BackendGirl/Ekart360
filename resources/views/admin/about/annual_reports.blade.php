@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<!-- Start Content-->
<div class="main-body">
    <div class="page-wrapper">

       <!-- [ Banner Content ] start -->
       @include('admin.layouts.inc.banner')
        <!-- [ Banner Content ] end -->
        
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $title }}</h5>
                        <a href="{{route('admin.recruitment-data.create')}}" class="btn btn-primary btn-sm float-right"><i class="far fa-plus"></i> Add</a>
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
                                        <th>Title</th>
                                        <th>File</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($profile as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->title }}</td>
                                        <td>
                                            @if(str_contains($value->file, '/uploads/recruitment/'))
                                              {{ URL::to($value->file) }}
                                            @else
                                              {{ $value->file }}
                                            @endif                                            
                                        </td>
                                        <td>{{ date('d-m-Y',$value->date) }}</td>
                                        <td>
                                            @if( $value->status == 'active' )
                                            <span class="badge badge-pill badge-success">{{ __('status_active') }}</span>
                                            @else
                                            <span class="badge badge-pill badge-warning">{{ __('status_inactive') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('admin.recruitment-data.edit',$value->id)}}" class="btn btn-icon btn-primary btn-sm">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <a href="{{route('admin.recruitment_data.delete',$value->id)}}" class="btn btn-icon btn-danger btn-sm">
                                                <i class="far fa-trash-alt"></i>
                                            </a>
                                           
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
