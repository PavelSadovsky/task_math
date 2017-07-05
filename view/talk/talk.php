<!DOCTYPE html>
<html lang="en">
<head>
  <title>Talk</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <link rel="stylesheet" href="/static/css/default.css">
    <link rel="stylesheet" href="/static/css/colors.css">
    <script type="text/javascript" src="/static/js/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="/static/js/jquery.tmpl.min.js"></script>
    <script language="JavaScript" src="/static/js/default.js" type="text/javascript"></script>

</head>
<body>
<style>
    ul { list-style-type: none; }
</style>

<?php

    $a_messages = array(
        'language_exist'            => 'This record is already in the database',
        'insert_correct'            => 'Insert record correct to db',
        'data_error'                => 'Incorrect input data',
        'delete_correct'            => 'Successfully record delete in db',
        'empty_id_from_del'         => "Empty id in table Talk from delete",
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

    <?php

    if( $data['action'] == 'edit' )
    {
        include_once 'view/talk/talk_edit_form.php';
    }
    elseif( $data['action'] == 'add' )
    {
        include_once 'view/talk/talk_add_form.php';
    }
    else
    {
        include_once 'view/talk/show_talk.php';
    }


    ?>


</body>
</html>