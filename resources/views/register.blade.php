@extends('layout')
@section('content')
	@include('parts.scripts')
	<div class="orta">
		<h3>Qeydiyyat</h3>
	<div style="margin-left: 20px;">
		<br>
		<br>
		<div class="container m-auto">
			<div class="row">
				<div class="col register_link_parent">
					{{--height="262px"--}}
					{{--314px--}}
					<div class="row" style="height: 80%">
					<a class="register_link" href="{{route('freelancer')}}"> <img class="register_link_image" style="" width="auto;" height="376px" src="{{asset('images/freelancer.png')}}"></a>
					</div>
					<div style=" font-family:sans-serif;height: 20%"  class="row afq register_link_parent text-center ml-5"><br>Freelancer Qeydiyyatı</div>
						<br>

				</div>
				<div class="col register_link_parent">
					{{--height="240px"--}}
					{{--288px--}}
					<div class="row" style="height: 80%">
					<a class="register_link" href="{{route('agency')}}"> <img class="register_link_image" width="auto" height="345px" src="{{asset('images/agentlik1.png')}}"> </a>
					</div>
					<div style=" font-family:sans-serif;height: 20% "  class="row afq register_link_parent text-center ml-5"><br>Agentlik Qeydiyyatı</div>
						<br>

				</div>
				<div class="col register_link_parent">
					{{--height:210px--}}
					{{--252px--}}
					<div class="row" style="height: 80%">
					<a class="register_link" href="{{route('sahibkar')}}"><img class="register_link_image" style="margin-left: 5%; width:auto; height:302px" src="{{asset('images/brand5.jpg')}}"></a>
					</div>
					<div style =" font-family:sans-serif;height: 20%; " class="row afq register_link_parent text-center ml-5"><br>Marka Qeydiyyatı </div>
						<br>

				</div>
			</div>
		</div>
		<br>
		<br>
		<br>
		<br>
	</div>
	</div>
	<br>
	@include('parts.footer')
@endsection