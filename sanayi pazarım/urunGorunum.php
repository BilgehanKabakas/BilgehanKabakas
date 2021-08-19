<?php

  if(!isset($_renk)) $_renk = "danger";
  if(!isset($_urunAdi)) $_urunAdi = "BOŞ";
  if(!isset($_urunAciklama)) $_urunAciklama = "BOŞ";
  if(!isset($_urunResim)) $_urunResim = "https://dummyimage.com/450x300/dee2e6/6c757d.jpg";
  if(!isset($_urunKategori)) $_urunKategori = "";
  if(!isset($_urunSonTeklifZamani)) $_urunSonTeklifZamani = "";
  if(!isset($_urunId)) $_urunId = "";
?>

<div class="col mb-5">
    <div class="card h-100">
      <!-- Sale badge-->
      <a href="#"><div class="badge bg-<?php echo "$_renk"; ?> text-white position-absolute" style="top: 0.5rem; right: 0.5rem"><?php echo $_urunKategori  ?></div></a>
        <!-- Product image-->
        <img class="card-img-top" src="<?php echo $_urunResim ?>" alt="...">
        <!-- Product details-->
        <div class="card-body p-4">
            <div class="text-center">
                <!-- Product name-->
                <h5 class="fw-bolder"><?php echo $_urunAdi ?></h5>
                <!-- Product price-->
              </br><p class="card-text"><?php echo $_urunAciklama ?></p>
            </div>
        </div>
        <!-- Product actions-->
        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="detay.php?urun_id=<?php echo $_urunId ?>">İncele</a></div>
        </div>
        <span class="badge badge-<?php echo "$_renk"; ?>"><?php echo $_urunSonTeklifZamani ?></span>
    </div>
</div>
