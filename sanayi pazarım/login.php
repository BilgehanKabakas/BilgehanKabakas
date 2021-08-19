<?php
require_once "connection.php";

$postGiris = false;
$postKayit = false;
$hata = false;
$hataMesaj = "";
$kayitMesaj = "";

if(isset($_POST['mail']) && isset($_POST['sifre']))
{
  //GIRIS
  $mail = $_POST['mail'];
  $sifre = $_POST['sifre'];
  $postGiris = true;
  $postKayit = false;

  //echo "E-mail:".$mail." Sifre:".$sifre;

  $sqlKontrol = "SELECT * FROM users where mail='$mail' and sifre = '$sifre' LIMIT 1;";
  $resultKontrol = $conn->query($sqlKontrol);
  if ($resultKontrol->num_rows > 0)
  {
    while($row = $resultKontrol->fetch_assoc())
    {
      //print_r($row);
      //echo "<br><br><br>Verilen Teklif: ".$verilmisTeklif." Urun Id:".$_urunId;

      setcookie("userName",$row["ad_soyad"],time()+3600); /* 1 saat */
      setcookie("mail",$mail,time()+3600); /* 1 saat */
      setcookie("sifre",$sifre,time()+3600); /* 1 saat */

      header('Location: index.php');
    }
  }else
  {
    $hata = true;
    $hataMesaj = "Kullanıcı mail ya da şifre yanlış.";
  }

}else if(isset($_POST['name']) && isset($_POST['mail']) && isset($_POST['sifre1']) && isset($_POST['sifre2']))
{
  //KAYIT
  $name = $_POST['name'];
  $mail = $_POST['mail'];
  $sifre1 = $_POST['sifre1'];
  $sifre2 = $_POST['sifre2'];
  $postGiris = false;
  $postKayit = true;


  if($sifre1 == $sifre2)
  {
    if(strlen($sifre1) >= 6)
    {
      $sqlKayit= "INSERT INTO `bilge`.`users` (`mail`, `ad_soyad`, `sifre`) VALUES ('$mail', '$name', '$sifre1');";

      if ($conn->query($sqlKayit) === TRUE)
      {
        $kayitMesaj = "Kaydınız başarılı, giriş yapabilirsiniz...";

      } else {
        echo '<script>alert("İşleminiz yapılamadı daha sonra tekrar deneyiniz.")</script>';
      }
    }else {
      $kayitMesaj = "Şifre uzunluğu minimum 6 karakter olmalıdır !";
    }
  }else {
    $kayitMesaj = "Şifreler uyuşmuyor!!!";
  }



}




?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>giris</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/-Login-form-Page-BS4-.css">
    <link rel="stylesheet" href="assets/css/Minimal-tabs-1.css">
    <link rel="stylesheet" href="assets/css/Minimal-tabs.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row mh-100vh">
            <div class="col-10 col-sm-8 col-md-6 col-lg-6 offset-1 offset-sm-2 offset-md-3 offset-lg-0 align-self-center d-lg-flex align-items-lg-center align-self-lg-stretch bg-white p-5 rounded rounded-lg-0 my-5 my-lg-0" id="login-block">

                <div id="minimal-tabs">
                <h2 class="text-info font-weight-light mb-5"> <a href="index.php" style=" text-decoration: none;"> <i class="fa fa-diamond"></i>&nbsp; Sanayi Pazarım</a></h2>
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active" role="tab" data-toggle="tab" href="#tab-1">Giriş</a></li>
                        <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#tab-2">Kayıt</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" role="tabpanel" id="tab-1">
                            <div class="m-auto">
                                <form method="post" action="">
                                    <div class="form-group"><label class="text-secondary">Email</label><input name="mail" class="form-control" type="text" required="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,15}$" inputmode="email"></div>
                                    <div class="form-group"><label class="text-secondary">Password</label><input name="sifre" class="form-control" type="password" required=""></div><button class="btn btn-info mt-2" type="submit">Giriş Yap</button>
                              </form>
                            </div>
                            <br>
                            <div style="visibility: <?php if($hata) echo 'visible'; else echo 'hidden';  ?>;" class="alert alert-danger" role="alert">
                              <?php echo $hataMesaj ?>
                            </div>
                        </div>
                        <div class="tab-pane" role="tabpanel" id="tab-2">

                            <div class="m-auto">
                                  <form method="post" action="#tab-2">
                                    <div class="form-group"><label class="text-secondary">Ad Soyad</label><input name="name" class="form-control" type="text" required="" inputmode="text"></div>
                                    <div class="form-group"><label class="text-secondary">Email</label><input name="mail" class="form-control" type="text" required="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,15}$" inputmode="email"></div>
                                    <div class="form-group"><label class="text-secondary">Şifre</label><input name="sifre1" class="form-control" type="password" required=""><label class="text-secondary">Tekrar Şifre</label><input name="sifre2" class="form-control" type="password" required=""></div>
                                    <button class="btn btn-info mt-2" type="submit">Kayıt Ol</button>
                                  </form>
                            </div>


                        </div>
                        <br>
                        <div style="visibility: <?php if( !empty($kayitMesaj) ) echo 'visible'; else echo 'hidden';  ?>;" class="alert alert-danger" role="alert">
                          <?php echo $kayitMesaj ?>
                        </div>

                    </div>



                </div>
            </div>
            <div class="col-lg-6 d-flex align-items-end" id="bg-block" style="background-image:url(&quot;assets/img/aldain-austria-316143-unsplash.jpg&quot;);background-size:cover;background-position:center center;"></div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
