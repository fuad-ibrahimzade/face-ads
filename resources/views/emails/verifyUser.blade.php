<!DOCTYPE html>
<html>
<head>
    <title>Qarşılama Emailı</title>
</head>

<body>
<h2>Xoş gəlmisiniz {{$user['name']}}</h2>
<br/>
Registrasiya etdiyiniz email budur: {{$user['email']}} , Emailınızı təstiqləmək üçün zəhmət olmasa aşağıdakı linkin üzərinə basın
<br/>
<a href="{{url('user/verify', $user->verifyUser->token)}}" target="_blank">Verify Email</a>
</body>

</html>