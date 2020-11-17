<?php
if(is_file('../core/mainModel.php')){
    require_once '../core/mainModel.php';
}else{
    require_once './core/mainModel.php';
}

class ajaxModel extends mainModel{

    // Zoom users
    protected function zoom_user_model($id_usuario){

        $sql = "SELECT id_user, civ, nombre, rol, reg_date FROM users u
        INNER JOIN roles r ON (u.id_rol = r.id_rol)
        WHERE id_user = :user";

        $result = parent::conectar()->prepare($sql);

        $result->bindValue(":user", $id_usuario, PDO::PARAM_INT);

        $result->execute();

        if ($result->rowCount() > 0){

            $datos = $result->fetch();

            unset($result);
            unset($conexion);
        
            return $datos;

        }

    }

    // Zoom radios
    protected function zoom_radio_model($id_radio){

        $sql = "SELECT id_radio, serial, identificador, tipo, marca, modelo, status, dependencia, nombre, fec_emis, observacion, estado FROM radio_master r
        INNER JOIN modelos md ON (r.id_modelo = md.id_modelo)
        INNER JOIN tipo_equipo t ON (md.id_tipo = t.id_tipo)
        INNER JOIN marcas m ON (md.id_marca = m.id_marca)
		INNER JOIN estatus e ON (r.id_estatus = e.id_status)
		INNER JOIN dependencias d ON (r.id_dependencia = d.id_dependencia)
		INNER JOIN estados es ON (r.id_estado = es.id_estado)
		INNER JOIN users u ON (r.id_usuario = u.id_user) WHERE id_radio = :radio";

        $result = parent::conectar()->prepare($sql);

        $result->bindValue(":radio", $id_radio, PDO::PARAM_INT);

        $result->execute();

        if ($result->rowCount() > 0){

            $datos = $result->fetch();

            unset($result);
            unset($conexion);
        
            return $datos;

        }

    }

    // Delete users
    protected function eliminar_user_model($id_user){

        $sql = "UPDATE users SET id_status = 2 WHERE id_user = :id_user";
        
        $result = parent::conectar()->prepare($sql);

        $result->bindValue(":id_user", $id_user, PDO::PARAM_INT);

        $result->execute();

        $result_boolean = ($result->rowCount() > 0);

        unset($result);
        unset($conexion);

        return $result_boolean;
        
    }

    // Registrar users
    protected function registrar_usuarios_modelo($datos){

        session_start(['name' => 'NSW']);

        $sql = "INSERT INTO users (civ, nombre, id_status, reg_date, reg_user, id_rol, pass) VALUES (:username, :nombres, :estatus, :fecha, :user, :rol, :pass)";

        $result = parent::conectar()->prepare($sql);

        $result->bindValue(":username", $datos['user'], PDO::PARAM_STR);
        $result->bindValue(":nombres", $datos['names'], PDO::PARAM_STR);
        $result->bindValue(":estatus", 1, PDO::PARAM_INT);
        $result->bindValue(":fecha", date("Y-m-d"), PDO::PARAM_STR);
        $result->bindValue(":user", $_SESSION['id_user'], PDO::PARAM_INT);
        $result->bindValue(":rol", $datos['rol'], PDO::PARAM_INT);
        $result->bindValue(":pass", $datos['pass'], PDO::PARAM_STR);

        $result->execute();

        $result_boolean = ($result->rowCount() > 0);

        unset($result);
        unset($conexion);

        return $result_boolean;

    }

    // Registrar equipo
    protected function registrar_equipo_modelo($datos,$responsable){
        session_start(['name' => 'NSW']);

        self::registrar_responsable_modelo($responsable);

        $sql = "INSERT INTO registro_componentes(componente_id, serial_fabrica, serial_bien_nacional, condicion_id, observacion, responsable_id, user_id, fecha_registro, marca_id, parroquia_id, dependencia_id, modelo) VALUES (:componente, :serial1, :serial2, :condicion, :observacion, :responsable_id, :user, :fecha, :marca_id, :parroquia_id, :dependencia_id, :modelo)";
        $result = parent::conectar()->prepare($sql);

        /* $datos = [
            "serial1" => $serial1,
            "serial2" => $serial2,
            "componente" => $componente,
            "marca" => $marca,
            "modelo" => $modelo,
            "parroqia" => $parroqia,
            "dependencia" => $dependencia,
            "condicion" => $condicion,
            "observacion" => $observacion,
            "cedula" => $cedula,
            "cargo" => $cargo,
            "nombres" => $nombres,
            "telefono" => $telefono,
            "correo" => $correo,
        ]; */

        $result->bindValue(":serial1", $datos['serial1'], PDO::PARAM_STR);
        $result->bindValue(":serial2", $datos['serial2'], PDO::PARAM_STR);
        $result->bindValue(":componente", $datos['componente'], PDO::PARAM_STR);
        $result->bindValue(":marca_id", $datos['marca'], PDO::PARAM_INT);
        $result->bindValue(":modelo", $datos['modelo'], PDO::PARAM_INT);
        $result->bindValue(":parroquia_id", $datos['parroquia'], PDO::PARAM_INT);
        $result->bindValue(":dependencia_id", $datos['dependencia'], PDO::PARAM_INT);
        $result->bindValue(":condicion", $datos['condicion'], PDO::PARAM_INT);
        $result->bindValue(":observacion", $datos['observacion'], PDO::PARAM_STR);
        $result->bindValue(":user", $_SESSION['id_user'], PDO::PARAM_INT);
        $result->bindValue(":fecha", date("Y-m-d"), PDO::PARAM_STR);

        $result->execute();
        
        $result_boolean = ($result->rowCount() > 0);

        unset($result);
        unset($conexion);

        return true;

    }

