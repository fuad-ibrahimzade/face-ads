<!DOCTYPE html>
<html>
<head>
  <title>Agentlik Kabineti </title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/kabinet.css')}}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @include('parts.scripts')
</head>
<body>
<ul >
  <li><img src="{{(Auth::user()->profile_image)}}" style="margin-left : 4px; width: 45%;"></li>
  <li><em style="font-style: italic;">{{ Auth::user()->name }}</em> </li>
  <li><img src="{{asset('img/rating.jpg')}}" style="width: 40%;"></li>
  <li style="font-size: 15px;">Haqqında  <br>
  	 {{--A agentliyi 3 ildir ki, SMM sahəsində  fəaliyyət göstərir. <br>--}}
  {{--2 cür xidmət paketi təqdim edirik <br>--}}
  {{--1 ci xidmət paket- 200 AZN <br>--}}
  {{--2 ci xidmət paketi-400 AZNdır--}}
    {{Auth::user()->activity}}
  </li>
  <li style="font-size: 15px;"><strong>Fəaliyyət sektoru</strong>  <br>
    @foreach(Auth::user()->sector as $sector)
      @if($loop->index<count(Auth::user()->sector)-1)
        {{$sector .', '}}
      @else
        {{$sector .' '}}
      @endif
    @endforeach
  </li>
  <li style="font-size: 15px;"><strong>Yerləşdiyi məkan</strong><br>
    @if(Auth::user()->street)
      {{ Auth::user()->street.', '.Auth::user()->city }}
    @else
      {{ Auth::user()->city }}
    @endif
  </li>
  <li>
    <strong>Xidmət paketlərinin qiymətləri</strong><br>
    {{--@php--}}
    {{--print_r(Auth::user()->smmservices);--}}
    {{--@endphp--}}
      @if(isset(Auth::user()->smmservices))
          <select name="pricingA" class="pricingA">
          @foreach(Auth::user()->smmservices as $smmservice)
              <option>{{$smmservice->pricing}}</option>
          @endforeach
          </select>
      @endif
    @if(isset(Auth::user()->pricing2))
    <em style="font-style: italic;">1. </em>
    @endif
    <select name="pricing" class="pricing">
      {{--@foreach(Auth::user()->smmservices as $smmservice)--}}
      {{--<option value="{{ $smmservice->packet_price }}">{{ $smmservice->packet_price }}</option>--}}
      {{--@endforeach--}}
        {{--{{Auth::user()->smmservices.'asasas'}}--}}
      @foreach(Auth::user()->pricing as $pricing)
        <option>{{$pricing}}</option>
      @endforeach
    </select>
    @if(isset(Auth::user()->pricing2))
    <br>
    <em style="font-style: italic;">2. </em>
    <select name="pricing2[]" class="pricing2">
      {{--@foreach(Auth::user()->smmservices as $smmservice)--}}
      {{--<option value="{{ $smmservice->packet_price }}">{{ $smmservice->packet_price }}</option>--}}
      {{--@endforeach--}}
      @foreach(Auth::user()->pricing2 as $pricing)
        <option>{{$pricing}}</option>
      @endforeach
    </select>
    @endif
    @if(isset(Auth::user()->pricing3))
    <br>
    <em style="font-style: italic;">3. </em>
    <select name="pricing3[]" class="pricing3">
      {{--@foreach(Auth::user()->smmservices as $smmservice)--}}
      {{--<option value="{{ $smmservice->packet_price }}">{{ $smmservice->packet_price }}</option>--}}
      {{--@endforeach--}}
      @foreach(Auth::user()->pricing3 as $pricing)
        <option>{{$pricing}}</option>
      @endforeach
    </select>
    @endif
  </li>
  <li><a href="{{url('profile/'.Auth::user()->email.'/edit')}}">Düzəliş Et </a></li>
  <li><a href="{{url('services/'.Auth::user()->email)}}">SMM Servislərim və işlərim</a></li>
  <li><a href="{{url('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Hesabdan Çıx</a></li>
</ul>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
  @csrf
</form>
<div style="margin-left:25%;padding:1px 16px;height:1000px;">
  <h2 style="text-align: center;"> Agentliyin Şəxsi Kabineti</h2>
  {{--<p> İlk ay saytdan istifadə ödənişsizdir. Bu qayda yalnız  3 səhifənin son 1 ay ərzində ki, aktivliyini dəyərləndirmək üçün istifadə edirlə bilər.50 Azn ödə 1 səhifənin performansını dəyərləndir,200 Azn ödə 5 səhifənin performansı dəyərləndir ,450 Azn ödə 10 səhifənin perfomansını dəyərləndir </p>--}}
  {{--<p style="font-size: 20px; text-align: center;" >Performans dəyərləndirməsini başlat</p>--}}
  <h4 style="text-align: center;"> Agentliyin Portfoliosu </h4>
  <input  style="background-color:#1a75ff;color:white; margin-left: 40%;" type="button" name="" value="Marka Əlavə Et ">
  <p style="font-size: 20px;"> Kartın Məlumatlarını Daxil Et və Ödənişə Başla </p> <br>
  <fieldset style="width: 40%;">
  	<p style="margin-left: 38%;">
  <input type="text" name="" placeholder="Kartın üzərindəki şifrəni daxil et">
  <br>
  <br>
  <input type="text" name="" placeholder="Kartın arxasındakı şifrəni daxil et">
  <br>
  <br>
  <input type="password" name="" placeholder="şifrəni Daxil Et ">
  <br>
  <br>
  <input type="button" name="" value=" Ödənişi Ödə">
</p>
  </fieldset>
</body>
</html>