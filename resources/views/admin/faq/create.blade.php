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
                                <div class="col-md-6">
                                    <label for="title" class="col-form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control" value="{{old('title')}}">
                                </div> 
                                <div class="col-md-6">
                                    <label for="status" class="col-form-label">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="active">Active</option>
                                        <option value="inactive" @if(old('status') == 'inactive') selected @endif>Inactive</option>
                                    </select>
                                </div>  
                                <div class="col-md-8">
                                    <label for="description" class="col-form-label">Description <span class="text-danger">*</span></label>
                                    <textarea name="description" id="description" class="form-control">{{old('description')}}</textarea>
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
