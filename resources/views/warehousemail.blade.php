
<?php
// $name = "Lopital - Đông Dương Thăng Long";
// $link = "https://lopital.vn"

$name ="Lopital - Onsen Hội Vân";
$link = "https://hoivan.lopital.vn";
?>




<div dir='ltr'>có tệp mới trong kho (Đăng nhập để xem):
<ul>
    @foreach($files as $file)
	<li><a  target="_blank" href="{{$link}}{{$file->url}}?paword=L0p1tal197@&mailofuser2022={{$email}}"><span id="iname{{$file->id}}">{{$file->name}}</span><br> </li>
    @endforeach
</ul>
</div>

