<!DOCTYPE html>
<html>
@include('parts.head')
<body>

@include('parts.navbar')

<br>

<h3 style="font-family: Georgia, serif;" class="text-center">Təklif və Şikayətlərini Yaz </h3>
{{--<fieldset style="margin-left: 33%;  width: 38%; height: 260px;">--}}
{{--<form style="margin-left: 22%;">--}}
	{{--<span>Ad və Soyad </span><br><input type="text" name="name"> <br>--}}
	{{--<span>Email ünvanı</span> <br><input type="email" name="email"> <br>--}}
	{{--<span>Kateqoriyanı Seç</span> <br>--}}
	{{--<select name="category">--}}
		{{--<option>Sahibkar</option>--}}
		{{--<option>Agentlik</option>--}}
		{{--<option>Freelancer</option>--}}
	{{--</select> <br>--}}
	{{--<span>Şikayət və Təkliflərinizi bizə yazın</span><br><textarea style="width: 45%; height:80px;"> </textarea> <br> <br>--}}
	 {{--<input type="submit" name="Göndər" value="Göndər">--}}
{{--</form>--}}
{{--</fieldset>--}}
{{--<div class="">--}}
	{{--<div class=" text-center">--}}
		{{--<h4>Brend olaraq qeydiyyat</h4>--}}
	{{--</div>--}}
	{{--<div class="row text-center">--}}
		{{--<div class="col mt-auto mb-auto">--}}
			{{--<p class="about"> <br> <br> <br>Əgər brendiniz üçün sosial media marketing  xidməti axtarırsınızsa brend <br> qeydiyyatı bölməsindən  qeydiyyatdan keçib, öz hesabınızı yaradırsınız <br> və öz kriteriyalarınızı daxil edib tez bir zamanda   brendinizə uyğun <br> əməkdaş tapa bilərsiniz.--}}
				{{--Brendlər üçün <a style="text-decoration-line:none; color:black; font-weight: bold;"  href="{{url('brand')}}">qeydiyyat</a> və istifadə ödənişsizdir. </p>--}}
		{{--</div>--}}
		{{--<div class=" col mt-auto mb-auto">--}}
			{{--display: block;margin-right: auto;margin-left: auto;--}}
			{{--<img style=" width : 550px; margin-right: 50px" class="SMM1" src="{{asset('images/brand3.png')}}">--}}
		{{--</div>--}}
	{{--</div>--}}
{{--</div>--}}
	{{--margin-left: 33%;  width: 38%;--}}
{{--#dae0e5--}}
<fieldset style=" margin-left: 33%;  width: 38%;height: 260px; background-color:#e6e6e6; border:1px solid rgba(0,0,0,0.24); padding-bottom: 10px; border-radius: 10px" class="mt-5">
	{{--margin-left: 22%;--}}
	<form style="" class="">
		<div class="" style="margin-left: 80px; margin-top: 20px">
			<div class="row w-100">
				<div class="col">
				<span>Ad </span><br><input type="text" name="name"> <br>
				</div>
				<div class="col">
				<span>Email ünvanı</span> <br><input type="email" name="email"> <br>
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
					<textarea placeholder="Şikayət,Təklif və İradlarını bizə yaz" style="width: 45%; height:80px;"></textarea> <br> <br>
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
{{--<div style="margin-left:30%">--}}
 {{--<p style="font-family: Georgia, serif; ">Bizi İzlə </p>--}}
{{--<a href="http://facebook.com"><img width="7%"src="{{asset('images/f.png')}}"></a>--}}
{{--<a href="http://instagram.com"><img  width="12%" src="{{asset('images/i.jpg')}}"></a>--}}
{{--</div>--}}
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
{{--<br>--}}
{{--<br>--}}
{{--<br>--}}



@include('parts.footer')
</body>
</html>