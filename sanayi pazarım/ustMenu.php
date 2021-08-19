<?php

session_start();

$giris = false;
$mail = "";
$sifre = "";
$username = "";


if(isset($_GET['islem']))
{
  switch ($_GET['islem'])
  {
    case 'cikis':
      setcookie("userName","",time()-3600); /* 1 saat */
      setcookie("mail","",time()-3600); /* 1 saat */
      setcookie("sifre","",time()-3600); /* 1 saat */
      header('Location: index.php');
      break;

    default:
      // code...
      break;
  }



}





if(isset($_COOKIE["mail"]) && isset($_COOKIE["userName"]) && isset($_COOKIE["sifre"]) )
{
   //echo '<script>alert("HEPSI VAR")</script>';

   $mail = $_COOKIE['mail'];
   $sifre = $_COOKIE['sifre'];
   $username = $_COOKIE["userName"];

   $sqlKontrol = "SELECT * FROM users where mail='$mail' and sifre = '$sifre' LIMIT 1;";
   $resultKontrol = $conn->query($sqlKontrol);
   if ($resultKontrol->num_rows > 0)
   {
     while($row = $resultKontrol->fetch_assoc())
     {
        $giris = true;
     }
   }else
   {
     $giris = false;
   }


}else {
   //echo '<script>alert("HEPSI YOK")</script>';

   $giris = false;
}




 ?>




<!-- UST MENU -->
        <nav class="navbar fixed-top  navbar-expand-lg navbar-light bg-info ">
            <div class="container px-4 px-lg-5">
              <a class="navbar-brand" href="index.php"><b>Sanayi Pazarım</b></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Ana Sayfa</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">Hakkımda</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">İletişim</a></li>

                        <form class="form-inline mr-auto" target="_self" style="margin-left:20px; ">
                            <div class="form-group"><input class="form-control search-field" type="search" placeholder="Search" id="search-field" name="search"><label for="search-field" style="margin-left:10px;"><i class="fa fa-search" ></i></label></div>
                        </form>

                        <li class="nav-item" style="margin-left:12px; margin-top:5px;">
                          <select class="custom-select custom-select-sm" aria-label=".form-select-sm example">
                            <option selected value="0">Tüm Kategoriler</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                          </select>
                        </li>

                    </ul>

                    <form class="d-flex">



                        <button style="visibility: <?php if($giris) echo 'visible'; else echo 'hidden';  ?>;" class="btn btn-danger" type="submit" style="margin-right:5px;">
                            <i class="bi-cart-fill me-1"></i>
                            Tekliflerim
                            <span class="badge bg-warning text-white ms-1 rounded-pill">0</span>
                        </button>

                        <div class="btn-group">
                          <button style="visibility: <?php if($giris) echo 'visible'; else echo 'hidden';  ?>;" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            HESABIM
                          </button>

                          <a href="login.php">
                          <button style="visibility: <?php if(!$giris) echo 'visible'; else echo 'hidden';  ?>;" type="button" class="btn btn-primary">
                            GİRİŞ YAP
                          </button>
                          </a>

                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Bilgilerim</a></li>
                            <li><a class="dropdown-item" href="#">Şifre Değiştir</a></li>
                            <li><a class="dropdown-item" href="#">Tekliflerim</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="index.php?islem=cikis">Çıkış Yap</a></li>
                          </ul>
                        </div>

                    </form>

                </div>
            </div>
        </nav>
