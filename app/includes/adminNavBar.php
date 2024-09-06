<nav class="navbar navbar-expand-lg navbar-light navbar-custom">
    <div class="container-fluid">
        <a class="navbar-brand" href="/User/index">
            <img src="/images/logo1.png" alt="Dispute Bills" style="max-height: 40px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php
                if (isset($_SESSION['admin_id'])) {
                    echo
                    "<li class=\"nav-item\"> 
                    <a class=\"nav-link\" href=\"\Admin\productManagement\">Manage Products</a>
                    </li>
                    " .
                        "<li class=\"nav-item\"> 
                    <a class=\"nav-link\" href=\"\Admin\reviewManagement\">Manage Reviews</a>
                    </li>
                    ";
                }
                ?>
            </ul>
            <ul class="navbar-nav ms-auto">
                <?php
                if (isset($_SESSION['admin_id'])) {
                    echo
                    "<li class=\"nav-item\"> 
                    <a class=\"nav-link\" href=\"\User\logout\">Log Out</a>
                    </li>
                    ";
                } else {
                    echo "<li class=\"nav-item\"> 
                    <a class=\"nav-link\" href=\"\User\login\">Log In</a>
                    </li>
                    ";
                }
                ?>
            </ul>
        </div>
    </div>
</nav>