<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Statistik</title>

    <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico?v=1.0')}}">

    <link rel="stylesheet" href="{{asset('style.css?v=2')}}">
    <link rel="stylesheet" href="{{asset('style2.css?v=2')}}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">

    <style>
        h1 {
            font-size: 24px;
            font-weight: bold;
        }

        .icon-menu {
          width: 40px;  /* Sesuaikan dengan ukuran ikon sebelumnya */
          height: 40px;
          margin-bottom: 6px;
          cursor: pointer;  /* Agar tetap bisa diklik */
      }
      
      </style>
</head>
<body>

    <div class="sidebar" id="sidebar">
        <div style="margin-top: 10vh; margin-left: 2vh; font-size: 23px; font-weight: 600">
            <i class="fas fa-user"></i>&nbsp;&nbsp;Admin {{auth()->user()->username}}
        </div>
        <ul>

            <li id="home"><i class="fas fa-home"></i>&nbsp;&nbsp;HOME</li>
            <li id="pesanan"><i class="fas fa-clipboard-list"></i>&nbsp;&nbsp;PESANAN</li>
            <li style="background: rgba(255, 255, 255, 0.4); cursor: default"><i class="far fa-chart-bar"></i>&nbsp;&nbsp;STATISTIK</li>
            <li>
                <form action="/logout" method="post">
                    @csrf
                    <button style="border: none; background: none; color: inherit" type="submit">
                        <i class="fas fa-power-off"></i>&nbsp;&nbsp;LOG OUT
                    </button>
                </form>
            </li>
        </ul>
    </div>
    <div class="nav-admin">
        <span class="toggle-btn"><img src="jempol.png" class="icon-menu">
          <span id="sembunyikan-menu" style="font-size: 20px">< Sembunyikan Menu</span>
          <span id="tampilkan-menu" style="font-size: 20px">Tampilkan Menu ></span>
        </span>
        <span style="font-size: 22px; font-weight: 500">Admin Panel (Data Stok, List Order & More)</span>
    </div>
    <div class="content" id="content">
        <h1>Grafik Visitor Web Harian</h1>
        <canvas class="mt-4" id="visitorChart"></canvas>
    </div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $('#tampilkan-menu').hide();

        if (localStorage.getItem('showSuccess')) {
            // Jalankan efek slideDown
            $('#sukses').slideDown(150);

            // Hapus status dari localStorage agar tidak terus berulang
            localStorage.removeItem('showSuccess');

            // Sembunyikan elemen setelah beberapa detik
            setTimeout(function() {
                $('#sukses').slideUp();
            }, 6000);
        }

        $('#home').on('click', function() {
            window.location.href = '/admin';
        });

        $('#pesanan').on('click', function() {
            window.location.href = '/pesanan';
        });

        $('.toggle-btn').on('click', function() {
        if ($('#sidebar').hasClass('hide')) {
            $('#sidebar').removeClass('hide');
            $('#content').removeClass('full');
            $('#sembunyikan-menu').show();
            $('#tampilkan-menu').hide();
        } else {
            $('#sidebar').addClass('hide');
            $('#content').addClass('full');
            $('#sembunyikan-menu').hide();
            $('#tampilkan-menu').show();
        }
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('visitorChart').getContext('2d');
    const visitorData = @json($visitors);

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: visitorData.map(v => v.date),
            datasets: [{
                label: 'Visitors per Day',
                data: visitorData.map(v => v.count),
                borderColor: 'blue',
                fill: false
            }]
        }
    });
</script>
</body>
</html>