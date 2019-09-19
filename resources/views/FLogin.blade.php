<!DOCTYPE html>
<html>
@include('parts.head')
<body>
@include('parts.navbar')
<div class="freelancer"><br>
	<br>
<fieldset style=" background-color:white;height: 45%; width: 38%; margin-left: 33%;">
     <h3> Daxil Ol</h3>
	 <span style="margin-left: 35px;">Email Ünvanı </span><br>
	 <input style="margin-left: 35px;" placeholder="freelancer@mammadov.az" type="email" name="">
	 <br><br>
	 <span  style="margin-left: 35px;"> Şifrə </span> <br>
	 <input style="margin-left: 35px;" placeholder="******"type="password" name=""> <br> 
	<input style="margin-left: 35px;"  type="checkbox" name=""> <i>Məni xatırla</i> <br>
	 <em style="margin-left: 35px;" > <a style="text-decoration-line: none;" href="">Şifrəni Unutdun ?</a></em>
	 
	  <input style="margin-left: 35%" type="submit" name="Daxil Ol" value="Daxil Ol">
	  <br>
	   <p>Hesabın Yoxdur ?<a style="text-decoration-line: none;" href="{{route('freelancer')}}">  Qeydiyyatdan Keç </a></p>
</fieldset>
<br>
</div>
</body>
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
<br>
<br>
<div>
@include('parts.footer')
</html>