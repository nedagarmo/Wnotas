<script type="text/javascript" src="modules/careers/javascripts/functions.js"></script>

<div id="window_careers" class="abs window">
      <div class="abs window_inner">
        <div class="window_top">
          <span class="float_left">
            <img src="../images/desktop/icons/theme_one/64x64/icon-17.png" />
            Lista de Carreras de la Universidad
          </span>
          <span class="float_right">
            <a href="#" class="window_min"></a>
            <a href="#" class="window_resize"></a>
            <a href="#icon_dock_careers" class="window_close"></a>
          </span>
        </div>
        <div class="abs window_content">
            <div class="window_aside">
				CRUD - Carreras disponibles en la universidad.
			</div>
			<div class="window_main">
				<div class="filtering">
					<form>
						Sigla / Nombre: <input type="text" name="careers_name" id="careers_name" />
						<button type="submit" id="careers_search_records">Buscar</button>
					</form>
				</div>
				<div id="careers_table_container"></div>
			</div>
        </div>
        <div class="abs window_bottom">
          Listo
        </div>
      </div>
      <span class="abs ui-resizable-handle ui-resizable-se"></span>
</div>