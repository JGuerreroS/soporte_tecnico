<!-- Modal Zoom Users -->
<div class="modal fade" id="zoom-user-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">Datos del usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <label for="usuario">Usuario:</label>
                <p id="usuario"></p>

                <label for="nombre">Nombres:</label>
                <p id="nombre"></p>

                <label for="fecha_reg">Rol:</label>
                <p id="rol"></p>

                <label for="fecha">Fecha de registro:</label>
                <p id="fecha"></p>

                <form id="frmEditUser">

                    <div class="form-group">
                        <label for="frmEditName">Editar Nombre</label>
                        <input type="text" class="form-control" name="frmEditName" id="frmEditName" placeholder="Nombre del usuario">
                    </div>

                    <div class="form-group">
                        <label for="frmEditStatus">Cambiar estatus</label>
                        <select name="frmEditStatus" id="frmEditStatus" class="custom-select">
                            <option value="1">Activo</option>
                            <option value="2">Desactivar</option>
                        </select>
                    </div>

                </form>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="btn-edit-user" class="btn btn-warning">Editar</button>
                <button type="button" id="btn-editsave-user" class="btn btn-primary">Guardar</button>

            </div>
        </div>
    </div>
</div>

<!-- Modal Zoom Radios -->
<div class="modal fade" id="zoom-radio-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">Datos del radio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <div class="row">

                    <div class="col-6">

                        <label for="mserial">Serial:</label>
                        <p id="mserial"></p>

                    </div>

                    <div class="col-6">

                        <label for="mid">ID:</label>
                        <p id="mid"></p>

                    </div>

                </div>

                <hr>

                <div class="row">

                    <div class="col-4">

                        <label for="mtipo">Tipo:</label>
                        <p id="mtipo"></p>

                    </div>

                    <div class="col-4">

                        <label for="mmarca">Marca:</label>
                        <p id="mmarca"></p>

                    </div>

                    <div class="col-4">

                        <label for="mmodelo">Modelo:</label>
                        <p id="mmodelo"></p>

                    </div>

                </div>

                <hr>

                <div class="row">

                    <div class="col-6">

                        <label for="mdependencia">Dependencia:</label>
                        <p id="mdependencia"></p>

                    </div>

                    <div class="col-6">

                        <label for="mestado">Estado:</label>
                        <p id="mestado"></p>

                    </div>

                </div>

                <hr>

                <div class="form-group">

                    <label for="mestatus">Estatus:</label>
                    <p id="mestatus"></p>

                </div>

                <div class="form-group">

                    <label for="mobser">Observación:</label>
                    <p id="mobser"></p>

                </div>

                <hr class="bg-info">

                <div class="row">

                    <div class="col-6">

                        <label for="muser">Registrado por:</label>
                        <p id="muser"></p>

                    </div>

                    <div class="col-6">

                        <label for="mfecha">Fecha de registro:</label>
                        <p id="mfecha"></p>

                    </div>

                </div>


            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

            </div>
        </div>
    </div>
</div>

<!-- Modal Registrar Users -->
<div class="modal fade" id="reg-user-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Registrar nuevo usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-12">

                        <form id="frm-reg-user" autocomplete="off">

                            <div class="form-inline">

                                <div class="form-group">
                                    <label for="frm_civ">Cédula: </label>
                                    <input type="text" class="form-control ml-4" name="frm_civ" id="frm_civ">
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary ml-4" style="border-color:grey" id="buscar_sigef">Buscar</button>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="frm_name">Nombres</label>
                                <input type="text" class="form-control" name="frm_name" id="frm_name" placeholder="Nombres">
                            </div>

                            <div class="row">

                                <div class="col-6">
                                    <div class="form-group">

                                        <label for="frm_cargo">Cargo</label>
                                        <input type="text" class="form-control" name="frm_cargo" id="frm_cargo">

                                    </div>
                                </div>

                                <div class="col-6">

                                    <div class="form-group">
                                        <label for="frm_pass">Contraseña</label>
                                        <input type="password" class="form-control" name="frm_pass" id="frm_pass">
                                    </div>

                                </div>

                            </div>

                            <div class="form-group">

                                <label for="frm_dependencia">Dependencia</label>
                                <input type="text" class="form-control" name="frm_dependencia" id="frm_dependencia">

                            </div>

                            <div class="form-group">
                                <label for="frm_rol">Privilegios</label>
                                <select class="custom-select" name="frm_rol" id="frm_rol">
                                    <option value="">Seleccione los privilegios</option>
                                    <option value="1">Administrador</option>
                                    <option value="2">Analista</option>
                                </select>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal Registrar equipo -->
