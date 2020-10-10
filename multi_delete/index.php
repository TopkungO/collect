<?php
    error_reporting(0);
    $con = mysqli_connect('localhost', 'root', '', 'crud_oop');
    if ($con) {
        // echo "connect success";
    } else {
        echo "Failed to connect" . mysqli_connect_error();
    }

    if (isset($_POST['delete'])) {
        
        if (count ($_POST['ids']) > 0) {
            $all = implode(",", $_POST['ids']);
            $sql = mysqli_query($con, "DELETE FROM mulit_delete WHERE id in ($all)");
            if ($sql) {
                echo "<script>alert('Data deleted successful');</script>";
            } else {
                echo "<script>alert('Something went wrong');</script>";
            }
        } else {
            $errmsg = "You need to select atleast one checkbox to delete";
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
    <title>Multi Delete</title>
</head>

<body>
    <div class="container">
        <form action="" method="post">
            <?php if (isset($errmsg)) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errmsg; ?>
                </div>
            <?php } ?>
            <table class="table table-striped">
                <tr>
                    <td colspan="4">
                        <input type="submit" name="delete" value="Delete" class="btn btn-danger" onClick="return confirm('are you sure you want to delete?');">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" class="form-check-input" id="select_all" name="">
                        <label for="" class="form-check-label">Select All</label>
                    </td>
                    <td>name</td>
                    <td>education</td>
                    <td>date</td>
                </tr>
                <tr>
                    <?php
                    $query = mysqli_query($con, "SELECT * FROM mulit_delete");
                    $totalcnt = mysqli_num_rows($query);
                    if ($totalcnt > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                <tr>
                    <td><input type="checkbox" class="checkbox" name="ids[]" value=<?php echo $row['id'] ?>></td>
                    <td><?php echo $row['fullname'] ?></td>
                    <td><?php echo $row['education'] ?></td>
                    <td><?php echo $row['postingDate'] ?></td>
                </tr>

            <?php
                        }
                    } else {
            ?>
            <tr>
                <td colspan="4">No record found</td>
            </tr>
        <?php } ?>
        </tr>
            </table>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            //เวลากด selectAll จะให้เลือกcheckbox ทั้งหมด
            $('#select_all').on('click', function() {
                if (this.checked) {
                    $('.checkbox').each(function() {
                        this.checked = true;
                    })
                } else {
                    $('.checkbox').each(function() {
                        this.checked = false;
                    })
                }
            })
            //เวลา ติ๊กcheckboxทั้งหมด แล้วจะให้SelectAllติ๊กถูกไปด้วย
            $('.checkbox').on('click', function() {
                if ($('.checkbox:checked').length == $('.checkbox').length) {
                    $('#select_all').prop('checked', true);
                } else {
                    $('#select_all').prop('checked', false);
                }
            })

        });
    </script>

</body>

<html>