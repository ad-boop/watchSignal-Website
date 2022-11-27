<?php
    //Start session management
    session_start();
    
    // if theres an emial
    if( array_key_exists("loggedInCustomerEmail", $_SESSION) ){
        echo "ok";
    }
    else{
        echo 'Not logged in.';
    }


