@extends('admin.layouts.master')
@section('title', $title)
@section('content')
<script src="https://code.jquery.com/jquery-3.7.0.slim.min.js" integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>

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
                                        <th>Company Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Country</th>
                                        <th>Year Established</th>
                                        <th>Categoy</th>
                                        <th>Photo</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($data as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->company_name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->phone}}</td>     
                                        <td>{{ $value->country}}</td>    
                                        <td>{{ $value->year_established }}</td>
                                        <td>{{ $value->category}}</td>   
                                        <td>
                                            @if($value->photo)
                                                <img src="{{URL::to($value->photo)}}" class="img-fluid zoom" style="max-width:80px" alt="{{$value->photo}}">
                                            @else
                                                <img src="{{URL::to('public/backend/img/thumbnail-default.jpg')}}" class="img-fluid zoom" style="max-width:100px" alt="avatar.png">
                                            @endif
                                        </td>                           
                                        <td>
                                            <form action="{{route($route.'.edit',$value->id)}}" id="update_status{{$value->id}}">
                                                <select name="status" id="status{{$value->id}}" class="form-control">
                                                    <option value="pending" @if($value->status == 'pending') selected @endif>Pending</option>
                                                    <option value="approved" @if($value->status == 'approved') selected @endif>Approved</option>
                                                    <option value="rejected" @if($value->status == 'rejected') selected @endif>Rejected</option>
                                                    <option value="activate" @if($value->status == 'activate') selected @endif>Activate</option>
                                                    <option value="deactivate" @if($value->status == 'deactivate') selected @endif>Deactivate</option>                                                
                                                </select>
                                                <!-- <input type="hidden" name="id[]" value="{{$value->id}}"> -->
                                            </form>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-icon btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $value->id }}" title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            <!-- Include Delete modal -->
                                            @include('admin.layouts.inc.delete')  
                                           
                                        </td>
                                    </tr>

                                    <script>
                                        $('#status{{$value->id}}').change(function(){ 
                                           $('#update_status{{$value->id}}').submit();
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
