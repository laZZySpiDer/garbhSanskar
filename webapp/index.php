<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?php include('links.php'); ?>
</head>
<body>


    <div class="row">
        <div class="col-sm-2">
            <div class="card">
                <?php include('navbar.php');
                    $dashboard = "active";
                ?>

            </div>
        </div>
        <div class="col-sm-10">
        
        </div>
    </div>

    <script>
    
    $(document).ready(function() {
  $('li.active').removeClass('active');
  $('a[href="' + location.pathname + '"]').closest('li').addClass('active'); 
});
    </script>
</body>
</html>