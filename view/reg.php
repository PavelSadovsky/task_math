<html lang="en">
<head>
    <title>Reg tpl</title>
    <link href="/static/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/css/signin.css" rel="stylesheet">
</head>

  <body>

           <p class="bg-danger col-md-2 col-md-offset-5"><?=$data['return_message'] ?></p>


    <div class="container">

            <form class="form-signin" role="form"  action="index.php?page=reg&action=add_registration" method="POST">

                <h2 class="form-signin-heading">Free registration!</h2>

                <input name="name" value="<?=$data['name']?>" type="text" class="form-control" placeholder="Your name" required autofocus>
                <br>
                <input name="email" value="<?=$data['email']?>" type="text" class="form-control" placeholder="Email address" required autofocus>
                <br>
                <br>
                <input name="password" type="password" class="form-control" placeholder="Password" required autofocus>
                <br>
                <input name="password2" type="password" class="form-control" placeholder="Password" required autofocus>
                <br>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Create account</button>

             </form>

    </div>
  </body>
</html>