<nav class="navbar navbar-custom navbar-expand-sm ">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="pull-left"></a> 
                <a class="nav-link" href="/User/index"><img src="/images/logo1.png" width="15%" class=".img-fluid. and height: auto;"></a>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="nav-item">
            <a href="#" class="nav-item"></a> 
                <a class="nav-link" href="\Publication\home">Home</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-item"></a> 
                <a class="nav-link" href="\Publication\home">Shop</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-item"></a> 
                <a class="nav-link" href="\Publication\home">About</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-item"></a> 
                <a class="nav-link" href="\Publication\home">Contact</a>
            </li>
            <?php
            if (isset($_SESSION['id'])) {
                echo
                "<li class=\"nav-item\"> 
                    <a class=\"nav-link\" href=\"\Publication\home\">Orders History</a>
                    </li>
                    ";
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
</nav>