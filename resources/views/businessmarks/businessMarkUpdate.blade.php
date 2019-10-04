<!DOCTYPE html>
<html>
{{--@include('parts.head')--}}
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
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
{{--@include('parts.navbar')--}}
{{--@include('parts.scripts')--}}
{{--<div class="sahibkar_registration_class"></div>--}}
<div class="container float-left">
    <div class="row">
        <div class="col-4">
            <ul >
                {{--<li><img src="{{asset('storage/avatars/'.Auth::user()->profile_image)}}" style="margin-left : 4px; width: 45%;"></li>--}}
                <li><img src="{{Auth::user()->profile_image}}" style="margin-left : 4px; width: 45%;"></li>
                {{--<li> Bakı Şirkətlər Qrupu  </li>  --}}
                <li><em style="font-style: italic;">{{ Auth::user()->name }}</em> </li>
                {{--<br>--}}
                <li> <strong> Şirkət Haqqında </strong> <br>
                    {{--Şirkətimiz 3 ildir ki, müxtəlif sektorlarda fəaliyyət göstərir. <br> Digital medianın əhəmiyyətini nəzərə alaraq şirkətlərimizin digtal mediada  keyfiyyətinə önəm veririk.--}}
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
                {{--<br>--}}
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
                {{--<li><a href="{{url('profile/'.Auth::user()->email.'/edit')}}" class="edit_profile">Profilə Düzəliş Et </a></li>--}}
                <li><a href="{{url('profile/'.Auth::user()->email)}}" class="go_profile active btn-light">Profilə qayıt </a></li>
                <li><a href="{{url('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Hesabdan Çıx</a></li>
            </ul>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
        <div class="col-8">
