<?php
    class Config{

    public static function connect():PDO {
            return new PDO(dsn:"mysql:host=localhost;dbname=")
    }
    }
