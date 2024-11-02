<?= $this->extend('templates/starting_page_layout'); ?>

<!-- Navbar Section -->
<?= $this->section('navaction') ?>
<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light shadow-sm">
   <!-- Logo -->
   <a class="navbar-brand" href="#">
      <img src="assets/img/logo_yns.png" alt="Logo" width="50" height="50" class="d-inline-block align-text-top" style="margin-top: -12px; margin-left: 40px;">
   </a>

   <div class="ml-auto" style="margin-right: 40px;">
      <!-- Login Button -->
      <button type="button" class="btn btn-primary rounded-pill" data-toggle="modal" data-target="#loginModal">
         Login
      </button>
      <!-- Scan QR Button -->
      <a href="<?= base_url('/'); ?>" class="btn btn-outline-primary rounded-pill pl-3 ml-2">
         <i class="material-icons mr-2">qr_code</i> Scan QR
      </a>
   </div>
</nav>

<script>
   window.addEventListener('scroll', () => {
      document.querySelector('nav').classList.toggle('bg-light', window.scrollY > 50);
   });
</script>
<?= $this->endSection() ?>

<!-- Hero Section -->
<?= $this->section('content'); ?>
<style>
   /* Hide the loginHero div on smaller devices */
   @media (max-width: 576px) {
      #loginHero {
         display: none; /* Hide on small screens */
      }
   }
</style>
<div class="hero-section d-flex align-items-center" style="background-color: #f8f9fa; height: 100vh; position: relative;">
   <div class="container-fluid d-flex flex-column flex-lg-row justify-content-between align-items-center">
      <div class="text-container" style="flex: 1; padding: 20px;">
         <h1 class="display-4 font-weight-bold mb-4" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1); color: #6c757d;">
            Selamat Datang di Portal SAGINS <br> Sistem Absensi Guru SMP Islam Nurush Shodiqin
         </h1>
         <div class="modal-body" id="loginHero">
            <?= view('\App\Views\admin\_message_block') ?>
            <form action="<?= url_to('login') ?>" method="post" class="mt-4">
               <?= csrf_field() ?>
               <div class="form-group">
                  <label for="login" class="font-weight-bold"><?= lang('Auth.emailOrUsername') ?></label>
                  <input type="text" id="login" class="form-control <?= session('errors.login') ? 'is-invalid' : '' ?>" name="login" placeholder="Masukkan Email atau Username" required autofocus>
                  <div class="invalid-feedback">
                     <?= session('errors.login') ?>
                  </div>
               </div>
               <br>
               <div class="form-group">
                  <label for="password" class="font-weight-bold">Password</label>
                  <input type="password" id="password" name="password" class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>" placeholder="Masukkan Password" required>
                  <div class="invalid-feedback">
                     <?= session('errors.password') ?>
                  </div>
               </div>
               <button type="submit" class="btn btn-primary btn-block mt-3"><?= lang('Auth.loginAction') ?></button>
            </form>
         </div>
      </div>
      <div class="image-container" style="flex: 1; display: flex; justify-content: center; padding: 20px;">
         <img src="assets/img/hero_yns.jpg" alt="Hero Image" class="img-fluid rounded" style="max-width: 100%; height: auto;">
      </div>
   </div>
</div>


<!-- Map Section -->
<div id="map" style="height: 400px; margin: 20px;"></div>

<!-- Include Leaflet CSS and JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
   // Initialize the map
   var map = L.map('map').setView([-6.4070, 106.8547], 15); // Latitude and Longitude for the location

   // Add OpenStreetMap tile layer
   L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
   }).addTo(map);

   // Add a marker at the specified location
   L.marker([-6.4070, 106.8547]).addTo(map)
      .bindPopup('<b>SMP Islam Nurush Shodiqin</b><br>Jl Masjid Jami Al Barkah Kp. Rawa RT/RW 02/08, Rawa Panjang, Kecamatan Bojonggede, Kabupaten Bogor, Jawa Barat 16920')
      .openPopup();
</script>

