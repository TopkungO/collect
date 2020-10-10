<?php
        include_once('functions.php');
        $updatedata=new DB_con();

        if(isset($_POST['update'])){
            $userid = $_GET['id'];
            $fname=$_POST['firstname'];
            $lname=$_POST['lastname'];
            $email=$_POST['email'];
            $phonenumber=$_POST['phonenumber'];
            $address=$_POST['address'];
            $sql=$updatedata->update($fname,$lname,$email,$phonenumber,$address,$userid);

            if($sql){
                echo "<script>alert('update Successfully');</script>";
                echo "<script>window.location.href='index.php'</script>";
            }else{
                echo "<script>alert('something went wrong! plese try again');</script>";
                echo "<script>window.location.href='update.php?id=$userid '</script>";
    
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
    <title>Edit</title>
</head>

<body>
    <div class="container">
        <h1 class="mt-3">Update</h1>

        <?php
        $userid = $_GET['id'];
        $updateuser = new DB_con();
        $sql = $updateuser->fetchonerecord($userid);
        while ($row = mysqli_fetch_array($sql)) {
        ?>

            <form action="" method="post">
                <div class="md-3">
                    <label for="firstname" class="form-label">Fist name</label>
                    <input type="text" class="form-control" name="firstname" required
                    value="<?php echo $row['firstname'];?>">
                </div>
                <div class="md-3">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="lastname" required
                    value="<?php echo $row['lastname'];?>">
                </div>
                <div class="md-3">
                    <label for="email" class="form-label">email</label>
                    <input type="email" class="form-control" name="email" required
                    value="<?php echo $row['email'];?>">
                </div>
                <div class="md-3">
                    <label for="phonenumber" class="form-label">phone</label>
                    <input type="text" class="form-control" name="phonenumber" required
                    value="<?php echo $row['phonenumber'];?>">
                </div>
                <div class="md-3">
                    <label for="address" class="form-label">address</label>
                    <textarea name="address" id="" cols="30" rows="5" class="form-control" required><?php echo $row['addreass'];?></textarea>
                </div>
                
                <?php } ?>
                
                <button type="submit" name="update" class="btn btn-success mt-3">Edit</button>
            </form>
    </div>
</body>

</html>