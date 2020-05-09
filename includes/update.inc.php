<?php 

    if(isset($_POST['submit_update'])){

        require 'dbh.php';

        $id          = mysqli_escape_string($conn,$_POST['id']);
        $title       = mysqli_escape_string($conn,$_POST['title']);
        $durasi      = mysqli_escape_string($conn,$_POST['durasi']);
        $rating      = mysqli_escape_string($conn,$_POST['rating']);

        $genre       = mysqli_escape_string($conn,$_POST['genre']);
        $writer      = mysqli_escape_string($conn,$_POST['writer']);
        $director    = mysqli_escape_string($conn,$_POST['director']);

        $gen         = mysqli_escape_string($conn,$_POST['gen']);
        $wri         = mysqli_escape_string($conn,$_POST['wri']);
        $dir         = mysqli_escape_string($conn,$_POST['dir']);


        $deskripsi   = mysqli_escape_string($conn,$_POST['deskripsi']);


        //  INSERT INTO FILM 
        $sql_film = "UPDATE film SET title=?,durasi=?,rating=?,deskripsi=? WHERE id=?;";
        $stmt_film = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt_film, $sql_film)){
            echo "MYSQL FAILED sql_film";
        }else{
            mysqli_stmt_bind_param($stmt_film,"ssssi",$title,$durasi,$rating,$deskripsi,$id);
            mysqli_stmt_execute($stmt_film); 
        }

        //  INSERT INTO GENRE
        $sql_genre = "UPDATE genre SET name=? WHERE id=?;";
        $stmt_genre = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt_genre, $sql_genre)){
            echo "MYSQL FAILED sql_genre";
        }else{
            mysqli_stmt_bind_param($stmt_genre,"si",$genre,$gen);
            mysqli_stmt_execute($stmt_genre); 
        }

        //  INSERT INTO WRITER
        $sql_writer = "UPDATE writer SET name=? WHERE id=?;";
        $stmt_writer = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt_writer, $sql_writer)){
            echo "MYSQL FAILED sql_writer";
        }else{
            mysqli_stmt_bind_param($stmt_writer,"si",$writer,$wri);
            mysqli_stmt_execute($stmt_writer); 
        }

        //  INSERT INTO DIRECTOR
        $sql_director = "UPDATE director SET name=? WHERE id=?;";
        $stmt_director = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt_director, $sql_director)){
            echo "MYSQL FAILED sql_director";
        }else{
            mysqli_stmt_bind_param($stmt_director,"si",$director,$dir);
            mysqli_stmt_execute($stmt_director); 
        }

        header("Location:../update.php?status=success");


    }else{
        echo "ERROR";
    }




?>