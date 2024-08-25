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
                                <div class="col-md-4">
                                    <label for="title" class="col-form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control" value="{{$data->title}}">
                                </div>
                                <div class="col-md-4">
                                    <label for="category" class="col-form-label">Category <span class="text-danger">*</span></label>
                                    <select name="category" id="category" class="form-control">
                                        <option value="">--Select any category--</option>
                                        @foreach($categories as $key=>$cat_data)
                                        <option value='{{$cat_data->id}}' @if($cat_data->id == $data->category) selected @endif>{{$cat_data->title}}</option>
                                        @endforeach
                                    </select>
                                </div>                             
                                <div class="col-md-4">
                                    <label for="date" class="col-form-label">Date <span class="text-danger">*</span></label>
                                    <input type="date" name="date" class="form-control" value="{{$data->date}}" id="date">
                                </div>
                                <div class="col-md-3">
                                    <label for="added_by" class="col-form-label">Added By <span class="text-danger">*</span></label>
                                    <input type="text" name="added_by" class="form-control" value="{{$data->added_by ??'Admin'}}">
                                </div>                               
                                <div class="col-md-3">
                                    <label for="status" class="col-form-label">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="active">Active</option>
                                        <option value="inactive" @if($data->status == 'inactive') selected @endif>Inactive</option>
                                    </select>
                                </div>
                                 <div class="col-md-3">
                                    <label for="photo" class="col-form-label">Photo <span class="text-danger">*</span></label>
                                    <input type="file" name="photo" class="form-control">
                                </div>   
                                <div class="col-md-3">
                                     <label for="inputPhoto" class="col-form-label">Old Photo <span class="text-danger">*</span></label><br>
                                        @php $data->photo ? $img = URL::to($data->photo) : $img = URL::to('public/backend/img/thumbnail-default.jpg') @endphp
                                         <img src="{{$img}}" style="width:100px;">
                                         <input type="hidden" name="hidden_photo" value="{{$data->photo}}">
                                         <input type="hidden" name="old_category" value="{{$data->category}}">
                                </div>    
                            </div>
                            <div class="row gx-2">                                                          
                                <div class="col-md-12">
                                    <label for="description" class="col-form-label">Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control editor" id="description" name="description" placeholder="Add description">{{$data->description}}</textarea>
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

@include('admin.layouts.editor')

<script>
    document.getElementById("date").value = "{{date('Y-m-d')}}";
</script>

@endsection
