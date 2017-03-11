<?php
header("Content-Type: text/html; charset=utf-8");
include("b.php");
?>
<html>
<head>
    <title>在线课表</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<link rel="stylesheet" type="text/css" href="css.css" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs
/jquery/1.4.0/jquery.min.js"></script>
<script type="text/javascript">


     //单双周计算
    var td = new Date()

	td.setHours(0)
    td.setMinutes(0)
    td.setSeconds(0)
    td.setMilliseconds(0)
    var td2 = Date.parse(td)
    var od2 = <?php echo $startTime; ?>*1000
    var d=Math.ceil(( (td2-od2)/1000/24/60/60+1 )/7+<?php echo $weekNu; ?>-1);


function loadXMLDoc(url)
{
var xmlhttp,an,ds;
var txt,x,xx,i,dsz;

     if(d%2==1)
    {

        ds="——双周";

    }
    else
    {
          ds="——单周";

    }


if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }



xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
        txt="";
    x=xmlhttp.responseXML.documentElement.getElementsByTagName("myclass");
    for (i=0;i<x.length;i++)
      {


      cn_xx=x[i].getElementsByTagName("c_name");
      tn_xx=x[i].getElementsByTagName("tea_name");
      w_xx=x[i].getElementsByTagName("week");
      ct_xx=x[i].getElementsByTagName("c_time");
      p_xx=x[i].getElementsByTagName("place");
      r_xx=x[i].getElementsByTagName("remarks");
     	 dsz_xx=x[i].getElementsByTagName("dsz");
      	 dsz=dsz_xx[0].firstChild.nodeValue;

          if(dsz==ds)
          {
             txt=txt + "<div id=\"add_css\">";
          }
          else
          {
             txt=txt + "<div id=\"center\">";
          }


        {
        try
          {


              txt=txt + "<div id=\"box\">课程：" + cn_xx[0].firstChild.nodeValue +"<span class=\"red\">"+dsz+"</span><br/>时间："+ w_xx[0].firstChild.nodeValue +" 第"
              + ct_xx[0].firstChild.nodeValue +"<br/>任课老师："+ tn_xx[0].firstChild.nodeValue+"<br/>地点："+ p_xx[0].firstChild.nodeValue +"<br/>备注："+ r_xx[0].firstChild.nodeValue + "</div></div>";
          }
         catch (er)
          {
          txt=txt + "加载失败！";
          }



        }


          txt=txt + "";
      }
    txt=txt + "";
    document.getElementById('txtCDInfo').innerHTML=txt;

    }

  }
xmlhttp.open("GET",url,true);
xmlhttp.send();


    an=url.slice(-1);
    if(an=='p'){
    an=0;
    }

    for(var nn=0;nn<=7;nn++)
    {
        document.getElementById("a"+nn).style.background="";
        document.getElementById("a"+nn).style.color="#fff";
        document.getElementById("a"+nn).style.opacity="1";
    }
    document.getElementById("a"+an).style.background="#272626";
    document.getElementById("a"+an).style.color="#fff";
      document.getElementById("a"+an).style.opacity="0.8";

}







</script>
</head>
<body>

    <div id="all">
    <div id="cd">
        <div onclick="loadXMLDoc('out_xml.php')" class="c_qb a0" id="a0"><span  class="ww">全 部</span> </div>
        <div class="c_qt2" id="a1" onclick="loadXMLDoc('out_xml.php?d=1')" ><span  class="ww">周一</span> </div>
        <div class="c_qt1" id="a2"  onclick="loadXMLDoc('out_xml.php?d=2')" ><span  class="ww">周二</span> </div>
        <div class="c_qt2" id="a3"  onclick="loadXMLDoc('out_xml.php?d=3')" ><span  class="ww">周三</span> </div>
        <div class="c_qt1" id="a4"  onclick="loadXMLDoc('out_xml.php?d=4')" ><span  class="ww">周四</span> </div>
        <div class="c_qt2" id="a5"  onclick="loadXMLDoc('out_xml.php?d=5')" ><span  class="ww">周五</span> </div>
        <div class="c_qt1" id="a6"  onclick="loadXMLDoc('out_xml.php?d=6')" ><span  class="ww">周六</span> </div>
        <div class="c_qt2" id="a7"  onclick="loadXMLDoc('out_xml.php?d=7')" ><span  class="ww">周末</span> </div>

    </div>
<div id="txtCDInfo" class="txtCDInfo"></div>

    <div id="ztj">。。。</div>
    <div id="bq"> © 2014  He110 </div>



    <script>
        document.getElementById('ztj').innerHTML="<span class='ww'>本周是第 "+d+" 周</span>";
    </script>
    </div>
    <div id='bg0'>青春是一场大雨，<br/>即使感冒了，还盼望回头再淋它一次。</div>
</body>
</html>
