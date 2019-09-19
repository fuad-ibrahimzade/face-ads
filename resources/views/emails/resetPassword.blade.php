<!DOCTYPE html>
<html>
<head>
    <title>Şifrə yeniləmə emailı Emailı</title>
</head>

<body>
{{--<h2>Xoş gəlmisiniz {{$user['name']}}</h2>--}}
<br/>
Hörmətli istifadəçi {{$tokenData->name}} şifrənizi yeniləmək üçün zəhmət olmasa aşağıdakı linkin üzərinə basın
<br/>
    <a href="{{url('reset-password', $tokenData->password_reset_token)}}" target="_blank">Şifrəni Yenilə</a>
</body>

</html>