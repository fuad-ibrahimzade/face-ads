<!DOCTYPE html>
<html>
{{--@include('parts.head')--}}
<body>
{{--@include('parts.navbar')--}}
<link rel="stylesheet" type="text/css" href="{{asset('css/kabinet.css')}}">
<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="{{asset('js/app.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
@include('parts.scripts')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<div class="">
<div class="">
    <ul >
        <li><img src="{{(Auth::user()->profile_image)}}" style="margin-left : 4px; width: 45%;"></li>
        <li><em style="font-style: italic;">{{ Auth::user()->name }}</em> </li>
        {{--<li><img src="{{asset('img/rating.jpg')}}" style="width: 40%;"></li>--}}
        {{--<li style="font-size: 15px;">Haqqında  <br>--}}
        {{--3 ildir ki, SMM sahəsində frilanser fəaliyyəti ilə məşğul oluram <br>--}}
        {{--2 cür xidmət paketi təqdim edirəm. <br>--}}
        {{--1 ci xidmət paket- 200 AZN <br>--}}
        {{--2 ci xidmət paketi-400 AZNdır</li> --}}
        <li style="font-size: 15px;"><strong>Haqqında</strong>  <br>
            {{ Auth::user()->activity }}
        </li>
        <li style="font-size: 15px;"><strong>Fəaliyyət sektoru</strong>  <br>
            {{--{{ Auth::user()->sector }}--}}
            @foreach(Auth::user()->sector as $sector)
                @if($loop->index<count(Auth::user()->sector)-1)
                    {{$sector .', '}}
                @else
                    {{$sector .' '}}
                @endif
            @endforeach
        </li>
        <li style="font-size: 15px;"><strong>Yerləşdiyi məkan</strong><br>
            {{--@if(Auth::user()->street)--}}
            {{--{{ Auth::user()->street.', '.Auth::user()->city }}--}}
            {{--@else--}}
            {{--{{ Auth::user()->city }}--}}
            {{--@endif--}}
            {{ Auth::user()->city }}
        </li>
        <li>
            <strong>Xidmət paketlərinin qiymətləri</strong><br>
            {{--@php--}}
            {{--print_r(Auth::user()->smmservices);--}}
            {{--@endphp--}}
            {{--@if(isset(Auth::user()->smmservices))--}}
            {{--<select name="pricingA" class="pricingA">--}}
            {{--@foreach(Auth::user()->smmservices as $smmservice)--}}
            {{--<option>{{$smmservice->pricing}}</option>--}}
            {{--@endforeach--}}
            {{--</select>--}}
            {{--@endif--}}
            {{--@if(isset(Auth::user()->pricing2))--}}
            {{--<em style="font-style: italic;">1. </em>--}}
            {{--@endif--}}
            <em style="font-style: italic;">1- </em>
            <select name="pricing_profile[]" class="pricing_profile">
                {{--@foreach(Auth::user()->smmservices as $smmservice)--}}
                {{--<option value="{{ $smmservice->packet_price }}">{{ $smmservice->packet_price }}</option>--}}
                {{--@endforeach--}}
                @foreach(Auth::user()->pricing as $pricing)
                    <option>{{$pricing}}</option>
                @endforeach
            </select>
            {{--<br>--}}
            @if(isset(Auth::user()->pricing2))
                &nbsp;
                <em style="font-style: italic;">2- </em>
                <select name="pricing_profile2[]" class="pricing_profile2">
                    {{--@foreach(Auth::user()->smmservices as $smmservice)--}}
                    {{--<option value="{{ $smmservice->packet_price }}">{{ $smmservice->packet_price }}</option>--}}
                    {{--@endforeach--}}
                    @foreach(Auth::user()->pricing2 as $pricing)
                        <option>{{$pricing}}</option>
                    @endforeach
                </select>
            @endif
            @if(isset(Auth::user()->pricing3))
                {{--<br>--}}
                &nbsp;
                <em style="font-style: italic;">3- </em>
                <select name="pricing_profile3[]" class="pricing_profile3">
                    {{--@foreach(Auth::user()->smmservices as $smmservice)--}}
                    {{--<option value="{{ $smmservice->packet_price }}">{{ $smmservice->packet_price }}</option>--}}
                    {{--@endforeach--}}
                    @foreach(Auth::user()->pricing3 as $pricing)
                        <option>{{$pricing}}</option>
                    @endforeach
                </select>
            @endif
        </li>
        @if(false)
            @if(isset(Auth::user()->social_links))
                <li style="font-size: 15px;"><strong>Sosial Profiller</strong><br>
                    @foreach(Auth::user()->social_links as $social_link_name => $social_link_url)
                        {{--{{ $social_link }}<br>--}}
                        @if(isset($social_link_url))
                            <a href="{{$social_link_url}}">
                                <img src="{{asset('images/social/'.$social_link_name.'-color.svg')}}" alt="Twitter" height="20px" style="filter: grayscale(100%);">
                            </a>
                            <br>
                        @endif
                    @endforeach
                </li>
            @endif
        @endif
        {{--<li>--}}
        {{--<strong>Xidmətin içinə daxildir</strong><br>--}}
        {{--<span class="services_for_price">{{Auth::user()->smmservices->get(0)->services_for_price}}</span>--}}
        {{--</li>--}}
        <li><em><a href="{{url('profile/'.Auth::user()->email)}}" class="go_profile active btn-light">Profilə qayıt</a></em></li>
        {{--<li><a href="{{url('services/'.Auth::user()->email)}}">SMM Servislərim və işlərim</a></li>--}}
        <li><em><a href="{{url('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Hesabdan Çıx</a></em></li>
    </ul>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>
