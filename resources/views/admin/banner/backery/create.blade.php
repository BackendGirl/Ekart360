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
                    <form method="post" action="{{route($route.'.store')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                          <fieldset class="row scheduler-border">
                            <legend>Left Photo</legend>
                            <div class="row gx-2">                                                          
                                <div class="col-md-4">
                                    <label for="left_title" class="col-form-label">Title </label>
                                    <input type="text" name="left_title" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="left_sub_title" class="col-form-label">Sub Title</label>
                                    <input type="text" name="left_sub_title" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="left_photo" class="col-form-label">{{ __('field_photo') }} <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="left_photo" id="left_photo" value="{{ old('left_photo') }}">
                                </div>                               
                            </div>
                          </fieldset>
                          <fieldset class="row scheduler-border">
                            <legend>Center Photo</legend>
                            <div class="row gx-2">                                                          
                                <div class="col-md-4">
                                    <label for="center_title" class="col-form-label">Title </label>
                                    <input type="text" name="center_title" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="center_sub_title" class="col-form-label">Sub Title </label>
                                    <input type="text" name="center_sub_title" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="center_photo" class="col-form-label">{{ __('field_photo') }} <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="center_photo" id="center_photo" value="{{ old('center_photo') }}">
                                </div>                               
                            </div>
                          </fieldset>
                          <fieldset class="row scheduler-border">
                            <legend>Right Photo</legend>
                            <div class="row gx-2">                                                          
                                <div class="col-md-4">
                                    <label for="right_title" class="col-form-label">Title </label>
                                    <input type="text" name="right_title" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="right_sub_title" class="col-form-label">Sub Title </label>
                                    <input type="text" name="right_sub_title" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="right_photo" class="col-form-label">{{ __('field_photo') }} <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="right_photo" id="right_photo" value="{{ old('right_photo') }}">
                                </div>                               
                            </div>
                          </fieldset>
                          <div class="row gx-2">
                                <div class="col-md-4">
                                    <label for="status" class="col-form-label">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>                           
                                <div class="form-group col-md-3">
                                    <button type="submit" class="btn btn-info btn-filter">Add</button>
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
