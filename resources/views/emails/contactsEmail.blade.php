<!DOCTYPE html>
<html>
<head>
    <title>Qarşılama Emailı</title>
</head>

<body>
<h2>Əlaqə quran şəxs:  {{$message_data['name']}}</h2>
<br/>
<span>Əlaqə quranın emailı budur: {{$message_data['email']}}</span>
<br/>
<span>Əlaqə quranın mesajı:</span>
<p>
    {{$message_data['message']}}
</p>
</body>

</html>