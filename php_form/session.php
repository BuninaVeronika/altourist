<?php
session_start();
if(isset($_SESSION['cooki_hash'])) { 
echo "Сессия"; 
}
else { 
session_destroy();
echo "Нет";
}