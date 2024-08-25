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
                    <form method="post" action="{{route($route.'.update',$data->id)}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        @method('patch')
                        <div class="row gx-2">
                            <div class="col-md-6">
                               <label for="title" class="col-form-label">Title <span class="text-danger">*</span></label>
                               <input type="text" name="title" value="{{$data->title}}" class="form-control" id="title">
                            </div>
                            <div class="col-md-6">@include('admin.layouts.inc.side_multi_images')</div>
                        </div>
                        <div class="row gx-2">
                            <div class="col-md-12">
                            <div class="form-group">
                                <label for="editor" class="col-form-label">Description <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="editor" name="description" placeholder="Add description">{{$data->description}}</textarea>
                                @error('description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
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
