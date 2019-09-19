<!DOCTYPE html>
<html>
@include('parts.head')
<body>

@include('parts.navbar')
</body>
<div>
	<p style=" color: #1a75ff; font-size:20px;">Ən Reytingli Agentliyi və Freelanceri Tap</p> <br>
 <span style="margin-left:10%;"> Sektoru Seç  <select style="" name="Sektorlar "> 
    <option value="Tibb">Tibb və Xəstəxana </option>
    <option value="Tikinti">Tikinti </option>
    <option value="Avtomabil">Avtomabil</option>
    <option value="Restoran">Restoran və Əyləncə Mərkəzləri  </option>
    <option value="Maliyyə">Maliyyə və Bank</option>
    <option value="Turizm">Turizm və Otel</option>
    <option value="Bütün">Bütün Sektorlar </option>
   </select></span>
   &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 
   Ölkəni Seç  <select name="Ölkələr ">
    <option value="volvo">Azərbaycan</option>
    <option value="saab">Türkiyə</option>
    <option value="fiat">Rusiya</option>
   </select> 
&nbsp&nbsp&nbsp&nbsp&nbsp<input type="submit" value="Axtar">
</form>
<h2 style= "  text-align: center; color:blue;">Agentliklər</h2> 
<img style= "margin-left: 4%;"width="6%"src="{{asset('images/a.jpg')}}"> <br>
<img style= "margin-left: 4%;" width="13%;" src="{{asset('images/rating.jpg')}}"><br>
<span style= "margin-left: 4%;"style= "margin-left: 9px;"> 80/100 - "A" Agentliyi </span> 
<br>
<br>
<img style= "margin-left: 4%;"style= "margin-left: 4%;" width="6%" src="{{asset('images/b.jpg')}}"><br>
<img style= "margin-left: 4%;" width="13%;" src="{{asset('images/rating1.jpg')}}"><br>
<span style= "margin-left: 4%;" style= "margin-left: 9px;"> 60/100 - "B" Agentliyi </span> 
<br>
<br>
<img style= "margin-left: 4%;"style= "margin-left: 9px;" width="6%" src="{{asset('images/c.jpg')}}"><br>
<img style= "margin-left: 4%;" width="13%;" src="{{asset('images/rating2.jpg')}}"><br>
<span style= "margin-left: 4%;" style= "margin-left: 9px;"> 50/100 - "C" Agentliyi </span><br>
<h2  style=" text-align: center; color:blue;">Freelancerlər</h2> 
<img style= "margin-left: 4%;"width="8%;" src="{{asset('images/man.jpg')}}"><br>
<img style= "margin-left: 4%;"width="13%;" src="{{asset('images/rating.jpg')}}"> <br>
<span style= "margin-left: 4%;"style= "margin-left: 9px;"> 80/100 - Əli Əliyev  </span> 
<br>
<br>
<img style= "margin-left: 4%;" style= "margin-left: 9px;" width="6%" src="{{asset('images/man1.jpg')}}"><br>
<img style= "margin-left: 4%;" width="13%;" src="{{asset('images/rating1.jpg')}}"><br>
<span style= "margin-left: 4%;" style= "margin-left: 9px;"> 60/100 - Tural Vəliyev </span>
<br> 
<img style= "margin-left: 4%;" style= "margin-left: 9px;" width="6%" src="{{asset('images/woman.jpg')}}"><br>
<img style= "margin-left: 4%;" width="13%;" src="{{asset('images/rating2.jpg')}}"><br>
<span style= "margin-left: 4%;" style= "margin-left: 9px;"> 50/100 - Aytac Məmmədova </span><br>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
@include('parts.footer')
</html>
