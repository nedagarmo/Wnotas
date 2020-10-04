<script type="text/javascript" src="modules/states/javascripts/functions.js"></script>

<div id="window_states" class="abs window">
      <div class="abs window_inner">
        <div class="window_top">
          <span class="float_left">
            <img src="../images/desktop/icons/theme_one/64x64/icon-12.png" />
            Estados
          </span>
          <span class="float_right">
            <a href="#" class="window_min"></a>
            <a href="#" class="window_resize"></a>
            <a href="#icon_dock_states" class="window_close"></a>
          </span>
        </div>
        <div class="abs window_content">
            <div class="window_aside">
				CRUD - Administraci&oacute;n de Estados
			</div>
			<div class="window_main">
				<div class="filtering">
					<form>
						Nombre: <input type="text" name="name_states" id="name_states" />
						<button type="submit" id="search_states_records">Buscar</button>
					</form>
				</div>
				<div id="states_table_container"></div>
			</div>
        </div>
        <div class="abs window_bottom">
          Listo
        </div>
      </div>
      <span class="abs ui-resizable-handle ui-resizable-se"></span>
</div>