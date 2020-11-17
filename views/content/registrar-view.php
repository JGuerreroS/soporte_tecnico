<?php if($_SESSION['nivel'] == 1){ require_once './controllers/ajaxController.php'; $selects = new ajaxController(); ?>

    <div class="card">

        <div class="card-header font-weight-bold">
            Componentes registrados
        </div>

        <div class="card-body">

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reg-equipo-modal">
                Registrar componente
            </button>

            <!-- <a href="<?= SERVERURL; ?>reporte/" target="_blank" class="btn btn-warning" title="Reporte PDF">
                <i class="icon-file-pdf"></i> Reporte
            </a> -->
            
            <hr>

            <!-- Tabla de lista de usuarios -->
            <table id='radioTable' class='table table-bordered table-responsive-sm'>
                <thead>
                    <tr>
                        <th class='text-center'> N° </th>
                        <th class='text-center'> Serial </th>
                        <th class='text-center'> ID </th>
                        <th class='text-center'> Tipo </th>
                        <th class='text-center'> Marca </th>
                        <th class='text-center'> Modelo </th>
                        <th class='text-center'> Estatus </th>
                        <th class='text-center'> Dependencia </th>
                        <th class='text-center'> Opciones </th>
                    </tr>
                </thead>

                <tfoot>
                    <tr>
                        <th class='text-center'> N° </th>
                        <th class='text-center'> Serial </th>
                        <th class='text-center'> ID </th>
                        <th class='text-center'> Tipo </th>
                        <th class='text-center'> Marca </th>
                        <th class='text-center'> Modelo </th>
                        <th class='text-center'> Estatus </th>
                        <th class='text-center'> Dependencia </th>
                        <th class='text-center'> Opciones </th>
                    </tr>
                </tfoot>
            </table>

        </div>

<?php }else{ ?>

    <div class="card">

        <div class="card-header font-weight-bold">
            Acceso prohibido!
        </div>

        <div class="card-body">
            <h5 class="card-title">No tienes privilegios suficientes para acceder a este módulo</h5>
        </div>
<?php } ?>