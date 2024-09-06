<?php
include('app/includes/header.php');
?>

<body class="bg-secondary">

        <h1>Order History</h1>
        <?php
        foreach ($data as $index => $order) {
            $prod = new \app\models\Product();
            $prod = $prod->getProductByID($order->product_id);
            echo "<div class=\"card\" style=\"width: 10.2em;\">
                    <div class=\"card-body\">
                        <h5 class=\"card-title\">$prod->title</h5>
                        <a href=\"\Customer\orderDetail?order_id=$order->order_id\" class=\"btn  btn-sm btn-primary\">View Order Detail</a>
                    </div>
                  </div>";                
        }
        ?>
  
    </div>
</body>

</html>