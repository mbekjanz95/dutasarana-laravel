<nav id="nav1" class="d-flex scrolling-text">
  
  <div id="pusat">** Pusat Belanja Komputer Terlengkap ! **&nbsp;&nbsp;&nbsp;&nbsp;|</div>

  <div id="email">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="mt-1 far fa-envelope"></i>&nbsp;help@dutasarana.com&nbsp;&nbsp;&nbsp;&nbsp;|</div>
  
  <div id="telepon">&nbsp;&nbsp;&nbsp;&nbsp;<i class="mt-1 fas fa-phone" style="opacity: 0.8;"></i>&nbsp;(+62) 81901057788&nbsp;&nbsp;&nbsp;&nbsp;|</div>

 <div id="jalan">&nbsp;&nbsp;&nbsp;&nbsp;<i class="mt-1 fas fa-map-marker-alt" style="opacity: 0.8;"></i>&nbsp;&nbsp;Jl. Kalibokor Selatan No.168 Surabaya&nbsp;&nbsp;&nbsp;&nbsp;|</div>

 <div id="jalan-responsive"><i class="mt-1 fas fa-map-marker-alt" style="opacity: 0.8;"></i>&nbsp;&nbsp;Jl. Kalibokor Selatan No.168 Surabaya</div>

 <div id="ig">&nbsp;&nbsp;&nbsp;&nbsp;<i class="mt-1 fab fa-instagram"></i>&nbsp;&nbsp;@dutasaranacomputer</div>

