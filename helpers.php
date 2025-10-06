<?php
function start_session_once() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}
?>