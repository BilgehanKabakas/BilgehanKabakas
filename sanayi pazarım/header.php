<!-- Header-->
<div class="" style="height:100px;">

</div>

<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Güncel Teklifler</h1>
            <p class="lead fw-normal text-white-50 mb-0">


              <?php

               if($giris)
               {
                 echo "Merhaba ".$username." hoş geldiniz :=)";
               }else
               {
                 echo "Teklif verebilmek icin sisteme kaydolmanız gerektiğinizi unutmayınız...";
               }

               ?>


            </p>
        </div>
    </div>
</header>