</nav>
<nav id="nav2" class="top-header flex">
  
    {{-- <a id="link-logo-responsive" class="menu-box me-auto" href="/">
      <img id="logo-responsive" src="logo-dsc.svg" alt="logo-navbar-responsive">
    </a> --}}

    
    <div id="image-header" style="position: relative; display: inline-block;">
      <a href="/about-us" style="position: absolute; left: 0; top: 0; width: 100px; height: 100%;"></a>
      <img style="margin-top: 9vh; z-index: 0" src="{{asset('tes-atas.png')}}" alt="logo-navbar-responsive">
  </div>
  

  <div class="left">
      <div class="dropdown">
        <a href="#" target="_blank" class="top-menu-left"> 
          Kategori Produk&nbsp;&nbsp;<i class="fas fa-bars"></i>
        </a>
          <div class="dropdown-content">
          <form id="dropdown-content-form" action="/dropdown" method="get">
          <input type="hidden" class="nama_produk" name="cari" value="">
          <input type="hidden" class="kategori_produk" name="kategori" value="">

            <div class="laptop">
            <a href="#">Laptop<i class="fas fa-angle-right float-end"></i></a>
              <div class="dropdown-sub-content laptop" style="font-size: 15px;">
                <ul class="intel">
                  <li><a href="#">Laptop Intel</a></li>
                  <li style="font-weight: 300;"><a class="ml-3 produk-link" href="#" data-nama-produk="celeron" data-kategori-produk="laptop">Intel Celeron</a></li>
                  <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="i3" data-kategori-produk="laptop">Intel Core i3</a></li>
                  <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="i5" data-kategori-produk="laptop">Intel Core i5</a></li>
                  <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="i7" data-kategori-produk="laptop">Intel Core i7</a></li>
                </ul>
                <ul class="amd">
                  <li><a href="#">Laptop AMD</a></li>
                  <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="athlon" data-kategori-produk="laptop">AMD Athlon</a></li>
                  <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="ryzen 3" data-kategori-produk="laptop">AMD Ryzen 3</a></li>
                  <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="ryzen 5" data-kategori-produk="laptop">AMD Ryzen 5</a></li>
                  <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="ryzen 7" data-kategori-produk="laptop">AMD Ryzen 7</a></li>
                </ul>
                <ul class="brand">
                  <li><a href="#">Laptop By Brand</a></li>
                  <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="asus" data-kategori-produk="laptop">Asus</a></li>
                  <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="msi" data-kategori-produk="laptop">MSi</a></li>
                  <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="hp" data-kategori-produk="laptop">HP</a></li>
                  <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="advan" data-kategori-produk="laptop">Advan</a></li>
                  <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="huawei" data-kategori-produk="laptop">Huawei</a></li>
                </ul>
                <ul class="vga">
                  <li><a href="#">Laptop By VGA</a></li>
                  <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="rtx" data-kategori-produk="laptop">Nvidia RTX</a></li>
                  <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="radeon" data-kategori-produk="laptop">AMD Radeon</a></li>
                  <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="uhd" data-kategori-produk="laptop">Intel UHD</a></li>
                  <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="iris" data-kategori-produk="laptop">Intel Iris</a></li>
                  <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="amd graphics" data-kategori-produk="laptop">AMD Graphics</a></li>
                </ul>
                <ul class="aksesoris">
                  <li><a href="#">Aksesori Laptop</a></li>
                  <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="headset" data-kategori-produk="headset">Headset</a></li>
                  <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="mouse" data-kategori-produk="mouse">Mouse</a></li>
                  <li class="mt-20"><a href="#">Browse More >></a></li>
                </ul>
              </div>
            </div>
            <div class="komputer">
              <a href="#">Komputer<i class="fas fa-angle-right float-end"></i></a>
                <div class="dropdown-sub-content komputer" style="font-size: 15px;">
                  <ul class="komputer-processor">
                    <li><a href="#">PC By Processor</a></li>
                    <li style="font-weight: 300;"><a class="ml-3 produk-link" href="#" data-nama-produk="i3" data-kategori-produk="personal computer">Intel Core i3</a></li>
                    <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="i5" data-kategori-produk="personal computer">Intel Core i5</a></li>
                    <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="i7" data-kategori-produk="personal computer">Intel Core i7</a></li>
                  </ul>
                  <ul class="komponen">
                    <li><a href="#">Komponen Komputer</a></li>
                    <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="ssd" data-kategori-produk="storage">SSD</a></li>
                    <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="ram" data-kategori-produk="storage">RAM</a></li>
                    <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="" data-kategori-produk="power supply">Power Supply</a></li>
                  </ul>
                  <ul class="aksesoris-pc">
                    <li><a href="#">Aksesoris PC</a></li>
                    <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="keyboard" data-kategori-produk="keyboard">Keyboard</a></li>
                    <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="mouse" data-kategori-produk="mouse">Mouse</a></li>
                    <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="headset" data-kategori-produk="headset">Headset</a></li>
                    <li class="mt-20"><a href="#">Browse More >></a></li>
                </div>
              </div>
              <div class="printer">
                <a href="#">Printer<i class="fas fa-angle-right float-end"></i></a>
                  <div class="dropdown-sub-content printer" style="font-size: 15px;">
                    <ul class="komponen">
                      <li><a href="#">Printer By Brand</a></li>
                      <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="canon" data-kategori-produk="printer">Canon</a></li>
                      <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="epson" data-kategori-produk="printer">Epson</a></li>
                      <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="brother" data-kategori-produk="printer">Brother</a></li>
                      <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="hp" data-kategori-produk="printer">HP</a></li>
                      <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="creality" data-kategori-produk="printer">Creality</a></li>
                      <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="zebra" data-kategori-produk="printer">Zebra</a></li>
                      <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="honeywell" data-kategori-produk="printer">Honeywell</a></li>
                      <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="hprt" data-kategori-produk="printer">HPRT</a></li>
                      <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="pantum" data-kategori-produk="printer">Pantum</a></li>
                    </ul>
                    <ul class="desktop">
                      <li><a href="#">Cartridge</a></li>
                      <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="canon" data-kategori-produk="cartridge">Canon</a></li>
                      <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="brother" data-kategori-produk="cartridge">Brother</a></li>
                      <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="hp" data-kategori-produk="cartridge">HP</a></li>
                    </ul>
                    <ul class="kabel">
                      <li><a href="#">Tinta</a></li>
                      <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="canon" data-kategori-produk="tinta">Canon</a></li>
                      <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="epson" data-kategori-produk="tinta">Epson</a></li>
                      <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="hp" data-kategori-produk="tinta">HP</a></li>
                      <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="brother" data-kategori-produk="tinta">Brother</a></li>
                      <li class="mt-20"><a href="#">Browse More >></a></li>                      
                    </ul>
                  </div>
                </div>
                <div class="lainnya">
                  <a href="#">Lainnya<i class="fas fa-angle-right float-end"></i></a>
                    <div class="dropdown-sub-content lainnya" style="font-size: 15px;">
                        <ul class="komponen">
                          <li><a href="#">Tablet</a></li>
                          <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="huion" data-kategori-produk="tablet">Huion</a></li>
                          <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="wacom" data-kategori-produk="tablet">Wacom</a></li>
                        </ul>
                      <ul class="desktop">
                        <li><a href="#">Projector</a></li>
                        <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="epson" data-kategori-produk="projector">Epson</a></li>
                        <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="acer" data-kategori-produk="projector">Acer</a></li>
                      </ul>
                      <ul class="kabel">
                        <li><a href="#">Toner</a></li>
                        <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="hp" data-kategori-produk="toner">HP</a></li>
                        <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="brother" data-kategori-produk="toner">Brother</a></li>
                        <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="xerox" data-kategori-produk="toner">Xerox</a></li>
                        <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="fuji xerox" data-kategori-produk="toner">Fuji Xerox</a></li>
                        <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="canon" data-kategori-produk="toner">Canon</a></li>
                      </ul>
                      <ul class="kabel">
                        <li><a href="#">Scanner</a></li>
                        <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="brother" data-kategori-produk="scanner">Brother</a></li>
                        <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="canon" data-kategori-produk="scanner">Canon</a></li>
                        <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="epson" data-kategori-produk="scanner">Epson</a></li>
                        <li style="font-weight: 300;"><a href="#" class="produk-link" data-nama-produk="hp" data-kategori-produk="scanner">HP</a></li>
                        <li class="mt-20"><a href="#">Browse More >></a></li>
                      </ul>
                    </div>
                  </div>
          </form>
          </div>
      </div>
    
  </div>
   
   
  <div class="right">
    <a href="/" class="top-menu-right" style="cursor: pointer;"> 
      Home
    </a>
    <a href="/about-us" class="top-menu-right"> 
      About Us
    </a>
    <div class="dropdown">
      <a href="#" style="cursor: pointer;" class="top-menu-right">DSC Store&nbsp;<i class="fas fa-angle-down"></i></a>
        <div class="dropdown-content">
          <a href="/branch-store">Branch Store</a>
          <a href="/maintenance">Service Center</a>
        </div>
    </div>
    <a href="/our-marketplace" class="top-menu-right"> 
      Our Marketplace
    </a>
    <a href="/pricelist" class="top-menu-right"> 
      Price List
    </a>
    <a href="/all-promo" class="top-menu-right"> 
      All Promo
    </a>
    <div class="dropdown">
      <a href="#" style="cursor: pointer;" class="top-menu-right">More Info&nbsp;<i class="fas fa-angle-down"></i></a>
        <div class="dropdown-content">
          <a href="/our-award">Our Award</a>
        </div>
    </div>
  </div>
