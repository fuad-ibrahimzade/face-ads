<!DOCTYPE html>
<html>
{{--@include('parts.header')--}}
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('parts.scripts')
</head>
   <body>
   {{--<div class="registration_class"></div>--}}
   {{--@include('parts.navbar')--}}
   {{--<script type="text/javascript">--}}
       {{--$(document).ready(function() {--}}
           {{--evvelkiPImage=$('.thumb_profile_image').attr('src');--}}
           {{--function readURL(input) {--}}
               {{--if (input.files && input.files[0]) {--}}
                   {{--var reader = new FileReader();--}}

                   {{--reader.onload = function (e) {--}}
                       {{--$('.thumb_profile_image').attr('src', e.target.result);--}}
                   {{--}--}}
                   {{--reader.readAsDataURL(input.files[0]);--}}
               {{--}--}}
               {{--else {--}}
                   {{--$('.thumb_profile_image').attr('src', evvelkiPImage);--}}
               {{--}--}}
           {{--}--}}

           {{--$(".profile_image").change(function () {--}}
               {{--readURL(this);--}}
           {{--});--}}
       {{--});--}}
   {{--</script>--}}
<div class="freelancer" style="background-color:#e6e6e6"><br>
<img style="width: auto; height: 80px;margin-left: auto;margin-right: auto; display: block" src="{{asset('images/logo.png')}}">
<fieldset style=" background-color:white ;width: 45%; margin-left: auto;margin-right: auto">
<form style= "margin-left:25px"; method="post" action="{{url('profile/'.Auth::user()->email.'/edit')}}" enctype="multipart/form-data">
    @csrf
<h3> Agentlik Qeydiyyatının Yenilənməsi </h3>
    <div class="main_errors">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div><strong>{{$error}}</strong></div>
            @endforeach
        @endif
    </div>
    <div class="other_errors"><strong></strong></div>
  <span style=" font-family:Georgia, serif; margin-left: 4%">Agentliyin adı</span> <span style=" font-family:Georgia, serif; margin-left: 10%;">  Email Ünvanı</span> <br>
 	<input style="margin-left: 25px;" placeholder="Freelancerin Adı və Soyadı" type="tex" name="name" value="{{Auth::user()->name}}"><input placeholder="mammadov@freelancer.az" style="margin-left: 33px;"
  type="email" name="email" value="{{Auth::user()->email}}">
 	<br>
  <br>
  <img style="margin-left: 25px;" height="55px"; src="{{(Auth::user()->profile_image)}}" class="thumb_profile_image"> <br>
  {{--<input style="margin-left:15px;"; type="submit" name="Profil Şəkilini Seç" value="Profil Şəkilini Seç">--}}
    &nbsp&nbsp&nbsp&nbsp&nbsp<label for="files" class="btn">Logonu Seç</label><br>
    &nbsp&nbsp&nbsp&nbsp&nbsp<input id="files" style=";" type="file" name="profile_image" class="profile_image">
 <br>
 <br>
 	<span style=" font-family:Georgia, serif; margin-left: 25px;">Şirkətinizin Haqqında  yazın </span>
  <br>
 	<textarea style=" width: 60%; height:60px; ; margin-left: 25px;" placeholder="Freelancer kimi faəliyyət göstəriyiniz müddəti, xidmət paketinizn qiyməti və s.məlumatları daxil edin." name="activity">{{Auth::user()->activity}}</textarea>
  <br> <br>
  <span style=" font-family:Georgia, serif; margin-left: 25px;">
 	Xidmət Göstərdiyiniz Sektoru Seçin <br>
 </span>
 	<br>

    <div class="sector_parent">
 	{{--<input type="checkbox" name="sector" value="Tibb" {{Auth::user()->sector=='Tibb' ? ' checked': ''}} > Tibb və Xəstəxana--}}
  {{--<input style="margin-left: 19px;" type="checkbox" name="sector" value="Əyləncə" {{Auth::user()->sector=='Əyləncə' ? ' checked': ''}}> Restoran və Əyləncə Mərkəzləri <br>--}}
  {{--<input type="checkbox" name="sector" value="Tikinti" {{Auth::user()->sector=='Tikinti' ? ' checked': ''}}> Tikinti--}}
  {{--<input style="margin-left: 95px;" type="checkbox" name="sector" value="Maliyyə" {{Auth::user()->sector=='Maliyyə' ? ' checked': ''}}> Maliyyə və Bank <br>--}}
  {{--<input type="checkbox" name="sector" value="Avtomabil" {{Auth::user()->sector=='Avtomabil' ? ' checked': ''}}> Avtomabil--}}
  {{--<input style="margin-left: 69px;" type="checkbox" name="sector" value="Turizm" {{Auth::user()->sector=='Turizm' ? ' checked': ''}}> Turizm və Otel <br>--}}
        @foreach(Auth::user()->sector as $sector)
            <div class="isector_parent">
                <input type="checkbox" name="sector[]" class="sector" value="{{$sector}}"  checked> {{' '.$sector}}
            </div>
        @endforeach
    </div>
  {{--<input type="checkbox" name="sector" value="Bütün" {{Auth::user()->sector=='Bütün' ? ' checked': ''}}> Bütün Sektorlar &nbsp&nbsp&nbsp--}}
  {{--<input placeholder="Sektor Əlavə Et " type="text" name=""> --}}
    <input placeholder="Digər Sektor Daxil Edin " type="text" name="new_sector_temp" class="new_sector_temp"> <input type="button" name="" value="Sektoru Əlavə Et" class="sector_adder" id="sector_adder">
    <input type="button" style="position: element(#sector_adder); transform: translateX(300px) translateY(-20px); height:20px; width:20px;" name="new_sector_remover" value="Seçilmiş Sektoru Poz" class="new_sector_remover ui-button-icon-primary ui-icon ui-icon-trash" style="width:5%; height:100%; display:block">
    <br><br>
  <span>Xidmətinizin Qiymət Aralığını Seçin</span> <br>
    <div class="qutu_parent">
  <select multiple='multiple'  name="pricing[]" class="pricing" id="pricing" {{isset(Auth::user()->pricing2)? ' disabled': ''}}>
      @foreach(Auth::user()->pricing as $pricing)
          <option>{{$pricing.' '.auth()->user()->currency}}</option>
      @endforeach
    {{--<option>0-250 AZN</option>--}}
    {{--<option>251-400 AZN</option>--}}
    {{--<option>401-600 AZN</option>--}}
    {{--<option>601-daha çox </option>--}}
  </select>
    @if(isset(Auth::user()->pricing2))
        <select multiple='multiple' name="pricing2[]" class="pricing2" {{isset(Auth::user()->pricing3)? ' disabled': ''}}>
            {{--@foreach(Auth::user()->smmservices as $smmservice)--}}
            {{--<option value="{{ $smmservice->packet_price }}">{{ $smmservice->packet_price }}</option>--}}
            {{--@endforeach--}}
            @foreach(Auth::user()->pricing2 as $pricing)
                <option>{{$pricing.' '.auth()->user()->currency}}</option>
            @endforeach
        </select>
    @endif
    @if(isset(Auth::user()->pricing3))
        {{--<br>--}}
        <select multiple='multiple' name="pricing3[]" class="pricing3">
            {{--@foreach(Auth::user()->smmservices as $smmservice)--}}
            {{--<option value="{{ $smmservice->packet_price }}">{{ $smmservice->packet_price }}</option>--}}
            {{--@endforeach--}}
            @foreach(Auth::user()->pricing3 as $pricing)
                <option>{{$pricing.' '.auth()->user()->currency}}</option>
            @endforeach
        </select>
    @endif
    </div>
    <button type="button" class="btn icon-btn btn-success new_price_box_adder"  >
        <span class="glyphicon btn-glyphicon glyphicon-plus img-circle text-success"></span>
        Yeni Qiymət qutu
    </button>
    <input type="button" style="position: element(#pricing); transform: translateX(0%) translateY(0%); height:1%; width:3%;" name="new_price_remover" value="Seçilmiş Qiymət Aralığını Poz" class="new_price_remover ui-button-icon-primary ui-icon ui-icon-trash" style="width:5%; height:100%">
    <p>
        <label for="price-amount" >Qiymət aralığı:</label>
        <input type="text" id="price-amount" style="border:0; color:#146e27; font-weight:bold;" onkeypress="return false;" spellcheck=false />
    </p>

    <div id="price-slider-range"></div><br>
  {{--<br>--}}
  {{--<br>--}}
  <input type="button" name="" value="Qiymət Aralığını Əlavə Et" class="new_price_adder">
  <br>
