<?php 

    
    if(isset($_POST['submit_add'])){

        require 'dbh.php';

        $title        = mysqli_escape_string($conn,$_POST['title']);
        $durasi       = mysqli_escape_string($conn,$_POST['durasi']);
        $rating       = mysqli_escape_string($conn,$_POST['rating']);
        // parameter genre, writer, dan director
        $genre_check = mysqli_escape_string($conn,$_POST['genre_check']);
        $genre_new   = mysqli_escape_string($conn,$_POST['genre_new']);
        $writer_check = mysqli_escape_string($conn,$_POST['writer_check']);
        $writer_new   = mysqli_escape_string($conn,$_POST['writer_new']);
        $director_check = mysqli_escape_string($conn,$_POST['director_check']);
        $director_new   = mysqli_escape_string($conn,$_POST['director_new']);
        // photos parameter
        $photos      = mysqli_escape_string($conn,$_FILES['photos']['name']);
        $photos_size = mysqli_escape_string($conn,$_FILES['photos']['size']);
        $photos_tmp  = mysqli_escape_string($conn,$_FILES['photos']['tmp_name']);
        // deskripsi
        $deskripsi   = mysqli_escape_string($conn,$_POST['deskripsi']);
            
            //  CHECK JIKA ADA YANG INPUT LEBIH DARI 1 Nilai di bagian Radio
            if(!empty($genre_new) && !empty($genre_check) ){
                header("Location:../add_film.php?status=405");
            }

            if(!empty($writer_new) && !empty($writer_check)){
                header("Location:../add_film.php?status=406");
            }

            if(!empty($director_new) && !empty($director_check)){
                header("Location:../add_film.php?status=407");
            }

            // INSERT NEW GENRE FIRST
            if(!empty($genre_new) && empty($genre_check)){
                $genre_new = preg_replace('/\s+/', '_', $genre_new); # fungsi untuk mereplace spasi menjadi ' _ '
                $genre_id        = "SELECT * FROM genre";
                $result_id_genre = mysqli_query($conn, $genre_id);
                $ids_genre       = mysqli_num_rows($result_id_genre);
                $ids_genre += 1;
                $add_genre  = "INSERT INTO genre (id,name) values (?,?)";
                $stmt_genre = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt_genre, $add_genre)){
                    echo "MYSQL FAILED";
                }else{
                    mysqli_stmt_bind_param($stmt_genre,"is",$ids_genre,$genre_new);
                    mysqli_stmt_execute($stmt_genre);
                }
            }

            // INSERT NEW WRITER
            if(!empty($writer_new) && empty($writer_check)){
                $writer_new = preg_replace('/\s+/', '_', $writer_new); # fungsi untuk mereplace spasi menjadi ' _ '
                $writer_id        = "SELECT * FROM writer";
                $result_id_writer = mysqli_query($conn, $writer_id);
                $ids_writer       = mysqli_num_rows($result_id_writer);
                $ids_writer += 1;
                $add_writer  = "INSERT INTO writer (id,name) values (?,?)";
                $stmt_writer = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt_writer, $add_writer)){
                    echo "MYSQL FAILED";
                }else{
                    mysqli_stmt_bind_param($stmt_writer,"is",$ids_writer,$writer_new);
                    mysqli_stmt_execute($stmt_writer);
                }
            }

            // INSERT NEW DIRECTOR
            if(!empty($director_new) && empty($director_check)){
                $director_new = preg_replace('/\s+/', '_', $director_new); # fungsi untuk mereplace spasi menjadi ' _ '
                $director_id        = "SELECT * FROM director";
                $result_id_director = mysqli_query($conn, $director_id);
                $ids_director       = mysqli_num_rows($result_id_director);
                $ids_director += 1;
                $add_director  = "INSERT INTO director (id,name) values (?,?)";
                $stmt_director = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt_director, $add_director)){
                    echo "MYSQL FAILED";
                }else{
                    mysqli_stmt_bind_param($stmt_director,"is",$ids_director,$director_new);
                    mysqli_stmt_execute($stmt_director);
                }
            }


            // INSERT PHOTO
            if(!empty($photos_size)){
                $photos_dir = "../upload/".uniqid('', true);
                $photos_file = $photos_dir.basename($photos);
                $imageFileType = strtolower(pathinfo($photos_file,PATHINFO_EXTENSION));
                $extensions_arr = array("jpg","jpeg","png","gif");
                echo "passed 3 <br>"; 
                if( in_array($imageFileType,$extensions_arr) ){
                    $photos_base64 = file_get_contents($photos_tmp);                           
                    $add_film = "INSERT INTO film (title,durasi,id_genre,id_writer,id_director,photo,rating,deskripsi) VALUES (?,?,?,?,?,?,?,?);";
                    $stmt_film = mysqli_stmt_init($conn);
                    echo "passed 4 <br>"; 
                    if(!mysqli_stmt_prepare($stmt_film, $add_film)){
                        echo "MYSQL FAILED";
                    }else{
                        echo "passed 7 <br>";
                        if(!empty($genre_new) && !empty($writer_new) && !empty($director_new) ){
                            echo "passed 8 <br>";
                            mysqli_stmt_bind_param($stmt_film,"ssiiisss",$title,$durasi,$ids_genre,$ids_writer,$ids_director,$photos_base64,$rating,$deskripsi);
                            mysqli_stmt_execute($stmt_film); 
                            move_uploaded_file($_FILES['photos']['tmp_name'],$photos_dir.$photos);
                            header("Location:../add_film.php?status=success");

                        }else if(empty($genre_new) && empty($writer_new) && empty($director_new)){
                            mysqli_stmt_bind_param($stmt_film,"ssiiisss",$title,$durasi,$genre_check,$writer_check,$director_check,$photos_base64,$rating,$deskripsi);
                            mysqli_stmt_execute($stmt_film); 
                            move_uploaded_file($_FILES['photos']['tmp_name'],$photos_dir.$photos);
                            header("Location:../add_film.php?status=success");

                        }else if(!empty($genre_new) && empty($writer_new) && empty($director_new)){
                            mysqli_stmt_bind_param($stmt_film,"ssiiisss",$title,$durasi,$ids_genre,$writer_check,$director_check,$photos_base64,$rating,$deskripsi);
                            mysqli_stmt_execute($stmt_film); 
                            move_uploaded_file($_FILES['photos']['tmp_name'],$photos_dir.$photos);
                            header("Location:../add_film.php?status=success");

                        }else if(!empty($genre_new) && !empty($writer_new) && empty($director_new)){
                            mysqli_stmt_bind_param($stmt_film,"ssiiisss",$title,$durasi,$ids_genre,$ids_writer,$director_check,$photos_base64,$rating,$deskripsi);
                            mysqli_stmt_execute($stmt_film); 
                            move_uploaded_file($_FILES['photos']['tmp_name'],$photos_dir.$photos);
                            header("Location:../add_film.php?status=success");

                        }else if(!empty($genre_new) && empty($writer_new) && !empty($director_new)){
                            mysqli_stmt_bind_param($stmt_film,"ssiiisss",$title,$durasi,$ids_genre,$writer_check,$ids_director,$photos_base64,$rating,$deskripsi);
                            mysqli_stmt_execute($stmt_film); 
                            move_uploaded_file($_FILES['photos']['tmp_name'],$photos_dir.$photos);
                            header("Location:../add_film.php?status=success");
    
                        }else if(empty($genre_new) && !empty($writer_new) && !empty($director_new)){
                            mysqli_stmt_bind_param($stmt_film,"ssiiisss",$title,$durasi,$genre_check,$ids_writer,$ids_director,$photos_base64,$rating,$deskripsi);
                            mysqli_stmt_execute($stmt_film); 
                            move_uploaded_file($_FILES['photos']['tmp_name'],$photos_dir.$photos);
                            header("Location:../add_film.php?status=success");
    
                        }else if(empty($genre_new) && empty($writer_new) && !empty($director_new)){
                            mysqli_stmt_bind_param($stmt_film,"ssiiisss",$title,$durasi,$genre_check,$writer_check,$ids_director,$photos_base64,$rating,$deskripsi);
                            mysqli_stmt_execute($stmt_film); 
                            move_uploaded_file($_FILES['photos']['tmp_name'],$photos_dir.$photos);
                            header("Location:../add_film.php?status=success");
    
                        }else if(empty($genre_new) && !empty($writer_new) && empty($director_new)){
                            mysqli_stmt_bind_param($stmt_film,"ssiiisss",$title,$durasi,$genre_check,$ids_writer,$director_check,$photos_base64,$rating,$deskripsi);
                            mysqli_stmt_execute($stmt_film); 
                            move_uploaded_file($_FILES['photos']['tmp_name'],$photos_dir.$photos);
                            header("Location:../add_film.php?status=success");
    
                        }else{
                            echo "ERROR";
                        }
                        
                    }    
                }
            }
            
        } # END IF SUBMIT 
    
    // else{
    //     echo "passed 9 <br>";
    //     mysqli_stmt_bind_param($stmt_film,"ssiiisss",$title,$durasi,$genre_check,$writer_check,$director_check,$photos_base64,$rating,$deskripsi);
    //     mysqli_stmt_execute($stmt_film); 
    //     move_uploaded_file($_FILES['photos']['tmp_name'],$photos_dir.$photos);
    //     header("Location:../add_film.php?status=success");
    // }

?>