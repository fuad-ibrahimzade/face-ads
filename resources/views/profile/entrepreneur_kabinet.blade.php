<!DOCTYPE html>
<html>
<head>
  <title>Brendin Şəxsi Kabineti </title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/kabinet.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('parts.scripts')

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<div class="container float-left">
    <div class="row">
        <div class="col-4">
            <ul >
                <li><img src="{{Auth::user()->profile_image}}" style="margin-left : 4px; width: 45%;"></li>
                <li><em style="font-style: italic;">{{ Auth::user()->name }}</em> </li>
                {{--<br>--}}
                <li> <strong> Şirkət Haqqında </strong> <br>
                 {{Auth::user()->activity}}
                </li>
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
                <li><strong><span>Sahibkarın Markaları</span> </strong>
                    <form action="{{url(Auth::user()->email.'/mark')}}" style="display: inline;">
                        @csrf
                        <input  class="" style=" margin-left: 1px; color: white; background-color: #ff6666;" type="submit" value="Marka Əlavə Et">
                    </form>
                </li>
                  @if(Auth::user()->businessMarks->get(0))
                    {{--border p-2--}}
                <div class="card">
                    <div class="card-header">
                    <fieldset style="overflow:scroll; overflow: auto; max-height: 180px" class="">
                    <div class="">
                        {{--<div class="(panel panel-default) panel-heading panel-body">asdasd</div>--}}
                        @foreach(Auth::user()->businessMarks as $businessMark)
                            {{--w-auto--}}
                            <div id="sides" style="margin:0;" class="">
                                <div id="left" style="float:left; width: 83%; overflow: hidden">
                                    <br>
                                    {{--bidene ashagidaki profile image margin-left 20px--}}
                                    <span><img src="{{$businessMark->profile_image}}" style="margin-left : 0px; width: 45px;"></span><br>
                                    <span style="margin-left: 0px;">Marka Adı : {{$businessMark->name}} </span> <br>
                                    <span style="margin-left: 0px;">Yerləşmə: {{$businessMark->city}} </span> <br>
                                    {{--<span style="margin-left: 18px;">Sektor: {{$businessMark->sector}} </span> <br>--}}
                                    <span style="margin-left: 0px;">Sektor:
                                        @foreach($businessMark->sector as $sector)
                                            @if($loop->index<count($businessMark->sector)-1)
                                                {{$sector .', '}}
                                            @else
                                                {{$sector .' '}}
                                            @endif
                                        @endforeach
                                    </span> <br>
                                    @if($businessMark->pricing)
                                        <span style="margin-left: 0px;">SMM xidməti üçün ayırdığı büdcə : {{$businessMark->pricing}} </span> <br>
                                    @endif
                                </div>
                                <div id="right" style="float: right; width: 17%; overflow: hidden; margin-top: 10%">
                                    <br>
                                    &nbsp&nbsp&nbsp
                                    <div style=" margin-left: 8px">
                                            <a href="{{url(Auth::user()->email.'/mark/update',$businessMark->id)}}"><img src="{{asset('/images/pencil-edit-button.png')}}" height="20"/></a>
                                    </div>
                                    &nbsp
                                    <div style="">
                                    <form action="{{url(Auth::user()->email.'/mark/delete',$businessMark->id)}}" method="post" style="display: block; margin: 0">
                                        @csrf
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
                    </div>
                </div>
                @endif
                {{--<br>--}}
                  {{--<br>--}}

                @if(true)
                    @if(isset(Auth::user()->social_links))
                        <li style="font-size: 15px;"><strong>Sosial Profiller</strong><br>
                            @foreach(Auth::user()->social_links as $social_link_name => $social_link_url)
                                @if(isset($social_link_url))
                                    <a class="btn" style="width: 60px" href="{{$social_link_url}}">
                                        <img src="{{asset('images/social/'.$social_link_name.'-color.svg')}}" alt="{{$social_link_name}}" height="20px" style="filter: grayscale(0%);">
                                    </a>
                                @endif
                            @endforeach
                        </li>
                    @endif
                @endif
                  <li><a href="{{url('profile/'.Auth::user()->email.'/edit')}}" class="edit_profile">Profilə Düzəliş Et </a></li>
                  <li><a href="{{url('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Hesabdan Çıx</a></li>
            </ul>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
        <div class="col-8">
            {{--margin-left:25%;padding:1px 16px;height:1000px;--}}
            <div style="margin-left:25%;padding:1px 16px;height:1000px;" class="text-center">
                {{--<button type="button" class="btn btn-primary">Primary</button>--}}
                <h3 style="text-align: center;" class="h3">Brendin Şəxsi Kabineti</h3>
                {{--<p  style="font-size: 30px; color: blue;"class="y1"> Agentlik və Freelancer Axtar</p>--}}
                <h5 class="h5"> Agentlik və Freelancer Axtar</h5>
                {{--<form  style="margin-left: 25px;" action="{{url('searchfilter_at_entrepreneur')}}" method="post">--}}
                    {{--@csrf--}}
                <br>
                <div class="search_filters card-group d-flex justify-content-center" style="display: initial; width: 900px">
                    <div class="card flex-column" style="width: auto;border: transparent;">
                        <div class="card-header" style="width: 250px" >
                            <span>Büdcə Aralığını Daxil Et </span>
                        </div>
                        <div class="card-body">
                            <span>Minumum </span>
                            <select name="price_min" >
                                @for($i = 100; $i <= 3000; $i+=100)
                                    <option value="{{ $i }}" {{$i==old('price_min') ? 'selected' : ($i==100 ? 'selected' : '')}}>{{ $i }}</option>
                                @endfor
                            </select>
                            <span>Maksimum </span>
                            <select name="price_max">
                                @for($i = 100; $i <= 3000; $i+=100)
                                    <option value="{{ $i }}" {{$i==old('price_max') ? 'selected' : (($i==3000 && !old('price_max')) ? 'selected' : '')}}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="card flex-column" style="width: auto;border: transparent;">
                        <div class="card-header">
                            <span style=""> Sektoru Seç </span>
                        </div>
                        <div class="card-body">
                            <span class="sector_parent">
                                <select  name="sector" style="width: 150px">
                                    @foreach(\App\Sector::all() as $sector)
                                        {{--<div class="isector_parent">--}}
                                        <option name="sector" class="sector" value="{{$sector->sector}}"  checked> {{' '.$sector->sector}}
                                        {{--</div>--}}
                                    @endforeach
                                </select>
                            </span>
                        </div>
                    </div>
                    <div class="card flex-column" style="width: auto;border: transparent;">
                        <div class="card-header">
                            <span style=""> Şəhəri Seç </span>
                        </div>
                        <div class="card-body">
                            <select name="city" style="width: 150px">
                                @foreach(\App\User::has('smmservices')->select('city')->distinct()->get() as $city)
                                    {{--<div class="isector_parent">--}}
                                    <option name="city" class="city" value="{{$city->city}}"  checked> {{' '.$city->city}}
                                        {{--</div>--}}
                                @endforeach]
                            </select>
                        </div>
                    </div>
                    <div class="card flex-column " style="width: auto;border: transparent; margin-right: 100px">
                        <div class="card-header" style="margin-right: 100px; background-color: transparent; border-color: transparent">
                            <input  style=""type="button" value="Axtar" onclick="get_ServiceProvidersForEntrepreneurAJAX(this,1); return false;">
                        </div>
                        <div class="card-body">

                        </div>
                    </div>
                </div>
                <br>
                {{--</form>--}}
                <div style="margin-left:5%;padding:1px 16px;height:1000px;">
                  <div class="col comparision-container text-left" style="display: inherit;" >
                    <div class="text-left" style="display: none">
                        <h2 style= "margin-left: 15px; color:blue;" class="text-center" >Agentlik</h2>
                    </div>
                    <div></div>
                    <div class="text-left" style="display: none">
                        <h2 style= "margin-left: 15px; color:blue;" class="text-center">Freelancerlər</h2>
                    </div>
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
                          <a style="" href="#" class="btn btn-dark compare_link m-auto" onclick="compare_link_handler(this); return false;" >
                              Digəri ilə Müqayisə Et
                          </a>
                      </div>
                      <div class="col flex-column smmprovider-work-compare-container text-center" style="display: none;">
                        <p style=" font-size:20px; ">"Mega Fun Əyləncə Mərkəzi" Sosial Media Marketing Performans Dəyərləndirməsi</p>
                        <span> <img style="margin-left: auto;margin-right: auto; display: block;" src="{{asset('images/performance.jpg')}}"></span>
                        <a style="color: #ff0900;" href="#" class="btn btn-light compare_link m-auto fa fa-times fa-lg" onclick="compare_link_handler(this,'close'); return false;" >
                        </a>
                      </div>
                  </div>
                </div>

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
                                <div class="search_filters card-group d-flex justify-content-center" style="display: initial; width: 850px">
                                    <div class="card flex-column" style="width: auto;border: transparent;">
                                        <div class="card-header" style="width: 250px">
                                            <span>Büdcə Aralığını Daxil Et </span>
                                        </div>
                                        <div class="card-body">
                                            <span>Minumum </span>
                                            <select name="price_min2">
                                                @for($i = 100; $i <= 3000; $i+=100)
                                                    <option value="{{ $i }}" {{$i==old('price_min2') ? 'selected' : ($i==100 ? 'selected' : '')}}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                            <span>Maksimum </span>
                                            <select name="price_max2">
                                                @for($i = 100; $i <= 3000; $i+=100)
                                                    <option value="{{ $i }}" {{$i==old('price_max2') ? 'selected' : (($i==3000 && !old('price_max2')) ? 'selected' : '')}}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="card flex-column" style="width: auto;border: transparent;">
                                        <div class="card-header">
                                            <span style=""> Sektoru Seç </span>
                                        </div>
                                        <div class="card-body">
                            <span class="sector_parent" style="width: 150px">
                                <select  name="sector2">
                                    @foreach(\App\Sector::all() as $sector)
                                        {{--<div class="isector_parent">--}}
                                        <option name="sector2" class="sector2" value="{{$sector->sector}}"  checked> {{' '.$sector->sector}}
                                        {{--</div>--}}
                                    @endforeach
                                </select>
                            </span>
                                        </div>
                                    </div>
                                    <div class="card flex-column" style="width: auto;border: transparent;">
                                        <div class="card-header">
                                            <span style=""> Şəhəri Seç </span>
                                        </div>
                                        <div class="card-body">
                                            <select name="city2" style="width: 150px">
                                                @foreach(\App\User::has('smmservices')->select('city')->distinct()->get() as $city)
                                                    {{--<div class="isector_parent">--}}
                                                    <option name="city2" class="city2" value="{{$city->city}}"  checked> {{' '.$city->city}}
                                                        {{--</div>--}}
                                                        @endforeach]
                                            </select>
                                        </div>
                                    </div>
                                    <div class="card flex-column " style="width: auto;border: transparent;background-color: transparent; margin-right: 100px">
                                        <div class="card-header" style="margin-right: 100px; background-color: transparent; border-color: transparent">
                                            <input  style=""type="button" value="Axtar" name='searchfilter_at_entrepreneur_ajax' onclick="get_ServiceProvidersForEntrepreneurAJAX(this,2); return false;">
                                        </div>
                                        <div class="card-body">

                                        </div>
                                    </div>
                                </div>
                                <div class="col comparision-container2 text-left" style="display: inherit;" >
                                    <div class="text-left" style="display: none">
                                        <h2 style= "margin-left: 15px; color:blue;" class="text-center">Agentlik</h2>
                                    </div>
                                    <div></div>
                                    <div class="text-left" style="display: none">
                                        <h2 style= "margin-left: 15px; color:blue;" class="text-center">Freelancerlər</h2>
                                    </div>
                                    <div></div>
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
                {{--<div class="row ">--}}
                    <footer class="text-center" style=" z-index: -1;padding-bottom: 20px;padding-bottom: 20px; text-align: center; position: relative; width:100%; clear: both;">&copy Bütün Hüquqlar Qorunur <br>FaceAds 2019</footer>
                {{--</div>--}}
            </div>
        </div>
    </div>
</div>
</body>
</html>

