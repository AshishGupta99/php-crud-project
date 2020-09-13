<?php

$insert = false;
$update = false;
$delete = false;
$host = "127.0.0.1";
$user = "root";
$pass = "mysql_native_password";
$db_name = "notes";
$con = mysqli_connect($host,$user,$pass,$db_name);
if(!$con){
  die("connection was not successfully".mysqli_connect_error());
}

if(isset($_GET['delete'])){
  $sno2 = $_GET['delete'];
  //echo $sno2;
  $delete = true;
  $md = "DELETE FROM `notes` WHERE `srNo` = $sno2";
  $ans = mysqli_query($con,$md);
}

/*for checking method we can echo $_SERVER['REQUEST_METHOD'] == 'POST';(this get output as GET OR POST) */
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  if(isset($_POST['srNoEdit'])){
    //echo "yes";
    //exit();
    //update the record
    $srNo = $_POST['srNoEdit'];
    $title = $_POST['titleEdit'];
    $discription = $_POST['descriptionEdit'];
    
    $sql = "UPDATE `notes` SET `title` = '$title', `description` = '$discription' WHERE `notes`.`srNo` = $srNo";
    $result = mysqli_query($con,$sql);
    if(!$resul){
     // echo "Note updated successfully";
     $update = true;
    }
    else{
      echo "you note no submitted successfully coz ".mysqli_error($con);
    }
  }
  else{
  //$_POST[name_input_field]
  $title = $_POST['title'];
  $discription = $_POST['description'];
  
  //sql mysqli_query
  $sql = "INSERT INTO `notes` (`srNo`, `title`, `description`, `date`) VALUES (NULL, '$title', '$discription', current_timestamp())";
  $ans = mysqli_query($con,$sql);
  
  //chekc rocord inssrted or note 
  if($ans){
    //echo "the record inserted successfully";
    $insert = true;
  }
  else{
    echo "the record has been not submitted becouse ".mysqli_error($con);
  }
 }
}
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <link rel="stylesheet" src="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <title>project 1. php CRUD</title>
   
  </head>
  <body>
    
    <!-- Button edit modal -->
  <!--  
 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">
  edit modal
</button> -->

<!--edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit this Note</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
        
  <form action="/MyProjects/CRUD/" method="POST">
     <div class="modal-body">
    <input type="hidden" name="srNoEdit" id="srNoEdit">
  <div class="form-group">
    <label for="title">Notes Title</label>
    <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
  </div>

  <div class="form-group">
    <label for="desc">Note Discription</label>
    <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
  </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</form>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">iNotes</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      
       <li class="nav-item">
        <a class="nav-link" href="#">Contact us</a>
      </li>
     
     
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

<?php
if($insert){
echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Succes!</strong> Your note has been inserted successfully!
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>";
}
?>

<?php
if($update){
echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Succes!</strong> Your note has been Updated successfully!
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>";
}
?>

<?php
if($delete){
echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Succes!</strong> Your note has been Deleted successfully!
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>";
}
?>

<div class="container my-4">
  <h2>Add a Notes</h2>
  <form action="/MyProjects/CRUD/index.php" method="POST">
  <div class="form-group">
    <label for="title">Note Title</label>
    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
  </div>

  <div class="form-group">
    <label for="desc">Note Discription</label>
    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Add Note</button>
</form>
</div>

<div class="container">
 
  <?php
  /*
  $sql = "SELECT * FROM `notes`";
  $result = mysqli_query($con,$sql);
  while($row = mysqli_fetch_assoc($result)){
    echo $row['srNo'] . ".Title " . $row['title'] . "description is ". $row['description']."<br>";
  }*/
  ?>
  
  <table class="table" id="myTable">
  <thead>
    
 <tr>
      <th scope="col">srNo</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Actions</th>
    </tr>  
  </thead>
  <tbody>
  <?php
  $sql = "SELECT * FROM `notes`";
  $result = mysqli_query($con,$sql);
  $n = 1;
  while($row = mysqli_fetch_assoc($result)){
    echo "<tr>
      <th scope='row'>".$n."</th>
      <td>".$row['title']."</td>
      <td>".$row['description']."</td>
      <td> <button class = 'edit btn btn-sn btn-primary' data-toggle='modal' data-target='#editModal' id=".$row['srNo'].">Edit</button>  <button class = 'delete edit btn btn-sn btn-primary' id=d".$row['srNo'].">Delete</button></td>
    </tr>";
   $n = $n + 1;
   
  }
  ?>

  </tbody>
</table>
  
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready( function () {
    $('#myTable').DataTable();
         });
  </script>
  
   <script>
      edits = document.getElementsByClassName('edit');
      Array.from(edits).forEach((elements) => {
        elements.addEventListener('click',(e) => {
          //document.write('edit',e.target.parentNode.parentNode);
          tr = e.target.parentNode.parentNode;
          title = tr.getElementsByTagName('td')[0].innerText;
          description = tr.getElementsByTagName('td')[1].innerText;
          //document.write(title, description);
          titleEdit.value = title;
          descriptionEdit.value = description;
          srNoEdit.value = e.target.id;
          //$('#editModal').modal('toggle')
          //document.write(e.target.id);
        })
      })
      
      
      deletes = document.getElementsByClassName('delete');
      Array.from(deletes).forEach((elements) => {
        elements.addEventListener('click',(e) => {
          //document.write('edit',e.target.parentNode.parentNode);
          tr = e.target.parentNode.parentNode;
          title = tr.getElementsByTagName('td')[0].innerText;
          description = tr.getElementsByTagName('td')[1].innerText;
          sno = e.target.id.substr(1,);
          if(confirm("are you sure You want to delete this Note?")){
            window.location = `/MyProjects/CRUD/index.php?delete=${sno}`;
          }
          else{
            alert("thank you!");
          }
        })
      })
    </script>
  
  </body>
</html>