<!-- About Section -->
<section id="about" class="about-section py-5" style="background: linear-gradient(to bottom, #f8f9fa, #e9ecef);">
   <div class="container text-center">
      <!-- <h2 class="mb-4 text-dark">Tentang Kami</h2> -->
      <p class="lead text-dark" style="text-align: left;">SMP Islam Nurush Shodiqin, didirikan pada tahun 2000 di Kabupaten Bogor, adalah institusi pendidikan yang mengedepankan integrasi antara ilmu pengetahuan umum dan nilai-nilai keislaman. Kami berkomitmen untuk menciptakan generasi unggul dalam akademis dan berakhlak mulia, memberikan pendidikan yang tidak hanya mengedukasi tetapi juga membentuk karakter siswa.</p>
      <p class="lead text-dark" style="text-align: left;">Kami percaya bahwa pendidikan harus menginspirasi dan mempersiapkan siswa untuk menjadi pemimpin masa depan. Dengan pendekatan holistik yang meliputi pengembangan kecerdasan emosional dan sosial, kami berupaya menciptakan lingkungan belajar yang dinamis dan kondusif bagi setiap siswa.</p>
   </div>
   <div class="container text-center">
      <br>
      <!-- <h2 class="mb-4" style="color: black;">Visi & Misi</h2> -->
      <div class="d-flex justify-content-center">
         <!-- Vision Card -->
         <div class="card m-2" style="width: 500px;">
            <div class="card-body">
               <h4 class="text-dark"><i class="fas fa-eye"></i> Visi</h4>
               <p style="color: black;">Menjadi lembaga pendidikan Islam yang terkemuka, berkomitmen untuk mencetak generasi Muslim yang cerdas, berakhlak mulia, dan siap berkontribusi positif bagi masyarakat.</p>
            </div>
         </div>
         <!-- Mission Card -->
         <div class="card m-2" style="width: 500px;">
            <div class="card-body">
               <h4 class="text-dark"><i class="fas fa-bullseye"></i> Misi</h4>
               <p style="color: black;">SMP Islam Nurush Shodiqin berkomitmen untuk:</p>
               <ol class="list-unstyled" style="padding-left: 0; color: black; text-align: left; margin-left: 10px;">
                  <li style="transition: transform 0.3s;"><i class="fas fa-check-circle"></i> Integrasi nilai-nilai keislaman dalam setiap aspek pendidikan.</li>
                  <li style="transition: transform 0.3s;"><i class="fas fa-check-circle"></i> Menyediakan pendidikan yang seimbang antara ilmu agama dan ilmu pengetahuan umum.</li>
                  <li style="transition: transform 0.3s;"><i class="fas fa-check-circle"></i> Menciptakan lingkungan yang mendukung pengembangan potensi akademik dan non-akademik siswa.</li>
                  <li style="transition: transform 0.3s;"><i class="fas fa-check-circle"></i> Menumbuhkan sikap peduli sosial dan cinta lingkungan di kalangan siswa.</li>
                  <li style="transition: transform 0.3s;"><i class="fas fa-check-circle"></i> Mendorong kolaborasi dan semangat kebersamaan dalam setiap kegiatan sekolah.</li>
               </ol>
               <p style="color: black;">Dengan misi ini, kami berusaha agar setiap siswa tidak hanya berhasil secara akademis tetapi juga menjadi individu yang bermanfaat bagi masyarakat.</p>
            </div>
         </div>
      </div>
   </div>
</section>



<!-- Add Bootstrap JS and dependencies if not already included -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.11/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



<!-- Add the following CSS for hover effect -->
<style>
   .list-unstyled li:hover {
      transform: translateY(-5px);
      cursor: pointer;
   }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Footer Section -->
<footer class="footer bg-light text-dark py-4">
   <div class="container text-center">
      <p class="mb-1">
         Jl. Masjid Jami Al Barkah Kp. Rawa RT/RW 02/08, Rawa Panjang, Kecamatan Bojonggede,
         Kabupaten Bogor, Jawa Barat 16920
      </p>
      <div class="social-links mt-3">
         <a href="#" class="text-dark mx-2" title="Facebook" aria-label="Facebook">
            <i class="fab fa-facebook-f"></i>
         </a>
         <a href="#" class="text-dark mx-2" title="Tiktok" aria-label="Tiktok">
            <i class="fab fa-tiktok"></i> <!-- Fixed the icon for Twitter -->
         </a>
         <a href="#" class="text-dark mx-2" title="Instagram" aria-label="Instagram">
            <i class="fab fa-instagram"></i>
         </a>
      </div>
      <p class="mt-4 mb-0">© 2023 All rights reserved.</p>
   </div>
</footer>

<!-- Optional JavaScript -->
<script>
   // Update the year dynamically (optional)
   document.addEventListener("DOMContentLoaded", function() {
      const yearElement = document.getElementById("year");
      if (yearElement) {
         yearElement.textContent = new Date().getFullYear();
      }
   });
</script>


<script>
   // Automatically set the current year
   document.getElementById("year").textContent = new Date().getFullYear();
</script>

<style>
   .footer {
      border-top: 1px solid #ddd;
   }

   .social-links a {
      font-size: 1.5rem;
      transition: color 0.3s;
   }

   .social-links a:hover {
      color: #007bff;
      /* Change to your desired hover color */
   }
</style>


<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="loginModalLabel">Login Dashboard</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <?= view('\App\Views\admin\_message_block') ?>
            <form action="<?= url_to('login') ?>" method="post">
               <?= csrf_field() ?>
               <div class="form-group">
                  <label><?= lang('Auth.emailOrUsername') ?></label>
                  <input type="text" class="form-control <?= session('errors.login') ? 'is-invalid' : '' ?>" name="login" autofocus>
                  <div class="invalid-feedback">
                     <?= session('errors.login') ?>
                  </div>
               </div>
               <br>
               <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>">
                  <div class="invalid-feedback">
                     <?= session('errors.password') ?>
                  </div>
               </div>
               <button type="submit" class="btn btn-primary btn-block mt-3"><?= lang('Auth.loginAction') ?></button>
            </form>
         </div>
      </div>
   </div>
</div>

<!-- Styles -->
<style>
   /* Hero Section Styles */
   .hero-section {
      background-position: center;
      background-repeat: no-repeat;
      color: wheat;
      position: relative;
      overflow: hidden;
   }

   .hero-section::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      z-index: 1;
      /* Overlay layer above the image */
   }

   .text-container {
      z-index: 2;
      /* Ensure text is above the overlay */
   }

   /* Navbar Styles */
   .navbar {
      transition: background-color 0.3s ease, padding 0.3s ease;
      background-color: transparent;
      /* Transparent background at the start */
   }

   .navbar.scrolled {
      background-color: rgba(0, 86, 179, 0.9);
      /* Change color when scrolling */
      padding: 10px 20px;
      /* Change padding for effect */
   }

   /* Button Hover Effects */
   .btn-primary:hover {
      background-color: #004494;
      /* Dark color on hover */
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
   }
</style>
<?= $this->endSection() ?>