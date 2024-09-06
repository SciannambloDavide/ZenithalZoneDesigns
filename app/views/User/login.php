<?php $this->view('header'); ?>
<!-- Page Title -->
<title>Zenithal Zone Designs | Home</title>
<!-- STYLE CSS -->
<!-- LINEARICONS -->
<link rel="stylesheet" href="/app/views/User/AdminLogin/fonts/linearicons/style.css">
<link rel="stylesheet" href="/app/views/User/AdminLogin/css/style.css" title="Alternate Style">
</head>

<body>
  <!-- Navbar -->
  <?php $this->view('User/AdminLogin/navBar'); ?>
  <main>
    <section class="vh-100 position-relative bg-overlay-dark ">
      <div class="container d-flex h-100 justify-content-center align-items-center position-relative z-index-10">
        <div class="d-flex justify-content-center align-items-center h-100 position-relative z-index-10 text-white">
          <!-- MIDDLE OF IMAGE SLIDE -->
          <div>
            <div class="inner" id="inner">
              <form action="" method="POST" id="loginForm">
                <h3 id="loginName"><?= __('Customer Login') ?><h3>
                <h3 id="loginType" hidden>customer<h3>
                    <div class="form-holder">
                      <span class="lnr lnr-user"></span>
                      <input type="text" class="form-control" name="username" id="username" placeholder="<?= __('Username') ?>" required/>
                    </div>
                    <!-- <div class="form-holder">
						<span class="lnr lnr-phone-handset"></span>
						<input type="text" class="form-control" placeholder="Phone Number">
					</div>
					<div class="form-holder">
						<span class="lnr lnr-envelope"></span>
						<input type="text" class="form-control" placeholder="Mail">
					</div>
					<div class="form-holder">
						<span class="lnr lnr-lock"></span>
						<input type="password" class="form-control" placeholder="Password">
					</div> -->
                    <div class="form-holder">
                      <span class="lnr lnr-lock"></span>
                      <input type="password" class="form-control" name="password" id="password" placeholder="<?= __('Password') ?>" required/>
                    </div>
                    <button id="#buttonAdmin">
                      <span><?= __('Login') ?></span>
                    </button>
                    <div style="margin-top: 15px; margin-bottom: 15px;">
                      <p id="loginAs"><?= __('Login As Admin?') ?></p>
                      <b class="link-info btn-sm" onclick="switchLogin()"><?= __('Click Here') ?></b><br>
                     
                    </div>
                    <a class="link-info btn-sm" href='/User/register' id="register"><?= __('Register For Customer') ?></a>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="position-absolute z-index-1 top-0 bottom-0 start-0 end-0">
        <!-- Swiper Info -->
        <div class="swiper-container overflow-hidden bg-light w-100 h-100" data-swiper data-options='{
                    "slidesPerView": 1,
                    "speed": 1500,
                    "loop": true,
                    "effect": "fade",
                    "autoplay": {
                      "delay": 5000
                    }
                  }'>
          <div class="swiper-wrapper">
            <div class="swiper-slide position-relative">
              <div class="w-100 h-100 bg-img-cover animation-move bg-pos-center-center" style="background-image: url(../../assets/images/slideshows/slideshow-1.jpg);">
              </div>
            </div>
            <div class="swiper-slide position-relative">
              <div class="w-100 h-100 bg-img-cover animation-move bg-pos-center-center" style="background-image: url(../../assets/images/slideshows/slideshow-2.jpg);">
              </div>
            </div>
            <div class="swiper-slide position-relative">
              <div class="w-100 h-100 bg-img-cover animation-move bg-pos-center-center" style="background-image: url(../../assets/images/slideshows/slideshow-3.jpg);">
              </div>
            </div>
          </div>

        </div>
        <!-- / Swiper Info-->
      </div>
    </section>
  </main>
  <script src="/app/views/User/AdminLogin/js/jquery-3.3.1.min.js"></script>
  <script src="/app/views/User/AdminLogin/js/main.js"></script>



  <script>
    function switchLogin() {
      var loginType = document.getElementById("loginType");
      var loginName = document.getElementById("loginName");
      if (loginType.innerHTML == 'admin') {
        loginType.innerHTML = 'customer';
        loginName.innerHTML = '<?= __('Customer Login') ?>';
        document.getElementById("loginAs").innerHTML = "<?= __('Login As Admin?') ?>";
        document.getElementById("loginForm").action = "/User/login";
        document.getElementById("register").removeAttribute("hidden");
        document.getElementById('username').value = '';
        document.getElementById('password').value = '';
      } else {
        loginType.innerHTML = 'admin'; 
        loginName.innerHTML = '<?= __('Admin Login') ?>';
        document.getElementById("loginAs").innerHTML = "<?= __('Log In As Customer') ?>";
        document.getElementById("register").hidden = "hidden";
        document.getElementById("loginForm").action = "/User/adminLogin";
        document.getElementById('username').value = '';
        document.getElementById('password').value = '';
      }
    }
  </script>

</body>

</html>