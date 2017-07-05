<!DOCTYPE html>
<html lang="en">
<head>
  <title>Country tpl</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="/static/css/bootstrap.min.css">
  <link rel="stylesheet" href="/static/css/default.css">
    <script language="JavaScript" src="/static/js/default.js" type="text/javascript"></script>
</head>
<body>
<br>
<br>
<a class="btn btn-danger col-md-offset-11"  href='/?logout=1'>Logout</a>

<div class="col-md-11">
<?php

$a_messages = array(
    'correct_add_country'             => 'Country add correct!',
    'correct_edit_country'            => 'Country edit correct!',
    'delete_country_correct'          => 'Country deleted!',
    'invalid_char_country'            => "Invalid characters in the Country.<br> Use characters(A-Z,a-z,-, )",
    'duplicate_in_the_database'       => "In the database there is already such a country",
    'exceeding_characters_country'    => "The name of the country uses more than 32 characters",

);


if( !empty($data['error']) )
{
    echo '<p class="bg-danger col-md-6">'.$a_messages[$data['error']].'</p>';
}
elseif( !empty($data['success']) )
{
    echo '<p class="bg-success col-md-6">'.$a_messages[$data['success']].'</p>';
}
?>
</div>


    <?php

    if( $data['action'] == "edit" )
    {
        include_once 'view/country/country_edit_form.php';
    }
    elseif ( $data['action'] == "add")
    {
        include_once 'view/country/country_add_form.php';
    }
    else
    {
        include_once 'view/country/country_show.php';
    }


    ?>


</body>
</html>