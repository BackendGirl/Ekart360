@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<!-- Start Content-->
<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Banner Content ] start -->
          @include('admin.layouts.inc.banner')
        <!-- [ Banner Content ] end -->

        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $title }}</h5>
                    </div>
                    <div class="card-block">
                    <form method="post" action="{{route('admin.about.profile.update')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                            <div class="row gx-2">

                          <div class="col-md-8">
                          <div class="form-group">
                                <label for="editor" class="col-form-label">Description <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="editor" name="description" placeholder="Add description">{{$data->profile}}</textarea>
                                @error('description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                                <label for="photo" class="col-form-label">Photos</label><br>
                                @if($data->profile_photo != null && $data->profile_photo !='')
                                 <div class="row">
                                  @foreach(explode(',', $data->profile_photo) as $subphotos)                       
                                    @php $catid = trim($subphotos,'[]"') @endphp                                                                               
                                        <div class="col-md-6">
                                           <img src="{{URL::to($catid)}}" style="width:100%;">
                                        </div>                                      
                                    @endforeach    
                                    </div>
                                    <input type="text" class="form-control" id="" name="hidden_file" value="{{$data->profile_photo}}"> 
                                @endif  
                                <input type="file" class="form-control" id="photo" name="photo[]" multiple>
                                @error('photo')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
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

@include('backend.layout.editor')

@endsection
