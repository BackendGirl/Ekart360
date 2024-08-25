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
                        @method('PATCH')
                            <div class="row gx-2">                                                          
                                <div class="col-md-3">
                                    <label for="name" class="col-form-label">Name </label>
                                    <input type="text" name="name" class="form-control" value="{{$data->first_name}}" readonly>
                                </div>
                                <div class="col-md-3">
                                    <label for="email" class="col-form-label">Email </label>
                                    <input type="email" name="email" class="form-control" value="{{$data->email}}" readonly>
                                </div>   
                                <div class="col-md-3">
                                    <label for="phone" class="col-form-label">Phone </label>
                                    <input type="tel" name="phone" class="form-control" value="{{$data->phone}}" readonly>
                                </div>   
                                <div class="col-md-3">
                                    <label for="status" class="col-form-label">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0" @if($data->status == 0) selected @endif>Inactive</option>
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

@include('backend.layout.editor')

<script>
    document.getElementById("date").value = "{{date('Y-m-d')}}";
</script>

@endsection
