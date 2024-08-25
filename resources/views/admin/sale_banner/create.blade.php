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
                            <div class="row gx-2">                                                          
                                <div class="col-md-4">
                                    <label for="title" class="col-form-label">Title</label>
                                    <input type="text" name="title" class="form-control" value="{{old('title')}}">
                                </div>   
                                <div class="col-md-4">
                                    <label for="sub_title1" class="col-form-label">Sub Title 1</label>
                                    <input type="text" name="sub_title1" class="form-control" value="{{old('sub_title1')}}">
                                </div>     
                                <div class="col-md-4">
                                    <label for="sub_title2" class="col-form-label">Sub Title 2</label>
                                    <input type="text" name="sub_title2" class="form-control" value="{{old('sub_title2')}}">
                                </div>   
                                <div class="col-md-4">
                                    <label for="photo" class="col-form-label">Photo <span class="text-danger">*</span></label>
                                    <input type="file" name="photo" class="form-control">
                                </div>   
                                <div class="col-md-4">
                                    <label for="status" class="col-form-label">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="active">Active</option>
                                        <option value="inactive" @if(old('status') == 'inactive') selected @endif>Inactive</option>
                                    </select>
                                </div>  
                            </div>
                            <div class="row gx-2">                                                                    
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

@include('admin.layouts.editor')

<script>
    document.getElementById("date").value = "{{date('Y-m-d')}}";
</script>

@endsection