<div class="freelancer" style="margin-left: 10%"><br>
    <a href="{{url('profile/'.Auth::user()->email)}}">
        <img style="width: auto; height: 80px;margin-left: auto;margin-right: auto; display: block" src="{{asset('images/logo.png')}}">
    </a>
    <fieldset style=" background-color:#e6e6e6 ;width: 600px;padding-bottom: 20px;margin-left: auto;margin-right: auto;border-radius: 10px">
        <form style= "margin-left:25px"; method="post" action="{{url(auth()->user()->email.'/add-smm-work')}}" enctype="multipart/form-data" class="form" novalidate >
            @csrf
            {{--<h3> Yeni Marka Üzrə Iş Qeydiyyatı </h3>--}}
            <h3 class="text-center"> Marka Əlavə Et </h3>
            <div class="main_errors">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div><strong>{{$error}}</strong></div>
                    @endforeach
                @endif
            </div>
            <div class="other_errors"><strong></strong></div>
            <span style=" font-family:Georgia, serif;margin-left: 5%">Markanın Adı</span>       <br>
            <input style="margin-left: 25px;" placeholder="" type="tex" name="name" value="{{old('name')}}">
            <br>
            <br>
            {{--<img style="margin-left: 25px;" height="55px"; src="../../../../../Users/Sabirfd/Desktop/0innoland%20layihe/10%20avgust/0/Yeni%20FaceAds%20saytı%20-%20Copy/images/profile.png"> <br>--}}
            {{--<input style="margin-left:15px;"; type="submit" name="Logonu Seç" value="Logonu Seç">--}}
            <img style="margin-left: 25px;" height="55px"; src="{{asset('images/profile.png')}}" class="thumb_profile_image"> <br>
            &nbsp&nbsp&nbsp&nbsp&nbsp<label for="files" class="btn">Markanın Logosunu Seç</label><br>
            &nbsp&nbsp&nbsp&nbsp&nbsp<input id="files" style=";" type="file" name="profile_image" class="profile_image">
            <br>
            <br>
            <span style="font-family:Georgia, serif; margin-left: 25px;">İş gördüyünüz Markanın Biznes fəaliyyəti Haqqında yazın </span>
            <br>
            <br>
            <textarea style="width: 60%; height: 60px; margin-left: 25px;" placeholder="." name="activity">{{old('activity')}}</textarea>
            <br> <br>
            <span style=" font-family:Georgia, serif;margin-left: 25px;">Markanın Xidmət göstərdiyi sektoru seçin <br>
            </span>
            <br>
            <div style="font-family:Georgia, serif;margin-left: 25px;">
            <div class="sector_parent">
                <div class="isector_parent">
                    <input type="checkbox" name="sector[]" value="Tibb" class="sector"> Tibb və Xəstəxana
                </div>
                <div class="isector_parent">
                    <input style="" type="checkbox" name="sector[]" value="Əyləncə" class="sector"> Restoran və Əyləncə Mərkəzləri
                    {{--<br>--}}
                    {{--margin-left: 19px;--}}
                </div>
                <div class="isector_parent">
                    <input type="checkbox" name="sector" value="Tikinti" class="sector"> Tikinti
                </div>
                <div class="isector_parent">
                    <input style="" type="checkbox" name="sector[]" value="Maliyyə" class="sector"> Maliyyə və Bank
                    {{--<br>--}}
                    {{--margin-left: 95px;--}}
                </div>
                <div class="isector_parent">
                    <input type="checkbox" name="sector[]" value="Avtomabil" class="sector"> Avtomabil
                </div>
                <div class="isector_parent">
                    <input  style="" type="checkbox" name="sector[]" value="Turizm" class="sector"> Turizm və Otel
                    {{--<br>--}}
                    {{--"margin-left: 69px;--}}
                </div>
            </div>
            {{--<input  placeholder="Sektor Əlavə Et "type="text" name="">--}}
            <input placeholder="Digər Sektor Daxil Edin " type="text" name="new_sector_temp" class="new_sector_temp"> <input type="button" name="" value="Sektoru Əlavə Et" class="sector_adder">
            {{--<input type="button" style="position: element(#sector_adder); transform: translateX(300px) translateY(-20px); height:20px; width:20px;" name="new_sector_remover" value="Seçilmiş Sektoru Poz" class="new_sector_remover fa fa-trash-o" style="width:5%; height:100%; display:block">--}}
            <a   name="new_sector_remover" value="Seçilmiş Sektoru Poz" class="new_sector_remover fa fa-trash-o fa-lg btn"></a>
            <br><br>
            <span style=" font-family:Georgia, serif;">Markanım Yerləşdiyi ölkəni seçin </span><br> <br>
            <select name="city" value="{{old('city')}}" class="city">
                <option value="AZ">Azərbaycan</option>
                {{--@include('parts.countries')--}}
                {{--<option class="first_city"> Bakı, Azərbyacan </option>--}}
                {{--<option>Ankara Türkiyə</option>--}}
                {{--<option> Moskva Rusiya</option>--}}
                {{--<option>Ölkə Əlavə Et</option>--}}
            </select>
            {{--<input style="margin-left: 35px;" placeholder="Şəhət, Ölkə" type="text" name="new_city_temp" class="new_city_temp"> <input type="button" name="" value="Ölkə Əlavə Et" class="new_city_adder"><br>--}}
            <br><br>
                {{--<span style=" font-family:Georgia, serif;margin-left: 5%">Markanın Odədiyi(Ödəyəcəyi) </span>       <br>--}}
                {{--<input style="margin-left: 25px;" placeholder="" type="tex" name="pricing" value="{{old('pricing')}}">--}}
                {{--<br>--}}
                <span style=" font-family:Georgia, serif;margin-left: 5%">İşin Başladığı zaman</span>       <br>
                <input style="margin-left: 25px;" placeholder=""  name="work_start" value="{{old('work_start')}}" width="276" >
                <br>
                {{--<span style=" font-family:Georgia, serif;margin-left: 5%">İşin Qurtardığı(Qurtaracağı) zaman</span>--}}
                <span style=" font-family:Georgia, serif;margin-left: 5%">İşin Bitmə zamanı</span>
                <br>
                <input style="margin-left: 25px;" placeholder=""  name="work_end" value="{{old('work_end')}}" width="276" >
                {{--<input id="datepicker" width="276" />--}}
            <br>
            <br>
            <input style="margin-left: 28%" type="submit" name="submit" value="Markanı əlavə et" class="submit"> <br>
            {{--<p> Hesabım var, <a style="text-decoration-line: none;" href="Slogin.html">Daxil Ol</a></p>--}}
                {{--<div class="text-center">--}}
                {{--<a href="{{url('profile/'.auth()->user()->email)}}" class="btn btn-dark">Geri qayıt</a>--}}
                {{--</div>--}}
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
</div>
    <footer class="text-center" style=" z-index: -1;padding-bottom: 20px; text-align: center; position: relative; width:100%; clear: both;">&copy Bütün Hüquqlar Qorunur <br>FaceAds 2019</footer>
</div>
</body>
{{--@include('parts.footer')--}}
</html>