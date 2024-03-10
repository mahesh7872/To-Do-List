<?php
$insert = false;
$Update = false;
$DELETE = false;

$server = "localhost";
$user = "root";
$password = "";
$db = "mahu_note";

$conn = mysqli_connect($server, $user, $password, $db);

if(!$conn){
    die(" Not Connected : " .mysqli_connect_error());
} else {
   // echo "Connection was Successfully";
}
  ########### Delete query ############
  if(isset($_GET['delete'])){
    $sno = $_GET['delete'];
    // echo $sno;
    $sql = "DELETE FROM `note_taker` WHERE `id` = $sno ";
    $result = mysqli_query($conn,$sql);
    if($result){
      // echo " delete the query";
      $DELETE = true;
    } else {
      echo "Not deleted";
    }
  }


if($_SERVER['REQUEST_METHOD'] == 'POST'){

  ########## Update Query ############

  if(isset($_POST['snoEdit'])){ 
    $sno = $_POST["snoEdit"];
    $titledit = $_POST["titleEdit"];
    $DESCedit = $_POST["descEdit"];
  
  $sql = "UPDATE  `note_taker` SET  `title` = '$titledit' , `description` = '$DESCedit' WHERE `note_taker`.`id` = '$sno' ";
  $result = mysqli_query($conn, $sql);
  // print_r($_POST);

  if($result){
    // echo "Inserted Successfully";
    $Update = true;
    // echo "Update the record successfully";
    } else {
      echo " Sorryyyyyyyyy to say Not Updated". mysqli_error($conn);
    }
    
  } else{
    ####### Add Query #########

  $title = $_POST["title"];
  $DESC = $_POST["desc"];

$sql = "INSERT INTO `note_taker`( `title`, `description`) VALUES ('$title' , '$DESC')";
$result = mysqli_query($conn, $sql);
if($result){
  // echo "Inserted Successfully";
  $insert = true;
  } else {
    echo "Not Inserted". mysqli_error($conn);
  }
}

}

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD OPERATION</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
     
  </head>

<body>
  <!-- Button Edit modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editNotes">
  Edit NOtes
</button> -->

<!-- Edit Modal -->
<div class="modal fade" id="editNotes" tabindex="-1" aria-labelledby="editNotesLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editNotesLabel">Edit Record </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!--Edit Modal Body -->
      <div class="madal-body">
      <form class="p-3" method="POST" action="">
      <input type="hidden" name="snoEdit" id="snoEdit">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label"><b>Title</b></label>
          <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp" required>
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text"><b>Text Note</b></span>
          <textarea class="form-control" name="descEdit" id="descEdit" aria-label="With textarea" required></textarea>
        </div>
      
      </div>
      <div class="modal-footer d-block mr-auto">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update Note</button>
        </div>
      </form>
    </div>
  </div>
</div>
  <nav class="navbar navbar-expand-lg bg-body-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img style="    height: 50px;width: 100%; background-size: cover;}" src="new-php-logo.svg" alt="php"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <?php
  if($Update){
    echo "
    <div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Updated! Successfully</strong> 
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";}
  if($insert){
    echo "
    <div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>success!</strong> Your data has been inserted successfully
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";}
  if($DELETE){
    echo "
    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
    <strong>success!</strong> Your data has been Deleted successfully
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";}
  ?>
    <div class="container p-3" style="background-color: lightgrey; border-radius: 8px;">
      <h2 class="text-center">Note Takeing App </h2>
      <form class="mt-3" method="POST" action="">
        
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label"><b>Title</b></label>
          <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" required>
        </div>
        <div class=" mb-3">
        <label for="exampleInputEmail1" class="form-label"><b>Text Note</b></label>
        
          <textarea class="form-control" name="desc" id="desc" aria-label="With textarea" required></textarea>
        </div>
        <button type="submit" id="style-button"   class="text-center btn btn-primary ">Add Note</button>
      </form>

    </div>
    <div class="container my-3">
     
      <table class = "table table-striped " id ="myTable">
  <thead>
    <tr>
      <th scope="col">Sr.no</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php
    
      $sql = "SELECT * FROM `note_taker`";
      $result = mysqli_query($conn,$sql);
      // $row = mysqli_fetch_assoc($result);
      $m = 0;
        while ($row = mysqli_fetch_assoc($result)){
            // echo $row['id'] . ".Title". $row['title'];
            $m = $m+1;
            echo "<tr>
            <th> " .$m." </th>
            <td>  " .$row['title']." </td>
            <td>  " .$row['description']." </td>
            <td> <button class=' delete btn btn-danger' id =d".$row['id']."> Delete </button> &nbsp;&nbsp;&nbsp;
                 <button class=' edit btn btn-primary' id =".$row['id']."> Edit </button>
            </td>
          </tr>";
        }
      
      ?>
    
  
  </tbody>
</table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
        <!-- <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script> -->
        <script>
         $(document).ready( function(){
        $('#myTable').DataTable();
        } );
        </script>
        <!-- <script>
          delete = document.getElementByClassName('delete');
          Arrray.from(deletes).forEach(element)=>{
            element.addEventListener("click",(e)=>{
              console.log("edit",);
              sno = e.target.id.substr(1,);
            })
          }
        </script> -->
        <script>
             deletes = document.getElementsByClassName('delete');
          Array.from(deletes).forEach((element)=>{
            element.addEventListener("click",(e)=>{
              console.log("delete", );

            sno = e.target.id.substr(1,);
           
            if(confirm("Are you sure want to delete this Record")){
              // console.log('Yes');
             // window.location = `/MACHIN-LEARNING/index.php?delete=${sno}`;
            } else {
              console.log("No Something id error");
            }
          })
          })
        </script>
        <script>
             edits = document.getElementsByClassName('edit');
          Array.from(edits).forEach((element)=>{
            element.addEventListener("click",(e)=>{
              console.log("edit", );
            
            tr = e.target.parentNode.parentNode;
            title = tr.getElementsByTagName("td")[0].innerText;
            description = tr.getElementsByTagName("td")[1].innerText;
            console.log(title, description);
            titleEdit.value = title;
            descEdit.value = description;
            snoEdit.value = e.target.id;
            console.log(e.target.id);
            $('#editNotes').modal('toggle');
          })
          })
        </script>
</body>

</html>