<div class="modal fade" id="reg-equipo-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" style="max-width: 800px !important;" role="document">
        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Registrar componente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-12">

                        <form id="frm-reg-equipo" autocomplete="off">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="tipo">Serial de fabrica</label>
                                        <input type="text" class="form-control" name="serial1" id="serial1" placeholder="Serial del radio">
                                    </div>

                                    <div class="col-6">
                                        <label for="tipo">N° Bienes Nacionales</label>
                                        <input type="text" class="form-control" name="serial2" id="serial2" placeholder="ID del radio">
                                        <!-- <input type="text" class="form-control" name="serial2" id="serial2" placeholder="ID del radio" onblur="buscarID(this.value)"> -->
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">

                                <div class="row">

                                    <div class="col-4">

                                        <label for="tipo">Componente</label>
                                        <select class="custom-select" name="componente" id="selectComponente">
                                            <option value="">Componentes</option>
                                        </select>

                                    </div>

                                    <div class="col-4">
                                        <label for="marca">Marca</label>
                                        <select class="custom-select" name="marca" id="selectMarca">
                                            <option value="">Marcas</option>
                                        </select>
                                    </div>

                                    <div class="col-4">
                                        <label for="modelo">Modelo</label>
                                        <!-- <select class="custom-select" name="modelo" id="modelo">
                                            <option value="">Modelos</option>
                                        </select> -->
                                        <input class="form-control" type="text" name="modelo" id="modelo" placeholder="Modelo">
                                    </div>

                                </div>

                            </div>

                            <div class="form-group">

                                <div class="row">

                                    <div class="col-4">

                                        <label for="estado">Estado</label>
                                        <select class="custom-select" name="estado" id="estado">
                                            <?= $selects->select_estados_controller(); ?>
                                        </select>

                                    </div>

                                    <div class="col-4">

                                        <label for="municipio">Municipio</label>
                                        <select class="custom-select" name="municipio" id="municipio">
                                            <option value=''>Municipios</option>
                                        </select>
                                        
                                    </div>

                                    <div class="col-4">

                                        <label for="parroq">Parroquia</label>
                                        <select class="custom-select" name="parroquia" id="parroquia">
                                            <option value=''>Parroquias</option>
                                        </select>
                                        
                                    </div>

                                </div>

                            </div>

                            <div class="form-group">

                                <div class="row">

                                    <div class="col-8">

                                        <label for="depend">Dependencia</label>
                                        <select class="custom-select" name="dependencia" id="dependencia">
                                            <?= $selects->select_dependencias_controller(); ?>
                                        </select>

                                    </div>

                                    <div class="col-4">

                                        <label for="estatus">Condición</label>
                                        <select class="custom-select" name="condicion" id="condicion">
                                            <?=$selects->select_estatus_controller()?>
                                        </select>

                                    </div>

                                </div>

                            </div>

                            <div class="form-group">

                                <label for="mobs">Observación:</label>
                                <textarea name="observacion" id="mobs" rows="3" class="form-control" placeholder="Observaciones"></textarea>

                            </div>

                            <h3>Datos de la persona que trae el equipo</h3>

                            <div class="row mb-5">

                                <div class="col-3">
                                    <label for="tipo">Cédula</label>
                                    <input type="text" class="form-control" name="cedula" id="cedula" placeholder="Cédula del funcionario" maxlength="10">
                                </div>

                                <div class="col-3">
                                    <label for="tipo">Cargo</label>
                                    <input type="text" class="form-control" name="cargo" id="cargo" placeholder="Jerarquía o cargo" maxlength="20">
                                </div>

                                <div class="col-6">
                                    <label for="tipo">Nombres</label>
                                    <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Nombre del funcionario">
                                </div>

                            </div>

                            <div class="row mb-5">

                                <div class="col-3">
                                    <label for="tipo">Teléfono</label>
                                    <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Télefono" maxlength="15">
                                </div>

                                <div class="col-6">
                                    <label for="tipo">Correo</label>
                                    <input type="email" class="form-control" name="correo" id="correo" placeholder="E-mail">
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" id="reg_equipo" class="btn btn-primary">Guardar</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal Registrar Marcas -->
<div class="modal fade reg-marca-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">

    <div class="modal-content">

        <h5 class="modal-title m-auto">Registrar marca</h5>

        <hr>

        <div class="row">
            <div class="col-12">

                <form id="frm-reg-marca" autocomplete="off">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-10">
                                <label class="ml-2">Nombre de la marca</label>
                                <input type="text" class="form-control ml-2" name="nombre_marca" id="nombre_marca" placeholder="Agregar marca">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" id="registrar_marca" class="btn btn-primary">Guardar</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
  </div>
</div>

<!-- Modal Registrar tipo de Componentes -->
<div class="modal fade reg-component-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">

    <div class="modal-content">

        <h5 class="modal-title m-auto">Registrar nuevo componente</h5>

        <hr>

        <div class="row">
            <div class="col-12">

                <form id="frm-reg-component" autocomplete="off">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-10">
                                <label class="ml-2">Nombre del componente</label>
                                <input type="text" class="form-control ml-2" name="nombre_componente" id="nombre_componente" placeholder="Agregar componente">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" id="registrar_componente" class="btn btn-primary">Guardar</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
  </div>
</div>