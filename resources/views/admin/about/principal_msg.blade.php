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
                    </div>
                    
                    <div class="card-block">
                    <form method="post" action="{{route('admin.about.principal_msg.update')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                            <div class="row gx-2">

                            <div class="card-block">
                    <form method="post" action="{{route('admin.about.college_anthem.update')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                          <div class="row gx-2">

                                    <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="editor" class="col-form-label">Description <span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="editor" name="description" placeholder="Add description">{{$data->principals_message}}</textarea>
                                        @error('description')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    </div>

                                    <div class="col-md-4">
                                <!-- [ Banner Content ] start -->
                                @include('admin.layouts.inc.side_multi_images')
                                    <!-- [ Banner Content ] end -->
                                    </div>

                                <div class="form-group col-md-3">
                                    <button type="submit" class="btn btn-info btn-filter">Update</button>
                                </div>
                            </div>
                        </form>
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
