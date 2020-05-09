<?php 

    if(isset($_POST['submit_add'])){

        require 'dbh.php';

        $genre_name = mysqli_escape_string($conn,$_POST['genre_name']);

        if(!empty($genre_name)){
            $genre_name_list = "SELECT * FROM genre";
            $result_name = mysqli_query($conn, $genre_name_list);
            $genre_id = mysqli_num_rows($result_name) + 1;

                // INSERT NEW GENRE
                $add_genre = "INSERT INTO genre (id,name) values (?, ?) ";
                $stmt_genre = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt_genre, $add_genre)){
                    echo "MYSQL FAILED";
                }else{
                    mysqli_stmt_bind_param($stmt_genre,"is",$genre_id,$genre_name);
                    mysqli_stmt_execute($stmt_genre);
                    
                    echo "success";
                    header("Location:../add_genre.php?successfully_added");
                }

        }else{
            header("Location:../add_genre.php?error=tidak_ada_input");
        }
            

    }else{
        echo "ERROR";
    }




?>