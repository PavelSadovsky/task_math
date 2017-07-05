<!DOCTYPE html>
<html lang="en">
<head>
  <title>language tpl</title>
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
        'correct_add_language'             => 'Language add correct!',
        'correct_edit_language'            => 'Language edit correct!',
        'delete_language_correct'          => 'Language deleted!',
        'invalid_char_language'            => "Invalid characters in the Language.<br> Use characters(A-Z,a-z,-, )",
        'duplicate_in_the_database'        => "In the database there is already such a language",
        'exceeding_characters_language'    => "The name of the language uses more than 32 characters",

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
        include_once 'view/language/language_edit_form.php';
    }
    elseif ( $data['action'] == "add")
    {
        include_once 'view/language/language_add_form.php';
    }
    else
    {
        include_once 'view/language/language_show.php';
    }


    ?>


</body>
</html>