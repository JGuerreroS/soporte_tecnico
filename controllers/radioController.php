<?php
require_once '../models/radioModel.php';

class radioController extends radioModel{

    public function lista_radios_controller(){

        $datos = radioModel::lista_radio_modelo();

        $tabla = "";

        $nro = 0;

        foreach ($datos as $value){ $nro++;

            $zoom = "<span class='btn btn-info btn-sm' data-toggle='modal' data-target='#zoom-radio-modal' onclick='zoom_radio(".$value['id_radio'].")'> <i class='icon-zoom-in'></i> </span>";

            //$delete = "<span class='btn btn-danger btn-sm' onclick='delete_radio(".$value['id_radio'].")'> <i class='icon-bin'></i> </span>";

            $tabla.= '{
                "nro": "'.$nro.'",
                "serial": "'.$value['serial'].'",
                "identificador": "'.$value['identificador'].'",
                "tipo": "'.$value['tipo'].'",
                "marca": "'.$value['marca'].'",
                "modelo": "'.$value['modelo'].'",
                "estatus": "'.$value['status'].'",
                "dependencia": "'.$value['dependencia'].'",
                "opciones": "'.$zoom.'"
            },';

        }

        $tabla = substr($tabla,0,strlen($tabla)-1);

        return '{"data":['.$tabla.']}';

    }

}

echo radioController::lista_radios_controller();