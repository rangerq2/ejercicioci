<div class="alert alert-success" style="display: none;"></div>

<button id="btnAdd" class="btn btn-success my-3 border-0">Agregar Usuario</button>
<table id="myTable" class="table table-bordered mt-3">
    <thead>
        <tr>
            <td>ID</td>
            <td>Perfil</td>
            <td>Nombre</td>
            <td>Apellido</td>
            <td>Email</td>
            <td>Telefono</td>
            <td>Acciones</td>
        </tr>
    </thead>
    <tbody id="showdata">

    </tbody>
</table>

<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close m-0 p-0" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                <form id="myForm" action="" method="post" class="form-horizontal" novalidate>
                    <input type="hidden" name="id" value="0">
                    <div class="form-group">
                        <label for="nombre" class="label-control col-md-4 required">Nombre *</label>
                        <div class="col-md-8">
                            <input type="text" name="nombre" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="apellido" class="label-control col-md-4 required">Apellido *</label>
                        <div class="col-md-8">
                            <input type="text" name="apellido" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="label-control col-md-4">E-mail</label>
                        <div class="col-md-8">
                            <input type="text" name="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telefono" class="label-control col-md-4 required">Telefono *</label>
                        <div class="col-md-8">
                            <input type="text" name="telefono" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_perfil" class="label-control col-md-4">Perfil *</label>
                        <div class="col-md-8">
                            <select name="id_perfil" id="id_perfil">
                                <?php foreach ($get_profiles as $profiles) { ?>
                                <option value="<?php echo $profiles->id ?>">
                                    <?php echo $profiles->descripcion; ?>
                                </option>
                                <?php 
                            } ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" id="btnSave" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>

<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close m-0 p-0" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Confirmar eliminacion</h4>
            </div>
            <div class="modal-body">
                Quieres eliminar el usuario?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default mx-2" data-dismiss="modal">Cerrar</button>
                <button type="button" id="btnDelete" class="btn btn-danger mx-2">Eliminar</button>
            </div>
        </div>
    </div>
</div> 