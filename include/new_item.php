<?php

include('db_connection.php');

$response = array(
   'status' => 0,
   'msg' => 'Something went wrong, Please try again.'
);


$rct = $_REQUEST['rct'];
$description = $_REQUEST['description'];
$quantity = $_REQUEST['quantity'];
$unit_price = $_REQUEST['unit_price'];


//calculating total amount
$total_amount = $quantity * $unit_price;
//calculating vat
$vat =  $vat = $total_amount * 0.18 ;

if (!empty($rct) && !empty($description)  && !empty($quantity)  && !empty($unit_price)) {
      
    $sql = "insert into sales (description, unit_price, quantity, total, vat, rct) values 
    (:description, :unit_price, :quantity, :total, :vat, :rct)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindparam(':description',$description);
    $stmt->bindparam(':unit_price',$unit_price);
    $stmt->bindparam(':quantity',$quantity);
    $stmt->bindparam(':total',$total_amount);
    $stmt->bindparam(':vat',$vat);
    $stmt->bindparam(':rct',$rct);

    $stmt->execute();
    

    $response['status'] = 1;
    $response['msg'] = 'Item inserted successfully';

}
else
    {
        $response['msg'] = "Please fill all the manadatory fields";
    }


echo json_encode($response);







?>