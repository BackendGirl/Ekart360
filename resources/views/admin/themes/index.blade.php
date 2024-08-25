@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<script src="{{URL::to('public/frontend/bakery/assets/js/jquery-3.6.0.min.js')}}"></script>

<div class="fixed">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid page_sub_menues">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav index-navbar me-auto mb-2 mb-lg-0">                  
                <li class="nav-item {{ Request::is('admin/setting*') ? 'active' : '' }}"><a href="{{ route('admin.setting.index') }}" class="nav-link btn {{ Request::is('admin/setting') ? 'btn-primary' : 'btn-info' }}">Site {{ trans_choice('module_setting', 2) }}</a></li>
                <li class="nav-item {{ Request::is('admin/themes*') ? 'active' : '' }}"><a href="{{ route('admin.themes.index') }}" class="nav-link btn {{ Request::is('admin/themes') ? 'btn-primary' : 'btn-info' }}">Themes</a></li>
            </ul>
    </div>
  </div>
</nav>
</div>

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
                        <form action="{{route($route.'.store')}}" method="post">
                            @csrf
                            @if(count($themes)>0)
                            <div class="row">
                                @foreach($themes as $theme)
                                <div class="col-md-3">
                                <div class="card card2 card_custom{{$theme->id}}" data-id="{{$theme->id}}">                                    
                                @if($theme->photo)
                                    <img src="{{URL::to($theme->photo)}}" class="img-fluid zoom">
                                @else
                                    <img src="{{URL::to('public/backend/img/thumbnail-default.jpg')}}" class="img-fluid zoom" alt="avatar.png">
                                @endif                                
                                <div class="card-body">
                                    <b class="card-text">{{$theme->title ?? ''}}</b>
                                </div>
                                </div>
                                </div>
                                <script>
                                    $(document).ready(function(){
                                        @if($theme->current_theme == 1)
                                            $(".card_custom{{$theme->id}}").css('border','2px solid green').css('padding','15px');                                            
                                            $("#current_theme").val({{$theme->id}});
                                        @endif
                                    });
                                    $(".card_custom{{$theme->id}}").click(function(){
                                        $(".card2").css('border','none').css('padding','0');
                                        $(this).css('border','2px solid green').css('padding','15px');                                        
                                        var theme = $(this).attr('data-id');      
                                        $("#current_theme").val(theme);
                                    });
                                </script>
                                @endforeach
                            </div>
                            <input type="hidden" name="current_theme" id="current_theme" value="{{$theme->id}}">
                            <div class="row">
                                <div class="col-md-3"><button class="form-control btn btn-success" type="submit">Update</button></div>
                            </div>
                            @endif
                            </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- End Content-->

@endsection