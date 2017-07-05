<html lang="en">
<head>
    <title>Login</title>
    <link href="/static/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/css/signin.css" rel="stylesheet">
</head>

  <body>

  <div class="col-md-11">
      <?php

      $a_messages = array(
          'registration_correct'             => 'Ragistration correct!',
          'login_incorrect'                  => 'Login or password incorrect!',

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

    <div class="container text-center">


    <br>
    <br>

      <form class="form-signin" role="form"  action="index.php/?page=login&action=login" method="POST">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input name="email" type="text" class="form-control" placeholder="Email address" required autofocus>
        <input name="password" type="password" class="form-control" placeholder="Password" required>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <a href="/?page=reg&action=reg">Registration</a>
      </form>
         

    </div>
</html>