<div class="freelancer" style="margin-left:10%"><br>
    <fieldset style="background-color:#e6e6e6 ;width: 600px;padding-bottom: 20px;margin-left: auto;margin-right: auto;border-radius: 10px"">
        <form style= "margin-left:25px"; method="post" action="{{url(Auth::user()->email.'/mark/update',$businessMark->id)}}" enctype="multipart/form-data" class="form" novalidate >
            @csrf
            <h3 class="text-center"> Marka Düzəlişi </h3>
            <div class="main_errors">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div><strong>{{$error}}</strong></div>
                    @endforeach
                @endif
            </div>
            <div class="other_errors"><strong></strong></div>
            <span style=" font-family:Georgia, serif;margin-left: 5%">Markanın Adı</span>       <br>
            <input style="margin-left: 25px;" placeholder="" type="tex" name="name" value="{{$businessMark->name}}">
            <br>
            <br>
            {{--<img style="margin-left: 25px;" height="55px"; src="../../../../../Users/Sabirfd/Desktop/0innoland%20layihe/10%20avgust/0/Yeni%20FaceAds%20saytı%20-%20Copy/images/profile.png"> <br>--}}
            {{--<input style="margin-left:15px;"; type="submit" name="Logonu Seç" value="Logonu Seç">--}}
            <img style="margin-left: 25px;" height="55px"; src="{{$businessMark->profile_image}}" class="thumb_profile_image"> <br>
            {{--<img style="margin-left: 25px;" height="55px"; src="{{asset('storage/avatars/'.$businessMark->profile_image)}}" class="thumb_profile_image"> <br>--}}
            &nbsp&nbsp&nbsp&nbsp&nbsp<label for="files" class="btn">Şəkil Seç</label><br>
            &nbsp&nbsp&nbsp&nbsp&nbsp<input id="files" style=";" type="file" name="profile_image" class="profile_image">
            <br>
            <br>
            <span style="font-family:Georgia, serif; margin-left: 25px;">Markanın Biznes fəaliyyəti Haqqında yazın </span>
            <br>
            <br>
            <textarea style="width: 60%; height: 60px; margin-left: 25px;" placeholder="." name="activity">{{$businessMark->activity}}</textarea>
            <br> <br>
            <span style=" font-family:Georgia, serif;margin-left: 25px;">Xidmət göstərdiyiniz sektoru seçin <br>
            </span>
            <br>
            <div class="sector_parent">
                {{--<div class="isector_parent">--}}
                    {{--<input type="checkbox" name="sector[]" value="Tibb" class="sector"> Tibb və Xəstəxana--}}
                {{--</div>--}}
                {{--<div class="isector_parent">--}}
                    {{--<input style="" type="checkbox" name="sector[]" value="Əyləncə" class="sector"> Restoran və Əyləncə Mərkəzləri--}}
                    {{--<br>--}}
                    {{--margin-left: 19px;--}}
                {{--</div>--}}
                {{--<div class="isector_parent">--}}
                    {{--<input type="checkbox" name="sector" value="Tikinti" class="sector"> Tikinti--}}
                {{--</div>--}}
                {{--<div class="isector_parent">--}}
                    {{--<input style="" type="checkbox" name="sector[]" value="Maliyyə" class="sector"> Maliyyə və Bank--}}
                    {{--<br>--}}
                    {{--margin-left: 95px;--}}
                {{--</div>--}}
                {{--<div class="isector_parent">--}}
                    {{--<input type="checkbox" name="sector[]" value="Avtomabil" class="sector"> Avtomabil--}}
                {{--</div>--}}
                {{--<div class="isector_parent">--}}
                    {{--<input  style="" type="checkbox" name="sector[]" value="Turizm" class="sector"> Turizm və Otel--}}
                    {{--<br>--}}
                    {{--"margin-left: 69px;--}}
                @foreach($businessMark->sector as $sector)
                    <div class="isector_parent">
                        <input type="checkbox" name="sector[]" class="sector" value="{{$sector}}"  checked> {{' '.$sector}}
                    </div>
                @endforeach
                </div>
            {{--</div>--}}
            {{--<input  placeholder="Sektor Əlavə Et "type="text" name="">--}}
            <input placeholder="Digər Sektor Daxil Edin " type="text" name="new_sector_temp" class="new_sector_temp"> <input type="button" name="" value="Sektoru Əlavə Et" class="sector_adder">
            <input type="button" style="position: element(#sector_adder); transform: translateX(300px) translateY(-20px); height:20px; width:20px;" name="new_sector_remover" value="Seçilmiş Sektoru Poz" class="new_sector_remover ui-button-icon-primary ui-icon ui-icon-trash" style="width:5%; height:100%; display:block">
            <br><br>
            <span style=" font-family:Georgia, serif;">Yerləşdiyiniz ölkəni seçin </span><br> <br>
            <select name="city" value="{{old('city')}}" class="city">
                <option class="first_city" selected> {{$businessMark->city}} </option>
                {{--<option class="first_city"> Bakı, Azərbyacan </option>--}}
                {{--<option>Ankara Türkiyə</option>--}}
                {{--<option> Moskva Rusiya</option>--}}
                {{--<option>Ölkə Əlavə Et</option>--}}
            </select>
            <input style="margin-left: 35px;" placeholder="Şəhət, Ölkə" type="text" name="new_city_temp" class="new_city_temp"> <input type="button" name="" value="Ölkə Əlavə Et" class="new_city_adder"><br>
            <br><br>

            <br>
            <br>
            {{--<a href="{{url('profile/'.auth()->user()->email)}}" class="btn btn-dark">Geri qayıt</a>--}}
            <input style="margin-left: 28%" type="submit" name="submit" value="Markaya düzəliş et" class="submit"> <br>
            {{--<p> Hesabım var, <a style="text-decoration-line: none;" href="Slogin.html">Daxil Ol</a></p>--}}

        </form>
    </fieldset>
    <footer class="text-center" style=" z-index: -1;padding-bottom: 20px;padding-bottom: 20px; text-align: center; position: relative; width:100%; clear: both;">&copy Bütün Hüquqlar Qorunur <br>FaceAds 2019</footer>
    {{--<br>--}}
    {{--<br>--}}
    {{--<br>--}}
    {{--<br>--}}
    {{--<br>--}}
    {{--<br>--}}
    {{--<br>--}}
</div>
        </div>
    </div>
</div>
</body>
{{--@include('parts.footer')--}}
</html>