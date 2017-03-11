<?php
header("Content-Type:text/xml; charset=utf-8");
$d=$_GET["d"];
if($d!=0)
{
    $tsql=" WHERE week=${d}";
}

$outt= "
<all_calss>";
include("a.php");

$rs = $pdo -> query("SELECT * FROM t_data ${tsql} ORDER BY week , c_time");

while($row = $rs -> fetch())
{

    switch ($row[week])
	{
	case 1:
 	$row[week]="周一";
  	break;
	case 2:
  	$row[week]="周二";
	  break;
     case 3:
  	$row[week]="周三";
	  break;
        case 4:
  	$row[week]="周四";
	  break;
        case 5:
  	$row[week]="周五";
	  break;
        case 6:
  	$row[week]="周六";
	  break;
        case 7:
  	$row[week]="周日";
	  break;
	default:
 	$row[week]="未知";
}

     switch ($row[c_time])
	{
	case 1:
         $row[c_time]="1、2节";
  	break;
	case 2:
  	$row[c_time]="3、4节";
	  break;
     case 3:
  	$row[c_time]="5、6节";
	  break;
        case 4:
  	$row[c_time]="7、8节";
	  break;
        case 5:
  	$row[c_time]="9、10节";
	  break;
        case 10:
         $row[c_time]="1节";
  	break;
         case 20:
         $row[c_time]="2节";
  	break;
         case 30:
         $row[c_time]="3节";
  	break;
         case 40:
         $row[c_time]="4节";
  	break;
         case 50:
         $row[c_time]="5节";
  	break;
         case 60:
         $row[c_time]="6节";
  	break;
         case 70:
         $row[c_time]="7节";
  	break;
         case 80:
         $row[c_time]="8节";
  	break;
         case 90:
         $row[c_time]="9节";
  	break;
         case 100:
         $row[c_time]="10节";
  	break;

	default:
 	$row[c_time]="未知";
}

    $t_time=mktime(9,20,0);
	$o_time=mktime(9,20,0,3,2,2014);
    $bd=ceil(($t_time-$o_time)/24/60/60/7)/2;


   if($row[dsz]==1)
   {
       $xml_dsz="<dsz>——单周</dsz>\n";
   }
   elseif($row[dsz]==2)
   {
        $xml_dsz="<dsz>——双周</dsz>\n";
   }
    else
    {
         $xml_dsz="<dsz> </dsz>\n";
    }

    $cn=$row[c_name];
    $week=$row[week];
    $ct=$row[c_time];
    $tn=$row[tea_name];
    $pl=$row[place];
    $rm=$row[remarks];
    if($rm==null)
    {
    	$rm="无";
    }
    if($cn==null)
    {
    	$cn="无";
    }
    if($week==null)
    {
    	$week="无";
    }
    if($ct==null)
    {
    	$ct="无";
    }
    if($tn==null)
    {
    	$tn="无";
    }
    if($pl==null)
    {
    	$pl="无";
    }


    $outt.="
    <myclass>
    <c_name>${cn}</c_name>
    <week>${week}</week>
    <c_time>${ct}</c_time>
    <tea_name>${tn}</tea_name>
    <place>${pl}</place>
    <remarks>${rm}</remarks>
    ${xml_dsz}</myclass>
    ";

}

echo $outt."</all_calss>";

/**
<?xml version=\"1.0\"  encoding=\"gb2312\" ?>
**/

?>
