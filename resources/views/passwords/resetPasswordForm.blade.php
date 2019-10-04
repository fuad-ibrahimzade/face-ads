<!DOCTYPE html>
<html>
@include('parts.head')
<head>
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('parts.scripts')
</head>
<body>
@include('parts.navbar')
<div class="freelancer"><br>
    <fieldset style=" background-color:#e6e6e6 ;width: 45%; margin-left: 30%;">
        <form style= "margin-left:25px"; method="post" action="{{url()->current()}}" enctype="multipart/form-data">
            @csrf
            {{--<h3> Freelancer Qeydiyyatının Yenilənməsi </h3>--}}
            <div class="main_errors">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div><strong>{{$error}}</strong></div>
                    @endforeach
                @endif
            </div>
            <div class="other_errors"><strong></strong></div>
            <br>
            <br>
            {{--<input style="margin-left: 35px;" placeholder="minimum" type="text" name="new_price_min" class="new_price_min">--}}
            {{--<input style="margin-left: 35px;" placeholder="maksimum" type="text" name="new_price_max" class="new_price_max">--}}
            {{--<input type="button" name="" value="Qiymət Aralığını Əlavə Et" class="new_price_adder">--}}
            <br>
            <span  style="margin-left: 5%">Yeni Şifrəni Yazın</span>  <span style="margin-left: 18%;">Şifrəni Təkrar Yazın</span> <br>
            <input type="password" name="password">  <input style="margin-left: 25px;" type="password" name="password_confirmation">

            <br>
            <br>
            <input style="margin-left: 28%" type="submit" name="submit" value="Düzəlişi Tamamla"><br>
            {{--<p> Hesabım var, <a style="text-decoration-line: none;" href="afh.html">Daxil Ol</a></p>--}}

        </form>
    </fieldset>

    <br>
    <br>
    <br>
</div>
@include('parts.footer')
</html>