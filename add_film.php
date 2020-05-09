<?php include 'includes/dbh.php'; ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <title>Index</title>
  </head>
  <body>
  
    <?php include 'navbar.php'; ?>

    <div class="text-center mt-5">
        <h1>Dumbways Movies XXI</h1>
        <div style="width: 500px; height: 5px; background-color: black; margin-left: auto; margin-right: auto;"></div>
    </div>


    <div class="container py-5">
            <div class="row mb-5">
                <div class="col-sm-12">
                    <h2 class="text-center">- Add New Film -</h2>
                    <hr>
                </div>  
            </div>

            <div class="row">
                <div class="col">
                    <?php 
                    if(isset($_GET['status'])){
                        if ($_GET['status'] == 404){
                            echo '<h5 class="text-center text-danger pb-5"> <small>---- *isi data dengan lengkap ya ^^v ----</small> </h5>';
                        }elseif($_GET['status'] == 405){
                            echo '<h5 class="text-center text-danger pb-5"> <small>---- *untuk genre check hanya boleh diisi satu jenis saja ^^v ----</small> </h5>';
                        }elseif($_GET['status'] == 406){
                            echo '<h5 class="text-center text-danger pb-5"> <small>---- *untuk writer check hanya boleh diisi satu jenis saja ^^v ----</small> </h5>';
                        }elseif($_GET['status'] == 407){
                            echo '<h5 class="text-center text-danger pb-5"> <small>---- *untuk director check hanya boleh diisi satu jenis saja ^^v ----</small> </h5>';
                        }
                    }
                    ?>
                </div>
            </div>

            <!-- ADD NEW FILM -->
            <div class="row">
                <div class="col-sm-4 ">
                    <form action="includes/add_film.inc.php" method="POST" enctype="multipart/form-data" style="padding: 10px; border: 1px solid #2d7a8a; width: 420px; height: 100%;">
                        <div class="form-group row">
                            <label for="inputNama" class="col-sm-4 col-form-label">Title</label>
                            <div class="col-sm">
                            <input type="text" name="title" class="form-control" id="inputNama" placeholder="Title Film">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputdurasi" class="col-sm-4 col-form-label">Durasi</label>
                            <div class="col-sm">
                            <input type="text" name="durasi" class="form-control" id="inputdurasi" placeholder="Durasi Film">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputrating" class="col-sm-4 col-form-label">Rating</label>
                            <div class="col-sm">
                            <input type="text" name="rating" class="form-control" id="inputrating" placeholder="Rating Film IMDb">
                            </div>
                        </div>

                        <!-- iNPUT GENRE WRITER DIRECTOR -->
                        <fieldset class="form-group pb-3">
                            <div class="row">
                            <legend class="col-form-label col-sm-4 pt-0">Genre</legend>
                            <div class="col-sm">
                                <?php 
                                    $sql_genre = "SELECT * FROM genre"; 
                                    $result_genre = mysqli_query($conn, $sql_genre);
                                    if(mysqli_num_rows($result_genre) > 0){
                                        while($row_genre = mysqli_fetch_assoc($result_genre)){
                                ?>
                                <div class="form-check">
                                    <input class="form-check-input" value=<?php echo '"'.$row_genre['id'].'"';?> type="radio" name="genre_check" id=<?php echo '"gen'.$row_genre['id'].'"';?> >
                                    <label class="form-check-label" for=<?php echo '"gen'.$row_genre['id'].'"';?>>
                                        <?php echo $row_genre['name']; ?>
                                    </label>
                                </div>
                                <?php }} ?>                
                                <div class="form-check ">
                                    <input class="form-check-input rounded pl-2" type="text" name="genre_new" id="gridRadios1" placeholder="input genre baru">
                                    <label class="form-check-label pr-2" for="gridRadios1">
                                        hidden label ^^v
                                    </label>
                                </div>
                            </div>
                            </div>
                        </fieldset>

                        <fieldset class="form-group  pb-3">
                            <div class="row">
                            <legend class="col-form-label col-sm-4 pt-0">Writer</legend>
                            <div class="col-sm">
                                <?php 
                                    $sql_writer = "SELECT * FROM writer"; 
                                    $result_writer = mysqli_query($conn, $sql_writer);
                                    if(mysqli_num_rows($result_writer) > 0){
                                        while($row_writer = mysqli_fetch_assoc($result_writer)){
                                ?>
                                <div class="form-check">
                                    <input class="form-check-input" value=<?php echo '"'.$row_writer['id'].'"';?> type="radio" name="writer_check" id=<?php echo '"writer'.$row_writer['id'].'"';?> >
                                    <label class="form-check-label" for=<?php echo '"writer'.$row_writer['id'].'"';?>>
                                        <?php echo $row_writer['name']; ?>
                                    </label>
                                </div>
                                <?php }} ?>                
                                <div class="form-check ">
                                    <input class="form-check-input rounded pl-2" type="text" name="writer_new" id="gridRadios2" placeholder="input writer baru">
                                    <label class="form-check-label pr-2" for="gridRadios2">
                                        hidden label ^^v
                                    </label>
                                </div>
                            </div>
                            </div>
                        </fieldset>

                        <fieldset class="form-group  pb-3">
                            <div class="row">
                            <legend class="col-form-label col-sm-4 pt-0">Director</legend>
                            <div class="col-sm">
                                <?php 
                                    $sql_director = "SELECT * FROM director"; 
                                    $result_director = mysqli_query($conn, $sql_director);
                                    if(mysqli_num_rows($result_director) > 0){
                                        while($row_director = mysqli_fetch_assoc($result_director)){
                                ?>
                                <div class="form-check">
                                    <input class="form-check-input" value=<?php echo '"'.$row_director['id'].'"';?> type="radio" name="director_check" id=<?php echo '"dir'.$row_director['id'].'"';?> >
                                    <label class="form-check-label" for=<?php echo '"dir'.$row_director['id'].'"';?>>
                                        <?php echo $row_director['name']; ?>
                                    </label>
                                </div>
                                <?php }} ?>                
                                <div class="form-check ">
                                    <input class="form-check-input rounded pl-2" type="text" name="director_new" id="gridRadios3" placeholder="input director baru">
                                    <label class="form-check-label pr-2" for="gridRadios3">
                                        hidden label ^^v
                                    </label>
                                </div>
                            </div>
                            </div>
                        </fieldset>

                        <!-- END iNPUT GENRE WRITER DIRECTOR -->
                        <div class="form-group row">
                            <div class="col-sm-4 pt-2">Upload Foto</div>
                            <div class="col-sm">
                                <div class="form-check pt-1">
                                    <input class="form-check-input" type="file" id="gridCheck1" name="photos">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm pt-4">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Deskripsi :</label>
                                    <textarea class="form-control" name="deskripsi" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-sm">
                            <button type="submit" name="submit_add" class="btn btn-primary">Add New Film List  </button>
                            </div>
                        </div>
                    </form>
                
                </div>
            </div>
            <!-- END ADD NEW FILM-->

    <div class="container mt-5">
        <div class="row text-center">
            <div class="col-sm-6">

                <?php 
                    $filter_genre = "select * from genre";
                    $result_genre = mysqli_query($conn, $filter_genre);
                    if(mysqli_num_rows($result_genre) > 0){
                    while($row_list_genre = mysqli_fetch_assoc($result_genre)){
                ?>
                    <!--  FUNGSI FILTER GAMBAR BERDASARKAN GENRE -->
                    <a class="btn btn-primary text-white" onclick=filterTable(<?php echo '"'.$row_list_genre['id'].'"';?>)>
                        <?php echo $row_list_genre['name']; ?>
                    </a> 

                <?php }} ?>
            </div>
            <div class="col-sm-6 text-right mt-2">
                <a href="add_genre.php" class="btn btn-primary">Add Genre</a>
                <a href="add_writer.php" class="btn btn-primary text-white">Add Writer</a>
                <a href="add_director.php" class="btn btn-primary text-white">Add Director</a>
                <a href="add_film.php" class="btn btn-primary text-white">Add Film</a>
                <a href="update.php" class="btn btn-warning font-weight-bold mt-1">Update Informasi Film</a>
                <a href="delete.php" class="btn btn-danger text-white mt-1 ">Delete Film</a>
            </div>
        </div>
    </div>

    <div class="container mt-5 mb-5">
        <div class="row text-center">

            <?php 
                $gmb = "SELECT * FROM film";
                $result_gmb = mysqli_query($conn, $gmb);
                $index = 0;
                if(mysqli_num_rows($result_gmb) > 0){
                while($row_list_gmb = mysqli_fetch_assoc($result_gmb)){
                    
            ?>            

            <div class=<?php echo '"col-sm-3 mb-5 gmb '.$row_list_gmb['id_genre'].'"';?>>
                <div class="gmb_center">
                    <img src=<?php echo '"data:image;base64,'.base64_encode($row_list_gmb['photo']).'"'; ?> 
                    class="movie_poster" 
                    data-title=<?php echo '"'. $row_list_gmb['title']. '"'; ?> 
                    data-durasi=<?php echo '"'. $row_list_gmb['durasi']. '"'; ?> 
                    data-deskripsi=<?php echo '"'. $row_list_gmb['deskripsi']. '"'; ?> 
                    >
                    <div class="text-center mb-4">
                        <span class="bg-warning border rounded  p-2 mt-1 font-weight-bold" style="width: 100px ">
                            <?php echo $row_list_gmb['rating']; ?>
                        </span>
                    </div>         
                    <h4 class="text-center mb-4 "><?php echo $row_list_gmb['title']; ?></h4>
                    <div class="text-center">
                    <button class="btn btn-success" onclick=onDetails(<?php echo $index++;?>)>Detail</button>
                    </div>
                </div>
            </div>

            <?php }} ?>        

        </div>
    </div>


    <!-- OVERLAY  -->
    <div class="image-popup"></div>
    <!-- END OF OVERLAY  -->      

    
    <!-- Optional JavaScript -->
    <script>

    /////////////////////////////////////////////////////////////
    //  <!--  FUNGSI FILTER GAMBAR BERDASARKAN GENRE -->
    function filterTable(x) {

    var gmb = document.getElementsByClassName("gmb");
    for (var i=0; i < gmb.length; i++ ){
        gmb[i].style.display = "none";
    }
    var img = document.getElementsByClassName(x);
    for (var i=0; i < img.length; i++ ){
        img[i].style.display = "block";
    }

    }
    ////////////////////////////////////////////////////////////

