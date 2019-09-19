<!DOCTYPE html>
<html>
@include('parts.head')
<body>
@include('parts.navbar')
@include('parts.scripts')
{{--<div class="sahibkar_registration_class"></div>--}}
<div class="freelancer"><br>
    <fieldset style=" background-color : white;width: 40%; margin-left: 33%;">
        <form style= "margin-left:25px"; method="post" action="{{url(Auth::user()->email.'/mark/update',$businessMark->id)}}" enctype="multipart/form-data" class="form" novalidate >
            @csrf
            <h3> Marka Düzəlişi </h3>
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
            <input style="margin-left: 45%" type="submit" name="submit" value="Markaya düzəliş et" class="submit"> <br>
            {{--<p> Hesabım var, <a style="text-decoration-line: none;" href="Slogin.html">Daxil Ol</a></p>--}}

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