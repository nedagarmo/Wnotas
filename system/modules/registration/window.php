<script type="text/javascript" src="modules/registration/javascripts/functions.js"></script>

<div id="window_registration" class="abs window">
      <div class="abs window_inner">
        <div class="window_top">
          <span class="float_left">
            <img src="../images/desktop/icons/theme_one/64x64/icon-18.png" />
            Matricular Materias
          </span>
          <span class="float_right">
            <a href="#" class="window_min"></a>
            <a href="#" class="window_resize"></a>
            <a href="#icon_dock_registration" class="window_close"></a>
          </span>
        </div>
        <div class="abs window_content">
            <div class="window_aside">
				Matricula de materias por usuario.
			</div>
			<div class="window_main">
				<div class="filtering">
					<form>
						Usuario: <input type="text" name="name_registration" id="name_registration" />
						Grupo: <input type="text" name="group_registration" id="group_registration" />
						<button type="submit" id="search_registration_records">Buscar</button>
					</form>
				</div>
				<div id="registration_table_container"></div>
			</div>
        </div>
        <div class="abs window_bottom">
          Listo
        </div>
      </div>
      <span class="abs ui-resizable-handle ui-resizable-se"></span>
</div>