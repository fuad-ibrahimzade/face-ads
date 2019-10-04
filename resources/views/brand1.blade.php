@extends('layout')
@section('content')
  <br>
  <div class="">
    <div class=" text-center">
      <h4>Brend olaraq qeydiyyat</h4>
    </div>
    <div class="row text-center">
      <div class="col ">
        <p class="about"> <br><br><br><br><br><br><br>Əgər brendiniz üçün sosial media marketing  xidməti axtarırsınızsa brend <br> qeydiyyatı bölməsindən  qeydiyyatdan keçib, öz hesabınızı yaradırsınız <br> və öz kriteriyalarınızı daxil edib tez bir zamanda   brendinizə uyğun <br> əməkdaş tapa bilərsiniz.
          Brendlər üçün <a style="text-decoration-line:none; color:black; font-weight: bold;"  href="{{url('brand')}}">qeydiyyat</a> və istifadə ödənişsizdir. </p>
      </div>
      <div class=" col mt-auto mb-auto">
        {{--display: block;margin-right: auto;margin-left: auto;--}}
        <img style=" width : 550px; margin-right: 50px" class="SMM1" src="{{asset('images/brand3.png')}}">
      </div>
    </div>
  </div>
  <br>
  <footer >&copy Bütün Hüquqlar Qorunur <br>
    FaceAds 2019</footer>
@endsection