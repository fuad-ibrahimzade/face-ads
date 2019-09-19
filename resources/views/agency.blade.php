<!DOCTYPE html>
<html>
@include('parts.head')
<body>
@include('parts.navbar')
@include('parts.scripts')
<div class="registration_class"></div>
<div class="freelancer"><br>
<fieldset style=" background-color:#e6e6e6 ;width: 600px;padding-bottom: 20px;margin-left: auto;margin-right: auto;border-radius: 10px">
 <div style= "margin-left:25px"; method="post" action="{{route('agency')}}" enctype="multipart/form-data" class="form container ml-5" novalidate >
     @csrf
  <h3 class="text-center mr-5"> Agentlik Qeydiyyat </h3>
     <div class="main_errors">
         @if ($errors->any())
             @foreach ($errors->all() as $error)
                 <div><strong>{{$error}}</strong></div>
             @endforeach
         @endif
     </div>
     <div class="other_errors"><strong></strong></div>
  <span style=" font-family:Georgia, serif;margin-left: 5%">Agentliyin adı</span><span style="font-family:Georgia, serif; margin-left: 18%;">  Email Ünvanı </span>        <br>                                            
 	<input style="margin-left: 25px;" placeholder="Agentliyin Adı" type="tex" name="name" value="{{old('name')}}">  <input placeholder="info@agency.az" style="margin-left: 25px;"type="email" name="email" value="{{old('email')}}">
  <br>
  <br>
  <img style="margin-left: 25px;" height="55px"; src="{{asset('images/profile.png')}}" class="thumb_profile_image"> <br><br>
  {{--<input style="margin-left:15px;"; type="submit" name="Logonu Seç" value="Logonu Seç">--}}
     &nbsp&nbsp&nbsp&nbsp&nbsp<label for="files" type="button" class="btn">Logonu Seç</label><br>
     &nbsp&nbsp&nbsp&nbsp&nbsp<input id="files" style="display: none;" type="file" name="profile_image" class="profile_image">
  <br>
 	<br>
 	<span style="font-family:Georgia, serif; margin-left: 25px;">Şirkətinizin Haqqında  yazın </span>
  <br>
 	<br>
 	<textarea style="width: 60%; height: 60px; margin-left: 25px;" placeholder="Agentlik kimi faəliyyət göstəriyiniz müddəti, xidmət paketinizn qiyməti və s.məlumatları daxil edin." name="activity">{{old('activity')}}</textarea>
  <br> <br>
  <span style=" font-family:Georgia, serif;margin-left: 25px;">Xidmət göstərdiyiniz sektoru seçin <br>
 </span>
 	<br>
     <div style="margin-left: 25px">
     <div class="sector_parent">
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
  {{--<input  style="" type="checkbox" name="sector[]" value="Bütün" {{' '.old('sector')=='Bütün'? 'checked':''}}> Bütün Sektorlar &nbsp&nbsp&nbsp&nbsp--}}
  {{--<input  placeholder="Sektor Əlavə Et "type="text" name="">--}}
     <input placeholder="Digər Sektor Daxil Edin " type="text" name="new_sector_temp" class="new_sector_temp"> <input type="button" name="" value="Sektoru Əlavə Et" class="sector_adder">
         <a style="position: element(#sector_adder); transform: translateX(0px) translateY(0px);" name="new_sector_remover" value="Seçilmiş Sektoru Poz" class="new_sector_remover btn btn-default fa fa-trash-o fa-lg"></a>
  <br><br>
  <span>Xidmətinizin Qiymət Aralığını Seçin</span> <br>
     <div class="qutu_parent">
         <select multiple='multiple' name="pricing[]" class="pricing" id="pricing">
             <option class="first_price" selected>0 AZN</option>
             {{--<option class="first_price">0-250 AZN</option>--}}
             {{--<option>251-400 AZN</option>--}}
             {{--<option>401-600 AZN</option>--}}
             {{--<option>601-daha çox </option>--}}
         </select>
     </div>
     <button type="button" class="btn icon-btn btn-light new_price_box_adder"  >
         <span class="glyphicon btn-glyphicon glyphicon-plus img-circle text-success"></span>
         Yeni Qiymət qutu
     </button>
         <a  style="position: element(#pricing); transform: translateX(0%) translateY(0%); " name="new_price_remover" value="Seçilmiş Qiymət Aralığını Poz" class="new_price_remover btn btn-default fa fa-trash-o fa-lg" ></a>
     {{--<label for="files" class="btn">min</label>--}}
     {{--<input style="margin-left: 35px;" placeholder="minimum" type="text" name="new_price_min" class="new_price_min">--}}
     {{--<input style="margin-left: 35px;" placeholder="maksimum" type="text" name="new_price_max" class="new_price_max">--}}
     <p>
         <label for="price-amount" >Qiymət aralığı:</label>
         <input type="text" id="price-amount" style="border:0; color:#146e27; font-weight:bold;" onkeypress="return false;" spellcheck=false />
     </p>

     <div id="price-slider-range" style="width: 450px"></div><br>
     <input type="button" name="" value="Qiymət Aralığını Əlavə Et" class="new_price_adder">
  <br>
  <br>
  {{--<input type="button" name="" value="Qiymət Aralığını Əlavə Et"> --}}
     <br>
 <span style=" font-family:Georgia, serif;">Agentliyinizin yerləşdiyi ölkəni seçin </span><br> <br>
  <select name="city" value="{{old('city')}}" class="city">
  	<option class="first_city"> Bakı, Azərbyacan </option>
  	<option>Ankara Türkiyə</option>
  	<option> Moskva Rusiya</option>
  	<option>Ölkə Əlavə Et</option>
  </select>
     <input style="margin-left: 35px;" placeholder="Şəhət, Ölkə" type="text" name="new_city_temp" class="new_city_temp"> <input type="button" name="" value="Ölkə Əlavə Et" class="new_city_adder"><br>
    <span  style="margin-left: 5%">Şifrəni Yaz</span>                   <span style="margin-left: 14%;">Şifrəni Təsdiqləyin</span> <br>
    <input type="password" name="password">  <input style="margin-left: 25px;" type="password" name="password_confirmation">

<br>
<br>
<input type="checkbox" name="terms" class="terms"> Şərtləri Qəbul Edirəm  <br>
<a style="text-decoration-line: none;" "color:#ff1a1a;"   href="" target="_blank">Şərtlər və Qaydalar</a>
<input style="margin-left: 28%" type="submit" name="submit" value="Qeydiyyat"> <br>
{{--<p> Hesabım var, <a style="text-decoration-line: none;" href="agh.html">Daxil Ol</a></p>--}}
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
@include('parts.footer')
</html>