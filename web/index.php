<?php 
	header("Content-Type:text/html; charset=gb2312");
	include("db.php");
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" /> 
<title>CRAC����֤���ѯ</title>
</head>

CRAC����֤���ѯ, ������Դ�� <a href=http://www.crac.org.cn/?page_id=1682>http://www.crac.org.cn/?page_id=1682</a>
<p>
<form action=index.php>
�������ѯ�ؼ��ʣ�������������֤����:<br><input name=str>
<input name=s value="��ѯ" type=submit> (��෵��1000�����, ��������ο�)
</form>
<?php

$str = $_REQUEST["str"];
if( $str == "" ) {
	echo "�������ѯ�ؼ���<p>";
	$q = "select tm, count from count order by tm desc limit 30";
	$stmt=$mysqli->prepare($q);
	$stmt->execute();
	$stmt->bind_result($tm,$count);
	echo "���ݿ���֤����Ϣ����";
	echo "<table border=1 cellspacing=0>";
	echo "<tr><th>ʱ��</th><th>������Ŀ</th></tr>\n";
	$stmt->store_result();	
	while($stmt->fetch()) {
		echo "<tr><td>".$tm."</td>";
		echo "<td>".$count."</td>";
		echo "</tr>\n";
	}
	$stmt->close();
	echo "</table>";
} else {
	$str = "%".$str."%";
	$q = "select * from crac where name like ? or bianhao like ? limit 1000";
	$stmt=$mysqli->prepare($q);
	$stmt->bind_param("ss",$str,$str);
	$stmt->execute();
	$stmt->bind_result($id,$name,$sex,$class,$bianhao,$tgrq,$dd,$hfrq,$hfjg);
	echo "��ѯ���";
	echo "<table border=1 cellspacing=0>";
	echo "<tr><th>���ID</th><th>����</th><th>�Ա�</th><th>��������</th><th>֤����</th><th>ͨ������</th><th>ͨ���ص�</th><th>�˷�����</th><th>�˷�����</th</tr>>\n";
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
