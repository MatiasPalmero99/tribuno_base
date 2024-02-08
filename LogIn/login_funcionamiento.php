<?php

if(isset($_POST['enviar'])){
    include('../conexiondb_club.php');
    session_start();

    $usuario=$_POST['user'];
    $clave=$_POST['contra_usuario'];
    $clave_cod=md5($clave);
    $sesion= false;

    $consulta="SELECT 
                personas.id_persona,
                personas.dni_persona,
                personas.nom_usuario,
                personas.nom_usuario,
                personas.password,

                personasxrol.id_usuario,
                personasxrol.id_persona,
                personasxrol.id_rol

                FROM personas 
                INNER JOIN personasxrol ON personasxrol.id_persona=personas.id_persona
                
                WHERE personas.nom_usuario='$usuario' AND personas.password='$clave_cod'
                AND personasxrol.id_rol='5'";
    $resultado= $conexionDB->query($consulta);

    $info_pers=$conexionDB->query($consulta);
    $info= $info_pers->fetch_object();

    $filas=mysqli_num_rows($resultado);

    if($filas){
        $sesion= true;
        $_SESSION['usuario'] = $usuario;
        $_SESSION['dni_persona'] = $info->dni_persona;
        $_SESSION['id_persona'] = $info->id_persona;
        $_SESSION['id_usuario'] = $info->id_usuario;
        header("location:../panel_admin.php");
    }else{
        header("location:login_index.php?mensaje=error");

    }
    mysqli_free_result($resultado);
    mysqli_close($conexionDB);
}
?>
