<?php

require ("../connection.php");

class registers_news_letter extends Conexion
{

public function __construct()
{
    parent::__construct();
}

    public function getRegistersById()
    {
        $sql = "SELECT * FROM registers_news_letter ORDER BY id ASC";

        $sentencia = $this->conexion_db->prepare($sql);

        $sentencia->execute(array());

        $result=$sentencia->fetchAll(PDO::FETCH_ASSOC);

        $sentencia->closeCursor();

        return($result);
    }    
}

$objRegisters = new registers_news_letter();

$result = $objRegisters->getRegistersById();

echo json_encode($result);

?>

