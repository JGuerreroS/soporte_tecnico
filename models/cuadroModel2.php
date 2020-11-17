<?php

require_once '../core/mainModel.php';

class cuadroModel2 extends mainModel{

    protected function cuadro_modelo(){

        $sql = "WITH t AS(

            SELECT split_part(estados,'-',1) AS estado, split_part(estados,'-',2) AS tipo, MOTOROLA, TELTRONIC, HYTERA from crosstab(
            $$
            SELECT estado||'-'||tipo AS estados, marca, COUNT(marca) 
        
            FROM radio_master rm
        
            INNER JOIN estados e ON (rm.id_estado = e.id_estado)
            INNER JOIN modelos m ON (rm.id_modelo = m.id_modelo)
            INNER JOIN marcas mr ON (m.id_marca = mr.id_marca)
            INNER JOIN tipo_equipo te ON (m.id_tipo = te.id_tipo)
        
            GROUP BY estados,mr.marca ORDER BY estados
        
            $$,$$
        
            SELECT DISTINCT marca FROM radio_master rm
            INNER JOIN modelos m ON (rm.id_modelo = m.id_modelo)
            INNER JOIN marcas mr ON (m.id_marca = mr.id_marca)
        
            $$)
            
            AS (
        
            estados text,
            MOTOROLA NUMERIC,
            TELTRONIC NUMERIC,
            HYTERA NUMERIC
        
            )
        )
        SELECT * ,
            COALESCE(MOTOROLA,0)+
            COALESCE(TELTRONIC,0)+
            COALESCE(HYTERA,0) total_estado_tipo FROM t
            UNION ALL
            SELECT '' estado, 'Total' tipo,
        
        SUM(MOTOROLA),
        SUM(TELTRONIC),
        SUM(HYTERA),
        
        SUM(
            COALESCE(MOTOROLA,0)+
            COALESCE(TELTRONIC,0)+
            COALESCE(HYTERA,0)
        ) total_marca
        FROM t";

        $result = mainModel::conectar()->prepare($sql);

        $result->execute();

        return $result->fetchAll();

    }
    
    
}