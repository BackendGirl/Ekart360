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
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="title">Title <span class="text-danger">*</span></label>
                                        <input id="title" type="text" name="title" placeholder="Enter title"
                                            value="{{$data->title}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="cat_id">Category <span class="text-danger">*</span></label>
                                        <select name="category" id="cat_id" class="form-control">
                                            <option value="">--Select any category--</option>
                                            @foreach($categories as $key=>$cat_data)
                                            <option value='{{$cat_data->id}}' @if($cat_data->id == $data->category) selected @endif>{{$cat_data->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group price_field table-responsive">
                                    <table>
                                            @if(count($product_price)>0)
                                            @foreach($product_price as $price_key=>$price)
                                                <tr>                                              
                                                <td class="mx-5"> 
                                                <label for="weight" class="col-form-label ml-3">Weight <span class="text-danger">*</span></label>
                                                    <input id="weight" type="text" name="weight[]" placeholder="Add weight"  value="{{$price->quantity}}" required>
                                                </td>
                                                <td><label for="price" class="col-form-label">Price <span class="text-danger">*</span></label>
                                                    <input id="price" type="number" name="price[]" placeholder="Enter price"  value="{{$price->price}}" required>
                                                </td>
                                                <td><label for="mrp" class="col-form-label">MRP <span class="text-danger">*</span></label>
                                                    <input id="mrp" type="number" name="mrp[]" placeholder="Enter mrp"  value="{{$price->mrp}}" required>
                                                </td>
                                                @if($price_key==0)
                                                <td><button class="btn btn-success float-right my-2 add_field" type="button">Add</button></td>
                                                @else
                                                <td><button class="btn btn-danger mx-2 my-2 remove_field" type="button">Remove</button></td>
                                                @endif
                                                </tr>  <br>
                                            @endforeach
                                            @else
                                            <tr>
                                            <td class="mx-5">
                                                    <label for="weight" class="col-form-label ml-3">Weight <span
                                                            class="text-danger">*</span></label>
                                                    <input id="weight" type="text" name="weight[]"
                                                        placeholder="Add weight" value="" required>
                                                </td>
                                                <td><label for="price" class="col-form-label">Price <span
                                                            class="text-danger">*</span></label>
                                                    <input id="price" type="number" name="price[]"
                                                        placeholder="Enter price" value="" required>
                                                </td>
                                                <td><label for="mrp" class="col-form-label">MRP <span
                                                            class="text-danger">*</span></label>
                                                    <input id="mrp" type="number" name="mrp[]"
                                                        placeholder="Enter mrp" value="" required>
                                                </td>                                             
                                                <td><button class="btn btn-success float-right my-2 add_field"
                                                        type="button">Add</button></td>
                                            </tr>
                                            @endif     
                                            </table>
                                    </div>
                                </div>                                
                            </div>
                            <div class="row">                               
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputPhoto">Photo <span class="text-danger">*</span></label>
                                        <input id="inputPhoto" type="file" name="photo" placeholder="Upload Photo"class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="sub_photos">Sub Photos </label>
                                        <input id="sub_photos" type="file" name="sub_photos[]" placeholder="Upload Photo" class="form-control" multiple>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="active">Active</option>
                                            <option value="inactive" @if($data->status == 'inactive') selected @endif>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="rating">Rating</label>
                                        <select name="rating" class="form-control">
                                            <option value="0.5" @if($data->rating == '0.5')) selected @endif>0.5</option>
                                            <option value="1" @if($data->rating == '1')) selected @endif>1</option>
                                            <option value="1.5" @if($data->rating == '1.5')) selected @endif>1.5</option>
                                            <option value="2" @if($data->rating == '2')) selected @endif>2</option>
                                            <option value="2.5" @if($data->rating == '2.5')) selected @endif>2.5</option>
                                            <option value="3" @if($data->rating == '3')) selected @endif>3</option>
                                            <option value="3.5" @if($data->rating == '3.5')) selected @endif>3.5</option>
                                            <option value="4" @if($data->rating == '4')) selected @else selected @endif>4</option>
                                            <option value="4.5" @if($data->rating == '4.5')) selected @endif>4.5</option>
                                            <option value="5" @if($data->rating == '5')) selected @endif>5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">                               
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputPhoto">Old Photo <span class="text-danger">*</span></label><br>
                                        @php $data->photo ? $img = URL::to($data->photo) : $img = URL::to('public/backend/img/thumbnail-default.jpg') @endphp
                                         <img src="{{$img}}" style="width:100px;">
                                         <input type="hidden" name="hidden_photo" value="{{$data->photo}}">
                                         <input type="hidden" name="hidden_sub_photos" value="{{$data->sub_photos}}">
                                         <input type="hidden" name="old_category" value="{{$data->category}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="sub_photos">Old Sub Photos </label><br>
                                        @if($data->sub_photos != null && $data->sub_photos !='')
                                            @foreach(explode(',', $data->sub_photos) as $key=>$subphotos)                       
                                            @php $catid = trim($subphotos,'[]"'); @endphp  
                                            @if($catid != '' && strlen($catid) > 1)
                                            @php $img =  str_replace("\\", '', $catid) @endphp
                                               <img src="{{URL::to($img)}}" class="img-fluid zoom" style="max-width:80px" alt="{{$img}}">
                                             @endif                               
                                            @endforeach    
                                        @endif  
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description">Description <span class="text-danger">*</span></label>
                                <textarea class="form-control editor" id="description" name="description" placeholder="Add description">{{$data->description}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="additional_info">Additional Info </label>
                                <textarea class="form-control editor2" id="additional_info" name="additional_info" placeholder="Add additional_info">{{$data->additional_info}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="care_instruction">Care Instruction </label>
                                <textarea class="form-control editor3" id="care_instruction" name="care_instruction" placeholder="Add care_instruction">{{$data->care_instruction}}</textarea>
                            </div>

                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-info">Update</button>
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
