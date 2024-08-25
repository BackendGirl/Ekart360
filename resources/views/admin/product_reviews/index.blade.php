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
                    <div class="card-block">
                      <!-- [ Data table ] start -->
                      <div class="table-responsive">
                            <table id="basic-table" class="display table nowrap table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Photo</th>
                                        <th>Title</th>
                                        <th>Rating</th>
                                        <th>Message</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($profile as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->first_name }}</td>  
                                        <td>
                                            @if($value->photo)
                                                <img src="{{URL::to($value->photo)}}" class="img-fluid zoom" style="max-width:80px" alt="{{$value->photo}}">
                                            @else
                                                <img src="{{URL::to('public/backend/img/thumbnail-default.jpg')}}" class="img-fluid zoom" style="max-width:100px" alt="avatar.png">
                                            @endif
                                        </td>
                                        <td>{{ $value->title }}</td>
                                        <td>{{ $value->rating }}</td>
                                        <td>{!! $value->message !!}</td>
                                        <td>                                            
                                            <button type="button" class="btn btn-icon btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $value->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            <!-- Include Delete modal -->
                                            @include('admin.layouts.inc.delete')                                           
                                        </td>
                                    </tr>
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

@include('backend.layout.editor')

@endsection
