<?php


class Conexion {
    public $isConnected;
    protected $conexion_db;
    private $username = "root";
    private $password = "";
    private $dbname = "login";
    private $host = "localhost";

    # métodos abstractos para ABM de clases que hereden
    public function __construct(){
        $this->isConnected = true;
        try {
            $this->conexion_db = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=utf8", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            $this->conexion_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conexion_db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }catch(PDOException $e) {
            $this->isConnected = false;
            throw new Exception($e->getMessage());
        }
    }
    //disconnecting from database
    //$database->Disconnect();
    public function Disconnect(){
        $this->conexion_db = null;
        $this->isConnected = false;
    }
    //Getting row
    //$getrow = $database->getRow("SELECT email, username FROM users WHERE username =?", array("yusaf"));
    public function getRow($query, $params=array()){
        try{
            $stmt = $this->conexion_db->prepare($query);
            $stmt->execute($params);
            return $stmt->fetch();
        }catch(PDOException $e){
            throw new Exception($e->getMessage());
        }
    }
    //Getting multiple rows
    //$getrows = $conexion_dbase->getRows("SELECT id, username FROM users");
    public function getRows($QUERY){
        try{
            $stmt = $this->conexion_db->prepare($QUERY);
            $stmt->execute();
            return $stmt->fetchAll();
        }catch(PDOException $e){
            throw new Exception($e->getMessage());
        }
    }

    //inserting un campo SELECT id_Instituciones FROM Instituciones
    //$insertrow = $database ->insertRow("INSERT INTO users (username, email) VALUES (?, ?)", array("yusaf", "yusaf@email.com"));
    public function insertRow($query, $params){
        try{
            $stmt = $this->conexion_db->prepare($query);
            $stmt->execute($params);
        }catch(PDOException $e){
            throw new Exception($e->getMessage());
        }
    }



    //updating existing row
    //$updaterow = $database->updateRow("UPDATE users SET username = ?, email = ? WHERE id = ?", array("yusafk", "yusafk@email.com", "1"));
    public function updateRow($query, $params){
        return $this->insertRow($query, $params);
    }
    //delete a row
    //$deleterow = $database->deleteRow("DELETE FROM users WHERE id = ?", array("1"));
    public function deleteRow($query, $params){
        return $this->insertRow($query, $params);
    }




}