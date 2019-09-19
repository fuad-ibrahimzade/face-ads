<!DOCTYPE html>
<html>
@include('parts.head')
<body>
{{--<ul>--}}
	{{--{{(new \Filestack\Filelink(UsersTableSeeder::filestack_handler_agency_profile, "AcDOjh26RKicWlRgz3T6Xz"))->url()}}--}}
	{{--{{(new \Filestack\Filelink(UsersTableSeeder::filestack_handler_freelancer_profile, "AcDOjh26RKicWlRgz3T6Xz"))->url()}}--}}
	{{--{{(new \Filestack\Filelink(UsersTableSeeder::filestack_handler_entrepreneur_profile, "AcDOjh26RKicWlRgz3T6Xz"))->url()}}--}}
	{{--{{(new \Filestack\Filelink(UsersTableSeeder::filestack_handler_business_mark_profile, "AcDOjh26RKicWlRgz3T6Xz"))->url()}}--}}
	{{--<img src="{{UsersTableSeeder::filestack_handler_agency_profile}}">--}}
	{{--<img src="{{UsersTableSeeder::filestack_handler_freelancer_profile}}">--}}
	{{--<img src="{{UsersTableSeeder::filestack_handler_entrepreneur_profile}}">--}}
	{{--<img src="{{UsersTableSeeder::filestack_handler_business_mark_profile}}">--}}

  {{--<li style="margin-left: 40px;"><a  href="{{route('faceads')}}">Əsas Səhifə</a></li>--}}
  {{--<li><a href="{{route('about')}}">Biz Kimik ? </a></li>--}}
  {{--<li><a href="{{route('SI')}}"> Necə İstifadə Edim ?</a></li>--}}
  {{--<li><a href="{{route('rating')}}">Ən Yaxşını Tap </a></li>--}}
  {{--<li><a href="{{route('contact')}}">Əlaqə</a></li>--}}
  {{--<li><a href="{{route('register')}}"> Qeydiyyat</a></li>--}}
  {{--<li><a href="{{route('login')}}">Daxil Ol</a></li>--}}
{{--</ul>--}}
@include('parts.navbar')
{{--<div class="first">--}}
{{--<br>--}}
{{--<br>--}}
{{--<br>--}}
{{--<br>--}}
{{--<img src="{{asset('images/Logo.png')}}" style="margin-left: 10px;"> <img src="{{asset('images/a1.png')}}" style="height: 270px;" >--}}
{{--<br>--}}
{{--<br>--}}
{{--<br>--}}
{{--<br>--}}
{{--<br>--}}
{{--<br>--}}
{{--<br>--}}
{{--<br>--}}


{{--<br>--}}
{{--</div>--}}
{{--<div class="second">--}}
	{{--<h3 style="color:  #0052cc; margin-left"> Rəqəmsal Marketinqin Analizi Nədir ? </h3>--}}
	{{--<img style="margin-left:30%; width: 30%; height: 55%;" src="{{asset('images/fi.png')}}">--}}
	{{--<p style="margin-left: 30px; font-size: 20px;">Rəqəmsal marketinq vasitələri ənənəvi vasitələrindən hədsiz dərəcədə fərqlənir. Bu səbəbdən də hazırda bir çox şirkətlər büdcəsinin böyük bir qismini rəqəmsal marketinqə ayırır. Nəticədə siz müştərilərinizin reaksiyalarını izləyə bilərsiniz. Beləliklə də düzgün nəticəni tez bir zamanda görüb, reklamın nə qədər uğurlu olduğunu analiz edə bilərsiniz. Nəticəyə əsasən bu sahədə yeni strategiyalar həyata keçirib, şirkətin fəaliyyət sahəsində  daha da inkişaf etməsinə şərait yarada bilərsiniz.--}}
    {{--Ənənəvi marketinqdə siz hədəf auditoriyanızı təxmini seçə bilirsiniz, rəqəmsalda isə dəqiqliklə bunu müəyyən edə bilərsiniz. Rəqəmsal marketinqdə diqqət cəlb edən,  insanlarda maraq oyadan işlər görməklə siz potensial müştərilərinizi veb-saytınızı ziyarət etməyə, məhsul və ya xidmətlərinizlə maraqlanmağa,onları dəyərləndirməyə və s. sövq edə bilərsiniz. <input type="button" name="" value="Daha Çox Bax"s> </p>--}}
	{{--<br>--}}
	{{--<br>--}}
	{{--<br>--}}
	{{--<br>--}}
	{{--<br>--}}
	{{--</div>--}}
	{{--<div>--}}
	{{--<h3 style="color:#0052cc;  font-family: oblique; "> Dünya ölkələri üzrə istifadəçilərimiz </h3>--}}
	{{--<img width="100%" height=550px; src="{{asset('images/map.png')}}">--}}
    {{--</div>--}}
<br>
<br>
<br>
{{--<div > <p class="A1"> SMM xidməti satanlar və <br> Brendlər arasındsa  KÖRPÜ  </p>--}}
	{{--<p style="margin-left:10%; font-style: italic;"> Agentliklər/Freelancerlər Brendlərlə tez bir zamanda <br> əlaqə yaradıb SMM xidmətlərini sata biləcəklər. </p> </div>--}}
{{--<img class="SMM" src="{{asset('images/SMM.png')}}">--}}

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

		{{--<div class=" ">--}}
			{{--display: block;margin-right: auto;margin-left: auto;--}}
			<img class="SMM" style="width: 900px; margin-left: 200px;" src="{{asset('images/SMM.png')}}">
		{{--</div>--}}
	</div>
</div>
{{--<br>--}}
{{--<br>--}}
{{--<br>--}}
{{--<br>--}}
{{--<br>--}}
{{--<br>--}}
<br>
<br>
{{--<br>--}}
{{--<br>--}}
</body>
@include('parts.footer')
</html>