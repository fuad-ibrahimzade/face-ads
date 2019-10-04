@extends('layout')
@section('content')
    @include('parts.scripts')
    <div class="registration_class"></div>
    <div class="freelancer"><br>
        {{--margin-left: 30%;--}}
        {{--width: 45%--}}
    <fieldset style=" background-color:#e6e6e6 ;width: 600px;padding-bottom: 20px;margin-left: auto;margin-right: auto;border-radius: 10px">
    <form style= "margin-left:25px"; method="post" action="{{route('freelancer')}}" enctype="multipart/form-data" class="form container ml-5" novalidate >
        @csrf
    <h3 class="text-center mr-5"> Freelancer Qeydiyyatı </h3>
        <div class="main_errors">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div><strong>{{$error}}</strong></div>
                @endforeach
            @endif
        </div>
        <div class="other_errors"><strong></strong></div>
      <span style=" font-family:Georgia, serif; margin-left: 4%">Freelancerin Adı və Soyadı</span> <span style=" font-family:Georgia, serif; margin-left: 10%;">  Email Ünvanı</span> <br>
        <input style="margin-left: 25px;" placeholder="Freelancerin Adı və Soyadı" type="text" name="name" value="{{old('name')}}"><input placeholder="mammadov@freelancer.az" style="margin-left: 33px;"
      type="email" name="email" value="{{old('email')}}">
        <br>
      <br>
      <img style="margin-left: 25px;" height="55px"; src="{{asset('images/profile.png')}}" class="thumb_profile_image"> <br><br>
      {{--<input style="margin-left:15px;"; type="submit" name="Profil Şəkilini Seç" value="Profil Şəkilini Seç">--}}
        &nbsp&nbsp&nbsp&nbsp&nbsp<label for="files" type="button" class="btn">Profil Şəkilini Seç</label><br>
        &nbsp&nbsp&nbsp&nbsp&nbsp<input id="files" style="display: none;" type="file" name="profile_image" class="profile_image">
     <br>
     <br>
        <span style=" font-family:Georgia, serif; margin-left: 25px;">Freelancer Fəaliyyətiniz Haqqında Yazın </span>
      <br>
        <textarea style=" width: 60%; height:60px; ; margin-left: 25px;" placeholder="Freelancer kimi faəliyyət göstəriyiniz müddəti, xidmət paketinizn qiyməti və s.məlumatları daxil edin." name="activity">{{old('activity')}}</textarea>
      <br> <br>
      <span style=" font-family:Georgia, serif; margin-left: 25px;">
        Xidmət Göstərdiyiniz Sektoru Seçin <br>
     </span>
        <br>
    <div style="margin-left: 25px">
        <div class="sector_parent">
            <div class="isector_parent">
                <input type="checkbox" name="sector[]" value="Bütün sektorlar" class="sector" > Bütün sektorlar
            </div>
            <div class="isector_parent">
                <input type="checkbox" name="sector[]" value="Tibb və Xəstəxana" class="sector" > Tibb və Xəstəxana
            </div>
            <div class="isector_parent">
                 <input style="" type="checkbox" name="sector[]" value="Restoran və Əyləncə Mərkəzləri" class="sector"> Restoran və Əyləncə Mərkəzləri
                {{--margin-left: 19px;--}}
            </div>
            <div class="isector_parent">
                 <input type="checkbox" name="sector[]" value="Tikinti" class="sector"> Tikinti
            </div>
            <div class="isector_parent">
                 <input style=";" type="checkbox" name="sector[]" value="Maliyyə və Bank" class="sector"> Maliyyə və Bank
                {{--margin-left: 95px--}}
            </div>
            <div class="isector_parent">
                <input type="checkbox" name="sector[]" value="Avtomabil" class="sector"> Avtomabil
            </div>
            <div class="isector_parent">
                <input style="" type="checkbox" name="sector[]" value="Turizm və Otel" class="sector"> Turizm və Otel
                {{--margin-left: 69px;--}}
            </div>
        {{--<input type="checkbox" name="sector[]" value="new_sector" class="new_sector" style="display: none "> <span class="new_sector_text" style="display:none"></span>--}}
        </div>
      {{--<input type="checkbox" name="sector[]" value="Bütün" {{' '.old('sector')=='Bütün'? 'checked':''}}> Bütün Sektorlar &nbsp&nbsp&nbsp--}}
      <input placeholder="Digər Sektor Daxil Edin " type="text" name="new_sector_temp" class="new_sector_temp"> <input type="button" name="" value="Sektoru Əlavə Et" class="sector_adder">
        {{--<input type="button" style="position: element(#sector_adder); transform: translateX(300px) translateY(-20px); height:20px; width:20px;" name="new_sector_remover" value="Seçilmiş Sektoru Poz" class="new_sector_remover ui-button-icon-primary ui-icon ui-icon-trash" style="width:5%; height:100%; display:block">--}}
        <a style="position: element(#sector_adder);" name="new_sector_remover" title="Seçilmiş Sektoru Poz" class="new_sector_remover btn btn-default fa fa-trash-o fa-lg"></a>
        {{--<a class="btn btn-default fa fa-trash-o fa-lg" style="background-color: transparent" data-toggle="tooltip" data-placement="top" title="message"></a>--}}
        {{--<input type="checkbox" name="sector" value="Bütün" {{' '.old('sector')=='Bütün'? 'checked':''}}> {{Auth::user->sector}}--}}
      <br><br>
      <span>Xidmətinizin Qiymət Aralığını Seçin</span> <br>
        <div class="qutu_parent d-flex justify-content-start">
            <div class="flex-column pricing_group">
                <em style="font-style: italic; display: inline-block;">1- </em>&nbsp;&nbsp;
            </div>
        <select multiple='multiple' name="pricing[]" class="pricing flex-column" id="pricing">
          <option class="first_price" selected>0 AZN</option>
        </select>
        </div>
        <button type="button" class="btn icon-btn btn-light new_price_box_adder"  style="display: none;">
            <span class="glyphicon btn-glyphicon glyphicon-plus img-circle text-success"></span>
            Yeni Qiymət paketi
        </button>
        <p>
        <label for="price-amount" >Qiymət aralığı:</label>
        <input type="text" id="price-amount" style="border:0; color:#146e27; font-weight:bold;" onkeypress="return false;" spellcheck=false />
        </p>

        <div id="price-slider-range" style="width: 450px"></div><br>
        <input type="button" name="" value="Qiymət Aralığını Əlavə Et" class="new_price_adder">
        <a style="position: element(#pricing); transform: translateX(0%) translateY(0%); " name="new_price_remover" title="Seçilmiş Qiymət Aralığını Poz" class="new_price_remover btn btn-default fa fa-trash-o fa-lg"></a>

      <br>
      <br>

      <br>
    <span style="font-family:Georgia, serif;">Fəaliyyət göstərdiyiniz ölkəni seçin </span><br> <br>
      <select name="city" value="{{old('city')}}" class="city">
          <option value="AZ">Azərbaycan</option>
      </select>
        @if(true)
            <br><br><br>
            <span style="font-family:Georgia, serif;">Malik Olduuğunuz Sosial Profillər</span><br><br>
            <div class="socials_parent">
                <div class="isocial_parent">
                    <label for="facebook-social" class="btn btn-default" style="">
                        <img src="{{asset('images/social/Facebook-color.svg')}}" alt="Facebook" height="20px" style="filter: grayscale(100%);">
                        Facebook
                    </label>
                    &nbsp;
                    <input style="" placeholder="Facebook Profile" type="text" name="social[]" id="facebook-social">
                </div>
                <div class="isocial_parent btn btn-default">
                    <label for="twitter-social" class="btn btn-default" style="">
                        <img src="{{asset('images/social/Twitter-color.svg')}}" alt="Twitter" height="20px" style="filter: grayscale(100%);">
                        Twitter
                    </label>
                     &nbsp;
                    <input style="" placeholder="Twitter Profile" type="text" name="social[]" id="twitter-social">
                </div>
                <div class="isocial_parent">
                    <label for="instagram-social" class="btn btn-default" style="">
                        <img src="{{asset('images/social/Instagram-color.svg')}}" alt="Instagram" height="20px" style="filter: grayscale(100%);">
                        Instagram
                    </label>
                    &nbsp;
                    <input style="" placeholder="Instagram Profile" type="text" name="social[]" id="instagram-social">
                </div>
                <div class="isocial_parent">
                    <label for="youtube-social" class="btn btn-default" style="">
                        <img src="{{asset('images/social/Youtube-color.svg')}}" alt="Youtube" height="20px" style="filter: grayscale(100%);">
                        Youtube
                    </label>
                    &nbsp;
                    <input style="" placeholder="Youtube Profile" type="text" name="social[]" id="youtube-social">
                </div>
                <div class="isocial_parent">
                    <label for="pinterest-social" class="btn btn-default" style="">
                        <img src="{{asset('images/social/Pinterest-color.svg')}}" alt="Pinterest" height="20px" style="filter: grayscale(100%);">
                        Pinterest
                    </label>
                    &nbsp;
                    <input style="" placeholder="Pinterest Profile" type="text" name="social[]" id="pinterest-social">
                </div>
                <div class="isocial_parent">
                    <label for="whatsapp-social" class="btn btn-default" style="">
                        <img src="{{asset('images/social/Whatsapp-color.svg')}}" alt="Whatsapp" height="20px" style="filter: grayscale(100%);">
                        Whatsapp
                    </label>
                    &nbsp;
                    <input style="" placeholder="Whatsapp Profile" type="text" name="social[]" id="whatsapp-social">
                </div>
                <div class="isocial_parent">
                    <label for="yelp-social" class="btn btn-default" style="">
                        <img src="{{asset('images/social/Yelp-color.svg')}}" alt="Yelp" height="20px" style="filter: grayscale(100%);">
                        Yelp
                    </label>
                    &nbsp;
                    <input style="" placeholder="Yelp Profile" type="text" name="social[]" id="yelp-social">
                </div>
                <div class="isocial_parent">
                    <label for="skype-social" class="btn btn-default" style="">
                        <img src="{{asset('images/social/Skype-color.svg')}}" alt="Skype" height="20px" style="filter: grayscale(100%);">
                        Skype
                    </label>
                    &nbsp;
                    <input style="" placeholder="Skype Profile" type="text" name="social[]" id="skype-social">
                </div>
                {{--<input type="checkbox" name="sector[]" value="new_sector" class="new_sector" style="display: none "> <span class="new_sector_text" style="display:none"></span>--}}
            </div>
        @endif
        {{--<br><br>--}}
        {{--<input style="margin-left: 35px;" placeholder="Şəhət, Ölkə" type="text" name="new_city_temp" class="new_city_temp"> <input type="button" name="" value="Ölkə Əlavə Et" class="new_city_adder">--}}
        <br><br><br>
        <span  style="margin-left: 5%">Şifrəni Yaz</span>  <span style="margin-left: 18%;">Şifrəni Təkrar Yazın</span> <br>
        <input type="password" name="password">  <input style="margin-left: 25px;" type="password" name="password_confirmation">

    <br>
    <br>
    <input type="checkbox" name="terms" class="terms"> Şərtləri Qəbul Edirəm <br>
    <a style="text-decoration-line: none;" "color:#ff1a1a;"   href="" target="_blank">Şərtlər və Qaydalar</a>  <input style="margin-left: 28%" type="submit" name="submit" value="Qeydiyyat"><br>
        {{--<p> Hesabım var, <a style="text-decoration-line: none;" href="afh.html">Daxil Ol</a></p>--}}
    </div>
     </form>
    </fieldset>

    <br>
    <br>
    <br>
    </div>
    @include('parts.footer')
@endsection