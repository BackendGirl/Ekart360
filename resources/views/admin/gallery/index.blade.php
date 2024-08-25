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
                        <a href="{{route('admin.gallery.create')}}" class="btn btn-primary btn-sm float-right"><i class="far fa-plus"></i> Add</a>
                    </div>

                    <div class="card-block">
                  <!-- [ Data table ] start -->
                  <div class="table-responsive">
                            <table id="basic-table" class="display table nowrap table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Sub Category</th>
                                        <th>Category</th>
                                        <th>Photo</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($gallery as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->title }}</td>                                        
                                        <td>{{ $value->sub_cat_title }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>
                                            @if($value->photo)
                                                <img src="{{URL::to($value->photo)}}" class="img-fluid zoom" style="max-width:80px" alt="{{$value->photo}}">
                                            @else
                                                <img src="{{URL::to('storage/photos/thumbnail-default.jpg')}}" class="img-fluid" style="max-width:80px" alt="avatar.png">
                                            @endif
                                        </td>  
                                        <td>
                                            @if( $value->status == 'active' )
                                            <span class="badge badge-pill badge-success">{{ __('status_active') }}</span>
                                            @else
                                            <span class="badge badge-pill badge-warning">{{ __('status_inactive') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                          <a href="{{route('admin.gallery.edit',$value->id)}}" class="btn btn-icon btn-primary btn-sm">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-icon btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $value->id }}" title="Delete">
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
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- End Content-->

@endsection
