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

    <div class="container mt-5">
        <div class="row">
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