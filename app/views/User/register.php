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
    <?php $this->view('User/AdminLogin/navBar');
    if (isset($_SESSION['error'])) {
        echo "<script>alert('" . $_SESSION['error'] . "');</script>";
        unset($_SESSION['error']); // Clear the message so it doesn't persist on refresh
    } ?>
    <main>
        <section class="vh-100 position-relative bg-overlay-dark ">
            <div class="container d-flex h-100 justify-content-center align-items-center position-relative z-index-10">
                <div class="d-flex justify-content-center align-items-center h-100 position-relative z-index-10 text-white">
                    <!-- MIDDLE OF IMAGE SLIDE -->
                    <div>
                        <div class="inner" id="inner">
                            <form action="/User/register" method="POST">
                                <h3 id="loginType"><?= __('Customer Registration') ?><h3>
                                        <div class="form-holder">
                                            <span class="lnr lnr-envelope"></span>
                                            <input type="email" id="email" name="email" class="form-control" placeholder="<?= __('Email') ?>" required>
                                        </div>
                                        <div class="form-holder">
                                            <span class="lnr lnr-user"></span>
                                            <input type="text" class="form-control" name="username" placeholder="<?= __('Username') ?>" required />
                                        </div>
                                        <div class="form-holder">
                                            <span class="lnr lnr-user"></span>
                                            <input type="text" id="name" name="name" class="form-control" placeholder="<?= __('Name') ?>" required>
                                        </div>

                                        <div class="form-holder">
                                           
                                            <span class="lnr lnr-lock"></span>
                                            
                                            <input type="password" class="form-control" name="password" placeholder="<?= __('Password') ?>" pattern=".{8,}" required />

                                        </div>
                                        <p><?= __('At Least 8 Characters For Password') ?></p>
                                        <button id="#buttonAdmin">
                                            <span><?= __('Register') ?></span>
                                        </button>
                                        <a class="link-info btn-sm" href='/User/login' id="register"><?= __('I have an account') ?></a>
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


</body>

</html>