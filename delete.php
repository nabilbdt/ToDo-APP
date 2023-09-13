<?php
    if(isset($_POST['delete'])){
        require_once 'includes/database.php';
        $id = $_POST['id'];
        echo $id;
        $sqlstatement = $pdo->prepare("delete from tach where id=?");
        $result = $sqlstatement->execute([$id]);
        header('location: index.php');

    }


?>