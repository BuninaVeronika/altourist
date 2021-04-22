<?php
$connect=mysqli_connect("localhost","root","");
if(!$connect)
{
    die("СУБД не подключена".mysqli_errno());
}
mysqli_set_charset($connect,"utf8");
if (!mysqli_select_db($connect,"altouruist_degree_bd"))
{
    die("Ошибка БД".mysqli_errno());
}