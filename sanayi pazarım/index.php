<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Sanayi Pazarım</title>
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
  require_once "header.php";

  ?>





        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                  <!-- URUNLER-->
                  <?php
                  $sql = "SELECT products.*, productcategories.category FROM products, productcategories
                   WHERE productcategories.id = products.categoryId ";
                  $result = $conn->query($sql);

                  if(isset($result->num_rows))
                  {
                   if ($result->num_rows > 0)
                   {
                       while($row = $result->fetch_assoc())
                       {
                         $_urunId = $row["id"];
                         $_urunKategori = $row["category"];
                         $_urunResim = $row["productImage"];
                         $_urunAdi = $row["productName"];
                         $_urunAciklama =  $row["productDescription"];
                         $_urunSonTeklifZamani = $row["offerFinishedTime"];
                         $_renk='primary';
                         require 'urunGorunum.php';
                         //echo "id: " . $row["id"]. " - Name: " . $row["productName"]. " " . $row["categoryId"]. "";
                       }
                   } else
                   {
                       echo "SİSTEMDE HİÇ AKTİF TEKLİF BULUNMAMAKTADIR";
                   }
                 }else{
                    echo "SİSTEMDE HİÇ AKTİF TEKLİF BULUNMAMAKTADIR";
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
