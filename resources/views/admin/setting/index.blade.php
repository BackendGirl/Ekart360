@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<div class="fixed">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid page_sub_menues">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav index-navbar me-auto mb-2 mb-lg-0">                  
                <li class="nav-item {{ Request::is('admin/setting*') ? 'active' : '' }}"><a href="{{ route('admin.setting.index') }}" class="nav-link btn {{ Request::is('admin/setting') ? 'btn-primary' : 'btn-info' }}">Site {{ trans_choice('module_setting', 2) }}</a></li>
                <li class="nav-item {{ Request::is('admin/theme*') ? 'active' : '' }}"><a href="{{ route('admin.themes.index') }}" class="nav-link btn {{ Request::is('admin/theme') ? 'btn-primary' : 'btn-info' }}">Themes</a></li>
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
                <form class="needs-validation" novalidate action="{{ route($route.'.siteinfo') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $title }}</h5>
                    </div>
                    <div class="card-block row">
                        
                        <!-- Form Start -->
                        <input name="id" type="hidden" value="{{ (isset($row->id))?$row->id:-1 }}">

                        <div class="form-group col-md-6">
                            <label for="title">{{ __('field_site_title') }} <span>*</span></label>
                            <input type="text" class="form-control" name="title" id="title" value="{{ isset($row->title)?$row->title:'' }}" required>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_site_title') }}
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="meta_title">{{ __('field_meta_title') }} <span>*</span></label>
                            <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{ isset($row->meta_title)?$row->meta_title:'' }}" required>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_meta_title') }}
                            </div>
                        </div>

                        <hr/>

                        <div class="form-group col-md-6">
                            <label for="meta_description">{{ __('field_meta_description') }}: <span>{{ __('field_meta_desc_length') }}</span></label>
                            <textarea class="form-control" name="meta_description" id="meta_description">{{ isset($row->meta_description)?$row->meta_description:'' }}</textarea>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_meta_description') }}
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="meta_keywords">{{ __('field_meta_keywords') }}: <span>{{ __('field_keywords_separate') }}</span></label>
                            <textarea class="form-control" name="meta_keywords" id="meta_keywords">{{ isset($row->meta_keywords)?$row->meta_keywords:'' }}</textarea>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_meta_keywords') }}
                            </div>
                        </div>

                        <hr/>

                        <div class="form-group col-md-6">

                            @if(isset($row->logo_path))
                            @if(is_file('uploads/'.$path.'/'.$row->logo_path))
                            <img src="{{ asset('uploads/'.$path.'/'.$row->logo_path) }}" class="img-fluid setting-image" alt="{{ __('field_site_logo') }}">
                            <div class="clearfix"></div>
                            @endif
                            @endif

                            <label for="logo">{{ __('field_site_logo') }}: <span>{{ __('image_size', ['height' => 80, 'width' => 'Any']) }}</span></label>
                            <input type="file" class="form-control" name="logo" id="logo">

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_site_logo') }}
                            </div>
                        </div>

                        <div class="form-group col-md-6">

                            @if(isset($row->favicon_path))
                            @if(is_file('uploads/'.$path.'/'.$row->favicon_path))
                            <img src="{{ asset('uploads/'.$path.'/'.$row->favicon_path) }}" class="img-fluid setting-image" alt="{{ __('field_site_favicon') }}">
                            <div class="clearfix"></div>
                            @endif
                            @endif

                            <label for="favicon">{{ __('field_site_favicon') }}: <span>{{ __('image_size', ['height' => 64, 'width' => 64]) }}</span></label>
                            <input type="file" class="form-control" name="favicon" id="favicon">

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_site_favicon') }}
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="phone">{{ __('field_phone') }}: </label>
                            <input type="tel" class="form-control" name="phone" id="phone" value="{{ isset($row->phone)?$row->phone:'' }}" required>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_phone') }}
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="email">{{ __('field_email') }}: </label>
                            <input type="text" class="form-control" name="email" id="email" value="{{ isset($row->email)?$row->email:'' }}" required>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_email') }}
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="address">{{ __('field_address') }}: </label>
                            <textarea class="form-control" name="address" id="address">{{ isset($row->address)?$row->address:'' }}</textarea>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_address') }}
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="latest_updates">{{ __('field_latest_updates') }}: </label>
                            <textarea class="form-control" name="latest_updates" id="latest_updates">{{ isset($row->latest_updates)?$row->latest_updates:'' }}</textarea>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_latest_updates') }}
                            </div>
                        </div>
                       
                        <!-- Form End -->

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">{{ __('btn_update') }}</button>
                    </div>

                </div>
                </form>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- End Content-->

@endsection