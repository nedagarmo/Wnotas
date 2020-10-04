<?php

/**
 * Clase de servidor que ejecuta operaciones sobre el fondo del sistema.
 *
 * @author Nelson D. Garzón M.
 */
 
session_start();
extract($_REQUEST);

$directorio = dirname(__FILE__)."/../../images/backgrounds/";
$folder = opendir("../../images/backgrounds/"); //ruta actual
$view_folder = "/images/backgrounds/";

if($action == 'list'){
	while ($archivo = readdir($folder)) //obtenemos un archivo y luego otro sucesivamente
	{
		if(is_file($directorio.$archivo)){
			if(substr($archivo, 0, 6) == "wact__"){
				echo '<li style="background:#D30707;" id="'.str_replace('.','_',$archivo).'">
						<a href="#" onclick="update_personalization_background(\''.$archivo.'\')">
							<img src="../images/backgrounds/'.$archivo.'" />
							<span>'.$archivo.'</span>
						</a>
					  </li>';
				$_SESSION['background_current'] = $archivo;
			}else{
				echo '<li id="'.str_replace('.','_',$archivo).'">
						<a href="#" onclick="update_personalization_background(\''.$archivo.'\')">
							<img src="../images/backgrounds/'.$archivo.'" />
							<span>'.$archivo.'</span>
						</a>
					  </li>';
			}
		}
	} 
}
else if($action == 'upload')
{
    if(isset($_FILES['image'])){
 
        $nombre = $_FILES['image']['name'];
        $temp   = $_FILES['image']['tmp_name'];
 
        // subir imagen al servidor
        move_uploaded_file($temp, $directorio.$nombre);
 
        echo  '<li id="'.str_replace('.','_',$nombre).'">
				<a href="#" onclick="update_personalization_background(\''.$nombre.'\')">
					<img src="'.$view_folder.$nombre.'" />
					<span>'.$nombre.'</span>
				</a>
            </li>';
    }
}
else if($action == 'update')
{	
	if(isset($_SESSION["background_current"]))
	{
		rename($directorio.$_SESSION["background_current"], $directorio.substr($_SESSION["background_current"],6));
	}
	rename($directorio.$background, $directorio."wact__".$background);
	$_SESSION["background_current"] = "wact__".$background;
	
}
else if($action == 'background')
{
	$ruta = $directorio;
	$patern = "wact__*.jpg";
	$carpeta = ""; 
	$file = ""; 
	$archivo_solicitado =  preg_split("/[\s.]+/",$patern);  
	if ($carpeta = opendir($ruta)){
		while(false !== ($valor=readdir($carpeta))){
			if ($valor!="."&&$valor!=".."){
				$archivo_encontrado =  preg_split("/[\s.]+/",$valor);
				if (preg_match("/".$archivo_solicitado[0]."/i",$archivo_encontrado[0])&&($archivo_encontrado[1]==$archivo_solicitado[1])){
					echo $archivo_encontrado[0].".".$archivo_encontrado[1];
				}
			}  
		} 
		closedir($carpeta);
	}
}

?>