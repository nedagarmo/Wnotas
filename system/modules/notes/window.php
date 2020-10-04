<script type="text/javascript" src="modules/notes/javascripts/functions.js"></script>

<div id="window_notes" class="abs window">
      <div class="abs window_inner">
        <div class="window_top">
          <span class="float_left">
            <img src="../images/desktop/icons/theme_one/64x64/icon-02.png" />
            Notas
          </span>
          <span class="float_right">
            <a href="#" class="window_min"></a>
            <a href="#" class="window_resize"></a>
            <a href="#icon_dock_notes" class="window_close"></a>
          </span>
        </div>
        <div class="abs window_content">
            <div class="window_aside">
				Notas del Estudiante
			</div>
			<div class="window_main">
				<p>Por favor, no olvide que el formato aceptado por el sistema consta de dos (2) columnas básicas (documento y grupo) el resto es el número de equivalencia de cada nota que usted quiere ingresar por alumno (Ej: 30,30,40).</p><br />
				<a href="javascript:;" id="notes_upload"><img src="../images/general/btn_csv.png" border="0" width="40" /><p>Procesar Archivo de Notas<p></a>
				<br />
				<div class="filtering">
					<form>
						Estudiante: <input type="text" name="name_notes" id="name_notes" />
						Grupo: <select name="group_notes" id="group_notes" >
									<?php
										include_once("../core/data.bases/simple.connection.class.php");
										if($_SESSION['role'] == 1){
											$sql = "SELECT g.id, g.nombre FROM grupo g INNER JOIN carrera_semestre_materia csm ON g.carrera_semestre_materia = csm.id INNER JOIN inscripcion_materia im ON g.id = im.grupo ORDER BY g.nombre ASC";
										}else{
											$sql = "SELECT g.id, g.nombre FROM grupo g INNER JOIN carrera_semestre_materia csm ON g.carrera_semestre_materia = csm.id INNER JOIN inscripcion_materia im ON g.id = im.grupo WHERE im.usuario = ". $_SESSION['id'] ." ORDER BY g.nombre ASC";
										}
										$exe = mysql_query($sql);
										while($row = mysql_fetch_array($exe)){
											echo "<option value='".$row[0]."'>".$row[1]."</option>";
										}
									?>
							   </select>
						<button type="submit" id="search_notes_records">Buscar</button>
					</form>
				</div>
				<div id="notes_table_container"></div>
			</div>
        </div>
        <div class="abs window_bottom">
          Listo
        </div>
      </div>
      <span class="abs ui-resizable-handle ui-resizable-se"></span>
</div>