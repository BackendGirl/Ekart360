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
                        <input type="hidden" name="hidden_photo" value="{{$data->center_photo}}">
                            <div class="row gx-2">                                                          
                                <div class="col-md-3">
                                    <label for="title" class="col-form-label">Title </label>
                                    <input type="text" name="title" class="form-control" value="{{ $data->center_title }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="sub_title" class="col-form-label">Sub Title </label>
                                    <input type="text" name="sub_title" class="form-control" value="{{ $data->center_sub_title }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="photo" class="col-form-label">{{ __('field_photo') }} <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="photo" id="photo" value="{{ $data->center_photo }}">
                                </div>     
                                <div class="col-md-3">
                                    <label for="" class="col-form-label">Old {{ __('field_photo') }}</label><br>
                                    @if($data->center_photo)
                                        <img src="{{URL::to($data->center_photo)}}" class="img-fluid zoom" style="max-width:80px" alt="{{$data->center_photo}}">
                                    @else
                                        <img src="{{URL::to('public/backend/img/thumbnail-default.jpg')}}" class="img-fluid zoom" style="max-width:80px" alt="avatar.png">
                                    @endif
                                </div>                           
                            </div>
                          <div class="row gx-2">
                                <div class="col-md-3">
                                    <label for="status" class="col-form-label">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="active">Active</option>
                                        <option value="inactive" @if($data->status == 'inactive') selected @endif>Inactive</option>
                                    </select>
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
