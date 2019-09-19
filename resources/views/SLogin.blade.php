<!DOCTYPE html>
<html>
@include('parts.head')
<body>
@include('parts.navbar')
<div class="freelancer">
	<br>
	<br>
<fieldset style=" background-color:white;height: 45%;
width: 40%; margin-left: 33%;">
     <h3> Daxil Ol</h3>
	 <span style="margin-left: 35px;">Email Ünvanı </span><br>
	 <input style="margin-left: 35px;" placeholder="info@sahibkar.az" type="email" name="">
	 <br><br>
	 <span  style="margin-left: 35px;"> Şifrə </span> <br>
	 <input style="margin-left: 35px;" placeholder="******"type="password" name=""> <br> 
	<input style="margin-left: 35px;"  type="checkbox" name=""> <i>Məni xatırla</i> <br>
	 <i style="margin-left: 35px;" > <a style="text-decoration-line: none;" href="">Şifrəni Unutdun ?</a></i>
	  <br>
	  <input style="margin-left: 55%" type="submit" name="Daxil Ol" value="Daxil Ol"> <br>
<p><a style="text-decoration-line: none;" href="{{route('sahibkar')}}"> Hesabın Yoxdur ? Qeydiyyatdan Keç </a></p>
	</fieldset>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
</div>
@include('parts.footer')
</html>