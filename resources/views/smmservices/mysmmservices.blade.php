<!DOCTYPE html>
<html>
{{--@include('parts.header')--}}
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('parts.scripts')
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
    <script src="{{asset('js/app.js')}}"></script>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<br>
<div class="container">
    <div style=" background-color:#e6e6e6 ;width: 45%; margin-left: 30%;">
        {{--evvel fieldset yuxari--}}
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Markanın Adı</th>
                <th scope="col">Ödədəiyi Məbləğ</th>
                <th scope="col">İşın başladığı Vaxt</th>
                <th scope="col">İşın Qurtaracağı Vaxt</th>
                <th scope="col">Marka İlə Əlaqə</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                <td>İşın Qurtaracağı Vaxt</td>
                <td><a class="btn btn-default fa fa-comment-o fa-lg" style="background-color: transparent" data-toggle="tooltip" data-placement="top" title="message"></a></td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
            </tr>
            @foreach($smmservices as $smmservice)
                <tr>
                    <th scope="row">{{$loop->index+1+3}}</th>
                    <td>{{$smmservice->business_mark_name}}</td>
                    <td>{{$smmservice->pricing}}</td>
                    <td>{{$smmservice->created_at}}</td>
                    <td>İşın Qurtaracağı Vaxt</td>
                    <td><a class="btn btn-default fa fa-comment-o fa-lg" style="background-color: transparent" data-toggle="tooltip" data-placement="top" title="message"></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="text-center">
        <a href="{{url('profile/'.$smmservice->email)}}" class="btn btn-dark">Geri qayıt</a>
    </div>
    <br>
</div>
@include('parts.footer')
</body>
</html>