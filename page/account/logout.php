<?php
session_start();
session_unset();
session_destroy();
header("Location: /Fujifilm_Shop/admin/login.php");
exit();
?>