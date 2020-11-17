<?php
require_once '../core/mainModel.php';

session_start(['name' => 'NSW']);

class radioModel extends mainModel{

    protected function lista_radio_modelo(){

        $sql = "SELECT id_radio, serial, identificador, tipo, marca, modelo, status, dependencia FROM radio_master r
        INNER JOIN modelos md ON (r.id_modelo = md.id_modelo)
        INNER JOIN tipo_equipo t ON (md.id_tipo = t.id_tipo)
        INNER JOIN marcas m ON (md.id_marca = m.id_marca)
		INNER JOIN dependencias d ON (r.id_dependencia = d.id_dependencia)
		INNER JOIN estatus e ON (r.id_estatus = e.id_status) ORDER BY id_radio DESC";

        $query = mainModel::conectar()->prepare($sql);

        $query->execute();

        $datos = $query->fetchAll();

        unset($query);
        unset($conexion);

        return $datos;
        
    }

}