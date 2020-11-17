<?php
require_once '../models/cuadroModel2.php';

class cuadroController extends cuadroModel2{

    public function cuadro_controlador(){

        $html = "";

        $datos = cuadroModel2::cuadro_modelo();

        foreach ($datos as $value) {
            $html .= "
            <tr>
                <td> $value[0] </td>
                <td> $value[1] </td>
                <td class='text-center font-weight-bold'> $value[2] </td>
                <td class='text-center font-weight-bold'> $value[3] </td>
                <td class='text-center font-weight-bold'> $value[4] </td>
                <td class='text-center font-weight-bold'> $value[5] </td>
            </tr>
            ";
        }

        return json_encode($html);

    }

}

echo cuadroController::cuadro_controlador();