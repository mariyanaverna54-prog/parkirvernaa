<?php
class Database {
    public static function connect() {
        return new PDO("mysql:host=localhost;dbname=db_parkir;charset=utf8","root","");
    }
}
