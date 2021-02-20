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
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `categories` WHERE cat_id= $id";
        $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){
            $catname = $row['cat_name'];
            $catdesc = $row['cat_description'];

           }
    ?>
     <?php
                $showAlert = false;
                $method = $_SERVER['REQUEST_METHOD'];
                if($method== 'POST'){
                    $th_title = $_POST['title'];
                    $th_desc = $_POST['desc'];
                    $sql ="INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestemp`) VALUES ( '$th_title', '$th_desc', '$id', '0', current_timestamp())";
                    $result = mysqli_query($conn, $sql);
                    $showAlert = true;
                    if($showAlert){
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Successfully!</strong> You are submited your comment plz wait for some time answer!!.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
                    }else{
                        echo '<div class="alert alert-denger alert-dismissible fade show" role="alert">
                        <strong>Ooh!!!</strong> Your comment are successfully submited please try again....
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
                    }
                }
           ?>

    <!--Categories container starts here-->
    <div class="container" my-4>
        <div class="jumbotron">
            <h1 class="display-4">welcome to <?php echo $catname; ?> Forum </h1>
            <p class="lead"> <?php echo $catdesc; ?> </p>
            <hr class="my-4">
            <p>This is peer to peer forum for sharung knowlege with each other</p>
            <a class="btn btn-primary btn-lg" href="threads.php" role="button">Learn more</a>
        </div>
    </div>
     
    <?php 
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
            echo '<div class="container">
                <h3 class="text-success">Ask answer and question</h3><br>
                <form action="'.$_SERVER['REQUEST_URI'].'" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Problem Title</label>
                        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">Keep your title as more questions.</div>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="desc" name="desc" style="height: 100px"></textarea>
                        <label for="floatingTextarea2">Elaborate your concern</label>
                    </div><br>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form><br><hr><br>
            </div>';
            }
            else{
                echo '<div class="container">
                <h3 class="text-success">Ask answer and question</h3><br>
                <p class="text-danger lead" role="alert">You are not a logged in. Please to able to start a comment..</p>
                      </div>';
            }

    ?>
        <div class="container">
        <?php   
                    $id = $_GET['catid'];
                    $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
                    $result = mysqli_query($conn, $sql);
                    $noResult = true;
                        while($row = mysqli_fetch_assoc($result)){
                        $noResult = false;        
                        $id = $row['thread_id'];
                        $desc = $row['thread_desc'];
                        $title = $row['thread_title'];
                        $thread_time = $row['timestemp'];
                        $thread_user_id = $row['thread_user_id'];

                        $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
                        $result2 = mysqli_query($conn, $sql2);
                        $row2 = mysqli_fetch_assoc($result2);
                        



                    
                 echo'  <div class="media border p-3 mb-3">
                            <img src="img/7.png" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:60px;">
                            <div class="media-body">
                                <p class= "font-weight-bold my-0">'.$thread_time.'</p>
                                <h5> Asked by: '. $row2['user_email'] .' at <small><i><a class="text-success" href="threads.php?threadid='.$id.'">'.$title.'</a></i></small></h5>
                                <p>'.$desc.'</p>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
        integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

</body>

</html>