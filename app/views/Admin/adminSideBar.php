<nav id="sidebar">
    <div class="p-4 pt-5">
        <a href="#" class="img logo rounded-circle mb-5" style="background-image: url(/images/logo.PNG);"></a>
        <ul class="list-unstyled components mb-5">
            <li>
                <a href="\Admin\dashboard"><?= __("Dashboard") ?></a>
            </li>
            <li>
                <a href="\Admin\productManagement"><?= __("Product Management") ?></a>
            </li>
            <li>
                <a href="\Admin\reviewManagement"><?= __("Review Management") ?></a>
            </li>
            <li>
                <a href="\Admin\categoryManagement"><?= __("Category Management") ?></a>
            </li>
            <li>
                <a href="\Admin\orderManagement"><?= __("Order Management") ?></a>
            </li>
            <li>
                <a href="/Admin/newsletter"><?= __("Newsletter") ?></a>
            </li>
            <li>
                <a href="/Admin/contactUser"><?= __("Contact User") ?></a>
            </li>
        
        </ul>
        <?php
                if($_SESSION['lang'] == 'en'){
                    echo "<a href=\"/Admin/langChecker\">EN</a>";
                }else{
                    echo "<a href=\"/Admin/langChecker\">FR</a>";    
                }
            ?>
    </div>
</nav>