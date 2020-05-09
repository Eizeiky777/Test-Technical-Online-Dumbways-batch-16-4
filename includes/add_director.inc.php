<?php 

    if(isset($_POST['submit_add'])){

        require 'dbh.php';

        $director_name = mysqli_escape_string($conn,$_POST['director_name']);

        if(!empty($director_name)){
            $director_list = "SELECT * FROM director";
            $result_director = mysqli_query($conn, $director_list);
            $director_id = mysqli_num_rows($result_director) + 1;

                // INSERT NEW director
                $add_director = "INSERT INTO director (id,name) values (?, ?) ";
                $stmt_director = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt_director, $add_director)){
                    echo "MYSQL FAILED";
                }else{
                    mysqli_stmt_bind_param($stmt_director,"is",$director_id,$director_name);
                    mysqli_stmt_execute($stmt_director);
                    
                    echo "success";
                    header("Location:../add_director.php?successfully_added");
                }

        }else{
            header("Location:../add_director.php?error=tidak_ada_input");
        }
            

    }else{
        echo "ERROR";
    }




?>