<!DOCTYPE html>
<html>
<head>
  <title>Brendin Şəxsi Kabineti </title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/kabinet.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--@include('parts.head')--}}
    @include('parts.scripts')
{{--    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">--}}
    {{--<script src="{{asset('js/app.js')}}"></script>--}}
    {{--bu ikisi yenidi app.js ve app.css--}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    {{--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>--}}
    {{--jquery-3.2.1.slim.min.js//bu ashibka verir jquery ishlemir taninmir--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<div class="container float-left">
    <div class="row">
        <div class="col-3">
            <ul >
                {{--<li><img src="{{asset('storage/avatars/'.Auth::user()->profile_image)}}" style="margin-left : 4px; width: 45%;"></li>--}}
                <li><img src="{{Auth::user()->profile_image}}" style="margin-left : 4px; width: 45%;"></li>
                {{--<li> Bakı Şirkətlər Qrupu  </li>  --}}
                <li><em style="font-style: italic;">{{ Auth::user()->name }}</em> </li>
                <br>
                <span> Şirkət Haqqında <br>
                 {{--Şirkətimiz 3 ildir ki, müxtəlif sektorlarda fəaliyyət göstərir. <br> Digital medianın əhəmiyyətini nəzərə alaraq şirkətlərimizin digtal mediada  keyfiyyətinə önəm veririk.--}}
                 {{Auth::user()->activity}}
                </span> <br>
                <li style="font-size: 15px;"><strong>Fəaliyyət sektorum</strong>  <br>
                    {{--{{ Auth::user()->sector }}--}}
                    @foreach(Auth::user()->sector as $sector)
                        @if($loop->index<count(Auth::user()->sector)-1)
                            {{$sector .', '}}
                        @else
                            {{$sector .' '}}
                        @endif
                    @endforeach
                </li>
                <li style="font-size: 15px;"><strong>Yerləşdiyim məkan</strong><br>
                    @if(Auth::user()->street)
                        {{ Auth::user()->street.', '.Auth::user()->city }}
                    @else
                        {{ Auth::user()->city }}
                    @endif
                </li>
                <li><strong><span>Sahibkarın Markaları</span> </strong></li><br>
                  {{--<span style="margin-left: 18px;">Marka Adı : "Bakı" Əyləncə Mərkəzi </span> <br>--}}
                  {{--<span style="margin-left: 18px;">Yerləşmə: Bakı Azərbaycan</span> <br>--}}
                  {{--<span style="margin-left: 18px;">Sektor: Əyləncə </span> <br>--}}
                  {{--<span style="margin-left: 18px;">SMM xidməti üçün ayırdığı büdcə : 500-700AZN </span>--}}
                  {{--<br>--}}
                  {{--<br>--}}
                  {{--<span style="margin-left: 18px;">Marka Adı :" Bakı Turizm Şirkəti" </span> <br>--}}
                  {{--<span style="margin-left: 18px;">Yerləşmə: Bakı Azərbaycan</span> <br>--}}
                  {{--<span style="margin-left: 18px;">Sektor: Turizm </span> <br>--}}
                  {{--<span style="margin-left: 18px;">SMM xidməti üçün ayırdığı büdcə : 600-900AZN </span>--}}
                  @if(Auth::user()->businessMarks->get(0))
                    {{--border p-2--}}
                    <fieldset style="overflow:scroll; overflow: auto; max-height: 220px" class="">
                    <div class="">
                        {{--<div class="(panel panel-default) panel-heading panel-body">asdasd</div>--}}
                        @foreach(Auth::user()->businessMarks as $businessMark)
                            {{--w-auto--}}
                            <div id="sides" style="margin:0;" class="">
                                <div id="left" style="float:left; width: 75%; overflow: hidden">
                                    <br>
                                    <span><img src="{{$businessMark->profile_image}}" style="margin-left : 20px; width: 45px;"></span><br>
                                    <span style="margin-left: 18px;">Marka Adı : {{$businessMark->name}} </span> <br>
                                    <span style="margin-left: 18px;">Yerləşmə: {{$businessMark->city}} </span> <br>
                                    {{--<span style="margin-left: 18px;">Sektor: {{$businessMark->sector}} </span> <br>--}}
                                    <span style="margin-left: 18px;">Sektor:
                                        @foreach($businessMark->sector as $sector)
                                            @if($loop->index<count($businessMark->sector)-1)
                                                {{$sector .', '}}
                                            @else
                                                {{$sector .' '}}
                                            @endif
                                        @endforeach
                                    </span> <br>
                                    @if($businessMark->pricing)
                                        <span style="margin-left: 18px;">SMM xidməti üçün ayırdığı büdcə : {{$businessMark->mark_pricing}} </span> <br>
                                    @endif
                                </div>
                                <div id="right" style="float: right; width: 25%; overflow: hidden; margin-top: 10%">
                                    <br>
                                    &nbsp&nbsp&nbsp
                                    <div style=" margin-left: 8px">
                {{--                    <form action="{{url('mark/update')}}">--}}
                                        {{--<input  style=" margin-left: 18px; color: white; background-color: #ff6666;" type="submit" value="Markaya Düzəliş Et"><img style="width: 10px" src="{{asset('/images/pencil-edit-button.png')}}"></input>--}}
                                        {{--<button type="submit" style="background-color:transparent; border-color:transparent;">--}}
                                            <a href="{{url(Auth::user()->email.'/mark/update',$businessMark->id)}}"><img src="{{asset('/images/pencil-edit-button.png')}}" height="20"/></a>
                                        {{--</button>--}}
                                    {{--</form>--}}
                                    </div>
                                    &nbsp
                                    <div style="">
                                    <form action="{{url(Auth::user()->email.'/mark/delete',$businessMark->id)}}" method="post" style="display: block; margin: 0">
                                        @csrf
                                        {{--<input  style=" margin-left: 18px; color: white; background-color: #ff6666;" type="submit" value="Markaya Düzəliş Et"><img style="width: 10px" src="{{asset('/images/pencil-edit-button.png')}}"></input>--}}
                                        {{--<input type="hidden" value="{{$businessMark->id)}}" name="id">  //ashibka veriri--}}
                                        <button type="submit" style="background-color:transparent; border-color:transparent; display: inherit; margin: 0">
                                            <a href="" class=""><img src="{{asset('/images/delete-button.png')}}" height="20"/></a>
                                        </button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    </fieldset>
                @endif
                  <br>
                  {{--<br>--}}
                  <form action="{{url(Auth::user()->email.'/mark')}}">
                    @csrf
              <input  style=" margin-left: 18px; color: white; background-color: #ff6666;" type="submit" value="Marka Əlavə Et">
                </form>
                  <li><a href="{{url('profile/'.Auth::user()->email.'/edit')}}">Düzəliş Et </a></li>
                  <li><a href="{{url('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Hesabdan Çıx</a></li>
            </ul>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
        <div class="col-9">
            {{--margin-left:25%;padding:1px 16px;height:1000px;--}}
            <div style="margin-left:25%;padding:1px 16px;height:1000px;" class="text-center">
                {{--<button type="button" class="btn btn-primary">Primary</button>--}}
                <h3 style="text-align: center;" class="h3">Brendin Şəxsi Kabineti</h3>
                {{--<p  style="font-size: 30px; color: blue;"class="y1"> Agentlik və Freelancer Axtar</p>--}}
                <h5 class="h5"> Agentlik və Freelancer Axtar</h5>
                {{--<form  style="margin-left: 25px;" action="{{url('searchfilter_at_entrepreneur')}}" method="post">--}}
                    {{--@csrf--}}
                  <span>Büdcə Aralığını Daxil Et </span>
                    {{--<label for="price-amount" >Qiymət aralığı:</label>--}}
                    <span style="margin-left: 15%;"> Sektoru Seç </span>
                   {{--<select  name="Sektor ">--}}
                    {{--<option value="volvo">Tibb və Xəstəxana</option>--}}
                    {{--<option value="saab">Tikinti</option>--}}
                    {{--<option value="fiat">Restoran və Əyləncə Mərkəzləri </option>--}}
                    {{--<option value="volvo">Maliyyə və Bank </option>--}}
                    {{--<option value="saab"> Turizm və Otel </option>--}}
                    {{--<option value="fiat">Bütün Sektorlar </option>--}}
                    {{--</select>  --}}
                    <span class="sector_parent">
                        <select  name="sector">
                            @foreach(\App\Sector::all() as $sector)
                                {{--<div class="isector_parent">--}}
                                    <option name="sector" class="sector" value="{{$sector->sector}}"  checked> {{' '.$sector->sector}}
                                {{--</div>--}}
                            @endforeach
                        </select>
                    </span>
                    <br>
                    <br>

                    <span>Minumum </span>
                  <select name="price_min">
                      @for($i = 100; $i <= 2000; $i+=100)
                          <option value="{{ $i }}" {{$i==old('price_min') ? 'selected' : ($i==100 ? 'selected' : '')}}>{{ $i }}</option>
                      @endfor
                    </select>
                    <span>Maksimum </span>
                    <select name="price_max">
                        @for($i = 100; $i <= 2000; $i+=100)
                            <option value="{{ $i }}" {{$i==old('price_max') ? 'selected' : (($i==2000 && !old('price_max')) ? 'selected' : '')}}>{{ $i }}</option>
                        @endfor
                     </select>
                    {{--<label for="price-amount" >Qiymət aralığı:</label>--}}
                    {{--<input type="text" id="price-amount" style="border:0; color:#146e27; font-weight:bold;" onkeypress="return false;" spellcheck=false />--}}
                    {{--</p>--}}

                    {{--<div id="price-slider-range-entrepreneur"></div><br>--}}
                    <span style="margin-left: 15%;"> Şəhəri Seç </span>
                    <select name="city">
                        @foreach(\App\User::has('smmservices')->distinct()->get(['city']) as $city)
                            {{--<div class="isector_parent">--}}
                            <option name="city" class="city" value="{{$city->city}}"  checked> {{' '.$city->city}}
                            {{--</div>--}}
                        @endforeach
                    </select>

                    <input  style="margin-left: 20%;"type="button" value="Axtar" onclick="get_ServiceProvidersForEntrepreneurAJAX(this,1); return false;">  <br>
                {{--</form>--}}
                <div style="margin-left:5%;padding:1px 16px;height:1000px;">
                  <div class="col comparision-container text-left" style="display: inherit;" >
                    <div class="text-left" style="display: none">
                        <h2 style= "margin-left: 15px; color:blue;" class="text-center" >Agentlik</h2>
                        {{--<img width="6%"src="{{asset('images/a.jpg')}}"> <br>--}}
                        {{--<a style="text-decoration-line: none;" href="{{url('A-agentlik')}}">"A" Agentliyi </a>--}}
                        {{--<br>--}}
                        {{--<img  width="6%" src="{{asset('images/b.jpg')}}"><br>--}}
                        {{--<a  style="text-decoration-line: none;" href="{{url('b')}}"><span style= "margin-left: 9px;"> "B" Agentliyi  </span> </a>--}}
                        {{--<br>--}}
                        {{--<img style= "margin-left: 9px;" width="6%" src="{{asset('images/c.jpg')}}"><br>--}}
                        {{--<span style= "margin-left: 9px;"> "C" Agentliyi </span><br>--}}
                    </div>
                    {{--@if(Session::has('smmservice_provider_users'))--}}
                        {{--@foreach(Session::get('smmservice_provider_users') as $smmservice_provider_user)--}}
                          {{--@if($smmservice_provider_user->customer_type=='Agency')--}}
                              {{--<br>--}}
                              {{--<div class="smmservice_provider_user">--}}
                                  {{--<img  style="margin-left: 9px" width="6%" src="{{asset('storage/avatars/'.$smmservice_provider_user->profile_image)}}"><br>--}}
                                  {{--<a  style="text-decoration-line: none;" href="{{url('user/'.$smmservice_provider_user->email)}}"><span style= "margin-left: 9px;"> {{$smmservice_provider_user->name}}  </span> </a>--}}
                              {{--</div>--}}
                              {{--<br>--}}
                          {{--@endif--}}
                        {{--@endforeach--}}
                    {{--@endif--}}
                    <div></div>
                    <div class="text-left" style="display: none">
                        <h2 style= "margin-left: 15px; color:blue;" class="text-center">Freelancerlər</h2>
                        {{--<img width="8%;" src="{{asset('images/man.jpg')}}"><br>--}}
                        {{--<span style= "margin-left: 9px;"> Əli Əliyev  </span>--}}
                        {{--<br>--}}
                        {{--<br>--}}
                        {{--<img style= "margin-left: 9px;" width="6%" src="{{asset('images/man1.jpg')}}"><br>--}}
                        {{--<span style= "margin-left: 9px;"> Tural Vəliyev </span>--}}
                        {{--<br>--}}
                        {{--<img style= "margin-left: 9px;" width="6%" src="{{asset('images/woman.jpg')}}"><br>--}}
                        {{--<span style= "margin-left: 9px;"> Aytac Məmmədova </span><br>--}}
                    </div>
                    {{--@if(Session::has('smmservice_provider_users'))--}}
                      {{--@foreach(Session::get('smmservice_provider_users') as $smmservice_provider_user)--}}
                          {{--@if($smmservice_provider_user->customer_type=='Freelancer')--}}
                              {{--<br>--}}
                              {{--<div class="smmservice_provider_user">--}}
                                  {{--<img  style= "margin-left: 9px;" width="6%" src="{{asset('storage/avatars/'.$smmservice_provider_user->profile_image)}}"><br>--}}
                                  {{--<a  style="text-decoration-line: none;" href="{{url('user/'.$smmservice_provider_user->email)}}"><span style= "margin-left: 9px;"> {{$smmservice_provider_user->name}}  </span> </a>--}}
                              {{--</div>--}}
                              {{--<br>--}}
                          {{--@endif--}}
                      {{--@endforeach--}}
                    {{--@endif--}}
                    <div></div>
                  </div>
                  <div class="col smmprovider-loading" style="display: none"><img style="margin-left: auto;margin-right: auto; display: block;" src="{{asset('images/Preloader_21.gif')}}"></div>
                  <div class="col smmprovider-info-container text-center" style="display: none;">
                      <br>
                      <h2 style= "margin-left: 15px; color:blue;">Şirkətin fəaliyyəri haqda</h2>
                      <img width="100px;" src="{{asset('storage/avatars/business_mark_profile.jp')}}"><br>
                      <span style="width: 10%" class="a"> Agentlik Haqqında:<br>
                          <span>
                          "A" Agneltiyi  Azərbaycan bazarında 2016 ci ildən fəaliyyət göstərən reklam agentliyidir. Fəaliyyət istiqamətimiz restoran və əyləncə mərkəzləri üçün SMM xidməti təqdim etməkdir.  3 Növ Paketimiz Var: Minumum Paket 450 AZN;Orta-Paket 750 AZN;Maksimum Paket 1000 AZN
                          </span>
                      </span>
                      <div class="contacts-container">
                          <p style="font-family: Georgia, serif; color:#1a75ff;">"A" Agentliyi  ilə Əlaqə Saxlayın</p>
                          <p class="SNC">
                          <a href="http://facebook.com"><img width="7%"src="{{asset('images/f.png')}}"></a>
                          <a href="http://instagram.com"><img  width="12%" src="{{asset('images/i.jpg')}}"></a>
                          <a href="http://gmail.com"><img  width="8%" src="{{asset('images/g.jpg')}}"></a>
                      </div>
                      <h3> Müştərilərimiz </h3>
                      <div class="smm_customers" style="display: inherit">
                          {{--overflow: auto;--}}
                          <div style="white-space: nowrap; width: auto"> <a href="MFEM" style="text-decoration-line:none;"> Mega Fun Əyləncə Mərkəzinin  Performans Dəyərləndirməsinə Bax </a></div>
                          <div> Bakı Əyləncə Mərkəzi Perfromans Dəyərləndirməsinə Bax</div>
                      </div>
                  </div>
                  <div class="d-flex justify-content-center">
                      <div class="col flex-column smmprovider-work-container text-center" style="display: none;">
                          <p style=" font-size:20px; ">"Mega Fun Əyləncə Mərkəzi" Sosial Media Marketing Performans Dəyərləndirməsi</p>
                          <span> <img style="margin-left: auto;margin-right: auto; display: block;" src="{{asset('images/performance.jpg')}}"></span>
                          {{--margin-left: 15%;--}}
                          <a style="" href="#" class="btn btn-dark compare_link m-auto" onclick="compare_link_handler(this); return false;" >
                              Digəri ilə Müqayisə Et
                              {{--<input style=" " type="submit" name="Digəri ilə Müqayisə Et" value="Digəri ilə Müqayisə Et">--}}
                          </a>
                          {{--margin-left: 15%--}}
                      </div>
                      <div class="col flex-column smmprovider-work-compare-container text-center" style="display: none;">
                        <p style=" font-size:20px; ">"Mega Fun Əyləncə Mərkəzi" Sosial Media Marketing Performans Dəyərləndirməsi</p>
                        <span> <img style="margin-left: auto;margin-right: auto; display: block;" src="{{asset('images/performance.jpg')}}"></span>
                        {{--margin-left: 15%;--}}
                        <a style="color: #ff0900;" href="#" class="btn btn-light compare_link m-auto fa fa-times fa-lg" onclick="compare_link_handler(this,'close'); return false;" >
                            {{--Digəri ilə Müqayisə Et--}}
                            {{--<input type="button" name="" class="fa fa-times fa-lg">--}}
                            {{--<input style=" " type="submit" name="Digəri ilə Müqayisə Et" value="Digəri ilə Müqayisə Et">--}}
                        </a>
                        {{--margin-left: 15%--}}
                      </div>
                  </div>
                </div>
                {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button>--}}

                <div id="myModal1" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title h4" id="myLargeModalLabel">Müqayisə üçün seç</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ...
                                {{--<form  style="margin-left: 25px;" action="{{url('searchfilter_at_entrepreneur_ajax')}}" method="post">--}}
                                    {{--@csrf--}}
                                    <span>Büdcə Aralığını Daxil Et </span>
                                    {{--<label for="price-amount" >Qiymət aralığı:</label>--}}
                                    <span style="margin-left: 15%;"> Sektoru Seç </span>
                                    {{--<select  name="Sektor ">--}}
                                    {{--<option value="volvo">Tibb və Xəstəxana</option>--}}
                                    {{--<option value="saab">Tikinti</option>--}}
                                    {{--<option value="fiat">Restoran və Əyləncə Mərkəzləri </option>--}}
                                    {{--<option value="volvo">Maliyyə və Bank </option>--}}
                                    {{--<option value="saab"> Turizm və Otel </option>--}}
                                    {{--<option value="fiat">Bütün Sektorlar </option>--}}
                                    {{--</select>  --}}
                                    <span class="sector_parent">
                                        <select  name="sector2">
                                            @foreach(\App\Sector::all() as $sector)
                                                {{--<div class="isector_parent">--}}
                                                <option name="sector2" class="sector2" value="{{$sector->sector}}"  checked> {{' '.$sector->sector}}
                                                {{--</div>--}}
                                            @endforeach
                                        </select>
                                    </span>
                                    <br>
                                    <br>

                                    <span>Minumum </span>
                                    <select name="price_min2">
                                        @for($i = 100; $i <= 2000; $i+=100)
                                            <option value="{{ $i }}" {{$i==old('price_min') ? 'selected' : ($i==100 ? 'selected' : '')}}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <span>Maksimum </span>
                                    <select name="price_max2">
                                        @for($i = 100; $i <= 2000; $i+=100)
                                            <option value="{{ $i }}" {{$i==old('price_max') ? 'selected' : (($i==2000 && !old('price_max')) ? 'selected' : '')}}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                    {{--<label for="price-amount" >Qiymət aralığı:</label>--}}
                                    {{--<input type="text" id="price-amount" style="border:0; color:#146e27; font-weight:bold;" onkeypress="return false;" spellcheck=false />--}}
                                    {{--</p>--}}

                                    {{--<div id="price-slider-range-entrepreneur"></div><br>--}}
                                    <span style="margin-left: 15%;"> Şəhəri Seç </span>
                                    <select name="city2">
                                        @foreach(\App\User::has('smmservices')->distinct()->get(['city']) as $city)
                                            {{--<div class="isector_parent">--}}
                                            <option name="city2" class="city2" value="{{$city->city}}"  checked> {{' '.$city->city}}
                                            {{--</div>--}}
                                        @endforeach
                                    </select>

                                    <input  style="margin-left: 20%;"type="button" value="Axtar" name="searchfilter_at_entrepreneur_ajax" onclick="get_ServiceProvidersForEntrepreneurAJAX(this,2);">  <br>
                                {{--</form>--}}
                                <div class="col comparision-container2 text-left" style="display: inherit;" >
                                    <div class="text-left" style="display: none">
                                        <h2 style= "margin-left: 15px; color:blue;" class="text-center">Agentlik</h2>
                                    </div>
                                    <div></div>
                                    {{--@if(Session::has('smmservice_provider_users'))--}}
                                        {{--@foreach(Session::get('smmservice_provider_users') as $smmservice_provider_user)--}}
                                            {{--@if($smmservice_provider_user->customer_type=='Agency')--}}
                                                {{--<br>--}}
                                                {{--<div class="smmservice_provider_user2">--}}
                                                    {{--<img  style="margin-left: 9px" width="6%" src="{{asset('storage/avatars/'.$smmservice_provider_user->profile_image)}}"><br>--}}
                                                    {{--<a  style="text-decoration-line: none;" href="{{url('user/'.$smmservice_provider_user->email)}}"><span style= "margin-left: 9px;"> {{$smmservice_provider_user->name}}  </span> </a>--}}
                                                {{--</div>--}}
                                                {{--<br>--}}
                                            {{--@endif--}}
                                        {{--@endforeach--}}
                                    {{--@endif--}}
                                    <div class="text-left" style="display: none">
                                        <h2 style= "margin-left: 15px; color:blue;" class="text-center">Freelancerlər</h2>
                                    </div>
                                    <div></div>
                                    {{--@if(Session::has('smmservice_provider_users'))--}}
                                        {{--@foreach(Session::get('smmservice_provider_users') as $smmservice_provider_user)--}}
                                            {{--@if($smmservice_provider_user->customer_type=='Freelancer')--}}
                                                {{--<br>--}}
                                                {{--<div class="smmservice_provider_user2">--}}
                                                    {{--<img  style= "margin-left: 9px;" width="6%" src="{{asset('storage/avatars/'.$smmservice_provider_user->profile_image)}}"><br>--}}
                                                    {{--<a  style="text-decoration-line: none;" href="{{url('user/'.$smmservice_provider_user->email)}}"><span style= "margin-left: 9px;"> {{$smmservice_provider_user->name}}  </span> </a>--}}
                                                {{--</div>--}}
                                                {{--<br>--}}
                                            {{--@endif--}}
                                        {{--@endforeach--}}
                                    {{--@endif--}}
                                </div>
                                <div class="col smmprovider-loading2" style="display: none"><img style="margin-left: auto;margin-right: auto; display: block;" src="{{asset('images/Preloader_21.gif')}}"></div>
                                <div class="col smmprovider-info-container2 text-center" style="display: none;">
                                    <br>
                                    <h2 style= "margin-left: 15px; color:blue;">Şirkətin fəaliyyəri haqda</h2>
                                    <img width="100px;" src="{{asset('storage/avatars/business_mark_profile.jp')}}"><br>
                                    <span style="width: 10%" class="a"> Agentlik Haqqında:<br>
                                    <span>
                                    "A" Agneltiyi  Azərbaycan bazarında 2016 ci ildən fəaliyyət göstərən reklam agentliyidir. Fəaliyyət istiqamətimiz restoran və əyləncə mərkəzləri üçün SMM xidməti təqdim etməkdir.  3 Növ Paketimiz Var: Minumum Paket 450 AZN;Orta-Paket 750 AZN;Maksimum Paket 1000 AZN
                                    </span>
                                    </span>
                                    <div class="contacts-container2">
                                        <p style="font-family: Georgia, serif; color:#1a75ff;">"A" Agentliyi  ilə Əlaqə Saxlayın</p>
                                        <p class="SNC">
                                            <a href="http://facebook.com"><img width="7%"src="{{asset('images/f.png')}}"></a>
                                            <a href="http://instagram.com"><img  width="12%" src="{{asset('images/i.jpg')}}"></a>
                                            <a href="http://gmail.com"><img  width="8%" src="{{asset('images/g.jpg')}}"></a>
                                    </div>
                                    <h3> Müştərilərimiz </h3>
                                    <div class="smm_customers2" style="display: inherit">
                                        overflow: auto;
                                        <div style="white-space: nowrap; width: auto"> <a href="MFEM" style="text-decoration-line:none;"> Mega Fun Əyləncə Mərkəzinin  Performans Dəyərləndirməsinə Bax </a></div>
                                        <div> Bakı Əyləncə Mərkəzi Perfromans Dəyərləndirməsinə Bax</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

