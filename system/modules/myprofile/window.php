<script type="text/javascript" src="modules/myprofile/javascripts/functions.js"></script>

<div id="window_myprofile" class="abs window">
      <div class="abs window_inner">
        <div class="window_top">
          <span class="float_left">
            <img src="../images/desktop/icons/theme_one/64x64/icon-09.png" />
            Mi Perfil
          </span>
          <span class="float_right">
            <a href="#" class="window_min"></a>
            <a href="#" class="window_resize"></a>
            <a href="#icon_dock_myprofile" class="window_close"></a>
          </span>
        </div>
        <div class="abs window_content">
            <div class="window_aside">
				Actualizaci&oacute;n de datos del perfil personal.<br /><br />
				<strong>Mis Carreras</strong><br />
				<ul>
					<?php
						include_once('../core/data.bases/simple.connection.class.php');
						$sql_my_careers = " SELECT c.* FROM carrera c INNER JOIN usuario_carrera uc ON c.id = uc.carrera WHERE uc.usuario = ".$_SESSION['id'];
						$exe_my_careers = mysql_query($sql_my_careers);
						while($row_my_careers = mysql_fetch_array($exe_my_careers))
						{
					?>
							<li><?php echo $row_my_careers['sigla']." - ".$row_my_careers['nombre']; ?></li>
					<?php
						}
					?>
				</ul>
			</div>
			<div class="window_main">
				<div class="filtering">&Uacute;nicamente se podr&aacute;n modificar los campos marcados con (<span style="color: #FD0404;">*</span>).  Los otros campos se muestran a manera de informaci&oacute;n.
				<br /> Si requiere actualizar datos que el formulario no permite, por favor, contacte al administrador del sistema.</div>
				<form id="frm_myprofile_update" name="frm_myprofile_update">
					<label for="myprofile_name">Nombres: </label><br /><input type="text" id="myprofile_name" name="myprofile_name" readonly="true" /><br />
					<label for="myprofile_lastname">Apellidos: </label><br /><input type="text" id="myprofile_lastname" name="myprofile_lastname" readonly="true" /><br />
					<label for="myprofile_document">Identificaci&oacute;n: </label><br /><input type="text" id="myprofile_document" name="myprofile_document" readonly="true" /><br />
					<label for="myprofile_email"><span style="color: #FD0404;">*</span> Correo: </label><br /><input type="text" id="myprofile_email" name="myprofile_email" /><br />
					<label for="myprofile_password"><span style="color: #FD0404;">*</span> Contrase&ntilde;a: </label><br /><input type="password" id="myprofile_password" name="myprofile_password" /><br />
					<input type="button" value="Guardar" name="btn_save_profile" id="btn_save_profile">
				</form>
			</div>
        </div>
        <div class="abs window_bottom">
          Listo
        </div>
      </div>
      <span class="abs ui-resizable-handle ui-resizable-se"></span>
</div>