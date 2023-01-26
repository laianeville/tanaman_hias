<?php

session_start();

session_destroy();

header('Location: /tanamanhias/login.php');