<span style="font-family:Georgia, serif;">Fəaliyyət göstərdiyiniz ölkəni seçin </span><br> <br>
  <select name="city" class="city">
      <option class="first_city" selected> {{Auth::user()->city}} </option>
  	{{--<option> Bakı, Azərbyacan </option>--}}
  	{{--<option>Ankara Türkiyə</option>--}}
  	{{--<option>Moskva Rusiya</option>--}}
  	{{--<option>Ölkə Əlavə Et</option>--}}
  </select><br><br>
    <input style="margin-left: 35px;" placeholder="Şəhət, Ölkə" type="text" name="new_city_temp" class="new_city_temp"> <input type="button" name="" value="Ölkə Əlavə Et" class="new_city_adder"><br><br><br>
    <span  style="margin-left: 5%">Şifrəni Yaz</span>  <span style="margin-left: 18%;">Şifrəni Təkrar Yazın</span> <br>
    <input type="password" name="password">  <input style="margin-left: 25px;" type="password" name="password_confirmation">

<br>
<br>
{{--<input type="checkbox" name=""> Şərtləri Qəbul Edirəm <br>--}}
{{--<a style="text-decoration-line: none;" "color:#ff1a1a;"   href="">Şərtlər və Qaydalar</a> --}}
    <input style="margin-left: 28%" type="submit" name="submit" value="Düzəlişi Tamamla"><br>
    {{--<p> Hesabım var, <a style="text-decoration-line: none;" href="afh.html">Daxil Ol</a></p>--}}

 </form>
</fieldset>

<br>
<br>
<br>
</div>
@include('parts.footer')
   </body>
</html>