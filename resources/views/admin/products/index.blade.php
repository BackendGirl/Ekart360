@extends('admin.layouts.master')
@section('title', $title)
@section('content')

 <!-- toastr Js -->
 <script src="{{ asset('dashboard/plugins/toastr/js/toastr.min.js') }}"></script>

@toastr_render

<!-- Start Content-->
<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $title }}</h5>
                        <a href="{{route($route.'.create')}}" class="btn btn-primary btn-sm float-right"><i class="far fa-plus"></i> Add</a>
                    </div>

                    <div class="card-block">
                  <!-- [ Data table ] start -->
                  <div class="table-responsive">
                            <table id="basic-table" class="display table nowrap table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Photo</th>
                                        <th>Sub Photos</th>
                                        <th>Category</th>
                                        <th>Vender</th>
                                        <th>Deal of the day</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($data as $key => $value)
                                  @php 
                                     if(!empty($value->vender)){
                                        $vender = DB::table('saller')->where('id',$value->vender)->first();
                                        if(!empty($vender)){
                                            $company_name = $vender->company_name;
                                        }else{
                                            $company_name = 'Admin';
                                        }
                                     }else{
                                        $company_name = 'Admin';
                                     }
                                  @endphp
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->title }}</td>
                                        <td>
                                            @if($value->photo)
                                                <img src="{{URL::to($value->photo)}}" class="img-fluid zoom" style="max-width:80px" alt="{{$value->photo}}">
                                            @else
                                                <img src="{{URL::to('public/backend/img/thumbnail-default.jpg')}}" class="img-fluid zoom" style="max-width:100px" alt="avatar.png">
                                            @endif
                                        </td>
                                        <td>
                                        @if($value->sub_photos != null && $value->sub_photos !='')
                                            @foreach(explode(',', $value->sub_photos) as $key=>$subphotos)                       
                                            @php $catid = trim($subphotos,'[]"'); @endphp  
                                            @if($catid != '' && strlen($catid) > 1)
                                            @php $img =  str_replace("\\", '', $catid) @endphp
                                               <img src="{{URL::to($img)}}" class="img-fluid zoom" style="max-width:80px" alt="{{$value->photo}}">
                                             @endif                               
                                            @endforeach    
                                        @endif  
                                        </td>
                                        <td>{{ $value->category_title }}</td>
                                        <td>{{ $company_name ?? 'Admin' }}</td>
                                        <td>
                                            <input type="checkbox" id="deal_of_the_day{{$value->id}}" name="deal_of_the_day" @if($value->deal_of_the_day == 1) checked @endif>
                                        </td>
                                        <td>
                                            @if( $value->status == 'active' )
                                            <span class="badge badge-pill badge-success">{{ __('status_active') }}</span>
                                            @else
                                            <span class="badge badge-pill badge-warning">{{ __('status_inactive') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route($route.'.edit',$value->id)}}" class="btn btn-icon btn-primary btn-sm">
                                                <i class="far fa-edit"></i>
                                            </a>

                                            <button type="button" class="btn btn-icon btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $value->id }}" title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            <!-- Include Delete modal -->
                                            @include('admin.layouts.inc.delete')  
                                           
                                        </td>
                                    </tr>

                                    <script src="{{URL::to('public/frontend/bakery/assets/js/jquery-3.6.0.min.js')}}"></script>

                                    <script>
                                        $("#deal_of_the_day{{$value->id}}").change(function(){                                            
                                            if ($(this).is(':checked')) {
                                                var value = 1;
                                            }else{
                                                var value = 0;
                                            }

                                            var product_id = {{$value->id}};

                                            $.ajax({
                                                type:"GET",
                                                url: "{{route('admin.deal_of_the_day')}}",
                                                data: {
                                                    value : value,
                                                    product_id : product_id
                                                },      
                                                success: function(data){
                                                    if (data['code'] == 200) {
                                                        toastr["success"](data['message']);
                                                    }else{
                                                        toastr["error"](data['message']);
                                                    }
                                                }
                                            }); 
                                            
                                        });
                                    </script>

                                  @endforeach
                                </tbody>
                            </table>                          
                        </div>
                        <!-- [ Data table ] end -->
                    </div>
                </div>
            </div>

        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- End Content-->

@endsection
