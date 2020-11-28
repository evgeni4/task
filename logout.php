<?php
session_start();
session_destroy();
header("Location: ".dirname($_SERVER['PHP_SELF']));
exit;