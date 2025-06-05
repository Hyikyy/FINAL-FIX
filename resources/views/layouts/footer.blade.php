<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>HIMATIF</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons, etc. -->

  <style>
    /* Social Media Icons */
    .instagram-icon {
      /* Warna Instagram adalah gradien, jadi kita akan menggunakan pendekatan yang lebih kompleks */
      background: linear-gradient(45deg, #405DE6, #5B51D8, #833AB4, #C13584, #E1306C, #FD1D1D);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .linkedin-icon {
      color: #0077B5; /* Biru LinkedIn */
    }

    .facebook-icon {
      color: #1877F2; /* Biru Facebook */
    }
  </style>

</head>
<body>

  <footer id="footer" class="footer accent-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-12 footer-about text-center">
          <a href="{{ route('welcome') }}" class="logo d-flex align-items-center justify-content-center">
            <span class="sitename">HIMATIF</span>
          </a>
          <div class="social-links d-flex justify-content-center mt-4">
            <a href="https://www.instagram.com/himatif.itdel/" title="Instagram"><i class="bi bi-instagram instagram-icon"></i></a>
            <a href="https://www.linkedin.com/" title="LinkedIn"><i class="bi bi-linkedin linkedin-icon"></i></a>
            <a href="https://www.facebook.com/" title="Facebook"><i class="bi bi-facebook facebook-icon"></i></a>
          </div>
        </div>

        <!-- Contact Us Section -->
        <div class="col-lg-12 footer-contact text-center mt-4">
          <h4>Contact Us</h4>
          <p>
            Alamat: Institut Teknologi Del <br>
            Jl. Sisingamangaraja, Sitoluama <br>
            Laguboti, Toba Samosir <br>
            Sumatera Utara, Indonesia<br>
            Email: himatif@gmail.com<br>
            Phone: [Nomor Telepon HIMATIF]<br>
          </p>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">HIMATIF</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        Designed by <a href=>PA-07</a>
      </div>
    </div>

  </footer>

</body>
</html>