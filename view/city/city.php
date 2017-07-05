<!DOCTYPE html>
<html lang="en">
<head>
  <title>City</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="/static/css/bootstrap.min.css">
  <link rel="stylesheet" href="/static/css/default.css">
    <script language="JavaScript" src="/static/js/default.js" type="text/javascript"></script>
</head>
<body>
<br>
<br>
<a class="btn btn-danger col-md-offset-11"  href='/?logout=1'>Logout</a>




    <?php

    if( $data['action'] == "edit" )
    {
        include_once 'view/city/city_edit_form.php';
    }
    elseif ( $data['action'] == "add")
    {
        include_once 'view/city/city_add_form.php';
    }
    else
    {
        include_once 'view/city/city_show.php';
    }


    ?>


</body>
</html>