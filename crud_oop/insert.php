<?php
     include_once('functions.php');

     $insertdata=new DB_con();

     if(isset($_POST['insert'])){
        $fname=$_POST['firstname'];
        $lname=$_POST['lastname'];
        $email=$_POST['email'];
        $phonenumber=$_POST['phonenumber'];
        $address=$_POST['address'];

        $sql=$insertdata->insert($fname,$lname,$email,$phonenumber,$address);

        if($sql){
            echo "<script>alert('record insert Successfully');</script>";
            echo "<script>window.location.href='index.php'</script>";
        }else{
            echo "<script>alert('something went wrong! plese try again');</script>";
            echo "<script>window.location.href='insert.php'</script>";
        }
     }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>insert</title>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">insert Page</h1>
        <form action="" method="post">
            <div class="md-3">
                <label for="firstname" class="form-label">Fist name</label>
                <input type="text" class="form-control" name="firstname" required>
            </div>
            <div class="md-3">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" class="form-control" name="lastname" required>
            </div>
            <div class="md-3">
                <label for="email" class="form-label">email</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="md-3">
                <label for="phonenumber" class="form-label">phone</label>
                <input type="text" class="form-control" name="phonenumber" required>
            </div>
            <div class="md-3">
                <label for="address" class="form-label">address</label>
                <textarea name="address" id="" cols="30" rows="10" class="form-control" required></textarea>
            </div>
            <a href="index.php" class="btn btn-primary mr-1 mt-3">Black</a>
            <button type="submit" name="insert" class="btn btn-success mt-3">insert</button>
        </form>
    </div>
</body>
</html>