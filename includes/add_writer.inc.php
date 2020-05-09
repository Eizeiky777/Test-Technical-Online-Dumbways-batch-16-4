<?php 

    if(isset($_POST['submit_add'])){

        require 'dbh.php';

        $writer_name = mysqli_escape_string($conn,$_POST['writer_name']);

        if(!empty($writer_name)){
            $writer_list = "SELECT * FROM writer";
            $result_writer = mysqli_query($conn, $writer_list);
            $writer_id = mysqli_num_rows($result_writer) + 1;

                // INSERT NEW WRITER
                $add_writer = "INSERT INTO writer (id,name) values (?, ?) ";
                $stmt_writer = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt_writer, $add_writer)){
                    echo "MYSQL FAILED";
                }else{
                    mysqli_stmt_bind_param($stmt_writer,"is",$writer_id,$writer_name);
                    mysqli_stmt_execute($stmt_writer);
                    
                    echo "success";
                    header("Location:../add_writer.php?successfully_added");
                }

        }else{
            header("Location:../add_writer.php?error=tidak_ada_input");
        }
            

    }else{
        echo "ERROR";
    }




?>