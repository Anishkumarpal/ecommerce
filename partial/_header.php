<?php
session_start();

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="index.php"><img src="img/logo.png" width=50px"></img></a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact</a>
      </li>';
      
       
       

            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
              echo'<form class="form-inline my-2 my-lg-0 mx-10">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success mx-2" type="submit">Search</button>
              <p class="text-light my-0 mx-0">Welcome '.$_SESSION['useremail'].'</p>
              <a href="partial/_logout.php" class="btn btn-primary ml-2">Logout</a>
              </form>';
                      
            }
            else{
              echo'<form class="form-inline my-2 my-lg-0">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success mx-2" type="submit">Search</button>
              </form>
              <button class="btn btn-primary ml-2" data-bs-toggle="modal" data-bs-target="#loginmodal">Login</button>
              <button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#signupmodal">Signup</button>';
            }
        

 echo '</div>
</div> 
</nav>';

include 'partial/_loginmodal.php'; 
include 'partial/_signupmodal.php';
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']== "true"){
  echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Holy guacamole!</strong> You should check in on some of those fields below.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
?>
