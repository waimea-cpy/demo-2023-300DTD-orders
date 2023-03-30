<?php

    require_once 'common-top.php';

    echo '<section>';

    echo '<h2>Logging You In...</h2>';

    // Clear out any previous login details
    // session_unset();
    unset( $_SESSION['user'] );

    // Get data from form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Get the user info from the DB
    $sql = 'SELECT *
            FROM users
            WHERE username=?';
    $users = getRecords( $sql, 's', [$username] );

    // If no user with that username, they need to make an account
    if( count( $users ) == 0 ) showErrorAndDie( 'No account with that username exists' );

    // User exists, so get their record (should be only one)
    $user = $users[0];

    // Check the hashed password against stored hash
    if( password_verify( $password, $user['hash'] ) == false ) showErrorAndDie( 'Incorrect password' );

    // Password is correct, so store user details in the session
    $_SESSION['user']['id']       = $user['id'];
    $_SESSION['user']['username'] = $user['username'];
    $_SESSION['user']['forename'] = $user['forename'];
    $_SESSION['user']['surname']  = $user['surname'];

    // Say hello, and head back to home page
    showStatus( 'Welcome, '.$user['forename'] );
    addRedirect( 2000, 'index.php' );

    echo '</section>';

    require_once 'common-bottom.php';
?>