</nav>

<nav id="nav3" class="navbar sticky flex navbar-shadow">
    <a href="/"><img class="logo" src="logo-dsc.svg" alt="logo-navbar"></a>

    <form class="src-produk d-flex" id="searchForm" method="get">
      <input id="cari-produk" name="cari" class="form-control me-0 custom-form-control" type="search" placeholder="Cari Produk, Kategori atau lainnya" aria-label="Search">
      <select id="list-kategori" name="kategori" class="form-select me-2 custom-form-select" aria-label="Select kategori">
          <option value="semua-kategori" selected>Semua Kategori</option>
          <option value="LAPTOP">Laptop</option>
          <option value="PERSONAL COMPUTER">PC</option>
          <option value="PRINTER">Printer</option>
          <option value="CARTRIDGE">Cartridge</option>
          <option value="TABLET">Tablet</option>
          <option value="PROJECTOR">Projector</option>
          <option value="TONER">Toner</option>
          <option value="SCANNER">Scanner</option>
          <option value="STORAGE">Storage</option>
          <option value="CCTV">CCTV</option>
          <option value="KEYBOARD">Keyboard</option>
          <option value="PRINTHEAD">Printhead</option>
          <option value="UPS">UPS</option>
          <option value="AKSESORIS">Aksesoris</option>
          <option value="TINTA">Tinta</option>
          <option value="DOCUMENT READER">Document Reader</option>
          <option value="SCANNER BARCODE">Scanner Barcode</option>
          <option value="KABEL">Kabel</option>
          <option value="KERTAS">Kertas</option>
          <option value="PRO">Pro</option>
          <option value="HEADSET">Headset</option>
          <option value="MOUSE">Mouse</option>
          <option value="MICROPHONE">Microphone</option>
      </select>
      <button id="btn-cari" type="submit" class="btn-src-produk">
          <i class="fa fa-search" aria-hidden="true"></i>
      </button>
  </form>


  <ul class="flex-icon">
      @auth
        <li>
          <a href="/wishlist" class="navbar-icon">
            <i class="far fa-heart"></i>
          </a>
        </li>
        <li class="icon-menu-space">
          <a href="/cart" class="navbar-icon">
            <i class="fas fa-shopping-cart"></i>
          </a>
        </li>
        <li id="username" name="username">
            <a href="/dashboard" class="navbar-menu" style="cursor: pointer">
              <i class="fas fa-cog"></i>&nbsp;&nbsp;DASHBOARD
            </a>
        </li>
        <li>
          <form action="/logout" method="post">
            @csrf
            <button style="background: none; border:none;" class="navbar-menu" type="submit">LOGOUT</button>
          </form>
        </li>
      @else
         <li>
          <a href="/login">
            <i style="cursor: pointer" id="wish-btn" class="navbar-icon far fa-heart"></i>
          </a>
         </li>
         <li class="icon-menu-space">
          <a href="/cart">
            <i style="cursor: pointer" id="cart-btn" class="navbar-icon fas fa-shopping-cart"></i>
          </a>
         </li>
         <li>
          <a href="/login" class="navbar-menu">
            LOGIN
          </a>
         </li>
         <li>
          <a href="/sign-up" class="navbar-menu">
            SIGN UP
          </a>
         </li>
      @endauth
  </ul>
