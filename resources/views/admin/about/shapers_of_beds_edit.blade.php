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
                    <form method="post" action="{{route('admin.about.shapers_of_beds.update')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                            <div class="row gx-2">                                                          
                                <div class="col-md-6">
                                    <label for="name" class="col-form-label">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{$data->name}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="status" class="col-form-label">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="active">Active</option>
                                        <option value="inactive" @if($data->status=='inactive') selected @endif >Inactive</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="photo" class="col-form-label">Photo <span class="text-danger">*</span></label>
                                    <input type="file" name="photo" class="form-control">
                                    @error('photo')
                                       <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div> 
                                <div class="col-md-6">
                                    <label for="photo" class="col-form-label">Old Photo</label><br>
                                    @if($data->photo)
                                        <img src="{{URL::to($data->photo)}}" style="width:150px;">
                                        <input type="hidden" value="{{$data->photo}}" name="hidden_photo">
                                    @endif
                                </div> 
                                <input type="hidden" value="{{$data->id}}" name="hidden_id">
                            </div>                           
                                <div class="form-group col-md-3">
                                    <button type="submit" class="btn btn-info btn-filter">Update</button>
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
