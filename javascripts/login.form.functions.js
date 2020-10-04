/**=============================================================================
 *
 *	Filename:  function.ajax.js
 *	
 *	(c)Autor: Arkos Noem Arenom
 *	
 *	Description: Ajax para hacer las consultas
 *	
 *	Licence: GPL|LGPL
 *	
 *===========================================================================**/

$(document).ready(function(){
	
	var timeSlide = 1000;
	$('#login_username').focus();
	$('#timer').hide(0);
	$('#timer').css('display','none');
	
	$('#timer_pass').hide(0);
	$('#timer_pass').css('display','none');
	
	$('#login_userbttn').click(function(){
		$('#timer').fadeIn(300);
		$('.box-info, .box-success, .box-alert, .box-error').slideUp(timeSlide);
		setTimeout(function(){
			if ( $('#login_username').val() != "" && $('#login_userpass').val() != "" ){
				
				$.ajax({
					type: 'POST',
					url: 'core/server.classes/login.server.class.php',
					data: 'username=' + $('#login_username').val() + '&password=' + $('#login_userpass').val(),
					success:function(msj){
						if ( msj == 1 ){
							$('#alertBoxes').html('<div class="box-success"></div>');
							$('.box-success').hide(0).html('Espere un momento&#133;');
							$('.box-success').slideDown(timeSlide);
							setTimeout(function(){
								window.location.href = "system";
							},(timeSlide + 500));
						}
						else{
							$('#alertBoxes').html('<div class="box-error"></div>');
							$('.box-error').hide(0).html('Lo sentimos, pero los datos son incorrectos.');
							$('.box-error').slideDown(timeSlide);
						}
						$('#timer').fadeOut(300);
					},
					error:function(){
						$('#timer').fadeOut(300);
						$('#alertBoxes').html('<div class="box-error"></div>');
						$('.box-error').hide(0).html('Ha ocurrido un error durante la ejecuci&oacute;n');
						$('.box-error').slideDown(timeSlide);
					}
				});
				
			}
			else{
				$('#alertBoxes').html('<div class="box-error"></div>');
				$('.box-error').hide(0).html('Los campos estan vac&iacute;os, por favor, ingrese su usuario y contrase&ntilde;a');
				$('.box-error').slideDown(timeSlide);
				$('#timer').fadeOut(300);
			}
		},timeSlide);
		
		return false;
		
	});
	
	$('#sendpass_userbttn').click(function(){
		$('#timer_pass').fadeIn(300);
		$('.box-info, .box-success, .box-alert, .box-error').slideUp(timeSlide);
		setTimeout(function(){
			if ( $('#email_user').val() != "" ){
				
				$.ajax({
					type: 'POST',
					url: 'core/server.classes/restore.server.class.php',
					data: 'email=' + $('#email_user').val(),
					success:function(msj){
						if ( msj == 1 ){
							$('#alertBoxes').html('<div class="box-success"></div>');
							$('.box-success').hide(0).html('Un email ha sido enviado a su cuenta de correo&#133;');
							$('.box-success').slideDown(timeSlide);
							show_restore_password();
						}
						else{
							$('#alertBoxes').html('<div class="box-error"></div>');
							$('.box-error').hide(0).html('Lo sentimos, pero los datos son incorrectos.');
							$('.box-error').slideDown(timeSlide);
						}
						$('#timer_pass').fadeOut(300);
					},
					error:function(){
						$('#timer_pass').fadeOut(300);
						$('#alertBoxes').html('<div class="box-error"></div>');
						$('.box-error').hide(0).html('Ha ocurrido un error durante la ejecuci&oacute;n');
						$('.box-error').slideDown(timeSlide);
					}
				});
				
			}
			else{
				$('#alertBoxes').html('<div class="box-error"></div>');
				$('.box-error').hide(0).html('Los campos estan vac&iacute;os, por favor, ingrese su email.');
				$('.box-error').slideDown(timeSlide);
				$('#timer_pass').fadeOut(300);
			}
		},timeSlide);
		
		return false;
		
	});
});
