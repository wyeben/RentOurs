<?php
session_start();

function set_user_session($user_id, $username) {
    $_SESSION['user_id'] = $user_id;
    $_SESSION['username'] = $username;
}

function get_user_session() {
    if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
        return array(
            'user_id' => $_SESSION['user_id'],
            'username' => $_SESSION['username']
        );
    } else {
        return null;
    }
}

function clear_user_session() {
    unset($_SESSION['user_id']);
    unset($_SESSION['username']);
}
?>
