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
                            <div class="row">
                                 <div class="col-md-4">
                                    <label for="photo" class="col-form-label">Photo <span class="text-danger">*</span></label>
                                    <input type="file" name="photo" class="form-control">
                                </div>   
                                <div class="col-md-2">
                                    <label for="photo" class="col-form-label">Old Photo</label><br>
                                    @if($data->photo)
                                        <img src="{{URL::to($data->photo)}}" style="width:150px;">
                                        <input type="hidden" name="hidden_img" value="{{$data->photo}}">
                                    @endif
                                </div> 
                                <div class="col-md-2">
                                    <label for="position" class="col-form-label">Position</label>
                                    <input type="number" name="position" class="form-control" value="{{$data->position}}">
                                </div>   
                                <div class="col-md-2">
                                    <label for="status" class="col-form-label">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="active">Active</option>
                                        <option value="inactive" @if($data->status=='inactive') selected @endif >Inactive</option>
                                    </select>
                                </div> 
                             </div>  
                             <div class="row">
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


@endsection
