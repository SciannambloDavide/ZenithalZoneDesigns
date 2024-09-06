<?php
include('app/includes/header.php');
?>

</body>
<div id='main'>
		<h1>View All Products</h1>
<table>		
        <form method="POST" action="/Product/productSearch">
            <div class="input-group mb-5">
                <input type="text" class="form-control rounded" placeholder="Search" name="content" required/>
                <div class="form-check text-start m-3">
                    <input type="radio" class="form-check-input" id="radio1" name="searchBy" value="title" checked>
                    <label class="form-check-label" for="radio1">Title</label>
                </div>
                <div class="form-check text-start m-3">
                    <input type="radio" class="form-check-input" id="radio2" name="searchBy" value="description">
                    <label class="form-check-label" for="radio1">Description</label>
                </div>
                <div class="form-group m-3">
                    <input type="submit" name="action" value="Search" class="bg-dark text-white"/>
                </div>
            </div>
        </form>
		<?php
		foreach($data as $index => $product){
            echo "            
            <tr><td><a href='/Product/view?id=$product->product_id'>$product->title</a></td><tr>
			";
		}
		?>
</table>
</div>
</body>
</html>