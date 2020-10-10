<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>index_page</title>
</head>

<body>
    <div class="container">
        <h1 class="mt-5">infomation page</h1>
        <a href="insert.php" class="btn btn-success mb-2">Go to Insert</a>

        <table id=mytable class="table table-border table-striped">
            <thead>
                <th>#</th>
                <th>First name</th>
                <th>last name</th>
                <th>Email</th>
                <th>Phone number</th>
                <th>Address</th>
                <th>Poting Date</th>
                <th>Edit</th>
                <th>Delete</th>
            </thead>
            <tbody>
                <?php
                include_once('functions.php');
                $fetchdata = new DB_con();
                $sql = $fetchdata->fetchdata();
                while ($row = mysqli_fetch_array($sql)) {
                ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['firstname']; ?></td>
                        <td><?php echo $row['lastname']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['phonenumber']; ?></td>
                        <td><?php echo $row['addreass']; ?></td>
                        <td><?php echo $row['postingdate']; ?></td>
                        <td><a href="update.php?id=<?php echo $row['id'] ?>" class="btn btn-primary">Edit</a></td>
                        <td><a href="delete.php?del=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>