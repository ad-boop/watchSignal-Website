<?php
// php for checking if staff is logged in
    //Start session management
    session_start();
    
    // if session for staff login exists
    if( array_key_exists("loggedInStaffEmail", $_SESSION) ){
        echo "ok";
    }
    // else
    else{
        echo 'Not logged in.';
    }
