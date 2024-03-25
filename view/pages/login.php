<?php

session_start();
include 'files/links.php';
if(isset($_SESSION['rollnumber'])){
  header('location:home');
}
if ( isset( $_POST[ 'signin' ] ) ) {

    $mailconnect = htmlspecialchars( $_POST[ 'email' ] );
    $passwordconnect = htmlspecialchars( $_POST[ 'password' ] );

    if ( !empty( $mailconnect ) || !empty( $passwordconnect ) ) {
        $requser = $bdd->prepare( 'SELECT * FROM users WHERE email= ? AND password= ?' );
        $requser->execute( array( $mailconnect, $passwordconnect ) );

        $Userexist = $requser->rowCount();
        if ( $Userexist == 1 ) {
            $Userinfo = $requser->fetch();
            $_SESSION[ 'id' ] = $Userinfo[ 'id' ];
            $_SESSION[ 'firstname' ] = $Userinfo[ 'firstname' ];
            $_SESSION[ 'lastname' ] = $Userinfo[ 'lastname' ];
            $_SESSION[ 'profilepic' ] = $Userinfo[ 'profilepic' ];
            $_SESSION[ 'email' ] = $Userinfo[ 'email' ];
            $_SESSION[ 'password' ] = $Userinfo[ 'password' ];
            $_SESSION[ 'verified' ] = $Userinfo[ 'verified' ];
            $_SESSION[ 'rollnumber' ] = $Userinfo[ 'rollnumber' ];
            $_SESSION[ 'created_at' ] = $Userinfo[ 'created_at' ];
            $_SESSION[ 'access' ] = $Userinfo[ 'access' ];
            $_SESSION[ 'connected' ] = $Userinfo[ 'connected' ];

            $rollnumber = $_SESSION[ 'rollnumber' ];
            $connected = $bdd->prepare( "UPDATE users SET connected = 1 WHERE rollnumber = '$rollnumber'" );
            $connected->execute( array() );
            $firstname = $_SESSION[ 'firstname' ];

            $err = 'success';
        } else $err = 'user_notfound';
    } else $err = 'empty';
}
?>

<meta charset = 'utf-8'>
<title>Emmak School of Science and Technology</title>
<meta content = 'width=device-width, initial-scale=1.0' name = 'viewport'>
<meta content = 'Free HTML Templates' name = 'keywords'>
<meta content = 'Free HTML Templates' name = 'description'>

<!-- Favicon -->
<link href = 'view/pages/includes/img/favicon.png' rel = 'icon'>
<link href = 'view\pages\img\favicon.png' rel = 'apple-touch-icon'>

<body class = 'hold-transition login-page'>
<div class = 'login-box'>
<div class = 'login-logo'>
<a href = './'><b>E</b>mmak <b>S</b>chool of <b>S</b>cience and <b>T</b>echnology</a>
</div>
<!-- /.login-logo -->
<div class = 'card'>
<div class = 'card-body login-card-body'>
<p class = 'login-box-msg'>Sign in to start your session</p>
<?php
if ( isset( $err ) ) {

    switch ( $err ) {
        case 'user_notfound':
        echo '<div class="alert alert-danger" role="alert">Email or password incorrect</div>';
        break;
        case 'empty':
        echo '<div class="alert alert-danger" role="alert">Please fill out all the fields</div>';
        break;

        case 'success':
        echo '<div class="alert alert-success" role="alert">Weldone '.$firstname.', Your login was successfull</div>';
        header( 'location:home' );
        break;

    }
}
?>
<form  method = 'post'>
<div class = 'input-group mb-3'>
<input type = 'email' class = 'form-control' placeholder = 'Email' name = 'email' required>
<div class = 'input-group-append'>
<div class = 'input-group-text'>
<span class = 'fas fa-envelope'></span>
</div>
</div>
</div>
<div class = 'input-group mb-3'>
<input type = 'password' class = 'form-control' placeholder = 'Password' name = 'password' required>
<div class = 'input-group-append'>
<div class = 'input-group-text'>
<span class = 'fas fa-lock'></span>
</div>
</div>
</div>
<div class = 'row'>
<div class = 'col-8'>
<div class = 'icheck-primary'>
<input type = 'checkbox' id = 'remember' required>
<label for = 'remember'>
Remember Me
</label>
</div>
</div>
<!-- /.col -->
<div class = 'col-4'>
<button type = 'submit' class = 'btn btn-primary btn-block' onclick = 'update()' name = 'signin'>Sign In</button>
</div>
<!-- /.col -->
</div>
</form>

<div class = 'social-auth-links text-center mb-3'>
<p>- OR -</p>
<a href = '#' class = 'btn btn-block btn-primary'>
<i class = 'fab fa-facebook mr-2'></i> Sign in using Facebook
</a>
<a href = '#' class = 'btn btn-block btn-danger'>
<i class = 'fab fa-google-plus mr-2'></i> Sign in using Google+
</a>
</div>
<!-- /.social-auth-links -->

<p class = 'mb-1'>
<a href = 'forgot-password.html'>I forgot my password</a>
</p>
<p class = 'mb-0'>
<a href = 'signup' class = 'text-center'>Register a new membership</a>
</p>
</div>
<!-- /.login-card-body -->
</div>
</div>
<!-- /.login-box -->

