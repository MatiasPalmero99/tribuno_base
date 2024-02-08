<?php 
session_start();
if(isset($_SESSION['usuario'])&&isset($_SESSION['id_persona'])){
include 'template/header_admin.html'; 
include 'conexiondb_club.php';

?>
<div id="layoutSidenav_content">
<?php
		$sql= "SELECT*FROM caja ORDER BY id_caja DESC LIMIT 1";
		$resultado=$conexionDB->query($sql);
		$row= $resultado->fetch_object();
		$caja=$row->ord_apertura;
?>
<?php
if($caja == 0){
// LA CAJA ESTÁ CERRADA
?>
	<main>
        <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-12 col-md-6">
                    <h1><?php echo $row->ord_apertura == 0 ? 'Apertura de caja' : 'Cierre de caja';?></h1>
                    <!-- <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol> -->
                </div>
                <div class="col-12 col-md-6 my-2">
                    <ol class="breadcrumb" style="float: right;">
                        <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="panel_admin.php">Panel Administración</a></li>
                        <li class="breadcrumb-item active"><?php echo $row->ord_apertura == 0 ? 'Apertura de caja' : 'Cierre de caja';?></li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-5 py-3">
				<form id="fapertura" action="admin/proc_caja.php" method="post">

				<div class="table-responsive shadow-sm p-0 mb-0 bg-white rounded-top">
					<table class="table table-hover table-sm">
					<thead class="table-dark">
						<tr>
							<th scope="col" colspan="2"><?php echo $row->ord_apertura == 0 ? 'Apertura de caja' : 'Cierre de caja';?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="col-3 font-italic">Fecha:</td>
							<td class="col-9 text-success" >
							<!--	<input type="text" id="f_cliente_denominacion" name="f_cliente_denominacion" value="CONSUMIDOR FINAL" class="inp-form-jac-error" style="width: 400px;display:none"/>  -->
								<span><?php
										date_default_timezone_set('America/Argentina/Salta');
										echo date("d/m/Y");
									?>
								</span>
							</td>
						</tr>
						<tr>
							<td class="col-3 font-italic">Estado:</td>
							<td class="col-9 text-danger" >
								<span><strong><?php echo $row->ord_apertura == 0 ? 'Caja cerrada' : 'Caja abierta';?></strong></span>
							</td>
						</tr>

						<!-- <tr>
							<td class="col-3 font-italic">Caja Inicial:</td>
							<td class="col-9 text-info" >
								<span>$ dasdas</span>
							</td>
						</tr> -->
						<tr>
							<td class="col-3 font-italic">Ingresar monto de Caja Inicial:</td>
							<td class="col-9 text-success" >
								<div class="form row">
									<label for="caja_monto_inicial" class="col-1 col-lg-1 col-form-label">$ </label>
									<div class="col-11 col-lg-5">
										<input type="text" class="form-control" name="caja_monto_inicial" id="caja_monto_inicial" value="0.00" />
										<label class="error" generated="true" for="caja_monto_inicial"></label>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td class="col-3 font-italic">Observaciones en apertura:</td>
							<td class="col-9 text-info" >
								<textarea id="caja_observaciones" name="caja_observaciones" rows="2" class="form-control" style="width: 100%;"></textarea>
							</td>
						</tr>
					</tbody>
					</table>
				</div>
				<div class="row my-3" class="class-table-caja">
                    <div class="container-fluid">
                        <div class="col-12 col-md-12">
                            <div class="row">
                                <div class="col-12 col-md-6 mt-3">
								<input type="submit" id="abrir_caja" name="abrir_caja" value="Abrir Caja" class="btn btn-success form-submit-btn" style="width: 100%;"/>
                                </div>
                                <div class="col-12 col-md-6 mt-3">
								<input type="button" value="Cancelar" class="btn btn-danger" style="width: 100%;"  onclick="history.back(-1);"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				</form>
                </div>
            </div>
        </div>
	</main>
<?php
}if($caja == 1){
// LA CAJA ESTÁ ABIERTA	
?>
	<main>	
		<div class="container-fluid">
            <div class="row mt-2">
                <div class="col-12 col-md-6">
                    <h1><?php echo $row->ord_apertura == 0 ? 'Apertura de caja' : 'Cierre de caja';?></h1>
                    <!-- <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol> -->
                </div>
                <div class="col-12 col-md-6 my-2">
                    <ol class="breadcrumb" style="float: right;">
                        <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="panel_admin.php">Panel Administración</a></li>
                        <li class="breadcrumb-item active"><?php echo $row->ord_apertura == 0 ? 'Apertura de caja' : 'Cierre de caja';?></li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-5 py-3">
					<form id="fapertura" action="admin/proc_caja.php" method="post">

					<div class="table-responsive shadow-sm p-0 mb-0 bg-white rounded-top">
						<table class="table table-hover table-sm">
						<thead class="table-dark">
							<tr>
								<th scope="col" colspan="2"><?php echo $row->ord_apertura == 0 ? 'Apertura de caja' : 'Cierre de caja';?></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="col-5 font-italic">Estado:</td>
								<td class="col-7 text-success" >
								<!--	<input type="text" id="f_cliente_denominacion" name="f_cliente_denominacion" value="CONSUMIDOR FINAL" class="inp-form-jac-error" style="width: 400px;display:none"/>  -->
									<span><strong><?php echo $row->ord_apertura == 0 ? 'Caja cerrada' : 'Caja abierta';?></strong></span>
								</td>
							</tr>
							<tr>
								<td class="col-5 font-italic">Caja Inicial:</td>
								<td class="col-7 text-info text-end" >
								<!--	<input type="text" id="f_cliente_denominacion" name="f_cliente_denominacion" value="CONSUMIDOR FINAL" class="inp-form-jac-error" style="width: 400px;display:none"/>  -->
									<span><strong>$ <?php echo number_format($row->mon_ini,2,'.','');?></strong></span>
								</td>
							</tr>
							<tr>
								<td class="col-5 font-italic">Caja Diaria:</td>
								<td class="col-7 text-info text-end" >
								<!--	<input type="text" id="f_cliente_denominacion" name="f_cliente_denominacion" value="CONSUMIDOR FINAL" class="inp-form-jac-error" style="width: 400px;display:none"/>  -->
									<span><strong>$ <?php echo number_format($row->saldo_caja,2,'.','');?></strong></span>
								</td>
							</tr>
<?php
							$total_caja= $row->mon_ini + $row->saldo_caja;
?>	
							<tr>
								<td class="col-5 font-italic">TOTAL:</td>
								<td class="col-7 text-danger text-end" >
								<!--	<input type="text" id="f_cliente_denominacion" name="f_cliente_denominacion" value="CONSUMIDOR FINAL" class="inp-form-jac-error" style="width: 400px;display:none"/>  -->
									<span><strong>$ <?php echo number_format($total_caja,2,'.','');?></strong></span>
								</td>
							</tr>
						</tbody>
						</table>
					</div>
					<div class="row my-3">
						<div class="container-fluid">
							<div class="col-12 col-md-12">
								<div class="row">
									<div class="col-12 col-md-6 mt-3">
									<input type="submit" id="cerrar_caja" name="cerrar_caja" value="Cerrar Caja" class="btn btn-warning form-submit-btn" style="width: 100%;"/>
									</div>
									<div class="col-12 col-md-6 mt-3">
									<input type="button" value="Cancelar" class="btn btn-dark" style="width: 100%;"  onclick="history.back(-1);"/>
									</div>
								</div>
							</div>
						</div>
					</div>

					</form>
                </div>
            </div>
        </div>
    </main>
<?php
}
?>
<?php 
include 'template/footer_admin.html' ; 
}else{
    header("Location: login/login_index.php");
}
?>

