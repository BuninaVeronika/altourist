<?php
session_start();
setcookie("email","",time()-3600,"/");
setcookie("cooki_hash","",time()-3600,"/");
unset($_SESSION["cooki_hash"]);