    // Registrar responsable
    static function registrar_responsable_modelo($datos){
        // session_start(['name' => 'NSW']);
        $cedula = $datos['cedula'];
        // var_dump($datos); die();
        $result = parent::conectar()->prepare("SELECT cedula FROM responsable WHERE cedula = '$cedula'");
        $result->execute();
        if($result->rowCount() == 0){
            $sql = "INSERT INTO responsable (cedula,cargo,nombres,telefono,correo,user,fecha) VALUES (:cedula,:cargo,:nombres,:telefono,:correo,:user,:fecha)";
            $result = parent::conectar()->prepare($sql);
            $result->bindValue(":cedula", $datos['cedula'], PDO::PARAM_STR);
            $result->bindValue(":cargo", $datos['cargo'], PDO::PARAM_STR);
            $result->bindValue(":nombres", $datos['nombres'], PDO::PARAM_STR);
            $result->bindValue(":telefono", $datos['telefono'], PDO::PARAM_STR);
            $result->bindValue(":correo", $datos['correo'], PDO::PARAM_STR);
            $result->bindValue(":user", $_SESSION['id_user'], PDO::PARAM_INT);
            $result->bindValue(":fecha", date("Y-m-d"), PDO::PARAM_STR);
            $result->execute();
            unset($result);
            unset($conexion);
        }else{
            return false;
        }
    }

    // Registrar marcas
    protected function registrar_marca_modelo($marca){
        $sql = "INSERT INTO marcas (marca) VALUES (:marca)";
        $result = parent::conectar()->prepare($sql);
        $result->bindValue(":marca", $marca, PDO::PARAM_STR);
        $result->execute();
        if ($result->rowCount() > 0) {
            unset($result);
            unset($conexion);
            return true;
        }else{
            return false;
        }
    }

    // Registrar componente
    protected function registrar_componente_modelo($componente){
        $sql = "INSERT INTO componentes (componente) VALUES (:componente)";
        $result = parent::conectar()->prepare($sql);
        $result->bindValue(":componente", $componente, PDO::PARAM_STR);
        $result->execute();
        if ($result->rowCount() > 0) {
            unset($result);
            unset($conexion);
            return true;
        }else{
            return false;
        }
    }

    // Actualizar contraseña
    protected function actualizar_user_pass_model($old_pass,$new_pass){
        $sql = "UPDATE users SET pass = :new_pass WHERE id_user = :user AND pass = :current_pass";
        $result = parent::conectar()->prepare($sql);
        $result->bindValue(":new_pass", $new_pass, PDO::PARAM_STR);
        $result->bindValue(":current_pass", $old_pass, PDO::PARAM_STR);
        $result->bindValue(":user", $_SESSION['id_user'], PDO::PARAM_INT);
        $result->execute();
        $result_boolean = ($result->rowCount() > 0);
        unset($result);
        unset($conexion);
        return $result_boolean;
    }

    // Editar usuario en vista users
    protected function update_user_model($datos){

        $sql = "UPDATE users SET nombre = :nombre, id_status = :estatus WHERE civ = :user AND id_status = :estatus";

        $result = parent::conectar()->prepare($sql);

        $result->bindValue(":user", $datos['user'], PDO::PARAM_STR);
        $result->bindValue(":nombre", $datos['name'], PDO::PARAM_STR);
        $result->bindValue(":estatus", $datos['estatus'], PDO::PARAM_INT);

        $result->execute();

        $result_boolean = ($result->rowCount() > 0);

        unset($result);
        unset($conexion);

        return $result_boolean;
        
    }

