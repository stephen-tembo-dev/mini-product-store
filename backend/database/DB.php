<?php

namespace app\database;

use PDO;

class DB
{
  private static $instance;
  private $db;

  private function __construct()
  {
    try {

      $db_host = getenv('DB_HOST');
      $db_name = getenv('DB_NAME');
      $db_username = getenv('DB_USERNAME');
      $db_password = getenv('DB_PASSWORD');

      $dsn = "mysql:host=localhost;dbname=ecomm";
      $username = "root";
      $password = "";

      $this->db = new PDO($dsn, $username, $password);

      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
      // Handle the exception
    }
  }

  public static function getInstance()
  {
    if (self::$instance === null) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function getDB()
  {
    return $this->db;
  }
}
