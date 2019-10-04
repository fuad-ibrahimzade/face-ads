@extends('layout')
@section('content')
  <br>

  <div class="">
    <div class=" text-center">
      <h4> Agentlik olaraq qeydiyyat</h4>
    </div>
    <div class="row text-center">
      <div class="col mt-auto mb-auto">
        <p class="about"> <br><br>Əgər  brendlər üçün sosial media marketing  xidməti təqdim edən agentliksinizsə, <br> agentlik  qeydiyyatı bölməsindən  qeydiyyatdan keçib, öz hesabınızı yaradırsınız <br> və agentliyiniz haqqında məlumatları və portfolionuzu daxil edib tez bir zamanda  <br>brendlərlə  əməkdaşlığa başlaya  bilərsiniz.
          Agentliklər üçün <a style="text-decoration-line:none; color:black; font-weight: bold;"  href="{{url('agency')}}">qeydiyyat</a> və istifadə <br> ödənişsizdir. </p>
      </div>
      <div class=" col mt-auto mb-auto">
        {{--display: block;margin-right: auto;margin-left: auto;--}}
        <img style=" width : 550px; margin-right: 50px" class="SMM1" src="{{asset('images/agentlik.png')}}">
      </div>
    </div>
  </div>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <footer >&copy Bütün Hüquqlar Qorunur <br>
    FaceAds 2019</footer>
@endsection