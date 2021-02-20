<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>Hello, world!</title>
</head>

<body>
    <?php include 'partial/_header.php'; ?>
    <?php include 'partial/_dbconnect.php'; ?>

    <?php   
         $id = $_GET['threadid'];
         $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
         $result = mysqli_query($conn, $sql);
         $noResult = true;
             while($row = mysqli_fetch_assoc($result)){
             $noResult = false;
             //$id = $row['thread_id'];
             $desc = $row['thread_desc'];
             $title = $row['thread_title'];

           }

           if($noResult){
            echo '
            <div class= "jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">No threads found!!! </h1>
                    <p class="lead"> Be the first person to ask a question</p>
                </div>

            </div>';
        }  
    ?>

     <!--Categories container starts here-->
     <div class="container" my-4>
        <div class="jumbotron">
            <h1 class="display-4">welcome to <?php echo $title; ?> Forum </h1>
            <p class="lead"> <?php echo $desc; ?> </p>
            <hr class="my-4">
            <p>This is peer to peer forum for sharung knowlege with each other</p>
            <p><i><b>Posted by Anish kumar pal<b></i></p>
        </div>
    </div>


<!------->

<?php
                $showAlert = false;
                $method = $_SERVER['REQUEST_METHOD'];
                if($method== 'POST'){
                    $comment = $_POST['comment'];
                   
                    $sql ="INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_time`, `comment_by`) VALUES ('$comment', '$id', current_timestamp(), '0')";
                    $result = mysqli_query($conn, $sql);
                    $showAlert = true;
                    if($showAlert){
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Successfully!</strong> Your comment has been added!!!.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
                    }
                }
           ?>


<!---->
<?php 
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
            echo '<div class="container">
                <h3>Ask answer and question</h3><br>
                <form action="'.$_SERVER['REQUEST_URI'] .'" method="POST">     
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="comment" name="comment" style="height: 100px"></textarea>
                        <label for="floatingTextarea2">please write your comment</label>
                    </div><br>
                    <button type="submit" class="btn btn-primary">Post comment</button>
                </form>
            </div>';
        }
        else{
            echo '<div class="container">
            <h3> Start a Discussion</h3><br>
            <p class="text-danger lead" role="alert">You are not a logged in. Please to able to start a Discussion..</p>
      </div>';
        }
    ?>   

</div>

    <div class="container">
                <h3 class="text-success">Asked Question and Answer</d3>           
    </div>
    <div class="container">
                        <?php if($noResult){
                            echo '
                            <div class= "jumbotron jumbotron-fluid">
                                <div class="container">
                                    <h1 class="display-4">No threads found!!! </h1>
                                    <p class="lead"> Be the first person to ask a question</p>
                                </div>

                            </div>';
                        }  
                        ?>        
    </div>








    <!------->
    <div class="container">
        <?php   
                    $id = $_GET['threadid'];
                    $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
                    $result = mysqli_query($conn, $sql);
                    $noResult = true;
                        while($row = mysqli_fetch_assoc($result)){
                        $noResult = false;        
                        $id = $row['comment_id'];
                        $content = $row['comment_content'];
                        $comment_time = $row['comment_time'];
                        $thread_user_id = $row['comment_by'];

                        $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
                        $result2 = mysqli_query($conn, $sql2);
                        $row2 = mysqli_fetch_assoc($result2);
                        
                       // $title = $row['comment_title'];

                    
                 echo  '<div class="media border p-3 mb-3">
                            <img src="img/7.png" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:60px;">
                            <div class="media-body">
                                <h5>'. $row2['user_email'] .',  At '.$comment_time.'</h5>
                                <p>'.$content.'</p>
                            </div>
                        </div>';
                        }   
                        //echo $noResult; 
                        if($noResult){
                            echo '
                            <div class= "jumbotron jumbotron-fluid">
                                <div class="container">
                                    <h1 class="display-4">No threads found!!! </h1>
                                    <p class="lead"> Be the first person to ask a question</p>
                                </div>

                            </div>';
                        }
                ?>


    </div>






    <?php include 'partial/_fotter.php'; ?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

</body>

</html>