</nav>

<nav id="nav-responsive" class="d-flex navbar-shadow">
      <input type="checkbox" id="check">
      <label for="check" class="burger-btn"> 
        <i class="fas fa-bars"></i>
      </label>
  
      <div id="variasi-dialog-confirm" style="display: none;">

      </div>

      <div class="burger">
        <label for="check" class="close-btn" style="opacity: 0.6">✖</label>
        <div id="menu-categories" class="d-flex mt-5">
          <h5 class="menu-box">Menu</h5>
          <h5 class="menu-box">Categories</h5>
        </div>

        <ul class="nav-list text-start mt-2" style="display: none">
          <li class="nav-item"><a href="#" class="nav-link">Home</a></li>
          <li class="nav-item"><a href="#" class="nav-link">About Us</a></li>
          <li class="nav-item">
            <a href="#" class="nav-link">DSC Store
              <span class="float-end"><i class="fas fa-plus"></i></span> 
            </a>
          </li>
          <li class="nav-item"><a href="#" class="nav-link">Our Marketplace</a></li>
          <li class="nav-item"><a href="#" class="nav-link">Price List</a></li>
          <li class="nav-item"><a href="#" class="nav-link">All Promo</a></li>
          <li class="nav-item">
            <a href="#" class="nav-link">More Info
              <span class="float-end"><i class="fas fa-plus"></i></span>
            </a>
          </li>
        </ul>

        <div style="opacity: 0.8">
          <div class="mt-5">Copyright © 2025 • Dutasarana.id</div>
          <div class="mt-2 justify-content-center">
            <a style="color: inherit" target="_blank" href="https://www.instagram.com/dutasaranacomputer/"><span class="icon-footer"><i class="fab fa-instagram"></i></span></a>
            <a style="color: inherit; margin-left: 20px;" target="_blank" href="https://www.tiktok.com/@dutasaranacomputer"><span class="icon-footer"><i class="fab fa-tiktok"></i></span></a>
            <a style="color: inherit; margin-left: 20px;" target="_blank" href="https://www.youtube.com/@dutasaranacomputer9655"><span class="icon-footer"><i class="fab fa-youtube"></i></span></a>
          </div> 
        </div>
      </div>
    
  <form class="src-produk-responsive mt-2" action="/cari-responsive" method="get">
    <input id="cari-produk-responsive" class="mt-3" name="cari" type="search" placeholder="Cari Nama/Kategori Produk" aria-label="Search">     
    <button id="btn-cari-responsive" type="submit" class="btn-src-produk">
      <i style="color: black" class="fa fa-search" aria-hidden="true"></i>
    </button>
  </form>
