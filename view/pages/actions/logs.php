<?php
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