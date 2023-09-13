<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

    <title>Update</title>
</head>
<body>
    <?php
    if(!isset($_POST['id'])){
        header('location: index.php');
    }
    include_once 'includes/database.php';
    include_once 'includes/nav.php';
    $id = $_POST['id'];
    $sqlstatement = $pdo->prepare('SELECT * FROM tach WHERE id=?');
    $sqlstatement->execute([$id]);
    $task = $sqlstatement->fetch(PDO::FETCH_OBJ);

    if(isset($_POST['update2'])){
        $title = $_POST["title"];
        $id = $_POST["id"];
        if(!empty($id) && !empty($title)){

            $sqlstatement = $pdo->prepare('UPDATE tach  SET title=? WHERE id=?');
            $result = $sqlstatement->execute([$title,$id]);
            if($result == true){
                header('location: index.php');
            }
            echo "$id , $title";
        }else{
            ?>
                <div class="alert alert-danger fw-bolder" role="alert">The <span class='fw-bolder'>title</span> is recuired!</div>
            <?php
        }
    }
    ?>
<div class="addtask border border-dark p-4 my-5 mx-auto w-75 ">
       <h4>Update </h4>
       <form  method="post">
        <input type="hidden" name="id" value="<?php echo $task->id ?>">
            <div class="col-auto">
                <label for="title" class="col-form-label">Title
                    <span class="required">*</span>
                </label>
            </div>
            <div class="col-auto">
                <input type="text" id="title" name="title" class="form-control" aria-describedby="titleHelpInline" value="<?php echo $task->title ?>">
            </div>
            <div class="col-auto">
                <span id="titleHelpInline" class="form-text">
                    task title.
                </span>
            </div>
            <div class="con-auto">
                <input class="btn btn-primary my-2 " type="submit" value="update" name="update2">
            </div>
       </form>
    </div>
</body>
</html>
<!--12 10:00-->