</nav>

    @auth
			<nav class="mobile-nav">
				<a href="/"><i class="fas fa-home"></i>Home</a>
				<a href="/wishlist"><i class="far fa-heart"></i>Wishlist</a>
				<a href="/cart"><i class="fas fa-shopping-cart"></i>Cart</a>
				<a href="/dashboard"><i class="fas fa-user"></i>Dashboard</a>
			</nav>
		@else
			<nav class="mobile-nav">
				<a href="/"><i class="fas fa-home"></i>Home</a>
				<a href="/wishlist"><i class="far fa-heart"></i>Wishlist</a>
				<a href="/cart"><i class="fas fa-shopping-cart"></i>Cart</a>
				<a href="/login"><i class="fas fa-user"></i>Login</a>
			</nav>
		@endauth

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
  $(document).ready(function(){
    $('.burger-btn').on('click', function() {
      $('#variasi-dialog-confirm').fadeIn();
      $('.nav-list').show();
    });

    $('.close-btn').on('click', function() {
      $('#variasi-dialog-confirm').fadeOut();
      $('.nav-list').hide();
    });

    $('#variasi-dialog-confirm').on('click', function() {
      $(this).fadeOut();
      $('#check').prop('checked', false);
    });


    let placeholders = [
                "Cari Produk, Kategori atau lainnya",
                "Cari Catridge Epson (003)",
                "Cari Catridge Canon GI-790",
                "Cari Catridge Brother D60",
                "Cari Printer HP 580",
                "Cari Printer Canon TS207",
                "Cari Printer Brother T426",
                "Cari Tablet Wacom CTL-472",
                "Cari Scanner Canon Lide 300",
                "Cari Scanner Brother ADS 1300",
            ];
            let index = 0;
            let input = $("#cari-produk");
            let inputResponsive = $("#cari-produk-responsive");

            setInterval(function () {
                input.addClass("fade-out"); // Tambahkan efek keluar
                inputResponsive.addClass("fade-out");
                setTimeout(() => {
                    index = (index + 1) % placeholders.length; // Looping array
                    input.attr("placeholder", placeholders[index]); // Ganti placeholder
                    input.removeClass("fade-out").addClass("fade-in"); // Efek masuk
                    inputResponsive.attr("placeholder", placeholders[index]); // Ganti placeholder
                    inputResponsive.removeClass("fade-out").addClass("fade-in");
                }, 500); // Tunggu animasi selesai (0.5 detik)
            }, 3000); // Ubah placeholder setiap 3 detik
        

    $('.produk-link').on('click', function() {
        var produk = $(this).data('nama-produk');
        var kategori = $(this).data('kategori-produk');
        
        $('.nama_produk').val(produk);
        $('.kategori_produk').val(kategori);
        $('#dropdown-content-form').submit();
    });

    $('#searchForm').on('submit', function (e) {
            e.preventDefault(); // Mencegah submit form default

            // Ambil nilai input kategori dan pencarian
            let kategori = $('#list-kategori').val();
            const cari = $('#cari-produk').val().trim();

            // Ubah kategori ke huruf kecil
            if (kategori !== 'semua-kategori') {
                kategori = kategori.toLowerCase();
            } else {
                kategori = 'semua-kategori'; // Kosongkan kategori jika pilihannya adalah "Semua Kategori"
            }

            // Bentuk URL dinamis
            let url = '/';
            if (kategori) {
                url += encodeURIComponent(kategori); // Encode kategori agar aman di URL
            }
            if (cari) {
                url += '/' + encodeURIComponent(cari); // Encode pencarian agar aman di URL
            }

            // Redirect ke URL baru
            window.location.href = url;
      });
  });      
</script>
