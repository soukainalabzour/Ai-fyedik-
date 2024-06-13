<?php
$total = [];
try{
    $db = new PDO("mysql:host=localhost;dbname=finale", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //count le nombre des client
    $stm = $db->prepare("SELECT COUNT(*) AS `TOTAL_CLIENT` FROM `client`");
    $stm->execute();
    $result = $stm->fetch();
    $total['TOTAL_CLIENT'] = $result['TOTAL_CLIENT'];

    //count le nombre des seller
    $stm = $db->prepare("SELECT COUNT(*) AS `TOTAL_SELLER` FROM `seller`");
    $stm->execute();
    $result = $stm->fetch();
    $total['TOTAL_SELLER'] = $result['TOTAL_SELLER'];


     //count le nombre des order
     $stm = $db->prepare("SELECT COUNT(*) AS `TOTAL_ORDER` FROM `order`");
     $stm->execute();
     $result = $stm->fetch();
     $total['TOTAL_ORDER'] = $result['TOTAL_ORDER'];

     //count le nombre des admin
     $stm = $db->prepare("SELECT COUNT(*) AS `TOTAL_ADMIN` FROM `admin`");
     $stm->execute();
     $result = $stm->fetch();
     $total['TOTAL_ADMIN'] = $result['TOTAL_ADMIN'];



    echo json_encode($total);
}catch(PDOException $e){
    echo $e->getMessage();
}

?>