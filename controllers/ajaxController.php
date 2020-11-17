<?php
if(is_file('../models/ajaxModel.php')){
    require_once '../models/ajaxModel.php';
}else{
    require_once './models/ajaxModel.php';
}

class ajaxController extends ajaxModel{

    // Zoom users
    public function zoom_user_controlador($id_usuario){

        $id_usuario = mainModel::limpiar_cadena($id_usuario);

        return ajaxModel::zoom_user_model($id_usuario);
        
    }

    // Zoom radios
    public function zoom_radio_controlador($id_radio){

        $id_radio = mainModel::limpiar_cadena($id_radio);

        return ajaxModel::zoom_radio_model($id_radio);
        
    }

    // Delete users
    public function eliminar_user_controller($id_user){

        return ajaxModel::eliminar_user_model($id_user);

    }

    // Registrar users
    public function registrar_usuarios_controlador($user,$pass,$name,$rol){
        $user = parent::limpiar_cadena($user);
        $pass = parent::limpiar_cadena($pass);
        $pass = parent::encriptar($pass);
        $name = parent::limpiar_cadena($name);
        $rol  = parent::limpiar_cadena($rol);
        $datos = array("user" => $user, "pass" => $pass, "names" => $name, "rol" => $rol);
        return ajaxModel::registrar_usuarios_modelo($datos);
    }

    // Registrar equipo
    public function registrar_equipos_controlador($data){
        $serial1 = parent::limpiar_cadena($data['serial1']);
        $serial2 = parent::limpiar_cadena($data['serial2']);
        $componente = parent::limpiar_cadena($data['componente']);
        $marca = parent::limpiar_cadena($data['marca']);
        $modelo = parent::limpiar_cadena($data['modelo']);
        $parroqia = parent::limpiar_cadena($data['parroquia']);
        $dependencia = parent::limpiar_cadena($data['dependencia']);
        $condicion = parent::limpiar_cadena($data['condicion']);
        $observacion = parent::limpiar_cadena($data['observacion']);
        $cedula = parent::limpiar_cadena($data['cedula']);
        $cargo = parent::limpiar_cadena($data['cargo']);
        $nombres = parent::limpiar_cadena($data['nombres']);
        $telefono = parent::limpiar_cadena($data['telefono']);
        $correo = parent::limpiar_cadena($data['correo']);

        $datos = [
            "serial1" => $serial1,
            "serial2" => $serial2,
            "componente" => $componente,
            "marca" => $marca,
            "modelo" => $modelo,
            "parroquia" => $parroqia,
            "dependencia" => $dependencia,
            "condicion" => $condicion,
            "observacion" => $observacion
        ];

        $responsable = [
            "cedula" => $cedula,
            "cargo" => $cargo,
            "nombres" => $nombres,
            "telefono" => $telefono,
            "correo" => $correo
        ];
        return parent::registrar_equipo_modelo($datos,$responsable);
    }
/* 
    // Registrar equipo
    public function registrar_radios_controlador($serial,$idradio,$modelo,$dependencia,$estatus,$estado,$observacion){
        $serial = parent::limpiar_cadena($serial);
        $idradio = parent::limpiar_cadena($idradio);
        $modelo = parent::limpiar_cadena($modelo);
        $estado  = parent::limpiar_cadena($estado);
        $dependencia  = parent::limpiar_cadena($dependencia);
        $estatus  = parent::limpiar_cadena($estatus);
        $observacion = parent::limpiar_cadena($observacion);

        $datos = array("serial" => $serial, "idradio" => $idradio, "modelo" => $modelo, "dependencia" => $dependencia, "estatus" => $estatus, "observacion" => $observacion, "estado" => $estado);

        return ajaxModel::registrar_radios_modelo($datos);
    } */

    // Actualizar contraseña
    public function actualizar_user_pass_controller($old_pass,$new_pass){

        $old_pass = parent::limpiar_cadena($old_pass);
        $old_pass = parent::encriptar($old_pass);
        $new_pass = parent::limpiar_cadena($new_pass);
        $new_pass = parent::encriptar($new_pass);

        return ajaxModel::actualizar_user_pass_model($old_pass,$new_pass);

    }

