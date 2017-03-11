<?php
header ( 'Content-Type:text/html;charset=utf-8 ');
if($_POST[pw]==null)
{
$_POST[pw]="vst93";
}
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css.css" />
<style type="text/css">
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
    <title>在线课表 - 安装程序</title>
    </head>
<body>
    <div id="a1">
        <div class='a2'>在线课表 V1.1 </div>
   <?php
date_default_timezone_set("Asia/Shanghai");
    if($_POST["host"]!=NULL){
$datetime=date("Y.m.d H:i");
$mysql_host=$_POST["host"];
$mysql_user=$_POST["user"];
$mysql_password= $_POST["password"];
$mysql_database= $_POST["database"];
$conn=@mysql_connect("$mysql_host","$mysql_user","$mysql_password");
if($conn && @mysql_select_db("$mysql_database",$conn))
{
    echo "<font color=\"red\">数据库连接成功！</font><br/>";
$t='
<?php
$dsn="mysql:host='.$mysql_host.';port=3306;dbname='.$mysql_database.';charset=utf8";
$pdo = new PDO($dsn,"'.$mysql_user.'","'.$mysql_password.'");
$pw="'.$_POST[pw].'";
?>
';
file_put_contents("a.php",$t);



     if(
       mysql_query("CREATE TABLE t_data(c_id int,c_name varchar(90),week int,c_time int,dsz int,tea_name varchar(90),place varchar(120),remarks varchar(300),y1 varchar (300),y2 varchar(300),y3 varchar(300))DEFAULT CHARSET=utf8")
      )
    {
    echo "t_data 建表成功!<br/>";
    }
    else{

        if(mysql_query("SELECT * FROM t_data"))
        {
            echo "t_data 已存在!<br/>";
        }
        else
        {
            echo "<font color=\"red\">t_data 建表失败!</font><br/>";
        }

    }


     echo "<p>建表过程结束,请手动删除install.php或将其改名！<br/><span class='red'>现在你可以<a href='admin.php'>进入后台</a>编辑啦！(请自行保存后台书签)</span>
</p>";

    $ok=1;
}
    else
    {
        echo "数据库连接失败！";
    }
}

if($ok!=1)
{
    echo " <form method='POST' action=''>
    Host:<input type='text' name='host' /><br/> User: <input type='text' name='user' /><br/> Password: <input type='text' name='password' /><br/>
    Database: <input type='text' name='database' /><br/>
    口令:<input type='text' name='pw' /><br/>(用于后台登录)
    <br/>
    <input type='submit' value=' 确 定 安 装 ' /> </form> ";
}
?>
    </div>
</body>
</html>
