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
                            <legend>Main Photo</legend>
                            <div class="row gx-2">                                                          
                                <div class="col-md-4">
                                    <label for="main_title" class="col-form-label">Title </label>
                                    <input type="text" name="main_title" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="main_sub_title" class="col-form-label">Sub Title </label>
                                    <input type="text" name="main_sub_title" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="main_photo" class="col-form-label">{{ __('field_photo') }} <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="main_photo" id="main_photo" value="{{ old('main_photo') }}">
                                </div>                               
                            </div>
                          </fieldset>
                          <fieldset class="row scheduler-border">
                            <legend>Side Photo</legend>
                            <div class="row gx-2">                                                          
                                <div class="col-md-4">
                                    <label for="side_title" class="col-form-label">Title </label>
                                    <input type="text" name="side_title" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="side_sub_title" class="col-form-label">Sub Title </label>
                                    <input type="text" name="side_sub_title" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="side_photo" class="col-form-label">{{ __('field_photo') }} <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="side_photo" id="side_photo" value="{{ old('side_photo') }}">
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
