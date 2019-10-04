@extends('layout')
@section('content')
	<br>
	<h3 style="font-family: Georgia, serif;" class="text-center">Təklif və Şikayətlərini Yaz </h3>
	<fieldset style=" margin-left: 33%;  width: 38%;height: 260px; background-color:#e6e6e6; border:1px solid rgba(0,0,0,0.24); padding-bottom: 10px; border-radius: 10px" class="mt-5">
		{{--margin-left: 22%;--}}
		<form style="" class="" action="{{url('contact')}}" method="post">
			@csrf

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
				<div class="text-center"><strong>{{ Session::get('success') }}
					</strong>
				</div>
			@endif
			<div class="" style="margin-left: 80px; margin-top: 20px">
				<div class="row w-100">
					<div class="col">
					<span>Ad </span><br><input type="text" name="contact_name"> <br>
					</div>
					<div class="col">
					<span>Email ünvanı</span> <br><input type="email" name="contact_email"> <br>
					</div>
				</div>
				{{--<div>--}}
					{{--<span>Email ünvanı</span> <br><input type="email" name="email"> <br>--}}
				{{--</div>--}}
				<div class="row w-100 ml-3">
					<div class="row w-100">
						<span>Təkliflərini Yaz </span><br>
					</div>
					<div class="row w-100">
						<textarea name="contact_message" placeholder="Şikayət,Təklif və İradlarını bizə yaz" style="width: 45%; height:80px;"></textarea> <br> <br>
					</div>
					<div class="row w-100">
						<input class="btn btn-light" type="submit" name="Göndər" value="Göndər">
					</div>
				</div>
			</div>
		</form>
	</fieldset>
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
	<br>
	<br>
	@include('parts.footer')
@endsection