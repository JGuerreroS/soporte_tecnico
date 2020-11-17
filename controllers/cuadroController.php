<?php
require_once '../models/cuadroModels.php';

class cuadroController extends cuadroModels{

    public function cuadro_controlador(){

        $html = "";

        $datos = cuadroModels::cuadro_modelo();

        foreach ($datos as $value) {
            $html .= "
            <tr>
                <td> $value[0] </td>
                <td> $value[1] </td>
                <td> $value[2] </td>
                <td> $value[3] </td>
                <td> $value[4] </td>
                <td> $value[5] </td>
                <td> $value[6] </td>
                <td> $value[7] </td>
                <td> $value[8] </td>
                <td> $value[9] </td>
                <td> $value[10] </td>
                <td> $value[11] </td>
                <td> $value[12] </td>
            </tr>
            ";
        }

        return json_encode($html);

    }

}

echo cuadroController::cuadro_controlador();