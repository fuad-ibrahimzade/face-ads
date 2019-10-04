@extends('layout')
@section('content')
    <div class="">
        <div class=" text-center">
            <h3>Biz Kimik ? </h3>
        </div>
        <div class="row text-center">
            <div class="col mt-auto mb-auto">
                <p class="about" > <br><br><br> Faceads sosial media kanlları üzərindən marketing xidməti təqdim edənləri <br> və bu xidməti almaq istəyən brendləri bir araya gətirən platfromadır.<br> Agentliklər/Freelancerlər hesablarını yaradaraq xidmətləri haqqında ətraflı <br> məlumatı  qeyd edəcəklər. <br>Brendlər qeydiyyatdan keçib hesablarını yaradaraq, özlərinə uyğun agentlik <br> və freelancerlər tapıb əməkdaşlığa başlaya biləcəklər.</p>
            </div>
            <div class=" col mt-auto mb-auto">
                {{--display: block;margin-right: auto;margin-left: auto;--}}
                <img  style="margin-right:50px ;width: 800px"class="SMM1" src="{{asset("images/SMM1.jpg")}}">
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    @include('parts.footer')
@endsection