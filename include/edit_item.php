<?php

include('db_connection.php');

$response = array(
   'status' => 0,
   'msg' => 'Something went wrong, Please try again.'
);

$id = intval($_REQUEST['id']);
$rct = $_REQUEST['rct'];
$description = $_REQUEST['description'];
$quantity = $_REQUEST['quantity'];
$unit_price = $_REQUEST['unit_price'];

//calculating total amount
$total_amount = $quantity * $unit_price;
//calculating vat
$vat =  $vat = $total_amount * 0.18 ;

if (!empty($id) && !empty($rct) && !empty($description)  && !empty($quantity)  && !empty($unit_price)) {
      
    $sql = "UPDATE sales SET description = :description, unit_price = :unit_price, quantity = :quantity, 
    total = :total, vat = :vat, rct = :rct WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    
    $stmt->bindparam(':id',$id);
    $stmt->bindparam(':description',$description);
    $stmt->bindparam(':unit_price',$unit_price);
    $stmt->bindparam(':quantity',$quantity);
    $stmt->bindparam(':total',$total_amount);
    $stmt->bindparam(':vat',$vat);
    $stmt->bindparam(':rct',$rct);

    $stmt->execute();
    

    $response['status'] = 1;
    $response['msg'] = 'Item updated successfully';

}
else
{
    $response['msg'] = "Please fill all the manadatory fields";
}

echo json_encode($response);



?>