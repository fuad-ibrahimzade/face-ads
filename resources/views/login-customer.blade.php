@extends('layout')
@section('content')
	<div class="freelancer ">
		<br>
		<br>
		<form action="{{route('login')}}" method="post" novalidate >
			@csrf
			{{--#dae0e5--}}
	<fieldset style=" background-color:#e6e6e6; border:1px solid rgba(0,0,0,0.24); width: 30%; padding-bottom: 10px; border-radius: 10px" class="m-auto text-center">
		{{--height: 45%;--}}
		{{--width: 40%; margin-left: 33%;--}}
		 <h3 class="text-center"> Daxil Ol</h3> <br>
		@if (Session::has('error'))
			{{--<div class="alert alert-info">{{ Session::get('error') }}</div>--}}
			<div><strong>{{ Session::get('error') }}
					@if (Session::has('verify-email'))
						{{--qqqq {!! Session::get('verify-email') !!}}--}}
						<a href="{!! url('/user/send-verify',Session::get('verify-email'))!!}">yeni verifikasiya göndər</a>
					@endif
				</strong>
			</div>
		@endif
		@if ($errors->any())
			@foreach ($errors->all() as $error)
				<div><strong>{{$error}}</strong></div>
			@endforeach
		@endif
		@if (Session::has('warning'))
			{{--<div class="alert alert-info">{{ Session::get('error') }}</div>--}}
			<div><strong>{{ Session::get('warning') }}
				</strong>
			</div>
		@endif
		@if (Session::has('success'))
			{{--<div class="alert alert-info">{{ Session::get('error') }}</div>--}}
			<div><strong>{{ Session::get('success') }}
				</strong>
			</div>
		@endif
		 <br>
		  <br>
		 <br>
		<div class="col">
			<div class=" text-center">
				 <span style=";">Email Ünvanı </span><br>
				{{--info@email.az--}}
				 <input style="" class="w-50" placeholder="email" type="email" name="email" id="inputBox">
				 <br><br>
				 <span  style=";"> Şifrə </span> <br>
				 <input style="" class="w-50" placeholder="******"type="password" name="password"> <br>
			</div>
			<div class="row text-center mt-2 w-75 ml-auto mr-auto">
				<div class="col ml-3">
					<input style=""  type="checkbox" name="remember_me" class="remember_me"> <i>Məni xatırla</i> <br>
					 <i style="" > <a style="text-decoration-line: none;" href="{{url('password-reset')}}">Şifrəni Unutdun ?</a></i>
				</div>
				  {{--<br>--}}
				<div class="col ">
					<input class="btn btn-light" style="" type="submit" name="Daxil Ol" value="Daxil Ol"> <br>
				</div>
			</div>
		</div>

		</fieldset>
		</form>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	</div>
	<br>
	@include('parts.footer')
@endsection
@section('extra-scripts')
	<script>
        var placeholderText = {
            "Sahibkar": "info@sahibkar.az",
            "Agentlik": "info@agency.az",
            "Frilanser": "freelancer@mammadov.az"
        };
        $(document).ready(function(){
            $("#selectionType").on("change",function() {
                var selection = $("#selectionType");
                var inputBox = $("#inputBox");

                var selectedVal = $(':selected', selection).text();
                $("#inputBox").attr("placeholder", placeholderText[selectedVal]);
            });
        })
	</script>
@endsection