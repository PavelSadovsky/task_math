<html lang="en">
<head>
    <title>default_page</title>
    <link href="static/css/bootstrap.min.css" rel="stylesheet">
    <link href="static/css/signin.css" rel="stylesheet">
</head>

  <body>

    <div class="container text-center">

<?php if ( $data['one'] ): ?>

    <div class="col-md-4  col-md-offset-4 panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Welcome</h3>
        </div>

        <div class="panel-body">
             <a href="index.php">
                 <?= $data['one'] ?>
             </a>
        </div>
    </div>

    <br>
    <br>

<?php endif; ?>



    </div> <!-- /container -->
  </body>
</html>