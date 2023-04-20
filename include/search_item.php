<?php
	include 'db_connection.php';
    

    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;

    $fromdate = isset($_POST['fromdate']) ? mysql_real_escape_string($_POST['fromdate']) : '';
    $todate = isset($_POST['todate']) ? mysql_real_escape_string($_POST['todate']) : '';

	$offset = ($page-1)*$rows;
	$result = array();
	
	$rs = $pdo->prepare("SELECT count(*) from sales where date between :fromdate and :todate");
    $rs->bindparam(':fromdate',$fromdate);
    $rs->bindparam(':todate',$todate);
    $rs->execute();
	$row = $rs->fetch();
	$result["total"] = $row[0];


	$rs = $pdo->prepare("SELECT * from sales date between :fromdate and :todate limit $offset,$rows");
    $rs->bindparam(':fromdate',$fromdate);
    $rs->bindparam(':todate',$todate);
	
	$items = array();
	while($row = $rs->fetch()){
		array_push($items, $row);
	}
	$result["rows"] = $items;

	echo json_encode($result);