<script type="text/javascript" src="modules/configurations/javascripts/functions.js"></script>

<div id="window_configurations" class="abs window">
      <div class="abs window_inner">
        <div class="window_top">
          <span class="float_left">
            <img src="../images/desktop/icons/theme_one/64x64/icon-13.png" />
            Lista de Configuraciones
          </span>
          <span class="float_right">
            <a href="#" class="window_min"></a>
            <a href="#" class="window_resize"></a>
            <a href="#icon_dock_configurations" class="window_close"></a>
          </span>
        </div>
        <div class="abs window_content">
            <div class="window_aside">
				Configuraciones Globales del Sistema.
			</div>
			<div class="window_main">
				<div class="filtering">
					<form>
						<?php if(isset($equivalencias_cortes)) { echo $equivalencias_cortes; } ?>
						Nombre: <input type="text" name="configurations_name" id="configurations_name" />
						<button type="submit" id="configurations_search_records">Buscar</button>
					</form>
				</div>
				<div id="configurations_table_container"></div>
			</div>
        </div>
        <div class="abs window_bottom">
          Listo
        </div>
      </div>
      <span class="abs ui-resizable-handle ui-resizable-se"></span>
</div>