    // Editar nombre en vista myaccount
    protected function updateuseraccountmodel($nombre){

        $sql = "UPDATE users SET nombre = :nombre WHERE id_user = :user";

        $result = parent::conectar()->prepare($sql);

        $result->bindValue(":nombre", $nombre, PDO::PARAM_STR);
        $result->bindValue(":user", $_SESSION['id_user'], PDO::PARAM_INT);

        $result->execute();

        $result_boolean = ($result->rowCount() > 0);

        unset($result);
        unset($conexion);

        return $result_boolean;

    }

    // Editar nombre en vista myaccount
    protected function count_users1_model(){

        $sql = "SELECT COUNT(id_user) FROM users WHERE id_rol = :rol AND id_status = :estatus";

        $result = parent::conectar()->prepare($sql);

        $result->bindValue(":estatus", 1, PDO::PARAM_INT);
        $result->bindValue(":rol", 1, PDO::PARAM_INT);

        $result->execute();

        if ($result->rowCount() > 0){

            $datos = $result->fetch();

            unset($result);
            unset($conexion);
        
            return $datos;

        }

    }

    // Editar nombre en vista myaccount
    protected function count_users2_model(){

        $sql = "SELECT COUNT(id_user) FROM users WHERE id_rol = :rol AND id_status = :estatus";

        $result = parent::conectar()->prepare($sql);

        $result->bindValue(":estatus", 1, PDO::PARAM_INT);
        $result->bindValue(":rol", 2, PDO::PARAM_INT);

        $result->execute();

        if ($result->rowCount() > 0){

            $datos = $result->fetch();

            unset($result);
            unset($conexion);
        
            return $datos;

        }

    }

    // Grafica del home
    protected function grafica_model(){
    
        // Linea 1
        $sql1 = "SELECT date_part('month',reg_date) AS fecha, COUNT(reg_date) AS total FROM users WHERE id_rol = 1 GROUP BY fecha ORDER BY fecha";

        $result1 = parent::conectar()->prepare($sql1);

        $result1->execute();
        
        $valX1 = array(); // Fecha
        $valY1 = array(); // ID

        foreach ($result1 as $row) {
            switch ($row[0]) {
                case '1':
                    $mes = "Enero";
                    break;
                case '2':
                    $mes = "Febrero";
                    break;
                case '3':
                    $mes = "Marzo";
                    break;
                case '4':
                    $mes = "Abril";
                    break;
                case '5':
                    $mes = "Mayo";
                    break;
                case '6':
                    $mes = "Junio";
                    break;
                case '7':
                    $mes = "Julio";
                    break;
                case '8':
                    $mes = "Agosto";
                    break;
                case '9':
                    $mes = "Septiembre";
                    break;
                case '10':
                    $mes = "Octubre";
                    break;
                case '11':
                    $mes = "Noviembre";
                    break;
                case '12':
                    $mes = "Diciembre";
                    break;
                
            }
            $valX1[] = $mes; //Fecha
            $valY1[] = $row[1]; // Total
        }
    
        $datosX1 = json_encode($valX1);
        $datosY1 = json_encode($valY1);
    
        // Linea 2
        $sql2 = "SELECT date_part('month',reg_date) AS fecha, COUNT(reg_date) FROM users WHERE id_rol = 2 GROUP BY fecha ORDER BY fecha";
    
        $result2 = parent::conectar()->prepare($sql2);

        $result2->execute();
    
        $valX2 = array(); // Fecha
        $valY2 = array(); // ID
    
        foreach ($result2 as $row) {
            switch ($row[0]) {
                case '1':
                    $mes = "Enero";
                    break;
                case '2':
                    $mes = "Febrero";
                    break;
                case '3':
                    $mes = "Marzo";
                    break;
                case '4':
                    $mes = "Abril";
                    break;
                case '5':
                    $mes = "Mayo";
                    break;
                case '6':
                    $mes = "Junio";
                    break;
                case '7':
                    $mes = "Julio";
                    break;
                case '8':
                    $mes = "Agosto";
                    break;
                case '9':
                    $mes = "Septiembre";
                    break;
                case '10':
                    $mes = "Octubre";
                    break;
                case '11':
                    $mes = "Noviembre";
                    break;
                case '12':
                    $mes = "Diciembre";
                    break;
                
            }
            $valX2[] = $mes; //Fecha
            $valY2[] = $row[1]; // Total
        }
    
        $datosX2 = json_encode($valX2);
        $datosY2 = json_encode($valY2);

        unset($result1);
        unset($result2);
        unset($conexion);
    
        return array($datosX1, $datosY1, $datosX2, $datosY2);
    
    }

    // Reporte PDF
    protected function reportepdf_model(){

        $sql = "SELECT civ, nombre, id_status, id_rol, reg_date FROM users";

        $result = parent::conectar()->prepare($sql);

        $result->execute();

        if ($result->rowCount() > 0){

            $datos = $result->fetchAll();

            unset($result);
            unset($conexion);
        
            return $datos;

        }

    }

