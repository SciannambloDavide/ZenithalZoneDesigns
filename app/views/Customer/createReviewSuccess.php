<html>
<head>
	<title><?= $name ?> view</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
<?php
include('/opt/lampp/htdocs/app/includes/header.php');
?>
<div id='main' style='text-align: center;'>
		<h1>Congradulations</h1>
		<p> You have successfully created a Review, but it will first be verified by an admin before it gets published.</p>
		<a href='/Product/viewAll'>Find another product</a> 
		<a href='/Product/view?id=<?= $_GET['id']; ?>'>Go back to the product</a>
<pre>
⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣟⣯⣼⣿⣿⣿⣿⠿⠿⠴⠰⣿⣿⣿⠟⠉⡄⠀⠀⠀⠀⠀⠀⠀⣰⡀⠀⠀⠀⠀⠈⠙⢿⣿⣿⣿⣷⠀⠀⠈⢹⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿
⣿⣿⣿⣿⣿⣿⣿⣿⡿⠛⠙⠉⣻⣿⣿⠿⠃⠀⠀⠀⣸⣿⡟⠁⠴⠊⠀⠀⠀⠀⠀⠀⠀⠀⠸⣧⠀⠀⠀⠀⠀⠀⠈⠙⣿⣿⣿⡀⠀⠀⠀⠙⢿⣿⣿⡷⢿⣿⣿⣿⣿
⣿⣿⣿⣿⣿⣿⣿⠟⢁⠢⠁⢤⣿⣿⣿⣷⣿⣶⣶⣶⣿⣧⣤⡀⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢻⣇⠀⠀⠀⠀⠀⠀⣠⣤⣿⣿⣷⣶⣶⣶⣶⣶⣾⣿⣇⠈⠹⣿⣿⣿
⣿⣿⣿⣿⣿⣿⠟⢠⠈⣠⣶⣾⡿⢛⣫⣽⣿⣯⣿⣯⣭⣟⠛⠃⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⢿⠄⠀⠀⠀⠀⠀⠛⠛⢋⣽⣿⣿⣿⣿⣭⣏⡛⠿⣿⣦⣄⠙⢿⣿
⣿⣿⣿⣿⣿⠁⠀⣰⣿⡿⠛⠟⣴⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⡆⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣠⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⣆⠈⠹⣿⣷⡌⠹
⣿⣿⣿⣯⠃⠀⣼⣿⡏⠀⠀⣼⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡑⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠠⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣧⠀⠈⣿⣿⠄
⣿⣿⣿⠀⠀⠠⣿⣿⠀⠀⢠⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡇⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣯⠀⠀⢸⣿⡆
⣿⣿⣿⠀⠀⠠⣿⣿⠀⠀⢸⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡿⠈⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠀⠀⢸⣿⡇
⣿⣿⣿⠀⠀⠀⠿⠟⠀⠀⠸⣿⠟⠉⠙⢿⣿⣿⣿⣿⣿⣿⣿⡇⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠺⣿⠏⠉⠙⣿⣿⣿⣿⣿⣿⣿⣿⣏⠀⠀⢸⣿⡇
⣿⣿⣿⡀⠀⠀⠀⠀⠀⠀⠀⢿⣦⣀⣠⣾⣿⣿⣿⣿⣿⣿⣿⠅⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠐⣿⣦⣤⣴⣿⣿⣿⣿⣿⣿⣿⣿⠋⠀⠀⠈⠉⠁
⣿⣿⣿⡏⠀⠀⠀⠀⠀⠀⠀⠀⠙⢿⠿⠛⠛⠛⠋⠉⠉⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠉⠉⠉⠉⠛⠙⠛⠛⠛⠉⣀⠀⠀⠀⠀⠀
⣿⣿⣿⡁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠐⠾⠗⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
⣿⣿⣿⡁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
⣿⣿⣿⣷⣄⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣶⣶⣤⣤⣤⣠⣤⣤⣤⣤⣤⣴⣶⣶⣆⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
⣿⣿⣿⣿⣿⣦⣄⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠂⣿⣿⡿⠿⡉⠻⠙⠋⢛⠛⠛⠿⠿⡿⣿⣿⢲⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣤⣾
⣿⣿⣿⣿⣿⣿⣿⣄⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠰⣿⡟⠁⠀⡅⠀⠀⠀⠈⠀⠐⢢⣀⠧⠉⢻⣸⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⡀⠀⣀⣤⣾⣿⣿
⣿⣿⣿⣿⣿⣿⣿⣿⣿⣷⣦⣄⣀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠻⣶⣐⠤⡥⠀⠀⠀⠂⠀⠀⠈⠝⣡⣾⡟⠹⠀⠀⠀⠀⠀⠀⠀⠀⢀⣠⣤⣶⣿⣿⣿⣿⣿⣿
⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣷⣶⣤⣤⣀⣀⣀⠀⠀⠀⠀⠀⠀⠙⠙⠿⠶⠲⡤⢦⠀⠖⢲⠶⠞⠛⠁⠀⠀⠀⠀⢀⣀⣠⣤⣶⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠀⠀⠀⠀⠀
</pre>
	</div>
</body>
</html>