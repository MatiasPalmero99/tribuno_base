<?php include 'template/header-pages.html'; ?>

<?php

    if(!isset($_GET['codigo'])){
        header('Location: personas_editar.php?mensaje=error');
        exit();
    }
    require('conexiondb_club.php');

        $idPersona= $_GET['codigo'];
        $instruccionSql= "SELECT*FROM personas WHERE id_persona='$idPersona'";
        $resultado=$conexionDB->query($instruccionSql); 
        $fila= $resultado->fetch_object()
        
?>

<div class="container">

    <div class="row">
        <div class="col-12 col-md-1">

        </div>
        <div class="col-12 col-md-10">
            <form action='admin/abm-personas.php' method="POST">
                <div class="row pt-3">
                    <div class="mb-3 col-12 col-lg-6">
                        <label for="exampleInputNombre" class="form-label">Nombre:</label>
                        <input type="text" name="nom_persona" class="form-control" id="exampleInputNombre" aria-describedby="nombreHelp" required value="<?php echo $fila->nom_persona ?>">
                        <div id="nombreHelp" class="form-text">Ingresar nombre completo.</div>
                    </div>
                    <div class="mb-3 col-12 col-lg-6">
                        <label for="exampleInputId" class="form-label">Apellido: </label>
                        <input type="text" name="ape_persona" class="form-control" id="exampleInputNombre" aria-describedby="idHelp" required value="<?php echo $fila->ape_persona ?>">
                        <div id="idHelp" class="form-text">Ingresar apellido/s.</div>
                    </div>

                </div>

                <div class="row">
                    <div class="mb-3 col-12 col-lg-6">
                        <label for="exampleInputNombre" class="form-label">DNI: </label>
                        <input type="number" name="dni_persona" class="form-control" id="exampleInputNombre" aria-describedby="nombreHelp" required value="<?php echo $fila->dni_persona ?>">
                        <div id="nombreHelp" class="form-text">Ingresar DNI.</div>
                    </div>
                    <div class="mb-3 col-12 col-lg-6">
                        <label for="exampleInputCel" class="form-label">Número de celular</label>
                        <input type="number" name="cel_persona" class="form-control" id="exampleInputCel" aria-describedby="celHelp" required value="<?php echo $fila->cel_persona ?>">
                        <div id="celHelp" class="form-text">Ingrese número de celular para contactarnos.</div>
                    </div>
               
                </div>

                <div class="row">
                    <div class="mb-3 col-12 col-lg-6">
                        <label for="exampleInputEmail1" class="form-label">Correo electrónico</label>
                        <input type="email" name="correo_persona" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required value="<?php echo $fila->correo_persona ?>">
                        <div id="emailHelp" class="form-text">Ingresar dirección de correo electrónico.</div>
                    </div>

                    <div class="mb-3 col-12 col-lg-6">
                        <label for="exampleInputEmail1" class="form-label">Nombre de Usuario</label>
                        <input type="text" name="nom_usuario" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required value="<?php echo $fila->nom_usuario ?>">
                        <div id="emailHelp" class="form-text">Ingresar dirección de correo electrónico.</div>
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 col-12 col-lg-6">
                        <label for="exampleInputCel" class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" id="exampleInputCel" aria-describedby="celHelp" required value="<?php echo $fila->password ?>">
                        <div id="celHelp" class="form-text">Ingresar Contraseña.</div>
                    </div>
                    <div class="mb-3 col-12 col-lg-6">
                        <label for="exampleInputEmail1" class="form-label">Domicilio</label>
                        <input type="text" name="domicilio_persona" class="form-control" id="exampleInputEmail1" aria-describedby="domHelp" required value="<?php echo $fila->domicilio_persona ?>">
                        <div id="emailHelp" class="form-text">Ingrese la fecha de nacimiento.</div>
                    </div>

                </div>

                <div class="row">               
                    <div class="mb-3 col-12 col-lg-6">
                        <label for="exampleInputEmail1" class="form-label">Fecha de nacimiento</label>
                        <input type="date" name="fec_persona" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required value="<?php echo $fila->fch_nac_persona ?>">
                        <div id="emailHelp" class="form-text">Ingrese la fecha de nacimiento.</div>
                    </div>
                </div>

                <div class="d-grid text-center my-3 mx-5">
                    <input type="hidden" name="codigo" value="<?php echo $fila->id_persona ?>">
                    <input type="submit" name="Modificar" id="idModificar" class="btn btn-success mb-5" value="Modificar">
                </div>
            </form>
            
        </div>
        <div class="col-12 col-md-1">

        </div>
    </div>
</div>