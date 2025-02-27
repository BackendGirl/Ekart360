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
                                <div class="col-md-12">
                                    <label for="title" class="col-form-label">Title <span class="text-danger">*</span></label>
                                    <textarea name="title" id="title" class="form-control editor">{{$data->title}}</textarea>
                                </div>      
                                <div class="col-md-4">
                                    <label for="date" class="col-form-label">Expiry Date <span class="text-danger">*</span></label>
                                    <input type="date" name="date" id="date" class="form-control" value="{{old('date')}}">
                                </div>                           
                                <div class="col-md-4">
                                    <label for="status" class="col-form-label">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="active">Active</option>
                                        <option value="inactive" @if($data->status == 'inactive') selected @endif>Inactive</option>
                                    </select>
                                </div>    
                            </div>
                            <div class="row gx-2">          
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

@if($data->date)
<script>
    document.getElementById("date").value = "{{date('Y-m-d',$data->date)}}";
</script>
@else
<script>
    document.getElementById("date").value = "{{date('Y-m-d')}}";
</script>
@endif

@endsection
