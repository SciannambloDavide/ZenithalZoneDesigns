<?php
include('app/includes/header.php');
?>

<body class="bg-secondary">

        <h1>Your Cart</h1>
        <?php
        foreach ($data as $index => $product) {
            $prod = new \app\models\Product();
            $prod = $prod->getProductByID($product->product_id);
            echo "<div class=\"card\" style=\"width: 18rem;\">
            <div class=\"card-body\">
                <h5 class=\"card-title\">$prod->title</h5>
                <p class=\"card-text\">$prod->description</p>
                <a href=\"\Cart\\removeFromCart?product_id=$prod->product_id&customer_id=$product->customer_id\" class=\"btn btn-primary\">Remove From Cart</a>
                    </div>
                  </div>";
        }
        ?>
  
    </div>
</body>

</html>