    // Buscar en sigefirrhh
    protected function buscar_sigefirrhh_model($cedula){

        $sql = "SELECT t.cedula, estatus, primer_nombre||' '||segundo_nombre||' '||primer_apellido||' '|| segundo_apellido AS nombres, descripcion_cargo, nombre FROM trabajador t
        INNER JOIN personal p ON (t.id_personal = p.id_personal)
        INNER JOIN cargo c ON (t.id_cargo = c.id_cargo)
        INNER JOIN dependencia d ON (t.id_dependencia = d.id_dependencia)
        WHERE t.cedula = :cedula";

        $result = mainModel::conn()->prepare($sql);

        $result->bindValue(":cedula", $cedula, PDO::PARAM_INT);

        $result->execute();

        if ($result->rowCount()>0){

            return $result->fetch();

        }else{

            return "No";

        }

    }

    // Select marca de componentes
    protected function select_marca_model(){
        $sql = "SELECT id, marca FROM marcas ORDER BY marca";
        $result = parent::conectar()->prepare($sql);
        $result->execute();
        $datos = $result->fetchAll();
        unset($result);
        unset($conexion);
        return $datos;
    }

    // Select componentes
    protected function select_componente_model(){
        $sql = "SELECT id, componente FROM componentes ORDER BY componente";
        $result = parent::conectar()->prepare($sql);
        $result->execute();
        $datos = $result->fetchAll();
        unset($result);
        unset($conexion);
        return $datos;
    }

    // Select marca radio
    protected function select_modelo_model($id_marca){
        $sql = "SELECT id, modelo FROM modelos WHERE marca_id = :marca ORDER BY modelo";
        $result = parent::conectar()->prepare($sql);
        $result->bindValue(":marca", $id_marca, PDO::PARAM_INT);
        $result->execute();
        return $result->fetchAll();
    }

    // Select estados
    protected function select_estados_model(){
        
        $sql = "SELECT id_estado, estado FROM estados ORDER BY estado";

        $result = parent::conectar()->prepare($sql);

        $result->execute();

        return $result->fetchAll();

    }

    // Select municipios
    protected function select_municipios_model($id_estado){
        
        $sql = "SELECT id_municipio, municipio FROM municipios WHERE id_estado = :estado ORDER BY municipio";

        $result = parent::conectar()->prepare($sql);

        $result->bindValue(":estado", $id_estado, PDO::PARAM_INT);

        $result->execute();

        return $result->fetchAll();

    }

    // Select parroquias
    protected function select_parroquias_model($id_municipio){
        
        $sql = "SELECT id_parroquia, parroquia FROM parroquias WHERE id_municipio = :municipio ORDER BY parroquia";

        $result = parent::conectar()->prepare($sql);

        $result->bindValue(":municipio", $id_municipio, PDO::PARAM_INT);

        $result->execute();

        return $result->fetchAll();

    }

    // Select parroquias
    protected function select_dependencias_model(){
        
        $sql = "SELECT id_dependencia, dependencia FROM dependencias ORDER BY dependencia";

        $result = parent::conectar()->prepare($sql);

        $result->execute();

        return $result->fetchAll();

    }

    // Select estatus del radio
    protected function select_estatus_model(){
        $sql = "SELECT id_status, status FROM estatus WHERE id_status IN (4,8) ORDER BY status ASC";
        $result = parent::conectar()->prepare($sql);
        $result->execute();
        return $result->fetchAll();
    }

    // Buscar serial de radio
/*     protected function buscar_serial_model($serial){
        $sql = "SELECT id_radio FROM radio_master WHERE serial = :serial";
        $result = parent::conectar()->prepare($sql);
        $result->bindValue(":serial", $serial, PDO::PARAM_STR);
        $result->execute();
        $total = $result->rowCount();
        unset($result);
        unset($conexion);
        return $total;
    } */

    protected function buscar_marca_model($marca){
        $sql = "SELECT id FROM marcas WHERE marca = :marca";
        $result = parent::conectar()->prepare($sql);
        $result->bindValue(":marca", $marca, PDO::PARAM_STR);
        $result->execute();
        $total = $result->rowCount();
        unset($result);
        unset($conexion);
        return $total;
    }

    // Buscar ID del radio
    protected function buscar_idradio_model($id){

        $sql = "SELECT identificador FROM radio_master WHERE identificador = :id";

        $result = parent::conectar()->prepare($sql);

        $result->bindValue(":id", $id, PDO::PARAM_STR);

        $result->execute();

        $total = $result->rowCount();

        unset($result);
        unset($conexion);

        return $total;

    }

}