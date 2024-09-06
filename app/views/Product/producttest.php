<!doctype html>
<html lang="en">

<head>
    <title>Product Manage</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>
    <select name="category[]" class="form-control" id="position" style="font-size: 14px;" multiple>
        <option value="nameASC">Product's Name A-Z</option>
        <option value="nameDESC">Product's Name Z-A</option>
        <option value="priceASC">Product's Price ASC</option>
        <option value="priceDESC">Product's Price DESC</option>
    </select>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#position").select2({
                allowClear: true,
                placeholder: 'Position'
            });
        });
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Page</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
</head>
<body>
    <select name="category[]" class="form-control" id="position" style="font-size: 14px;" multiple>
        <option value="nameASC">Product's Name A-Z</option>
        <option value="nameDESC">Product's Name Z-A</option>
        <option value="priceASC">Product's Price ASC</option>
        <option value="priceDESC">Product's Price DESC</option>
    </select>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $("#position").select2({
                allowClear: true,
                placeholder: 'Position'
            });
        });
    </script>
</body>
</html>
