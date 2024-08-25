<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

    @php $setting = DB::table('settings')->first(); @endphp

    @if(isset($setting))
        <!-- App Title -->
        <title>@yield('title') | {{ $setting->meta_title ?? '' }}</title>
        
        <meta name="description" content="{!! str_limit(strip_tags($setting->meta_description), 160, ' ...') !!}">
        <meta name="keywords" content="{!! strip_tags($setting->meta_keywords) !!}">

        @if(is_file('uploads/setting/'.$setting->favicon_path))
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('uploads/setting/'.$setting->favicon_path) }}" type="image/x-icon">
        @endif
        @endif

        @if(empty($setting))
        <!-- App Title -->
        <title>@yield('title')</title>
      @endif

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
   

         <style>
          @import url('https://fonts.googleapis.com/css2?family=El+Messiri:wght@700&display=swap');

          * {
	 margin: 0;
	 padding: 0;
	 font-family: 'El Messiri', sans-serif;
}
 body {
	 background: #031323;
	 overflow: hidden;
}
 .fas {
	 width: 32px;
}
 section {
	 display: flex;
	 justify-content: center;
	 align-items: center;
	 min-height: 100vh;
	 /* background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab); */
   background: linear-gradient(-45deg, #23a6d5,#23a6d5);
	 background-size: 400% 400%;
	 animation: gradient 10s ease infinite;
}
 @keyframes gradient {
	 0% {
		 background-position: 0% 50%;
	}
	 50% {
		 background-position: 100% 50%;
	}
	 100% {
		 background-position: 0% 50%;
	}
}
 .box {
	 position: relative;
}
 .box .square {
	 position: absolute;
	 background: rgba(255, 255, 255, 0.1);
	 backdrop-filter: blur(5px);
	 box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
	 border: 1px solid rgba(255, 255, 255, 0.15);
	 border-radius: 15px;
	 animation: square 10s linear infinite;
	 animation-delay: calc(-1s * var(--i));
}
 @keyframes square {
	 0%, 100% {
		 transform: translateY(-20px);
	}
	 50% {
		 transform: translateY(20px);
	}
}
 .box .square:nth-child(1) {
	 width: 100px;
	 height: 100px;
	 top: -15px;
	 right: -45px;
}
 .box .square:nth-child(2) {
	 width: 150px;
	 height: 150px;
	 top: 105px;
	 left: -125px;
	 z-index: 2;
}
 .box .square:nth-child(3) {
	 width: 60px;
	 height: 60px;
	 bottom: 85px;
	 right: -45px;
	 z-index: 2;
}
 .box .square:nth-child(4) {
	 width: 50px;
	 height: 50px;
	 bottom: 35px;
	 left: -95px;
}
 .box .square:nth-child(5) {
	 width: 50px;
	 height: 50px;
	 top: -15px;
	 left: -25px;
}
 .box .square:nth-child(6) {
	 width: 85px;
	 height: 85px;
	 top: 165px;
	 right: -155px;
	 z-index: 2;
}
 .container {
	 position: relative;
	 padding: 50px;
	 width: 260px;
	 min-height: 380px;
	 /* display: flex; */
	 justify-content: center;
	 align-items: center;
	 /* background: rgba(255, 255, 255, 0.1); */
	 background:white;
	 backdrop-filter: blur(5px);
	 border-radius: 10px;
	 box-shadow: 0 25px 45px rgba(0, 0, 0, 0.2);
}
.container *{
	color:#002147 !important;
}
 .container::after {
	 content: '';
	 position: absolute;
	 top: 5px;
	 right: 5px;
	 bottom: 5px;
	 left: 5px;
	 border-radius: 5px;
	 pointer-events: none;
	 background: linear-gradient(to bottom, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.1) 2%);
}
 .form {
	 position: relative;
	 width: 100%;
	 height: 100%;
}
 .form h2 {
	 color: #fff;
	 letter-spacing: 2px;
	 margin-bottom: 30px;
}
 .form .inputBx {
	 position: relative;
	 width: 100%;
	 margin-bottom: 20px;
}
 .form .inputBx input {
	 width: 80%;
	 outline: none;
	 border: 1px solid #002147;
	 /* border: 1px solid rgba(255, 255, 255, 0.2); */
	 background: rgba(255, 255, 255, 0.2);
	 padding: 8px 10px;
	 padding-left: 40px;
	 border-radius: 15px;
	 color: #fff;
	 font-size: 16px;
	 box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
}
 .form .inputBx .password-control {
	 position: absolute;
	 top: 11px;
	 right: 10px;
	 display: inline-block;
	 width: 20px;
	 height: 20px;
	 background: url(https://snipp.ru/demo/495/view.svg) 0 0 no-repeat;
	 transition: 0.5s;
}
 .form .inputBx .view {
	 background: url(https://snipp.ru/demo/495/no-view.svg) 0 0 no-repeat;
	 transition: 0.5s;
}
 .form .inputBx .fas {
	 position: absolute;
	 top: 13px;
	 left: 13px;
}
 .form .inputBx input[type="submit"] {
	 background: #002147;
	 color:white !important;
	 max-width: 100px;
	 padding: 8px 10px;
	 box-shadow: none;
	 letter-spacing: 1px;
	 cursor: pointer;
	 transition: 1.5s;
}
 .form .inputBx input[type="submit"]:hover {
	 background: linear-gradient(115deg, rgba(0, 0, 0, 0.10), rgba(255, 255, 255, 0.25));
	 color: #fff;
	 transition: 0.5s;
}
 .form .inputBx input::placeholder {
	 color: #fff;
}
 .form .inputBx span {
	 position: absolute;
	 left: 30px;
	 padding: 10px;
	 display: inline-block;
	 color: #fff;
	 transition: 0.5s;
	 pointer-events: none;
}
 .form .inputBx input:focus ~ span, .form .inputBx input:valid ~ span {
	 transform: translateX(-30px) translateY(-25px);
	 font-size: 12px;
}
 .form p {
	 color: #fff;
	 font-size: 15px;
	 margin-top: 5px;
}
 .form p a {
	 color: #fff;
}
 .form p a:hover {
	 background-color: #000;
	 background-image: linear-gradient(to right, #434343 0%, black 100%);
	 -webkit-background-clip: text;
	 -webkit-text-fill-color: transparent;
}
 .remember {
	 position: relative;
	 display: inline-block;
	 color: #fff;
	 margin-bottom: 10px;
	 cursor: pointer;
}
 
         </style>


    </head>
    <body>

    <section>
  
  <div class="box">
    
  
    
   <div class="container"> 
    <div style="text-align:center;">
	<img src="{{ asset('uploads/setting/'.$setting->logo_path) }}" style="max-width:80%;">
    </div><br>
    <div class="form">       
            <!-- Form Start -->
            <form method="POST" action="{{ route('login') }}">
        @csrf
            <div class="input-group mb-3 inputBx">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                <span>Email</span>
                <i class="fas fa-key"></i>               
            </div>
               @error('email')
                    <span class="invalid-feedback" style="color:white;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            <div class="input-group mb-4 inputBx password">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                <span>Password</span>
                <a href="#" class="password-control" onclick="return show_hide_password(this);"></a>
                <i class="fas fa-key"></i>

                @error('password')
                    <span class="invalid-feedback" style="color:white;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!-- <div class="form-group text-left">
                <div class="checkbox checkbox-fill d-inline">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="cr remember" for="remember">
                        {{ __('field_remember') }}
                    </label><br>
                </div>
            </div> -->
            <div class="inputBx">
              <input type="submit" class="btn btn-primary shadow-2 mb-4" name="submit" value="{{ __('auth_login') }}">
            </div>
        </form>
        <!-- Form End -->

      
    </div>
  </div>
    
  </div>
</section>

        <script>
          function show_hide_password(target){
	var input = document.getElementById('password');
	if (input.getAttribute('type') == 'password') {
		target.classList.add('view');
		input.setAttribute('type', 'text');
	} else {
		target.classList.remove('view');
		input.setAttribute('type', 'password');
	}
	return false;
}
        </script>
    </body>
</html>