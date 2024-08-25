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
                                    <label for="category" class="col-form-label">Sub Category <span class="text-danger">*</span></label>
                                    <select name="category" id="category" class="form-control">
                                        <option value="">select</option>
                                        @if(count($categories)>0)
                                            @foreach($categories as $value)
                                              <option value="{{$value->id}}" @if(old('category') == $value->id) selected @endif>{{$value->title}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="photo" class="col-form-label">Photo <span class="text-danger">*</span></label>
                                    <input type="file" name="photo" class="form-control">
                                </div>     
                                <div class="col-md-4">
                                    <label for="status" class="col-form-label">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="active">Active</option>
                                        <option value="inactive" @if(old('status') == 'inactive') selected @endif>Inactive</option>
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
