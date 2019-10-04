<!DOCTYPE html>
<html>
<head>
  <title>Freelanserin Şəxsi Kabineti </title>
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
    <select name="pricing[]" class="pricing">
      @foreach(Auth::user()->pricing as $pricing)
        <option>{{$pricing}}</option>
      @endforeach
    </select>
    {{--<br>--}}
    &nbsp;
    @if(isset(Auth::user()->pricing2))
    <em style="font-style: italic;">2- </em>
    <select name="pricing2[]" class="pricing2">
      @foreach(Auth::user()->pricing2 as $pricing)
        <option>{{$pricing}}</option>
      @endforeach
    </select>
    @endif
    @if(isset(Auth::user()->pricing3))
    {{--<br>--}}
      &nbsp;
    <em style="font-style: italic;">3- </em>
    <select name="pricing3[]" class="pricing3">
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
  <li><em><a href="{{url('profile/'.Auth::user()->email.'/edit')}}" class="edit_profile">Profilə Düzəliş Et </a></em></li>
  <li><em><a href="{{url('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Hesabdan Çıx</a></em></li>
</ul>
  </div>
  <div class="">
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
    </form>
    <div style="margin-left:25%;padding:1px 16px;height:1000px;">
      <h2 style="text-align: center;">Freelanserin Şəxsi Kabineti</h2>
      <h4 style="text-align: center">Freelancerin Portfoliosu</h4>
      <a style="margin-left: 5%;border-color: #dae0e5; background-color: #e6e6e6" href="{{ url(auth()->user()->email.'/add-smm-work') }}"  class="btn btn-default">Marka Əlavə Et</a>
      <br>
      <br>
      <div class="container" style="display: none">
        <div style=" background-color:#e6e6e6 ;width: 75%; margin-left: 10%;">
          {{--evvel fieldset yuxari--}}
          <table class="table">
            <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Markanın Adı</th>
              <th scope="col">Markanın logosu</th>
              {{--<th scope="col">Ödədəmə Məbləği</th>--}}
              <th scope="col">İşın başladığı Vaxt</th>
              <th scope="col">İşın Qurtarma Vaxt</th>
              <th scope="col">Marka İlə Əlaqə</th>
              <th scope="col">Markaya Düzəliş Et</th>
            </tr>
            </thead>
            <tbody class="smmworks">
            </tbody>
          </table>
        </div>
        <br>
      </div>
      <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel">Pozmağa əminsinizmi?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body smmservice_to_delete" style="display: none">
              ...
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Geri qayıt</button>
              <button type="button" class="btn btn-danger" onclick="confirmDeleteSMMWorkPrompt();">Poz</button>
            </div>
          </div>
        </div>
      </div>

      <div class="">
        <footer class="text-center" style=" padding-bottom: 20px; text-align: center; position: relative; width:100%; clear: both;">&copy Bütün Hüquqlar Qorunur <br>FaceAds 2019</footer>
      </div>

    </div>


  </div>

</div>

</body>
</html>