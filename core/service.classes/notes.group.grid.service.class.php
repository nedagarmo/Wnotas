<?php



/**

 * Clase de servidor que alimenta las variables de configuración del sistema

 *

 * @author Nelson D. Garzón M.

 */



extract($_REQUEST);

include_once(dirname(__FILE__) . '/../data.access.objects/users.dao.class.php');

include_once(dirname(__FILE__) . '/../data.access.objects/notes.dao.class.php');

require_once(dirname(__FILE__).'/../../libraries/html2pdf/html2pdf.class.php');



$dao = new users();

$dao_notes = new notes();

$result = $dao->get_all_users_by_group($group);



// get the HTML

ob_start();

?>

<page backtop="35mm" backbottom="14mm" backleft="10mm" backright="10mm" style="font-size: 10pt">

    <page_header>

        <table class="page_header" style="width: 100%;">

            <tr>

                <td style="width: 100%; text-align: center;">

                    <img src="../../images/general/logo_reportes.jpg" />

                </td>

			</tr>

			<tr>

                <td style="width: 100%; text-align: center; font-size: 12px;">

                    WNOTAS v.1.0

                </td>

            </tr>

        </table>

    </page_header>

    <page_footer>

        <table class="page_footer" style="width: 100%;">

            <tr>

                <td style="width: 100%; text-align: center;">

                    Página [[page_cu]]/[[page_nb]]

                </td>

            </tr>

        </table>

    </page_footer>

	<div class="note" style="font-size: 10px">

		<?php

		if($result != null){

			echo "<br />";

			echo "<table width='1000' border='1'><thead><tr><th>Estudiante</th><th>Materia</th><th>Nota 01</th><th>Nota 02</th><th>Nota 03</th><th>Definitiva</th><th>Habilitaci&oacute;n</th></tr></thead><tbody>";

			while (!$result->EOF){

				echo "<tr><td>".$result->fields['nombres']." ".$result->fields['apellidos']."</td>";

				echo "<td>".$result->fields['materia']."</td>";

				$result_notes = $dao_notes->get_notes_by_user_and_group($result->fields['id'], $group);

				$hi_counter = 1;

				$definitive = 0;

				$habilitacion = "N/A";

				$total_notes = 1;

				while(!$result_notes->EOF){

					if($total_notes > 3){

						break;

					}

					if($result_notes->fields['tipo_nota'] == 1){

						echo "<td>";

							echo $result_notes->fields['nota'];

						echo "</td>";

						$definitive = $definitive + (($result_notes->fields['nota'] * $result_notes->fields['equivalencia']) / 100);

						$hi_counter ++;

					}else{

						$habilitacion = $result_notes->fields['nota'];

					}

					$total_notes ++;

					$result_notes->MoveNext();

				}

				echo "<td>".$definitive."</td>";

				echo "<td>".$habilitacion."</td>";

				echo "</tr>";

				$result->MoveNext();

			}

			echo "</tbody></table>";

		}

		?>

	</div>

</page>



<?php

$content = ob_get_clean();
ob_clean();

try

{

	// init HTML2PDF

	$html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', array(0, 0, 0, 0));

	// display the full page

	$html2pdf->pdf->SetDisplayMode('fullpage');

	// convert

	$html2pdf->writeHTML($content, isset($_GET['vuehtml']));

	// send the PDF

	$html2pdf->Output('NotasGrupo.pdf');

}

catch(HTML2PDF_exception $e) {

	echo $e;

	exit;

}



?>