    // Editar usuario en vista users
    public function update_user_controller($usuario,$nombre,$estatus){

        $user = mainModel::limpiar_cadena($usuario);
        $name = mainModel::limpiar_cadena($nombre);
        $status = mainModel::limpiar_cadena($estatus);

        $datos = array("user" => $user, "name" => $name, "estatus" => $status);

        return ajaxModel::update_user_model($datos);
        
    }

    // Editar nombre en vista myaccount
    public function updateuseraccountcontroller($nombre){

        $nombre = mainModel::limpiar_cadena($nombre);

        return ajaxModel::updateuseraccountmodel($nombre);

    }

    // Contar usuarios
    public function count_users1_controller(){

        return ajaxModel::count_users1_model();

    }

    // Contar usuarios
    public function count_users2_controller(){

        return ajaxModel::count_users2_model();

    }

    // Grafica del home
    public function grafica_controller(){

        return ajaxModel::grafica_model();

    }

    // Reporte PDF
    public function reportepdf_controller(){

        return ajaxModel::reportepdf_model();
        
    }

    // Buscar en sigefirrhh
    public function buscar_sigefirrhh_controller($cedula){

        $cedula = mainModel::limpiar_cadena($cedula);

        $datos = ajaxModel::buscar_sigefirrhh_model($cedula);

        return json_encode($datos);

    }

    // Select modelo de componente
    public function select_modelo_controller($id_marca){
        $datos = ajaxModel::select_modelo_model($id_marca);
        $html = "<option value=''>Modelo</option>";
        foreach ($datos as $value){ 
            $html.="<option value='$value[0]'>".$value[1]."</option>";
        }
        unset($datos);
        unset($conexion);
        return $html;
    }

    // Select estados
    public function select_estados_controller(){

        $datos = ajaxModel::select_estados_model();

        $html = "<option value=''>Estados</option>";

        foreach ($datos as $value){
            
            $html.="<option value='$value[id_estado]'>".$value['estado']."</option>";

        }

        unset($datos);
        unset($conexion);

        return $html;

    }

    // Select municipios2
    public function select_municipios_controller($id_estado){

        $datos = ajaxModel::select_municipios_model($id_estado);

        $html = "<option value=''>Municipios</option>";

        foreach ($datos as $value){
            
            $html.="<option value='$value[id_municipio]'>".$value['municipio']."</option>";

        }

        unset($datos);
        unset($conexion);

        return $html;

    }

    // Select parroquias
    public function select_parroquias_controller($id_municipio){

        $datos = ajaxModel::select_parroquias_model($id_municipio);

        $html = "<option value=''>Parroquias</option>";

        foreach ($datos as $value){
            
            $html.="<option value='$value[id_parroquia]'>".$value['parroquia']."</option>";

        }

        unset($datos);
        unset($conexion);

        return $html;

    }

    // Select parroquias
    public function select_dependencias_controller(){

        $datos = ajaxModel::select_dependencias_model();

        $html = "<option value=''>Dependencias</option>";

        foreach ($datos as $value){
            
            $html.="<option value='$value[id_dependencia]'>".$value['dependencia']."</option>";

        }

        unset($datos);
        unset($conexion);

        return $html;

    }

    // Select estatus del radio
    public function select_estatus_controller(){
        $datos = parent::select_estatus_model();
        $html = "<option value=''>Estatus</option>";
        foreach ($datos as $value){
            $html.="<option value='$value[id_status]'>".$value['status']."</option>";
        }
        unset($datos);
        unset($conexion);
        return $html;
    }

/*     // Buscar serial del equipo
    public function buscar_serial_controller($serial){
        $serial = mainModel::limpiar_cadena($serial);
        $total = ajaxController::buscar_serial_model($serial);
        if($total){
            return "El serial <b>$serial</b> ya se encuentra registrado en la base de datos";
        }else{
            return false;
        }

    } */

    // Buscar marca repetida
    public function buscar_marca_controller($marca){
        $marca = mainModel::limpiar_cadena($marca);
        $total = ajaxController::buscar_marca_model($marca);
        if($total){
            return "El marca <b>$marca</b> ya se encuentra registrado en la base de datos";
        }else{
            return false;
        }
    }

    // Buscar ID del radio
    public function buscar_idradio_controller($id){

        $id = mainModel::limpiar_cadena($id);

        $total = ajaxController::buscar_idradio_model($id);

        if($total){

            return "El ID <b>$id</b> ya se encuentra registrado en la base de datos";

        }else{
            
            return false;
            
        }

    }

