<script type="text/javascript" src="modules/mygroups/javascripts/functions.js"></script>
	<div id="window_mygroups" class="abs window">
		<div class="abs window_inner">
			<div class="window_top">
				<span class="float_left">
					<img src="../images/desktop/icons/theme_one/64x64/icon-20.png" />
						Mis Grupos
				</span>
				<span class="float_right">
					<a href="#" class="window_min"></a>
					<a href="#" class="window_resize"></a>
					<a href="#icon_dock_mygroups" class="window_close"></a>
				</span>
			</div>
			<div class="abs window_content">
				<div class="window_aside">
					Lista de Grupos Asignados.
				</div>
				<div class="window_main">
					<div class="filtering">
						<form>
							Nombre / Descripcion: <input type="text" name="mygroups_name" id="mygroups_name" />
							<button type="submit" id="search_mygroups_records">Buscar</button>
						</form>
					</div>
					<div id="mygroups_table_container"></div>
				</div>
			</div>
			<div class="abs window_bottom">
				Listo
			</div>
		</div>
      <span class="abs ui-resizable-handle ui-resizable-se"></span>
    </div>