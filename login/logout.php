<?php
require("../common/session.php");

if(Session::current())
    Session::logout();

header('Location: /');