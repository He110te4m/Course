<?php
header("Content-Type: text/html; charset=utf-8");
include("a.php");
$do=trim($_GET["do"]);
if($do==2)
{
    setcookie("pw", "", time()-1);
    header("location:admin.php");
}
if( $_COOKIE["pw"]!= $pw )
{
       header("location:admin.php");
}



if($do==4)
{

    $s_time=mktime(0,0,0)-(date("w")-1)*3600*24;
    $t2='
<?php
$startTime='.$s_time.';
$weekNu='.$_POST[set_week].';
?>
';

    if(file_put_contents("b.php",$t2))
    {

        $out="<div id='out'>成功将本周重置为第 $_POST[set_week] 周。</div>";
    }
    else
    {
         $out="<div id='out'>重置失败！</div>";
    }


}




$cn=trim($_POST["c_name"]);
$dsz=trim($_POST["dsz"]);
$week=trim($_POST["week"]);
$ct=trim($_POST["c_time"]);
$tn=trim($_POST["t_name"]);
$pl=trim($_POST["pl"]);
$rm=trim($_POST["rm"]);
$d_cn=trim($_GET["d_cn"]);
$d_ct=trim($_GET["d_ct"]);
$d_week=trim($_GET["d_week"]);

if($do==1)
{

    if($_GET["ok"]==1)
	{
   	 	if($pdo -> query("DELETE FROM t_data WHERE c_name='${d_cn}'and week=${d_week} and c_time='${d_ct}'"))
        {$out="<div id='out'>删除成功</div>";}

    }
    else
	{
		$out="<div id='out'><a href='?do=1&d_week=${d_week}&d_cn=${d_cn}&d_ct=${d_ct}&ok=1'>点击此处</a>确定删除 ${d_cn}</div>";
	}
}

if($do==3)
{
	if($_GET["ok"]==1)
	{
		if($pdo -> query("DELETE FROM t_data"))
		{$out="<div id='out'>已清空全部科目！</div>";}
	}
	else
	{
		$out="<div id='out'><a href='?do=3&ok=1'>点击此处</a>确定删除全部科目</div>";
	}
}

$rs = $pdo -> query("SELECT * FROM t_data  ORDER BY week , c_time");
if(!empty($cn))
{
    if($pdo -> query("INSERT INTO t_data(c_id,c_name,week,c_time,dsz,tea_name,place,remarks) VALUES (1,'${cn}',${week},${ct},${dsz},'${tn}','${pl}','${rm}')"))
    { $out="<div id='out'>添加成功,<a href='?'>点此刷新</a>课看到刚添加的课程</div>";}
}

$form="
<form method='post' action=''  >
    科目：<input type=\"text\" name=\"c_name\" maxlength=\"30\" />
    <select name=\"dsz\">
<option value=\"0\">默认</option>
<option value=\"1\">单周</option>
<option value=\"2\">双周</option>
</select>
    <br/>
    时间：<select name=\"week\">
<option value=\"1\">周一</option>
<option value=\"2\">周二</option>
<option value=\"3\">周三</option>
<option value=\"4\">周四</option>
<option value=\"5\">周五</option>
<option value=\"6\">周六</option>
<option value=\"7\">周末</option>
</select>
 <select name=\"c_time\">
<option value=\"1\">1-2节</option>
<option value=\"2\">3-4节</option>
<option value=\"3\">5-6节</option>
<option value=\"4\">7-8节</option>
<option value=\"5\">9-10节</option>
<option value=\"10\">1节</option>
<option value=\"20\">2节</option>
<option value=\"30\">3节</option>
<option value=\"40\">4节</option>
<option value=\"50\">5节</option>
<option value=\"60\">6节</option>
<option value=\"70\">7节</option>
<option value=\"80\">8节</option>
<option value=\"90\">9节</option>
<option value=\"100\">10节</option>
</select>
<br/>
教师：<input type=\"text\" name=\"t_name\" maxlength=\"30\" /> <br/>地点：<input type=\"text\" name=\"pl\" maxlength=\"30\" /><br/>
    备注：<textarea name=\"rm\" cols='20' rows='10' ></textarea><br/>
    <input class='btn-s' type=\"submit\" value=\"完 成 添加\" />
    </form>
";

$form2="<form method='post' action='?do=4'>
今天是第<input type=\"text\" name=\"set_week\" maxlength=\"2\" size='1'/>
<input class='btn-s' type=\"submit\" value=\"确定重置周数\" /></form>";





while($row = $rs -> fetch())
{

    switch ($row[week])
	{
	case 1:
 	$row2[week]="周一";
  	break;
	case 2:
  	$row2[week]="周二";
	  break;
     case 3:
  	$row2[week]="周三";
	  break;
        case 4:
  	$row2[week]="周四";
	  break;
        case 5:
  	$row2[week]="周五";
	  break;
        case 6:
  	$row2[week]="周六";
	  break;
        case 7:
  	$row2[week]="周日";
	  break;
	default:
 	$row[week]="未知";
    }

     switch ($row[c_time])
	{
	case 1:
         $row2[c_time]="1、2节";
  	break;
	case 2:
  	$row2[c_time]="3、4节";
	  break;
     case 3:
  	$row2[c_time]="5、6节";
	  break;
        case 4:
  	$row2[c_time]="7、8节";
	  break;
        case 5:
  	$row2[c_time]="9、10节";
	  break;
        case 10:
         $row2[c_time]="1节";
  	break;
         case 20:
         $row2[c_time]="2节";
  	break;
         case 30:
         $row2[c_time]="3节";
  	break;
         case 40:
         $row2[c_time]="4节";
  	break;
         case 50:
         $row2[c_time]="5节";
  	break;
         case 60:
         $row2[c_time]="6节";
  	break;
         case 70:
         $row2[c_time]="7节";
  	break;
         case 80:
         $row2[c_time]="8节";
  	break;
         case 90:
         $row2[c_time]="9节";
  	break;
         case 100:
         $row2[c_time]="10节";
  	break;

	default:
 	$row[c_time]="未知";
}
    $all_c=$all_c."<div>${row[c_name]} [ ${row2[week]} ${row2[c_time]} ] #<a href=\"?do=1&d_week=${row[week]}&d_cn=${row[c_name]}&d_ct=${row[c_time]}\">删除</a>#</div>";

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
</style>
<body>
<div id=\"a1\"><div class='a2'>课程管理 --[<a href='?do=2'>退出</a>]</div>" .$out.$form."<div class='a3'>
</div>".$all_c."<div style='background: #f44;margin:5px 3px;padding:3px;'>[<a href='?do=3'>删除全部科目</a>] ${form2}</div>
<div class='a2'>==<a href='index.php'>返 回 前 台</a>==</div></div>
</body></html>";
