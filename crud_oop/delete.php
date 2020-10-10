<?php
    include_once('functions.php');
    if(isset($_GET['del'])){
        $userid=$_GET['del'];
        $deletedate=new DB_con();
        $sql=$deletedate->delete($userid);

        if($sql){
            echo "<script>alert('Record Delete Successfully');</script>";
            echo "<script>window.location.href='index.php'</script>";
        }
    }
?>