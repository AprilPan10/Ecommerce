<?php
session_start();
unset($_SESSION['username']);
unset($_SESSION['id']);
unset($_SESSION['role']);
?>
<div class="container block">
    <h3>You have logged out</h3>
</div>
