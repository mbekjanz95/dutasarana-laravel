<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Toko Komputer, PC, Printer, Aksesoris terbaik di Surabaya, Malang, Kediri, Solo, Denpasar, Jogja (Yogyakarta) - Canon, Epson. HP , Brother , Asus">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FAQ</title>
    
    <link rel="icon" type="image/x-icon" href="favicon.ico?v=1.0">

    <link rel="stylesheet" href="style.css?v=2">
    <link rel="stylesheet" href="style2.css?v=2">
    <link rel="stylesheet" href="style3.css?v=2">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a59b9b09ab.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">

    <style>
      .faq-header {
        cursor: pointer;
        transition: background-color 0.3s ease, color 0.3s ease;
      }
      .faq-header:hover {
        background-color: #f8f9fa;
        color: #007bff;
      }
      .sub-header-indent {
        margin-left: 20px; /* Mengatur indentasi */
        font-weight: bold; /* (Opsional) membuat teks tebal */
        font-size: 1rem; /* (Opsional) mengatur ukuran teks */
      }
      .sub-collapse-indent {
        margin-left: 40px; /* Mengatur indentasi */
        font-weight: bold; /* (Opsional) membuat teks tebal */
        font-size: 1rem; /* (Opsional) mengatur ukuran teks */
      }
    </style>
  </head>
  <body>

@include('partials.navbar')
@include('partials.floatingbutton')

