<?php 
	header("Content-Type:text/html; charset=gb2312");
	include("db.php");
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" /> 
<title>CRAC操作证书查询</title>
</head>

CRAC操作证书查询, 数据来源于 <a href=http://www.crac.org.cn/?page_id=1682>http://www.crac.org.cn/?page_id=1682</a>
<p>
<form action=index.php>
请输入查询关键词，可以是姓名，证书编号:<br><input name=str>
<input name=s value="查询" type=submit> (最多返回1000个结果, 结果仅供参考)
</form>
<?php

$str = $_REQUEST["str"];
if( $str == "" ) {
	echo "请输入查询关键词";
} else {
	$str = "%".$str."%";
	$q = "select * from crac where name like ? or bianhao like ? limit 1000";
	$stmt=$mysqli->prepare($q);
	$stmt->bind_param("ss",$str,$str);
	$stmt->execute();
	$stmt->bind_result($id,$name,$sex,$class,$bianhao,$tgrq,$dd,$hfrq,$hfjg);
	echo "查询结果";
	echo "<table border=1 cellspacing=0>";
	echo "<tr><th>身份ID</th><th>姓名</th><th>性别</th><th>操作类型</th><th>证书编号</th><th>通过日期</th><th>通过地点</th><th>核发日期</th><th>核发机构</th>\n";
	$stmt->store_result();	
	while($stmt->fetch()) {
		echo "<tr><td>".$id."</td>";
		echo "<td>".$name."</td>";
		echo "<td>".$sex."</td>";
		echo "<td>".$class."</td>";
		echo "<td>".$bianhao."</td>";
		echo "<td>".$tgrq."</td>";
		echo "<td>".$dd."</td>";
		echo "<td>".$hfrq."</td>";
		echo "<td>".$hfjg."</td></tr>";
	}
	$stmt->close();
	echo "</table>";
}
?>
