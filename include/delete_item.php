<?php

include('db_connection.php');

$response = array(
   'status' => 0,
   'msg' => 'Something went wrong, Please try again.'
);

$id = intval($_REQUEST['id']);

if (!empty($id)) {
    
    $sql = "DELETE FROM sales WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    $stmt->bindparam(':id',$id);

    $stmt->execute();
    

    $response['status'] = 1;
    $response['msg'] = 'Item deleted';
}
else
{
    $response['msg'] = "Item id not selected";
}

echo json_encode($response);

?>