<div class="container mt-5">
  <h1 class="text-center mb-4">Frequently Asked Questions</h1>
  <div class="accordion" id="faqAccordion">
    <!-- Question 1 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="faqHeading1">
        <button class="accordion-button collapsed faq-header" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse1" aria-expanded="false" aria-controls="faqCollapse1">
          Pembelian (Purchasing)
        </button>
      </h2>
      <div id="faqCollapse1" class="accordion-collapse collapse" aria-labelledby="faqHeading1" data-bs-parent="#faqAccordion">
        <div id="subHeader1-1" class="accordion-body">
          <button class="accordion-button collapsed p-0 text-decoration-none" type="button" data-bs-toggle="collapse" data-bs-target="#subCollapse1-1" aria-expanded="false" aria-controls="subCollapse1-1">
            <strong class="sub-header-indent">Bagaimana cara membeli produk di website ini ?</strong>
          </button>
          <div id="subCollapse1-1" class="collapse mt-2">
            <strong class="sub-collapse-indent"></strong>
          </div>
        </div>
        <div id="subHeader1-2" class="accordion-body">
          <button class="accordion-button collapsed p-0 text-decoration-none" type="button" data-bs-toggle="collapse" data-bs-target="#subCollapse1-2" aria-expanded="false" aria-controls="subCollapse1-2">
            <strong class="sub-header-indent">Apa bisa melakukan pembelian secara online di marketplace lain (Tokopedia/Shopee/dll) ?</strong>
          </button>
          <div id="subCollapse1-2" class="collapse mt-2">
            <strong class="sub-collapse-indent"></strong>
          </div>
        </div>
        <div id="subHeader1-3" class="accordion-body">
          <button class="accordion-button collapsed p-0 text-decoration-none" type="button" data-bs-toggle="collapse" data-bs-target="#subCollapse1-3" aria-expanded="false" aria-controls="subCollapse1-3">
            <strong class="sub-header-indent">Apa yang dimaksud dengan fitur “Ambil di Toko” ?</strong>
          </button>
          <div id="subCollapse1-3" class="collapse mt-2">
            <strong class="sub-collapse-indent"></strong>
          </div>
        </div>
      </div>
    </div>
    <!-- Question 2 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="faqHeading2">
        <button class="accordion-button collapsed faq-header" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
          Pembayaran (Billing)
        </button>
      </h2>
      <div id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faqHeading2" data-bs-parent="#faqAccordion">
        <div id="subHeader2-1" class="accordion-body">
          <button class="accordion-button collapsed p-0 text-decoration-none" type="button" data-bs-toggle="collapse" data-bs-target="#subCollapse2-1" aria-expanded="false" aria-controls="subCollapse2-1">
            <strong class="sub-header-indent">Apa saja pilihan pembayaran yang tersedia ?</strong>
          </button>
          <div id="subCollapse2-1" class="collapse mt-2">
            <strong class="sub-collapse-indent"></strong>
          </div>
        </div>
        <div id="subHeader2-2" class="accordion-body">
          <button class="accordion-button collapsed p-0 text-decoration-none" type="button" data-bs-toggle="collapse" data-bs-target="#subCollapse2-2" aria-expanded="false" aria-controls="subCollapse2-2">
            <strong class="sub-header-indent">Bisakah membeli produk di website ini secara kredit ?</strong>
          </button>
          <div id="subCollapse2-2" class="collapse mt-2">
            <strong class="sub-collapse-indent"></strong>
          </div>
        </div>
      </div>
    </div>
    <!-- Question 3 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="faqHeading3">
        <button class="accordion-button collapsed faq-header" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
          Pengiriman & Ekspedisi (Delivery & Tracking)
        </button>
      </h2>
      <div id="faqCollapse3" class="accordion-collapse collapse" aria-labelledby="faqHeading3" data-bs-parent="#faqAccordion">
        <div id="subHeader3-1" class="accordion-body">
          <button class="accordion-button collapsed p-0 text-decoration-none" type="button" data-bs-toggle="collapse" data-bs-target="#subCollapse3-1" aria-expanded="false" aria-controls="subCollapse3-1">
            <strong class="sub-header-indent">Apa saja pilihan jasa pengiriman yang tersedia di sini?</strong>
          </button>
          <div id="subCollapse3-1" class="collapse mt-2">
            <strong class="sub-collapse-indent"></strong>
          </div>
        </div>
        <div id="subHeader3-2" class="accordion-body">
          <button class="accordion-button collapsed p-0 text-decoration-none" type="button" data-bs-toggle="collapse" data-bs-target="#subCollapse3-2" aria-expanded="false" aria-controls="subCollapse3-2">
            <strong class="sub-header-indent">Apakah ada fitur “Gratis Ongkir” yang bisa digunakan bila belanja di sini?</strong>
          </button>
          <div id="subCollapse3-2" class="collapse mt-2">
            <strong class="sub-collapse-indent"></strong>
          </div>
        </div>
        <div id="subHeader3-3" class="accordion-body">
          <button class="accordion-button collapsed p-0 text-decoration-none" type="button" data-bs-toggle="collapse" data-bs-target="#subCollapse3-3" aria-expanded="false" aria-controls="subCollapse3-3">
            <strong class="sub-header-indent">Bagaimana cara melacak status pengiriman pesanan saya?</strong>
          </button>
          <div id="subCollapse3-3" class="collapse mt-2">
            <strong class="sub-collapse-indent"></strong>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Question 4 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="faqHeading4">
        <button class="accordion-button collapsed faq-header" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse4" aria-expanded="false" aria-controls="faqCollapse4">
          Garansi Produk (Product Warranty)
        </button>
      </h2>
      <div id="faqCollapse4" class="accordion-collapse collapse" aria-labelledby="faqHeading4" data-bs-parent="#faqAccordion">
        <div id="subHeader4-1" class="accordion-body">
          <button class="accordion-button collapsed p-0 text-decoration-none" type="button" data-bs-toggle="collapse" data-bs-target="#subCollapse4-1" aria-expanded="false" aria-controls="subCollapse4-1">
            <strong class="sub-header-indent">Apa yang termasuk dalam cakupan garansi produk?</strong>
          </button>
          <div id="subCollapse4-1" class="collapse mt-2">
            <strong class="sub-collapse-indent"></strong>
          </div>
        </div>
        <div id="subHeader4-2" class="accordion-body">
          <button class="accordion-button collapsed p-0 text-decoration-none" type="button" data-bs-toggle="collapse" data-bs-target="#subCollapse4-2" aria-expanded="false" aria-controls="subCollapse4-2">
            <strong class="sub-header-indent">Berapa lama garansi yang diberikan untuk produk yang saya beli?</strong>
          </button>
          <div id="subCollapse4-2" class="collapse mt-2">
            <strong class="sub-collapse-indent"></strong>
          </div>
        </div>
        <div id="subHeader4-3" class="accordion-body">
          <button class="accordion-button collapsed p-0 text-decoration-none" type="button" data-bs-toggle="collapse" data-bs-target="#subCollapse4-3" aria-expanded="false" aria-controls="subCollapse4-3">
            <strong class="sub-header-indent">Bagaimana cara mengajukan klaim garansi?</strong>
          </button>
          <div id="subCollapse4-3" class="collapse mt-2">
            <strong class="sub-collapse-indent"></strong>
          </div>
        </div>
        <div id="subHeader4-4" class="accordion-body">
          <button class="accordion-button collapsed p-0 text-decoration-none" type="button" data-bs-toggle="collapse" data-bs-target="#subCollapse4-4" aria-expanded="false" aria-controls="subCollapse4-4">
            <strong class="sub-header-indent">Apa yang harus dilakukan jika produk mengalami kerusakan setelah periode garansi berakhir?</strong>
          </button>
          <div id="subCollapse4-4" class="collapse mt-2">
            <strong class="sub-collapse-indent"></strong>
          </div>
        </div>
      </div>
    </div>
    <!-- Question 5 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="faqHeading5">
        <button class="accordion-button collapsed faq-header" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse5" aria-expanded="false" aria-controls="faqCollapse5">
          Pusat Perbaikan (Service Center)
        </button>
      </h2>
      <div id="faqCollapse5" class="accordion-collapse collapse" aria-labelledby="faqHeading5" data-bs-parent="#faqAccordion">
        <div id="subHeader5-1" class="accordion-body">
          <button class="accordion-button collapsed p-0 text-decoration-none" type="button" data-bs-toggle="collapse" data-bs-target="#subCollapse5-1" aria-expanded="false" aria-controls="subCollapse5-1">
            <strong class="sub-header-indent">Apakah DSC menyediakan jasa perbaikan di lokasi atau harus dikirim ke pusat perbaikan?</strong>
          </button>
          <div id="subCollapse5-1" class="collapse mt-2">
            <strong class="sub-collapse-indent"></strong>
          </div>
        </div>
        <div id="subHeader5-2" class="accordion-body">
          <button class="accordion-button collapsed p-0 text-decoration-none" type="button" data-bs-toggle="collapse" data-bs-target="#subCollapse5-2" aria-expanded="false" aria-controls="subCollapse5-2">
            <strong class="sub-header-indent">Apa saja jenis perbaikan yang tersedia di DSC?</strong>
          </button>
          <div id="subCollapse5-2" class="collapse mt-2">
            <strong class="sub-collapse-indent"></strong>
          </div>
        </div>
        <div id="subHeader5-3" class="accordion-body">
          <button class="accordion-button collapsed p-0 text-decoration-none" type="button" data-bs-toggle="collapse" data-bs-target="#subCollapse5-3" aria-expanded="false" aria-controls="subCollapse5-3">
            <strong class="sub-header-indent">Berapa biaya perbaikan yang perlu dibayarkan?</strong>
          </button>
          <div id="subCollapse5-3" class="collapse mt-2">
            <strong class="sub-collapse-indent"></strong>
          </div>
        </div>
      </div>
    </div>
    <!-- Question 6 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="faqHeading6">
        <button class="accordion-button collapsed faq-header" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse6" aria-expanded="false" aria-controls="faqCollapse6">
          Pengembalian Produk (Product Return)
        </button>
      </h2>
      <div id="faqCollapse6" class="accordion-collapse collapse" aria-labelledby="faqHeading6" data-bs-parent="#faqAccordion">
        <div id="subHeader6-1" class="accordion-body">
          <button class="accordion-button collapsed p-0 text-decoration-none" type="button" data-bs-toggle="collapse" data-bs-target="#subCollapse6-1" aria-expanded="false" aria-controls="subCollapse6-1">
            <strong class="sub-header-indent">Bagaimana cara mengembalikan produk yang tidak sesuai pesanan?</strong>
          </button>
          <div id="subCollapse6-1" class="collapse mt-2">
            <strong class="sub-collapse-indent"></strong>
          </div>
        </div>
        <div id="subHeader6-2" class="accordion-body">
          <button class="accordion-button collapsed p-0 text-decoration-none" type="button" data-bs-toggle="collapse" data-bs-target="#subCollapse6-2" aria-expanded="false" aria-controls="subCollapse6-2">
            <strong class="sub-header-indent">Bagaimana cara mengembalikan produk yang rusak/cacat pabrik?</strong>
          </button>
          <div id="subCollapse6-2" class="collapse mt-2">
            <strong class="sub-collapse-indent"></strong>
          </div>
        </div>
      </div>
    </div>
    <!-- Question 7 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="faqHeading7">
        <button class="accordion-button collapsed faq-header" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse7" aria-expanded="false" aria-controls="faqCollapse7">
          Mitra Bisnis (Business Partner)
        </button>
      </h2>
      <div id="faqCollapse7" class="accordion-collapse collapse" aria-labelledby="faqHeading7" data-bs-parent="#faqAccordion">
        <div id="subHeader7-1" class="accordion-body">
          <button class="accordion-button collapsed p-0 text-decoration-none" type="button" data-bs-toggle="collapse" data-bs-target="#subCollapse7-1" aria-expanded="false" aria-controls="subCollapse7-1">
            <strong class="sub-header-indent">Apakah DSC memberikan harga khusus untuk pembelian grosir atau bisnis skala besar?</strong>
          </button>
          <div id="subCollapse7-1" class="collapse mt-2">
            <strong class="sub-collapse-indent"></strong>
          </div>
        </div>
        <div id="subHeader7-2" class="accordion-body">
          <button class="accordion-button collapsed p-0 text-decoration-none" type="button" data-bs-toggle="collapse" data-bs-target="#subCollapse7-2" aria-expanded="false" aria-controls="subCollapse7-2">
            <strong class="sub-header-indent">Apakah DSC membuka peluang kerjasama dengan pihak lain?</strong>
          </button>
          <div id="subCollapse7-2" class="collapse mt-2">
            <strong class="sub-collapse-indent"></strong>
          </div>
        </div>
        <div id="subHeader7-3" class="accordion-body">
          <button class="accordion-button collapsed p-0 text-decoration-none" type="button" data-bs-toggle="collapse" data-bs-target="#subCollapse7-3" aria-expanded="false" aria-controls="subCollapse7-3">
            <strong class="sub-header-indent">Bagaimana cara mengajukan permohonan kerjasama dengan DSC?</strong>
          </button>
          <div id="subCollapse7-3" class="collapse mt-2">
            <strong class="sub-collapse-indent"></strong>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  @include('partials.footer')
</body>
</html>