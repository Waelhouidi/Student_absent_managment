<?php
class DataBase{
    private $host = "localhost";
    private $base_name = "absence";
    private $username = "root";
    private $password = "";
    public $connexion;
  public function connect() {
        $this->connexion = new mysqli($this->host, $this->username, $this->password, $this->basename);
        if ($this->connexion->connect_error) {
            die("Connection failed: " . $this->connexion->connect_error);
        }
        return $this->connexion;
    }

}

?>