<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        
         @include('admin.layouts.common.header_script')

    </head>
    <body>

        <div class="auth-wrapper">
            <div class="auth-content">
                <div class="auth-bg">
                    <span class="r"></span>
                    <span class="r s"></span>
                    <span class="r s"></span>
                    <span class="r"></span>
                </div>

                <!-- Start Content-->
                @yield('content')
                <!-- End Content-->
                
            </div>
        </div>

        @include('admin.layouts.common.footer_script')
    </body>
</html>