// Fungsi Ondetails yang ada pada tombol details
    function onDetails(d){
        let image_popup2 = document.querySelector('.image-popup');

        let img_meta = document.querySelectorAll('.gmb .gmb_center img')[d];
        let img = new Image();
        img.onload = () => {

            image_popup2.innerHTML = ` 
                <div class="con">
                    <div class='text-center mb-5 mt-5'>
                        <img src="${img.src}" width="${img.width}" height="${img.height}">
                    </div>
                    <h3 class='mb-3 font-weight-bold'>- ${img_meta.dataset.title} - </h3>
                    <p class='text-danger font-weight-bold'>durasi film : ${img_meta.dataset.durasi}</p>
                    <div style='width: 400px;'>
                        <p>${img_meta.dataset.deskripsi}</p>
                    <div>
                </div>
            `;
            image_popup2.style.display = 'flex';
        };

        img.src = img_meta.src; 
        img.width = "255";
        img.height = "355";
    } 
// END CONTAINER gambar yang diubah jadi fungsi onclick masing2

// ---------------------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------------------

    // Hide klik
    let image_popup = document.querySelector('.image-popup');
    image_popup.onclick = e => {
        if (e.target.className == 'image-popup') {
            image_popup.style.display = "none";
        }
    };
    // END Hide 



    </script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>