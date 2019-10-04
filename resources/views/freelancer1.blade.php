@extends('layout')
@section('content')
  <br>
  <div class="">
    <div class=" text-center">
      <h4> Frilanser olaraq qeydiyyat</h4>
    </div>
    <div class="row text-center">
      <div class="col mt-auto mb-auto">
        <p class="about"> Əgər fərdi qayda da brendlər üçün sosial media marketing  xidməti təqdim edən <br> frilansersinizsə, frilanser  qeydiyyatı bölməsindən  qeydiyyatdan keçib, öz hesabınızı <br> yaradırsınız  və fəaliyyətiniz  haqqında məlumatları və portfolionuzu daxil edib tez bir <br> zamanda  brendlərlə  əməkdaşlığa başlaya  bilərsiniz.
          Frilanser üçün <a style="text-decoration-line:none; color:black; font-weight: bold;"  href="{{url('freelancer')}}">qeydiyyat</a> və <br> istifadə  ödənişsizdir. </p>
      </div>
      <div class=" col mt-auto mb-auto">
        {{--display: block;margin-right: auto;margin-left: auto;--}}
        <img style=" width : 550px; margin-right: 50px" class="SMM1" src="{{asset('images/freelancer.jpg')}}">
      </div>
    </div>
  </div>
  <br>
  <br>
  <br>
  <br>
  <br>
  <footer >&copy Bütün Hüquqlar Qorunur <br>
  FaceAds 2019</footer>
@endsection