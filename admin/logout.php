<?php
session_start();
unset(filter_input(INPUT_SESSION, 'id'));
session_destroy();
header("Location: index.php");
?>
