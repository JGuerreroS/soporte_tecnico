<?php

require_once '../core/mainModel.php';

class cuadroModels extends mainModel{

    protected function cuadro_modelo(){

        $sql = "SELECT DISTINCT estado,
        /*Teltronic*/
        (SELECT COUNT(id_tipo) FROM modelos m 
            INNER JOIN radio_master rm ON (rm.id_modelo = m.id_modelo)
             WHERE id_tipo = 1 AND rm.id_estado = e.id_estado AND id_marca = 2)
        AS eb_tel,
        
        (SELECT COUNT(id_tipo) FROM modelos m 
            INNER JOIN radio_master rm ON (rm.id_modelo = m.id_modelo)
             WHERE id_tipo = 2 AND rm.id_estado = e.id_estado AND id_marca = 2)
        AS mov_tel,
        
        (SELECT COUNT(id_tipo) FROM modelos m 
            INNER JOIN radio_master rm ON (rm.id_modelo = m.id_modelo)
             WHERE id_tipo = 3 AND rm.id_estado = e.id_estado AND id_marca = 2)
        AS por_tel,
        --Total tectronic
        (SELECT COUNT(id_tipo) FROM modelos m 
            INNER JOIN radio_master rm ON (rm.id_modelo = m.id_modelo)
             WHERE rm.id_estado = e.id_estado AND id_marca = 2) AS total_teltronic,
        
        /*Motorolla*/
        (SELECT COUNT(id_tipo) FROM modelos m 
            INNER JOIN radio_master rm ON (rm.id_modelo = m.id_modelo)
             WHERE id_tipo = 1 AND rm.id_estado = e.id_estado AND id_marca = 1)
        AS eb_moto,
        
        (SELECT COUNT(id_tipo) FROM modelos m 
            INNER JOIN radio_master rm ON (rm.id_modelo = m.id_modelo)
             WHERE id_tipo = 2 AND rm.id_estado = e.id_estado AND id_marca = 1)
        AS mov_moto,
        
        (SELECT COUNT(id_tipo) FROM modelos m 
            INNER JOIN radio_master rm ON (rm.id_modelo = m.id_modelo)
             WHERE id_tipo = 3 AND rm.id_estado = e.id_estado AND id_marca = 1)
        AS por_moto,
        --Total Motorolla
        (SELECT COUNT(id_tipo) FROM modelos m 
            INNER JOIN radio_master rm ON (rm.id_modelo = m.id_modelo)
             WHERE rm.id_estado = e.id_estado AND id_marca = 1) AS total_motorolla,
        /*HYTERA*/
        (SELECT COUNT(id_tipo) FROM modelos m 
            INNER JOIN radio_master rm ON (rm.id_modelo = m.id_modelo)
             WHERE id_tipo = 3 AND rm.id_estado = e.id_estado AND id_marca = 3)
        AS por_hyt,
        
        (SELECT COUNT(id_tipo) FROM modelos m 
            INNER JOIN radio_master rm ON (rm.id_modelo = m.id_modelo)
             WHERE id_tipo = 2 AND rm.id_estado = e.id_estado AND id_marca = 3)
        AS mov_hyt,
        --Total Hytera
        (SELECT COUNT(id_tipo) FROM modelos m 
            INNER JOIN radio_master rm ON (rm.id_modelo = m.id_modelo)
             WHERE rm.id_estado = e.id_estado AND id_marca = 3) AS total_hytera,
        
        COUNT(e.estado) AS total
        
        
        FROM radio_master rm
        INNER JOIN estados e ON (rm.id_estado = e.id_estado)
        GROUP BY estado,eb_tel,mov_tel,por_tel,total_teltronic,eb_moto,mov_moto,por_moto,total_motorolla,por_hyt,mov_hyt,total_hytera,e.estado ORDER BY estado";

        $result = mainModel::conectar()->prepare($sql);

        $result->execute();

        return $result->fetchAll();

    }
    
    
}