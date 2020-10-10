<?php
 include_once('function.php');

 if(isset($_POST['submit'])){
    $cont =count($_POST['skill']);
    $skill=$_POST['skill'];

    if($cont>=1){
        for($i=0;$i< $cont;$i++){
            if(trim($_POST['skill'][$i]) !=''){
                $sql=mysqli_query($dbcon,"INSERT INTO tblskill(skill) VALUES('$skill[$i]')");
            }

        }
        $cont=0;
        echo "<script>alert('skill insert successfully')</script>";
    }else{
        echo "<script>alert('Plese Enter your Skill!!!')</script>";
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
    <title>Dynamic Add Delete</title>
</head>

<body>
    <div class="container mt-3">
        <div class="display-3">Dynamic Add/delete</div>
        <form action="" name="add_name" id="add_name" method="post">
            <div class="table-responsive">
                <table class="table table-bordered" id="dynamic_field">
                    <tr>
                        <td>
                            <input type="text" name="skill[]" placeholder="Enter you skill" class="form-control name_list">

                        </td>
                        <td>
                            <button type="button" name="add" id="add"class="btn btn-success">add Move</button>
                        </td>
                    </tr>
                </table>
                <input type="submit" name="submit" id="submit" class="btn btn-info" value="submit">
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function(){
            let i = 1;
            $('#add').click(function() {
                i++; 
                $('#dynamic_field').append('<tr id="row' + i + '"><td><input type="text" name="skill[]" placeholder="Enter you skill" class="form-control name_list"></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>')
            });

            $(document).on('click','.btn_remove',function(){
                let button_id=$(this).attr('id');
                $('#row'+button_id+'').remove();
            })

        });
    </script>
</body>

</html>