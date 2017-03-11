<?php
header("Content-Type: text/html; charset=utf-8");
include("a.php");
$pp=$_POST[pw];
if(!empty($pp))
{
    if($pp==$pw)
    {
        setcookie("pw", "${pp}", time()+3600*24*7);
        header("location:input.php");
    }
    else
    {
        $out="<div id='out'>口令错误！</div>";
    }
}

echo "<html>
<head>
<title>课表后台</title>
<link rel=\"stylesheet\" type=\"text/css\" href=\"css.css\" />
<style type=\"text/css\">
body{
color:#fff;
}
#a1 {
max-width: 600px;
margin: 0px auto;
padding:10px;
border: 2px solid #fff;
}
#out{
color:#43D6F1;
padding:3px;
border: 2px solid #f55;
}
.a2{
margin:5px 0;
padding:10px;
background:#58C5F0;
}
.a3
{
border: 2px solid #58C5F0;
}
a:link
{
color:#4AA5FF;
}
.red{
color:#f22;
}
</style>
<body>
<div id=\"a1\">
<div class='a2'>口令核对</div>
$out
<form method='post' action='' >
口令：<input type=\"text\" name=\"pw\" maxlength=\"30\"><br/>
<input class='btn-s' type=\"submit\" value=\"确认口令\" /><br/>

<div class='a2'>==<a href='index.php'>返 回 前 台</a>==</div>
</div>
";
