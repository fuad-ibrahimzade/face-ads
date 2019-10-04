<!DOCTYPE html>
<html>
<head>
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
           <li> <strong> Şirkət Haqqında </strong> <br>
                {{Auth::user()->activity}}
           </li>
           <li style="font-size: 15px;"><strong>Fəaliyyət sektorum</strong>  <br>
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
               <div class="card">
                   <div class="card-header">
               <fieldset style="overflow:scroll; overflow: auto; max-height: 180px; " class="">
                   <div class="">
                       @foreach(Auth::user()->businessMarks as $businessMark)
                           {{--w-auto--}}
                           <div id="sides" style="margin:0;" class="">
                               <div id="left" style="float:left; width: 83%; overflow: hidden">
                                   <br>
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
                           {{--{{ $social_link }}<br>--}}
                           @if(isset($social_link_url))
                               <a class="btn" style="width: 60px" href="{{$social_link_url}}">
                                   <img src="{{asset('images/social/'.$social_link_name.'-color.svg')}}" alt="{{$social_link_name}}" height="20px" style="filter: grayscale(0%);">
                               </a>
                               {{--<br>--}}
                               {{--&nbsp;&nbsp;--}}
                           @endif
                       @endforeach
                   </li>
               @endif
           @endif
           <li><a href="{{url('profile/'.Auth::user()->email)}}" class="go_profile active btn-light">Profilə qayıt </a></li>
           <li><a href="{{url('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Hesabdan Çıx</a></li>
       </ul>
       <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
           @csrf
       </form>
   </div>
   <div class="col-8">
<div class="freelancer" style="margin-left: 15%;"><br>
    <a href="{{url('profile/'.Auth::user()->email)}}">
        <img style="width: auto; height: 80px;margin-left: auto;margin-right: auto; display: block" src="{{asset('images/logo.png')}}">
    </a>
<fieldset style=" background-color:white ;background-color: #e6e6e6;width: 650px; margin-left: auto;margin-right: auto">
<form style= "margin-left:25px"; method="post" action="{{url('profile/'.Auth::user()->email.'/edit')}}" enctype="multipart/form-data">
    @csrf
<h3 class="text-center"> Sahibkar  Qeydiyyatının Yenilənməsi </h3>
    <div class="main_errors">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div><strong>{{$error}}</strong></div>
            @endforeach
        @endif
    </div>
    <div class="other_errors"><strong></strong></div>
  <span style=" font-family:Georgia, serif; margin-left: 4%">Şirkətin Adı</span> <span style=" font-family:Georgia, serif; margin-left: 10%;">  Email Ünvanı</span> <br>
 	<input style="margin-left: 25px;" placeholder="Şirkətin Adı" type="tex" name="name" value="{{Auth::user()->name}}"><input placeholder="mammadov@freelancer.az" style="margin-left: 33px;"
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
    <div style="margin-left: 25px">
    <div class="sector_parent">
        @foreach(Auth::user()->sector as $sector)
            <div class="isector_parent">
                <input type="checkbox" name="sector[]" class="sector" value="{{$sector}}"  checked> {{' '.$sector}}
            </div>
        @endforeach
    </div>
    <input placeholder="Digər Sektor Daxil Edin " type="text" name="new_sector_temp" class="new_sector_temp"> <input type="button" name="" value="Sektoru Əlavə Et" class="sector_adder">
    <a style="position: element(#sector_adder);" name="new_sector_remover" title="Seçilmiş Sektoru Poz" class="new_sector_remover btn btn-default fa fa-trash-o fa-lg"></a>
  <br>
  <br>
    <div class="socials_parent">
        @if(true)
            @if(isset(Auth::user()->social_links))
                <span style=" font-family:Georgia, serif; margin-left: 25px;">
                    Malik Olduuğunuz Sosial Profillər <br>
                </span>
                <br>
                @foreach(Auth::user()->social_links as $key => $value)
                    @if(isset($value))
                        <div class="isocial_parent">
                            <label for="{{strtolower($key)}}-social" class="btn btn-default" style="">
                                <img src="{{asset('images/social/'.$key.'-color.svg')}}" alt="{{$key}}" height="20px" style="filter: grayscale(0%);">
                                {{$key}}
                            </label>
                            &nbsp;
                            <input style="" placeholder="{{$key}} Profile" type="text" name="social[]" id="{{strtolower($key)}}-social" value="{{$value}}">
                        </div>
                    @else
                        <div class="isocial_parent">
                            <label for="{{strtolower($key)}}-social" class="btn btn-default" style="">
                                <img src="{{asset('images/social/'.$key.'-color.svg')}}" alt="{{$key}}" height="20px" style="filter: grayscale(100%);">
                                {{$key}}
                            </label>
                            &nbsp;
                            <input style="" placeholder="{{$key}} Profile" type="text" name="social[]" id="{{strtolower($key)}}-social" value="">
                        </div>
                    @endif
                @endforeach
            @else
                @foreach(array('Facebook','Twitter','Instagram','Youtube','Pinterest','Whatsapp','Yelp','Skype') as $key)
                    <div class="isocial_parent">
                        <label for="{{strtolower($key)}}-social" class="btn btn-default" style="">
                            <img src="{{asset('images/social/'.$key.'-color.svg')}}" alt="{{$key}}" height="20px" style="filter: grayscale(100%);">
                            {{$key}}
                        </label>
                        &nbsp;
                        <input style="" placeholder="{{$key}} Profile" type="text" name="social[]" id="{{strtolower($key)}}-social" value="">
                    </div>
                @endforeach
            @endif
        @endif
    </div>
    {{--<br><br><br>--}}
        <br>
    <span  style="margin-left: 5%">Şifrəni Yaz</span>  <span style="margin-left: 18%;">Şifrəni Təkrar Yazın</span> <br>
    <input type="password" name="password">  <input style="margin-left: 25px;" type="password" name="password_confirmation">

<br>
<br>
        <input style="margin-left: 28%; display: none" type="submit" name="submit" value="Düzəlişi Tamamla">
        <input style="margin-left: 28%" type="button" name="submit2" value="Düzəlişi Tamamla"><br>
    </div>
 </form>
</fieldset>

<br>
<br>
<br>
</div>
   </div>
   </div>
   </div>
   <div class="modal fade" id="emailChangeModal" tabindex="-1" role="dialog" aria-labelledby="emailChangeModal" aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="emailChangeModalLabel">Emailı dəyişməyə əminsinizmi?</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body" style="">
                   Email dəyişdikdə yenidən login etməli olacaqsınız.
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Geri qayıt</button>
                   <button type="button" class="btn btn-primary">Davam Elə</button>
               </div>
           </div>
       </div>
   </div>
   <footer class="text-center" style=" z-index: -1;padding-bottom: 20px; text-align: center; position: relative; width:100%; clear: both;">&copy Bütün Hüquqlar Qorunur <br>FaceAds 2019</footer>
</body>
</html>