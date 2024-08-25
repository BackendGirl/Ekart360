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

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Name <span class="text-danger">*</span></label>
                                        <input id="name" type="text" name="name" placeholder="Enter name"
                                            value="{{old('name')}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="designation">Designation <span class="text-danger">*</span></label>
                                        <input id="designation" type="text" name="designation" placeholder="Enter designation"
                                            value="{{old('designation')}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputPhoto">Photo <span class="text-danger">*</span></label>
                                        <input id="inputPhoto" type="file" name="photo" placeholder="Upload Photo"class="form-control">
                                    </div>
                                </div> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="title">Title <span class="text-danger">*</span></label>
                                        <input id="title" type="text" name="title" placeholder="Enter title" class="form-control">
                                    </div>
                                </div> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="rating">Rating <span class="text-danger">*</span></label>
                                        <select name="rating" class="form-control">
                                        <option value="0.5" @if(old('rating' == '0.5')) selected @endif>0.5</option>
                                            <option value="1" @if(old('rating' == '1')) selected @endif>1</option>
                                            <option value="1.5" @if(old('rating' == '1.5')) selected @endif>1.5</option>
                                            <option value="2" @if(old('rating' == '2')) selected @endif>2</option>
                                            <option value="2.5" @if(old('rating' == '2.5')) selected @endif>2.5</option>
                                            <option value="3" @if(old('rating' == '3')) selected @endif>3</option>
                                            <option value="3.5" @if(old('rating' == '3.5')) selected @endif>3.5</option>
                                            <option value="4" @if(old('rating' == '4')) selected @else selected @endif>4</option>
                                            <option value="4.5" @if(old('rating' == '4.5')) selected @endif>4.5</option>
                                            <option value="5" @if(old('rating' == '5')) selected @endif>5</option>
                                        </select>
                                    </div>
                                </div> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="active">Active</option>
                                            <option value="inactive" @if(old('status') == 'inactive') selected @endif>Inactive</option>
                                        </select>
                                    </div>
                                </div>                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" class="form-control" placeholder="Enter description"></textarea>
                                    </div>
                                </div>                              
                            </div>

                            <div class="form-group mb-3">
                                <button class="btn btn-success" type="submit">Submit</button>
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

@endsection

@push('scripts')
<script>
    var data = '<tr><td> <label for="weight">weight <span class="text-danger">*</span></label><input id="weight" type="text" name="weight[]" placeholder="Add weight" required></td><td><label for="price" class="col-form-label">Price <span class="text-danger">*</span></label><input id="price" type="number" name="price[]" placeholder="Enter price" required></td><td><label for="price" class="col-form-label">Price <span class="text-danger">*</span></label><input id="mrp" type="number" name="mrp[]" placeholder="Enter mrp" required></td><td><button class="btn btn-danger mx-2 my-2 remove_field" type="button">Remove</button></td></tr>';
    $(".add_field").click(function(){
      $(".price_field").append(data);
    })

    $(".price_field").on('click','.remove_field',function(){
      $(this).closest('tr').remove();
    })

  </script>

@endpush