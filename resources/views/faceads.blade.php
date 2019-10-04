@extends('layout')
@section('content')
	<br>
	<br>
	<br>
	<div class="container">
		<div class="col" style="">
			<div class="row">
				<div class="col">
					<span class="A1" > SMM xidməti satanlar və <br> Brendlər arasındsa  KÖRPÜ  </span>
				</div>
				<div class="col" style="margin-left: 50px">
					<a href="{{url('pay-start')}}" class="btn btn-lg" style="border-radius: 40px;background-color: #4da6ff;color: white">Ödəniş ödə analizə başla</a>
				</div>
			</div>
			{{--margin-left:10%--}}
			<div class="row">
				<span style="; font-style: italic;"> Agentliklər/Freelancerlər Brendlərlə tez bir zamanda <br> əlaqə yaradıb SMM xidmətlərini sata biləcəklər. </span>
			</div>
		</div>
		<div class="col text-center">
				<img class="SMM" style="width: 900px; margin-left: 200px;" src="{{asset('images/SMM.png')}}">
		</div>
	</div>
	<br>
	<br>
	@include('parts.footer')
@endsection