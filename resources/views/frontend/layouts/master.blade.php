<!DOCTYPE html>
<html lang="en">
<head>
	@include('frontend.layouts.head')	
	@php $current_theme = DB::table('themes')->where('current_theme',1)->first(); @endphp
</head>
<body class="theme-color-1">
	
	    <!-- Loader Start -->
		<div class="fullpage-loader">
			<span></span>
			<span></span>
			<span></span>
			<span></span>
			<span></span>
			<span></span>
		</div>
    <!-- Loader End -->
	@include('frontend.layouts.notification')

	<!-- Header -->
	@if($current_theme->id == 3)
		@include('frontend.layouts.header_classic_shop') 
	@elseif($current_theme->id == 4)
		@include('frontend.layouts.header_furniture') 	
	@else
		@include('frontend.layouts.header') 
	@endif
	<!--/ End Header -->

	@yield('main-content')
	
	<!-- Header -->
	@if($current_theme->id == 3)
		@include('frontend.layouts.footer_classic_shop') 	
	@elseif($current_theme->id == 4)
		@include('frontend.layouts.footer_furniture') 	
	@else
		@include('frontend.layouts.footer') 
	@endif
	<!--/ End Header -->

</body>
</html>