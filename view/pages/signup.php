<?php include 'files/links.php';
$bdd = new PDO( 'mysql:host=localhost; dbname=emmaksst; charset=UTF8', 'root', '' );
if ( isset( $_POST[ 'reg' ] ) ) {
    if ( !empty( $_POST[ 'firstname' ] ) && !empty( $_POST[ 'lastname' ] ) && !empty( $_POST[ 'email' ] )
    && !empty( $_POST[ 'password' ] ) && !empty( $_POST[ 'password2' ] ) && !empty( $_POST[ 'role' ] ) ) {
        $firstname = htmlspecialchars( $_POST[ 'firstname' ] );
        $lastname = htmlspecialchars( $_POST[ 'lastname' ] );
        $email = htmlspecialchars( $_POST[ 'email' ] );
        $password = htmlspecialchars( $_POST[ 'password' ] );
        $confirmpassword = htmlspecialchars( $_POST[ 'password2' ] );
        $role = htmlspecialchars( $_POST[ 'role' ] );
        if ( $password == $confirmpassword ) {
            if ( filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
                $check = $bdd->prepare( 'SELECT email FROM users WHERE email=?' );
                $check->execute( array( $email ) );
                $data = $check->fetch();
                $row = $check->rowCount();
                if ( $row == 0 ) {
                    function genererChaineAleatoire( $longueur = 10 ) {
                        return substr( str_shuffle( str_repeat( '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil( $longueur / 62 ) ) ), 0, $longueur );
                    }
                    // Utilisation de la fonction
                    genererChaineAleatoire();
                    // Chaîne aléatoire de 10 caractères
                    genererChaineAleatoire( 20 );
                    // Chaîne aléatoire de 20 caractères
                    $mot = genererChaineAleatoire().genererChaineAleatoire( 20 );

                    $regUser = $bdd->prepare( 'INSERT INTO users (firstname, lastname, email, password, rollnumber,access)  VALUES(?,?,?,?,?,?)' );
                    $regUser->execute( array( $firstname, $lastname, $email, $password, $mot, $role ) );
                    $err='success';
                } else $err='email_existing';
            }else $err='email_invalid';
        } else $err='password';
    } else $err='empty';
}
?>

<meta charset="utf-8">
<title>Emmak School of Science and Technology</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<meta content="Free HTML Templates" name="keywords">
<meta content="Free HTML Templates" name="description">

<!-- Favicon -->
<link href="view/pages/includes/img/favicon.png" rel="icon">
<link href="view\pages\img\favicon.png" rel="apple-touch-icon">

<body class="hold-transition register-page">
  <div class="register-box">
    <div class="register-logo">
      <a href="./"><b>E</b>mmak <b>S</b>chool of <b>S</b>cience and <b>T</b>echnology</a>
    </div>

    <div class="card">
      <div class="card-body register-card-body">
        <p class="login-box-msg">Register a new membership</p>
        <?php
        if (isset($err)) {
         
          switch ($err) {
            case 'password':
              echo '<div class="alert alert-danger" role="alert">Passwords don\'t match</div>';
              break;
            case 'empty':
              echo '<div class="alert alert-danger" role="alert">Please fill out all the fields</div>';
              break;
            case 'email_invalid':
              echo '<div class="alert alert-danger" role="alert">Email incorrect </div>';
              break;
            case 'success':
              echo '<div class="alert alert-success" role="alert">Weldone'.$firstname.', Your account has been created Success</div>';
              header('Location:login');
              break;
            case 'email_existing':
              echo '<div class="alert alert-danger" role="alert">Email already used </div>';
          }
        }
        ?>

        <form method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="First name" name="firstname" required>
            <input type="text" class="form-control" placeholder="Last name" name="lastname" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" name="email" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Retype password" name="password2" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleSelectBorder">I am</code></label>
            <select class="form-control" id="exampleSelectBorder" name="role" required>
              <option value="">--Select--</option>
              <option value="1">Learner</option>
              <option value="2">Tutor</option>
            </select>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
                <label for="agreeTerms">
                  I agree to the <a href="#">terms</a>
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block" name="reg">Register</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-primary">
            <i class="fab fa-facebook mr-2"></i>
            Sign up using Facebook
          </a>
          <a href="#" class="btn btn-block btn-danger">
            <i class="fab fa-google-plus mr-2"></i>
            Sign up using Google+
          </a>
        </div>

        <a href="login" class="text-center">I already have a membership</a>
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
  <!-- /.register-box -->