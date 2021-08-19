<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Shop Item - Start Bootstrap Template</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Search.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>


    <?php
      require_once "connection.php";
      require_once "ustMenu.php";


    $verilmisTeklif = 0;
    $urunKategori = "BOŞ";
    $urunResim = "https://dummyimage.com/450x300/dee2e6/6c757d.jpg";
    $urunAdi = "BOŞ";
    $urunAciklama =  "BOŞ";
    $urunAciklama2 =  "BOŞ";
    $urunSonTeklifZamani = "BOŞ";
    $urunBasTeklifZamani = "BOŞ";
    $renk='dark';

    if(isset($_GET["urun_id"]))
      $_urunId = $_GET["urun_id"];
    else
      header("Location: index.php");


      if(isset($_POST['teklifMiktari']))
      {
        $gelenDeger = $_POST['teklifMiktari'];
        //echo "verilen teklif".$gelenDeger;

        $sqlTeklifVer = "INSERT INTO `bilge`.`offers` (`userId`, `productId`, `offerHead`, `offerValue`, `offerCreateTime`) VALUES (1, $_urunId, '$urunAdi', $gelenDeger, NOW())";

        if ($conn->query($sqlTeklifVer) === TRUE) {
          $verilmisTeklif = $gelenDeger;
        } else {
          echo '<script>alert("Teklifiniz alınamadı daha sonra tekrar deneyiniz.")</script>';
        }
      }





        if($giris)
        {
        $sqlUrunTeklif = "SELECT * from offers where offers.userId = 1 and offers.productId = $_urunId ORDER BY offers.offerCreateTime DESC LIMIT 1; ";
        $resultUrunTeklif = $conn->query($sqlUrunTeklif);
        if(isset($resultUrunTeklif->num_rows))
        {
          if ($resultUrunTeklif->num_rows > 0)
          {
            while($row = $resultUrunTeklif->fetch_assoc())
            {
              $verilmisTeklif = $row["offerValue"];
              //echo "<br><br><br>Verilen Teklif: ".$verilmisTeklif." Urun Id:".$_urunId;
            }
          }
        }
        }
        $sqlUrunBilgi = "SELECT products.*, productcategories.category FROM products, productcategories WHERE productcategories.id = products.categoryId and products.id = $_urunId; ";
        $resultUrunBilgi = $conn->query($sqlUrunBilgi);
        if(isset($resultUrunBilgi->num_rows))
        {
        if ($resultUrunBilgi->num_rows > 0)
        {
            // her bir satırı döker
            while($row = $resultUrunBilgi->fetch_assoc())
            {
                $urunKategori = $row["category"];
                $urunResim = $row["productImage"];
                $urunAdi = $row["productName"];
                $urunAciklama =  $row["productDescription"];
                $urunAciklama2 =  $row["productSubDescription"];
                $urunSonTeklifZamani = $row["offerFinishedTime"];
                $urunBasTeklifZamani = $row["offerCreateTime"];
                $renk='primary';
                //require 'urunGorunum.php';
                //echo "id: " . $row["id"]. " - Name: " . $row["productName"]. " " . $row["categoryId"]. "";
            }
          }else{
              echo "Sistemde böyle bir ürün bulunmamaktadır.";
          }
        }else{
           header("Location: index.php");
           //echo "HATA VAR: ".var_dump($result);
        }




     ?>

    <br><br><br>



        <!-- Product section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="<?php echo $urunResim ?>" alt="..."></div>
                    <div class="col-md-6">
                        <div class="small mb-1"><?php echo $urunBasTeklifZamani ?></div>

                        <?php
                        if($verilmisTeklif > 0 )
                        {
                            require_once 'teklifVerildiButon.php';


                        }
                         ?>

                        <h1 class="display-5 fw-bolder"><?php echo $urunAdi ?></h1>
                        <div class="fs-5 mb-5">
                            <span>Teklifin bitiş zamanı: <?php echo $urunSonTeklifZamani ?></span>
                        </div>

                        <p class="lead"><?php echo $urunAciklama ?></p>
                        <br>
                        <p  class="lead"><?php echo $urunAciklama2 ?></p>

                        <div  id ="teklif" class="">
                          <br>
                          <br>
                          <br>

                          <form  name="formTeklif" method="post" action="detay.php?urun_id=<?php echo $_urunId ?>" >
                            <div class="input-group" >
                              <input id="inputTeklif" style="border: 1px solid #dc3545;" name="teklifMiktari"  value="1" type="number" min="1" class="form-control" aria-label="">
                              <div  class="input-group-append"  >
                                <span  style="border: 1px solid #dc3545;" class=" input-group-text">₺</span>
                                <span style="border: 1px solid #dc3545;" class="input-group-text " data-toggle="tooltip" data-placement="top" title="Verilen Güncel Teklifiniz"><?php echo $verilmisTeklif; ?>.00</span>
                              </div>

                              <button onclick="document.getElementById('deger').innerHTML=document.getElementById('inputTeklif').value;" style="margin-left:10px;" data-toggle="modal" data-target="<?php if(!$giris) echo '#exampleModalGiris'; else echo '#exampleModal';?> " type="button" class="btn btn-outline-danger" >Teklif Ver</button>
                            </div>


                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalGiris" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog " role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Giriş Yapınız</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    Teklif verebilmek için giriş yapmanız gerekmektedir.
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <a href="login.php"><button type="button" class="btn btn-primary">Giriş Yap</button></a>
                                  </div>
                                </div>
                              </div>
                            </div>


                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Verdiğiniz Teklifi Onaylıyor musunuz?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="media">
                                      <div class="media-body">
                                        <h5 class="mt-0 mb-1"><?php echo $urunAdi ?></h5>
                                        <div class="small mb-1"><?php echo "Son teklif zamanı: ".$urunSonTeklifZamani ?></div>
                                      </div>
                                      <img src="<?php echo $urunResim ?>" class="ml-3" style="width:100px;" alt="...">
                                    </div>
                                  </div>
                                  <p class="p-1 mb-2 bg-danger text-white text-center" >Teklif: <b> <span id="deger"></span> TL </b></p>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                                    <button type="submit" class="btn btn-primary">Teklifi Onaylıyorum</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </form>


                        </div>

                    </div>
                </div>
            </div>
        </section>




        <!-- Related items section-->
        <section class="py-5 bg-light">
            <div class="container px-4 px-lg-5 mt-5">
                <h2 class="fw-bolder mb-4">Related products</h2>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">



                  <?php
                  $sqlDigerUrunler = "SELECT products.*, productcategories.category FROM products, productcategories
                          WHERE productcategories.id = products.categoryId LIMIT 4";
                  $resultDigerUrunler = $conn->query($sqlDigerUrunler);

                  if(isset($resultDigerUrunler->num_rows)){
                   if ($resultDigerUrunler->num_rows > 0){
                       while($row = $resultDigerUrunler->fetch_assoc()){
                         $_urunId = $row["id"];
                         $_urunKategori = $row["category"];
                         $_urunResim = $row["productImage"];
                         $_urunAdi = $row["productName"];
                         $_urunAciklama =  $row["productDescription"];
                         $_urunAciklama2 =  $row["productSubDescription"];
                         $_urunSonTeklifZamani = $row["offerFinishedTime"];
                         $_renk='primary';
                         require 'urunGorunum.php';
                         //echo "id: " . $row["id"]. " - Name: " . $row["productName"]. " " . $row["categoryId"]. "<br>";
                       }
                   } else{
                       echo "Sistemde ürün bulunmamaktadır.";
                   }
                 }else{
                    header("Location: index.php");
                 }
                  ?>

                </div>
            </div>
        </section>


        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright © Your Website 2021</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>
