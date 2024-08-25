<div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $banner_title }}</h5>
                    </div>

                    <div class="card-block">
                    <form method="post" action="{{route('admin.about.banner.update')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" value="{{$banner_field_name}}" name="field_name">
                        <input type="hidden" value="{{$table_name}}" name="table_name">                        
                            <div class="row gx-2">
                            <div class="col-2">                          
                                <label for="editor" class="col-form-label">Old Banner</label>     
                                @if($data->$banner_field_name)                   
                                 <img src="{{URL::to($data->$banner_field_name)}}" style="width:100%;">
                                 <input type="hidden" value="{{$data->$banner_field_name}}" name="old_banner">    
                                @endif
                            </div>
                            <div class="col-2">
                                <label for="editor" class="col-form-label">Choose File</label>                                
                                <input type="file" name="banner" id="banner" class="form-control">
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