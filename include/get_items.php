<?php
   include('db_connection.php');
  

	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
    
	$textSearch = isset($_POST['textSearch']) ? mysql_real_escape_string($_POST['textSearch']) : '';

	$where = "description like '%$textSearch%'";

	$offset = ($page-1)*$rows;
	$result = array();

	
	$rs = $pdo->query("select count(*) from sales where " . $where );
	$row = $rs->fetch();
    $response["total"] = $row[0];


	$rs = $pdo->query("select * from sales where " . $where . " order by id DESC limit $offset,$rows");
	
	$items = array();
	while($row = $rs->fetch()){
		array_push($items, $row);
	}
	$response["rows"] = $items;

	echo json_encode($response);

?>