    // Registrar marca
    public function registrar_marca_controlador($marca){
        if ($marca=="") {
            return 2;
        }
        return parent::registrar_marca_modelo($marca);
    }

    // Registrar componente
    public function registrar_componente_controlador($componente){
        if ($componente=="") {
            return 2;
        }
        return parent::registrar_componente_modelo($componente);
    }

    // Select marca de componente
    public function select_marca_controller(){
        $datos = parent::select_marca_model();
        $html = "<option value=''>Marca</option>";
        foreach ($datos as $value){
            $html.="<option value='$value[0]'>".$value[1]."</option>";
        }
        return $html;
    }

    // Select tipo de componente
    public function select_componente_controller(){
        $datos = parent::select_componente_model();
        $html = "<option value=''>Seleccione</option>";
        foreach ($datos as $value){
            $html.="<option value='{$value[0]}'>".$value[1]."</option>";
        }
        return $html;
    }
}

if(isset($_POST['serial1']) && isset($_POST['serial2'])){
    
    echo ajaxController::registrar_equipos_controlador($_POST);
    
}

// Select de componente
if(isset($_GET['selectComponente'])){
    echo ajaxController::select_componente_controller();
}

// Select marca de componente
if(isset($_GET['selectMarca'])){
    echo ajaxController::select_marca_controller();
}

// registrar marca
if(isset($_POST['registrar_marca'])){         
    echo ajaxController::registrar_marca_controlador($_POST['registrar_marca']);
}

// registrar componente
if(isset($_POST['registrar_componente'])){        
    echo ajaxController::registrar_componente_controlador($_POST['registrar_componente']);
}

// Zoom users
if (isset($_GET['zoom_user'])){
    echo json_encode(ajaxController::zoom_user_controlador($_GET['zoom_user']));
}

// Zoom radios
if (isset($_GET['zoom_radio'])){
    echo json_encode(ajaxController::zoom_radio_controlador($_GET['zoom_radio']));
}

// Delete users
if (isset($_GET['d_user'])){
    echo ajaxController::eliminar_user_controller($_GET['d_user']);
}

// Create users
if (isset($_POST['frm_civ']) && isset($_POST['frm_pass']) && isset($_POST['frm_name']) && isset($_POST['frm_rol'])){

    if (empty($_POST['frm_civ']) || empty($_POST['frm_pass']) || empty($_POST['frm_name']) || empty($_POST['frm_rol'])){

        echo 2; // Formulario incompleto
        
    }else{
        
        echo ajaxController::registrar_usuarios_controlador($_POST['frm_civ'],$_POST['frm_pass'],$_POST['frm_name'],$_POST['frm_rol']);

    }

}

// Actualizar contraseña
if (isset($_POST['current_pass']) && isset($_POST['new_pass'])){

    echo ajaxController::actualizar_user_pass_controller($_POST['current_pass'],$_POST['new_pass']);

}

// Editar usuario en vista users
if (isset($_POST['usuario']) && isset($_POST['name']) && isset($_POST['status'])) {
    
    echo ajaxController::update_user_controller($_POST['usuario'], $_POST['name'], $_POST['status']);
        
}

// Editar nombre en vista myaccount
if (isset($_POST['my_a_name'])){
    
    echo ajaxController::updateuseraccountcontroller($_POST['my_a_name']);
    
}

// Buscar en sigefirrhh
if (isset($_POST['cedula'])) {
    
    echo ajaxController::buscar_sigefirrhh_controller($_POST['cedula']);

}

// Select municipios
if (isset($_GET['id_est'])){

    echo ajaxController::select_municipios_controller($_GET['id_est']);

}

// Select parroquias
if (isset($_GET['id_mun'])){

    echo ajaxController::select_parroquias_controller($_GET['id_mun']);

}

// Select marcas
if (isset($_GET['tipo'])){

    echo ajaxController::select_marca_controller($_GET['tipo']);

}

// Select modelo
if (isset($_GET['marca'])){

    echo ajaxController::select_modelo_controller($_GET['marca']);

}

// Buscar marca
if (isset($_GET['buscar_serial'])){
    echo ajaxController::buscar_marca_controller($_GET['buscar_marca']);
}

// Buscar id del radio
if (isset($_GET['buscar_idradio'])){

    echo ajaxController::buscar_idradio_controller($_GET['buscar_idradio']);

}