<script type="text/javascript" src="modules/subjects/javascripts/functions.js"></script>

<div id="window_subjects" class="abs window">
      <div class="abs window_inner">
        <div class="window_top">
          <span class="float_left">
            <img src="../images/desktop/icons/theme_one/64x64/icon-19.png" />
            Lista de Materias
          </span>
          <span class="float_right">
            <a href="#" class="window_min"></a>
            <a href="#" class="window_resize"></a>
            <a href="#icon_dock_subjects" class="window_close"></a>
          </span>
        </div>
        <div class="abs window_content">
            <div class="window_aside">
				CRUD - Materias
			</div>
			<div class="window_main">
				<div class="filtering">
					<form>
						Sigla / Nombre: <input type="text" name="subjects_name" id="subjects_name" />
						<button type="submit" id="subjects_search_records">Buscar</button>
					</form>
				</div>
				<div id="subjects_table_container"></div>
			</div>
        </div>
        <div class="abs window_bottom">
          Listo
        </div>
      </div>
      <span class="abs ui-resizable-handle ui-resizable-se"></span>
</div>