<!-- Scripts -->
<script type="text/javascript" src="modules/users/javascripts/functions.js"></script>

<div id="window_users" class="abs window">
	<div class="abs window_inner">
		<div class="window_top">
			<span class="float_left">
				<img src="../images/desktop/icons/icon_users.png" />
				Administraci&oacute;n de Usuarios
			</span>
			<span class="float_right">
				<a href="#" class="window_min"></a>
				<a href="#" class="window_resize"></a>
				<a href="#icon_dock_users" class="window_close"></a>
			</span>
		</div>
		<div class="abs window_content">
			<div class="window_aside">
				CRUD - M&oacute;dulo de administraci&oacute;n de usuarios.
			</div>
			<div class="window_main">
				<div class="filtering">
					<form>
						Nombre: <input type="text" name="name" id="name" />
						Identificaci&oacute;n: <input type="text" name="document" id="document" />
						<button type="submit" id="search_records">Buscar</button>
					</form>
				</div>
				<div id="users_table_container"></div>
			</div>
		</div>
		<div class="abs window_bottom">
			Listo.
		</div>
	</div>
	<span class="abs ui-resizable-handle ui-resizable-se"></span>
</div>