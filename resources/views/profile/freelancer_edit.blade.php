<!DOCTYPE html>
<html>
<head>
    {{--<title>Freelanserin Şəxsi Kabineti </title>--}}
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
</head>
<body>
<div class="">
   <div class="">
       <ul >
           <li><img src="{{(Auth::user()->profile_image)}}" style="margin-left : 4px; width: 45%;"></li>
           <li><em style="font-style: italic;">{{ Auth::user()->name }}</em> </li>
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
               {{ Auth::user()->city }}
           </li>
           <li>
               <strong>Xidmət paketlərinin qiymətləri</strong><br>
               <em style="font-style: italic;">1- </em>
               <select name="pricing_profile[]" class="pricing_profile">
                   @foreach(Auth::user()->pricing as $pricing)
                       <option>{{$pricing}}</option>
                   @endforeach
               </select>
               {{--<br>--}}
               @if(isset(Auth::user()->pricing2))
                   &nbsp;
                   <em style="font-style: italic;">2- </em>
                   <select name="pricing_profile2[]" class="pricing_profile2">
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
                       @foreach(Auth::user()->pricing3 as $pricing)
                           <option>{{$pricing}}</option>
                       @endforeach
                   </select>
               @endif
           </li>
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
           <li><em><a href="{{url('profile/'.Auth::user()->email)}}" class="go_profile active btn-light">Profilə qayıt</a></em></li>
           <li><em><a href="{{url('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Hesabdan Çıx</a></em></li>
       </ul>
       <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
           @csrf
       </form>
   </div>
    <div class="freelancer " style="; margin-left:10%;">

            <br>
        <a href="{{url('profile/'.Auth::user()->email)}}">
            <img style="width: auto; height: 80px;margin-left: auto;margin-right: auto; display: block" src="{{asset('images/logo.png')}}">
        </a>
        <fieldset style=" background-color:white ;background-color:#e6e6e6 ;width: 650px; margin-left: auto;margin-right: auto;border-radius: 10px" class="">
        <form style= "margin-left:25px"; method="post" action="{{url('profile/'.Auth::user()->email.'/edit')}}" enctype="multipart/form-data">
            @csrf
        <h3 class="text-center"> Freelancer Qeydiyyatının Yenilənməsi </h3>
            <div class="main_errors">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div><strong>{{$error}}</strong></div>
                    @endforeach
                @endif
            </div>
            <div class="other_errors"><strong></strong></div>
          <span style=" font-family:Georgia, serif; margin-left: 4%">Freelancerin Adı və Soyadı</span> <span style=" font-family:Georgia, serif; margin-left: 10%;">  Email Ünvanı</span> <br>
            <input style="margin-left: 25px;" placeholder="Freelancerin Adı və Soyadı" type="tex" name="name" value="{{Auth::user()->name}}"><input placeholder="mammadov@freelancer.az" style="margin-left: 33px;"
          type="email" name="email" value="{{Auth::user()->email}}">
            <br>
          <br>
          <img style="margin-left: 25px;" height="55px"; src="{{(Auth::user()->profile_image)}}" class="thumb_profile_image"> <br>
            &nbsp&nbsp&nbsp&nbsp&nbsp<label for="files" class="btn">Profil Şəkilini Seç</label><br>
            &nbsp&nbsp&nbsp&nbsp&nbsp<input id="files" style=";" type="file" name="profile_image" class="profile_image">
         <br>
         <br>
            <span style=" font-family:Georgia, serif; margin-left: 25px;">Freelancer Fəaliyyətiniz Haqqında Yazın </span>
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
            {{--<input type="button" style="position: element(#sector_adder); transform: translateX(300px) translateY(-20px); height:20px; width:20px;" name="new_sector_remover" value="Seçilmiş Sektoru Poz" class="new_sector_remover ui-button-icon-primary ui-icon ui-icon-trash" style="width:5%; height:100%; display:block">--}}
            <a style="position: element(#sector_adder);" name="new_sector_remover" title="Seçilmiş Sektoru Poz" class="new_sector_remover btn btn-default fa fa-trash-o fa-lg"></a>
            <br><br>
          <span>Xidmətinizin Qiymət Aralığını Seçin</span> <br>
            <div class="qutu_parent d-flex justify-content-start">
            @if(isset(Auth::user()->pricing))
                    <div class="flex-column pricing_group">
                        <em style="font-style: italic; display: inline-block;">1- </em>&nbsp;&nbsp;
                    </div>
              <select multiple='multiple' name="pricing[]" class="pricing flex-column" id="pricing" {{isset(Auth::user()->pricing2)? ' disabled': ''}}>
                  @foreach(Auth::user()->pricing as $pricing)
                      @if($loop->index==0)
                      <option  selected>{{$pricing.' '.auth()->user()->currency}} </option>
                      @else
                      <option>{{$pricing.' '.auth()->user()->currency}} </option>
                      @endif
                  @endforeach
              </select>
            @endif
            {{--<br>--}}
            @if(isset(Auth::user()->pricing2))
                    <div class="flex-column pricing_group2">
                        <em style="font-style: italic; display: inline-block;">1- </em>&nbsp;&nbsp;
                    </div>
                <select multiple='multiple' name="pricing2[]" class="pricing2 flex-column" {{isset(Auth::user()->pricing3)? ' disabled': ''}}>
                    @foreach(Auth::user()->pricing2 as $pricing)
                        <option {{$loop->index==0 ? ' selected': ' '}}>{{$pricing.' '.auth()->user()->currency}}</option>
                    @endforeach
                </select>
            @endif
            @if(isset(Auth::user()->pricing3))
                    <div class="flex-column pricing_group3">
                        <em style="font-style: italic; display: inline-block;">1- </em>&nbsp;&nbsp;
                    </div>
                {{--<br>--}}
                <select multiple='multiple' name="pricing3[]" class="pricing3 flex-column">
                    @foreach(Auth::user()->pricing3 as $pricing)
                        <option {{$loop->index==0 ? ' selected': ' '}}>{{$pricing.' '.auth()->user()->currency}}</option>
                    @endforeach
                </select>
            @endif
            </div>
            <button type="button" class="btn icon-btn btn-success new_price_box_adder" style="display: none;">
                <span class="glyphicon btn-glyphicon glyphicon-plus img-circle text-success"></span>
                Yeni Qiymət paketi
            </button>
            <p>
                <label for="price-amount" >Qiymət aralığı:</label>
                <input type="text" id="price-amount" style="border:0; color:#146e27; font-weight:bold;" onkeypress="return false;" spellcheck=false />
            </p>

            <div id="price-slider-range" style="width: 550px"></div><br>
            <input type="button" name="" value="Qiymət Aralığını Əlavə Et" class="new_price_adder">
            <a style="position: element(#pricing); transform: translateX(0%) translateY(0%); " name="new_price_remover" title="Seçilmiş Qiymət Aralığını Poz" class="new_price_remover btn btn-default fa fa-trash-o fa-lg"></a>
            <br>
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
</div>
</body>
</html>