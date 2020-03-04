<!DOCTYPE html>
<html>
      <title>PHP CRUD</title>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      </head>


      <body>
        <?php require_once 'process.php'; ?>
        <?php if(isset($_SESSION['message'])): ?>
              <div class="alert alert-<?=$_SESSION['msg_type']?>">        
              <?php
                  echo $_SESSION['message'];
                  unset($_SESSION['message']);
              ?>
              </div>
        <?php endif  ?>
        <div  class="container">
        <?php $mysqli = new mysqli('localhost','ashu','ashu123','crud') or die("Connect failed: %s\n". $conn -> error); 
              $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);// pre_r($result);?>
        <div class="row justify-content-center">
            <table class = "table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Location</th>
                  <th colspan="2">Action</th>
                </tr>
              </thead>
              <?php
                while ($row = $result->fetch_assoc()):  
              ?>     
              <tr>
                <td>  <?php echo $row['Name'];      ?></td>
                <td>  <?php echo $row['Location'];  ?></td>
                <td>
                    <a href="index.php?edit=<?php echo $row['id']; ?>"class="btn btn-info">Edit</a>
                    <a href="process.php?delete=<?php echo $row['id']; ?>"class="btn btn-danger">Delete</a>
                </td>
              </tr>
            <?php endwhile;   ?>
            </table> 
        </div>
        <?php 
          pre_r($result->fetch_assoc());
          function pre_r($array)
          {
              echo '<pre>';
              print_r($array);
              echo '<pre>';
          }
        ?>

        <div class="row justify-content-center">
          <form action="process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
            <label>Name</label>
            <input type="text" class= "form-control" name="name" value="<?php echo $name; ?>" placeholder="Enter Your Name" >
            </div>
            <div class="form-group">
            <label>Location</label>
            <input type="text" class= "form-control" name="location" value="<?php echo $location; ?>"placeholder="Enter Your Location">
            </div>
            <div class="form-group">
                <?php if($update == true):?>
                <button type="submit" class="btn btn-info" name="update">Update</button>
                <?php else: ?>
                <button type="submit" class="btn btn-info" name="save">Save</button>
                <?php endif; ?>
            </div>
            </form>
          </div>
          </div>
        </body>
</html>
 