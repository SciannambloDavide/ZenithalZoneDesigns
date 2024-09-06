<html>
<head>
	<title><?= $name ?> view</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link rel="stylesheet" href="/app/includes/css.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
<?php
include('/opt/lampp/htdocs/app/includes/header.php');
?>
<div id='main'>
		<form method='post' action=''>
			<div class="form-group">
				<label>Title:<input type="text" class="form-control" name="title" placeholder="Jon" required/></label>
			</div>
			<div class="form-group">
                <p>Description:</p>
            <textarea id="comment" name="description" rows="4" cols="50" placeholder="Write your comment" required></textarea>
			</div>
			<br>
            <div class="form-group">
            <p>Rating:</p>
            <p>
<span style="margin-right: 125px;">0</span>
        <span style="margin-right: 125px;">1</span>
        <span style="margin-right: 125px;">2</span>
        <span style="margin-right: 125px;">3</span>
        <span style="margin-right: 125px;">4</span>
        <span>5</span>
</p>
            <label style="display: inline-block;width:550px;">
            
    </label>

<input type="range" name="rating" class="form-range" min="0" max="5" id="customRange2">
			</div>
           <br>
			<div class="form-group">
				<input type="submit" name="action" value="Create Review" /> 
				<a href='/User/index'>Cancel</a>
			</div>
		</form>
	</div>
    
</body>
</html>