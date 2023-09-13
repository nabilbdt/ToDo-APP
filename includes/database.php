<?php
//connection with database
try {
    $pdo = new PDO("mysql:host=localhost;dbname=todo","root","");
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }

?>