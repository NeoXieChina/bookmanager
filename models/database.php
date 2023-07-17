<?php
    function getDataBaseHander() {
        //服务器
        $pdo = new PDO( 'mysql:host=localhost;dbname=bookmanager;charset=utf8;', 'root', 'root' );
        $pdo->query("set names utf8;"); 
        return $pdo;
    }
?>