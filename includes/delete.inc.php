<?php 

    if(isset($_GET['ids'])){

        require 'dbh.php';

        $ids = $_GET['ids'];
        $sql_delete = "DELETE FROM film WHERE id=$ids";
        mysqli_query($conn, $sql_delete);

        header("Location:../delete.php?delete_successfully");
    }else{
        echo "ERROR";
    }




?>