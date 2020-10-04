<?php include_once("../core/secure.classes/session.validation.secure.class.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge, chrome=1" />
<meta name="description" content="HI Desktop" />
<title>WNotas</title>

<!--[if lt IE 7]>
	<script>
		window.top.location = 'ie.html';
	</script>
<![endif]-->

<link rel="stylesheet" href="../stylesheets/reset.css" />
<link rel="stylesheet" href="../stylesheets/desktop.css" />

<!--[if lt IE 9]>
	<link rel="stylesheet" href="../stylesheets/ie.css" />
<![endif]-->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
<script>
  !window.jQuery && document.write(unescape('%3Cscript src="../libraries/jquery/jquery.js"%3E%3C/script%3E'));
  !window.jQuery.ui && document.write(unescape('%3Cscript src="../libraries/jquery/jquery.ui.js"%3E%3C/script%3E'));
</script>

<script src="../javascripts/jquery.desktop.js"></script>

<!--  JTable Scripts  -->
<script type="text/javascript" src="../libraries/jtable/jquery.jtable.js"></script>
<script type="text/javascript" src="../libraries/jtable/localization/jquery.jtable.es.js"></script>
<link href="../libraries/jtable/themes/lightcolor/gray/jtable.css" rel="stylesheet" type="text/css" />
<link href="../libraries/jtable/themes/jqueryui/jtable_jqueryui.css" rel="stylesheet" type="text/css" />
<link href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />

<!-- Import CSS file for validation engine (in Head section of HTML) -->
<link href="../libraries/jvalidation_engine/css/validationEngine.jquery.css" rel="stylesheet" type="text/css" />
 
<!-- Import Javascript files for validation engine (in Head section of HTML) -->
<script type="text/javascript" src="../libraries/jvalidation_engine/js/jquery.validationEngine.js"></script>
<script type="text/javascript" src="../libraries/jvalidation_engine/js/languages/jquery.validationEngine-es.js"></script>

<script type="text/javascript" src="../libraries/jquery.ajaxupload/ajaxupload.js"></script>

<script>
function apply_style_tables(){
    $('.hi_table_worked').addClass('ui-widget-content').find('td').css({padding: '10px'});
    $('.hi_table_worked').find('th').css({padding: '10px','font-size': '15px', 'font-weight': 'bold'});
    $('.hi_table_worked tr:has(td):odd').addClass('ui-state-default');
    $('.hi_table_worked tr:has(td):even').addClass('ui-state-focus');
    $('.hi_table_worked tr:has(th)').addClass('ui-widget-header');
}
</script>

</head>
<body>
	
	
	<div class="abs" id="wrapper">
		<div class="abs" id="desktop">	
			<!-- Menu Contextual -->
				<div id="contextual_menu">
					<ul>
						<li id="myprofile" dir="#icon_dock_myprofile"><img src="../images/desktop/icons/theme_one/16x16/icon-05.png" />Mi Perfil</li>
						<?php
							if($_SESSION['role'] == 1){
						?>
						<li id="configurations" dir="#icon_dock_configurations"><img src="../images/desktop/icons/theme_one/16x16/icon-13.png" />Configuraciones</li>
                        <li id="personalization" dir="#icon_dock_personalization"><img src="../images/desktop/icons/theme_one/16x16/icon-06.png" />Personalizaci&oacute;n</li>
						<?php
							}
						?>
					</ul>
				</div>
			<!-- Fin Menu Contextual -->
			
			<!--   Iconos del escritorio   -->
			
			<?php
				if($_SESSION['role'] == 1){
			?>
			<a class="abs icon" style="left:20px;top:20px;" href="#icon_dock_users">
			  <img src="../images/desktop/icons/icon_users.png" />
			  Usuarios
			</a>
			<a class="abs icon" style="left:20px;top:100px;" href="#icon_dock_careers">
			  <img src="../images/desktop/icons/theme_one/64x64/icon-17.png" />
			  Carreras
			</a>
			<a class="abs icon" style="left:20px;top:180px;" href="#icon_dock_subjects">
			  <img src="../images/desktop/icons/theme_one/64x64/icon-19.png" />
			  Materias
			</a>
			<a class="abs icon" style="left:20px;top:260px;" href="#icon_dock_groups">
			  <img src="../images/desktop/icons/theme_one/64x64/icon-20.png" />
			  Grupos
			</a>
			<?php
				}
			?>
			<?php
				if($_SESSION['role'] == 2){
			?>
			<a class="abs icon" style="left:20px;top:20px;" href="#icon_dock_notes">
			  <img src="../images/desktop/icons/theme_one/64x64/icon-02.png" />
			  Notas
			</a>
			<?php
				}
			?>
			<?php
				if($_SESSION['role'] == 3){
			?>
			<a class="abs icon" style="left:20px;top:20px;" href="#icon_dock_registration">
			  <img src="../images/desktop/icons/theme_one/64x64/icon-18.png" />
			  Inscribir Materias
			</a>
			<?php
				}
			?>
			
			<!--   Fin Iconos del escritorio   -->

			<!-- Ventanas -->
			
			<?php
				if($_SESSION['role'] == 1){
			?>
			<?php include_once('modules/users/window.php'); ?>
			<?php include_once('modules/careers/window.php'); ?>
			<?php include_once('modules/subjects/window.php'); ?>
			<?php include_once('modules/groups/window.php'); ?>
			<?php include_once('modules/configurations/window.php'); ?>
			<?php include_once('modules/associates/window.php'); ?>
			<?php include_once('modules/users_careers/window.php'); ?>
			<?php include_once('modules/states/window.php'); ?>
			<?php include_once('modules/semesters/window.php'); ?>
			<?php include_once('modules/type_notes/window.php'); ?>
			<?php include_once('modules/personalization/window.php'); ?>
			<?php
				}
			?>
			<?php
				if($_SESSION['role'] == 1 || $_SESSION['role'] == 2){
			?>
			<?php include_once('modules/notes/window.php'); ?>
			<?php include_once('modules/mygroups/window.php'); ?>
			<?php
				}
			?>
			<?php
				if($_SESSION['role'] == 1 || $_SESSION['role'] == 3){
			?>
			<?php include_once('modules/registration/window.php'); ?>
				<?php 
					if($_SESSION['role'] == 3){
				?>
					<?php include_once('modules/mynotes/window.php'); ?>
					<?php include_once('modules/history/window.php'); ?>
				<?php
					}
				?>
			<?php
				}
			?>
			<?php include_once('modules/myprofile/window.php'); ?>
			
			<!-- Fin Ventanas -->

		</div>
		
		<!-- Menu -->
		<div class="abs" id="bar_top">
			<span class="float_right" id="clock"></span>
			<ul>
				<li>
					<a class="menu_trigger" href="#">Programas</a>
					<ul class="menu">
						<?php
							if($_SESSION['role'] == 1){
						?>
						<li>
							<a href="#icon_dock_associates" class="lnk_window">Asociar Carrera/Semestre/Materia</a>
						</li>
						<li>
							<a href="#icon_dock_users_careers" class="lnk_window">Matricular Usuario - Carrera</a>
						</li>
						<?php
							}
						?>
						<?php
							if($_SESSION['role'] == 1 || $_SESSION['role'] == 3){
						?>
						<li>
							<a href="#icon_dock_registration" class="lnk_window">Inscribir Materias</a>
						</li>
							<?php
								if($_SESSION['role'] == 3){
							?>
							<li>
								<a href="#icon_dock_history" class="lnk_window">Hist&oacute;rico</a>
							</li>
							<li>
								<a href="#icon_dock_mynotes" class="lnk_window">Mis Notas</a>
							</li>
							<?php
								}
							?>
						<?php
							}
						?>
						<?php
							if($_SESSION['role'] == 1 || $_SESSION['role'] == 2){
						?>
						<li>
							<a href="#icon_dock_notes" class="lnk_window">Registrar Notas</a>
						</li>
							<?php
								if($_SESSION['role'] == 2){
							?>
							<li>
								<a href="#icon_dock_mygroups" class="lnk_window">Mis Grupos</a>
							</li>
							<?php
								}
							?>
						<?php
							}
						?>
					</ul>
				</li>
				<?php
					if($_SESSION['role'] == 1){
				?>
				<li>
					<a class="menu_trigger" href="#">Panel de Control</a>
					<ul class="menu">
						<li>
							<a href="#icon_dock_users" class="lnk_window">Usuarios</a>
						</li>
						<li>
							<a href="#icon_dock_careers" class="lnk_window">Carreras</a>
						</li>
						<li>
							<a href="#icon_dock_subjects" class="lnk_window">Materias</a>
						</li>
						<li>
							<a href="#icon_dock_groups" class="lnk_window">Grupos</a>
						</li>
						<li>
							<a href="#icon_dock_states" class="lnk_window">Estados</a>
						</li>
						<li>
							<a href="#icon_dock_semesters" class="lnk_window">Semestres</a>
						</li>
						<li>
							<a href="#icon_dock_type_notes" class="lnk_window">Tipos de Notas</a>
						</li>
						<li>
							<a href="#icon_dock_configurations" class="lnk_window">Configuraciones</a>
						</li>
					</ul>
				</li>
				<?php
					}
				?>
				<li>
					<a class="menu_trigger" href="#">Sistema</a>
					<ul class="menu">
						<?php
							if($_SESSION['role'] == 1){
						?>
						<li>
							<a href="#icon_dock_personalization" class="lnk_window">Personalizaci&oacute;n</a>
						</li>
						<?php
							}
						?>
						<li>
							<a href="#" onclick="system_exit(); return false;" target="_self">Salir</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
		<!-- Fin Menu -->
		
		<!-- Barra de tareas -->
		<div class="abs" id="bar_bottom">
			<a class="float_left" href="#" id="show_desktop" title="Show Desktop">
				<img src="../images/desktop/icons/icon_22_desktop.png" />
			</a>
			<ul id="dock">
				<li id="icon_dock_users">
					<a href="#window_users">
						<img src="../images/desktop/icons/icon_users.png" />
						Usuarios
					</a>
				</li>						
				<li id="icon_dock_careers">
					<a href="#window_careers">
						<img src="../images/desktop/icons/theme_one/64x64/icon-17.png" />
						Carreras
					</a>
				</li>
				<li id="icon_dock_subjects">
					<a href="#window_subjects">
						<img src="../images/desktop/icons/theme_one/64x64/icon-19.png" />
						Materias
					</a>
				</li>
				
				<li id="icon_dock_groups">
					<a href="#window_groups">
						<img src="../images/desktop/icons/theme_one/64x64/icon-20.png" />
						Grupos
					</a>
				</li>
				
				<li id="icon_dock_mygroups">
					<a href="#window_mygroups">
						<img src="../images/desktop/icons/theme_one/64x64/icon-20.png" />
						Mis Grupos
					</a>
				</li>
				
				<li id="icon_dock_configurations">
					<a href="#window_configurations">
						<img src="../images/desktop/icons/theme_one/64x64/icon-13.png" />
						Configuraciones
					</a>
				</li>
				
				<li id="icon_dock_myprofile">
					<a href="#window_myprofile">
						<img src="../images/desktop/icons/theme_one/64x64/icon-09.png" />
						Mi Perfil
					</a>
				</li>
				
				<li id="icon_dock_registration">
					<a href="#window_registration">
						<img src="../images/desktop/icons/theme_one/64x64/icon-18.png" />
						Inscribir Materias
					</a>
				</li>
				
				<li id="icon_dock_states">
					<a href="#window_states">
						<img src="../images/desktop/icons/theme_one/64x64/icon-12.png" />
						Estados
					</a>
				</li>
				
				<li id="icon_dock_semesters">
					<a href="#window_semesters">
						<img src="../images/desktop/icons/theme_one/64x64/icon-11.png" />
						Semestres
					</a>
				</li>
				
				<li id="icon_dock_type_notes">
					<a href="#window_type_notes">
						<img src="../images/desktop/icons/theme_one/64x64/icon-05.png" />
						Tipos de Notas
					</a>
				</li>
				
				<li id="icon_dock_associates">
					<a href="#window_associates">
						<img src="../images/desktop/icons/theme_one/64x64/icon-10.png" />
						Asociar Carrera/Semestre/Materia
					</a>
				</li>
				
				<li id="icon_dock_users_careers">
					<a href="#window_users_careers">
						<img src="../images/desktop/icons/theme_one/64x64/icon-01.png" />
						Matricular Usuario - Carrera
					</a>
				</li>
				
				<li id="icon_dock_notes">
					<a href="#window_notes">
						<img src="../images/desktop/icons/theme_one/64x64/icon-02.png" />
						Notas
					</a>
				</li>
				
				<li id="icon_dock_mynotes">
					<a href="#window_mynotes">
						<img src="../images/desktop/icons/theme_one/64x64/icon-02.png" />
						Mis Notas
					</a>
				</li>
				
				<li id="icon_dock_history">
					<a href="#window_history">
						<img src="../images/desktop/icons/theme_one/64x64/icon-04.png" />
						Hist&oacute;rico
					</a>
				</li>
				
				<li id="icon_dock_personalization">
					<a href="#window_personalization">
						<img src="../images/desktop/icons/theme_one/64x64/icon-06.png" />
						Personalizaci&oacute;n
					</a>
				</li>
			</ul>
			<a class="float_right" href="#" title="&copy; Todos los derechos reservados">
				<img src="../favicon.ico" />
			</a>
		</div>
		<!-- Fin Barra de tareas -->		
	</div>
</body>
</html>