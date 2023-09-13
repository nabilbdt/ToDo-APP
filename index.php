<!DOCTYPE html>
<html lang="en">
<head>
  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>ToDo App</title>
</head>
<body>
<?php include_once 'includes/database.php'; ?>
<?php include_once 'includes/nav.php'; ?>
<div class="container">
    <div class="row g-3 align-items-center">
        <?php
        $title='';
        if(isset($_POST['add'])){
            $title = $_POST['inputtitle'];
            if(!empty($title)){
               $sqlstatement = $pdo->prepare("insert into tach values(null,?)");
               $result = $sqlstatement ->execute([$title]);
              ?>
            <div class="alert alert-success fw-bolder" role="alert">the title : <span class='fw-bolder'><?= $title ?></span></div>
            <?php  
            }
            else{
                ?>
                <div class="alert alert-danger fw-bolder" role="alert">The <span class='fw-bolder'>title</span> is recuired!</div>
                <?php
            }
        }
        ?>
    <div class="addtask border border-dark p-4 my-5 mx-auto w-75 ">
       <h4>Add new task</h4>
       <form  method="post">
            <div class="col-auto">
                <label for="title" class="col-form-label">Title
                    <span class="required">*</span>
                </label>
            </div>
            <div class="col-auto">
                <input type="text" id="title" name="inputtitle" class="form-control" aria-describedby="titleHelpInline">
            </div>
            <div class="col-auto">
                <span id="titleHelpInline" class="form-text">
                    task title.
                </span>
            </div>
            <div class="con-auto">
                <input class="btn btn-primary my-2 " type="submit" value="add" name="add">
            </div>
       </form>
    </div>
    </div>

    <?php
    $sqlstatement = $pdo->query("SELECT * FROM tach");
    $tasks = $sqlstatement->fetchALL(PDO::FETCH_ASSOC);
    ?>
    <table class="table  mx-auto w-75">
      <thead>
        <tr class="text-center">
          <th scope="col">ID</th>
          <th scope="col">Title</th>
          <th scope="col">Operation</th>
        </tr>
      </thead>
        <tbody>
          <?php
          foreach ($tasks as $key => $task) {
            ?>
            <tr class="text-center">
              <td>
              <span class="badge rounded-pill bg-primary"> <?php echo $task["id"] ?></span>
             </td>
              <td><?php echo $task["title"] ?></td>
              <td>
                <form method="post">
                  <input type="hidden" name="id" value="<?php echo $task["id"] ?>">
                  <input formaction="update.php" type="submit" class="btn btn-primary" value="&#9999;" name="update">
                  <input formaction="delete.php"  type="submit" class="btn btn-danger" onclick="return confirm('voulez vous supprimer set tache')" value="&#10008;" name="delete">
                </form>
              </td>
            </tr>
            <?php 
          }

          ?>
        </tbody>
    </table>
</div>
<footer>
    <p class="text-center">&copy; 2023. Licensed under the MIT License.</p>
</footer>
</body>
</html>