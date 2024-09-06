<!-- Footer -->
    <!-- Footer-->
    <footer class="bg-dark mt-10  ">  
    
        <!-- Menus & Newsletter-->
        <div class="border-top-white-opacity py-7 mt-7 text-white">
            <div class="container" data-aos="fade-in">
                <div class="row my-4 flex-wrap">

        
                    <!-- Footer Nav-->
                    <nav class="col-6 col-md mb-4 mb-md-0">
                        <h6 class="mb-4 fw-bolder fs-6"><?= __('Company') ?></h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a class="text-decoration-none text-white opacity-75 opacity-25-hover transition-all"
                                    href="/Home"><?= __('About Us') ?></a></li>
                            <li class="mb-2"><a class="text-decoration-none text-white opacity-75 opacity-25-hover transition-all"
                                    href="/Contact/Contact_us"><?= __('Contact') ?></a></li>
                        </ul>
                    </nav>
                    <!-- /Footer Nav-->
        
                    <!-- Footer Nav-->
                    <nav class="d-none d-md-block col-md">
                        <h6 class="mb-4 fw-bolder fs-6">Navigation</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a class="text-decoration-none text-white opacity-75 opacity-25-hover transition-all"
                                    href="#"><?= __('Go To The Top') ?></a></li>
                            <li class="mb-2"><a class="text-decoration-none text-white opacity-75 opacity-25-hover transition-all"
                                    href="/Wish/viewAllWish"><?= __('Wish List') ?></a></li>
                            <li class="mb-2"><a class="text-decoration-none text-white opacity-75 opacity-25-hover transition-all"
                                    href="/Customer/viewProfile"><?= __('Your Account') ?></a></li>
                        </ul>
                    </nav>
                    <!-- /Footer Nav-->

                    <!-- Footer Contact-->
                    <div class="col-12 col-md-5">
                        <h6 class="mb-4 fw-bolder fs-6"><?= __('Join Our Newsletter') ?></h6>
                        <p class="opacity-75"><?= __('Sign up to our newsletter to be the first to know about new arrivals, sales or anything else Zenithal. By subscribing to our mailing list you agree to our terms and conditions.') ?></p>
                        <form id="newsletter-form" action="/Subscribe" method="post"
                            class="bg-white d-flex justify-content-start align-items-center border-dark-focus-within transition-all mt-4">
                            <div class="input-group m-0">
                                <input type="email" name="email" id="email-input" class="form-control d-flex flex-grow-1 border-0 bg-transparent py-3"
                                    placeholder="<?= __('Enter Your Email') ?>" aria-label="Enter your email" required>
                                <button type="submit" class="input-group-text bg-transparent border-0" id="submit-button"><i
                                        class="ri-arrow-right-line align-middle"></i></button>
                            </div>
                        </form>
                    </div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            // Get the form, email input, and submit button
                            const form = document.getElementById("newsletter-form");
                            const emailInput = document.getElementById("email-input");
                            const submitButton = document.getElementById("submit-button");
                            // Add event listener to the form submission
                            form.addEventListener("submit", function (event) {
                                // Check if the email is valid
                                if (!emailInput.checkValidity()) {
                                    // If not valid, prevent the form submission
                                    event.preventDefault();
                                    // Optionally, you can display an error message here
                                    alert("Please enter a valid email address.");
                                }
                            });
                        });
                    </script>
                    <!-- /Footer Contact-->

                </div>
                
            </div>
        </div>
        <!-- Menus & Newsletter-->
    
    </footer>
    <!-- / Footer-->