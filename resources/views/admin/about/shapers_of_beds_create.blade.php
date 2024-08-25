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
                    <form method="post" action="{{route('admin.about.shapers_of_beds.store')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                            <div class="row gx-2">                                                          
                                <div class="col-md-6">
                                    <label for="name" class="col-form-label">Name</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="photo" class="col-form-label">Photo <span class="text-danger">*</span></label>
                                    <input type="file" name="photo" class="form-control">
                                    @error('photo')
                                       <span class="text-danger">{{$message}}</span>
                                    @enderror
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
