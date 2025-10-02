<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>DASHBOARD - {{auth()->user()->username}}</title>
    
    <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico?v=1.0')}}">

    <link rel="stylesheet" href="{{asset('style.css?v=2')}}">
    <link rel="stylesheet" href="{{asset('style2.css?v=2')}}">
    <link rel="stylesheet" href="{{asset('style3.css?v=2')}}">
    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a59b9b09ab.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

  </head>
  <body style="padding-bottom: 80px">
    
@include('partials.navbar')


<div class="container">
    <h5 class="mt-5">Silahkan melakukan pembayaran ke salah satu rekening berikut :</h5>
    <table class="table table-bordered mt-4" style="border-width:8px;">
        <thead class="table-primary">
            <tr class="text-center">
                <th scope="col">Total Pembayaran</th>  
            </tr>
        </thead>
        <tbody>
            <tr class="text-center">
                <td>Rp. {{number_format($gtotal,0,',','.')}}</td>  
            </tr>
        </tbody>
    </table>
     
    <table class="table table-bordered mt-5" style="border-width:8px;">
        <thead class="table-success">
            <tr class="text-center">
                <th scope="col">Rekening BCA / Mandiri</th>  
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="mt-1" style="display: flex; justify-content: center;">
                        <div style="font-weight: 500; font-size: 18px; font-family: 'Open Sans', sans-serif;">A/n : CV. Duta Sarana Sejahtera</div>
                    </div>
                    <div class="mt-3" style="display: flex; justify-content: center; align-items: center; gap: 20px; margin-bottom: 10px;">
                        <div class="d-block text-center" style="background: #fff; padding: 10px; border-radius: 12px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                            <img src="{{asset('logo-bank/bca.png ')}}" alt="BCA" style="height: 30px;">
                            <div class="mt-1" style="font-weight: 300">No. Rek. : 1309 3988 99</div>
                        </div>
                        <div class="d-block text-center" style="background: #fff; padding: 10px; border-radius: 12px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                            <img src="{{asset('logo-bank/mandiri.png ')}}" alt="Mandiri" style="height: 30px;">
                            <div class="mt-1" style="font-weight: 300">No. Rek. : 1420 0667 288 99</div>
                        </div>
                    </div>
                </td>  
            </tr>
        </tbody>
    </table>

    <div class="text-center mt-4">
        <button id="konf-pembayaran" class="btn btn-warning btn-lg" style="font-weight: 300">Konfirmasi Pembayaran</button>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
    $('#konf-pembayaran').on('click', function() {
      window.location.href = '/manual-payment/konfirmasi-pembayaran';
    });
});
</script>
  </body>
</html>