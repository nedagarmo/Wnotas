<?php



/**

 * Clase de servidor que alimenta las variables de configuración del sistema

 *

 * @author Nelson D. Garzón M.

 */



session_start();

extract($_REQUEST);

include_once(dirname(__FILE__) . '/../data.access.objects/users.dao.class.php');

include_once(dirname(__FILE__) . '/../data.access.objects/notes.dao.class.php');

require_once(dirname(__FILE__).'/../../libraries/html2pdf/html2pdf.class.php');



$dao_notes = new notes();

$result_subjects = $dao_notes->get_subjects_by_user($_SESSION['id']);

$result = $dao_notes->get_semesters_by_user($_SESSION['id']);



// get the HTML

ob_start();

?>

<page backtop="40mm" backbottom="14mm" backleft="10mm" backright="10mm" style="font-size: 7pt">

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

	<div class="note">

		<?php

		if($result != null){

			echo "<strong style='font-size: 17px;'>".$_SESSION['name']."</strong> <br /> C.C. ".$_SESSION['document']."<br /><br /><br />";

			$current_semester = 0;

			echo "<strong>Semetre I</strong><br /><br />";

			echo "<table width='1000' border='1'><thead><tr><th>Materia</th><th>Nota 01 - 30%</th><th>Nota 02 - 30%</th><th>Nota 03 - 40%</th><th>Definitiva</th><th>Habilitaci&oacute;n</th></tr></thead><tbody>";

			$first_row = true;

			while (!$result->EOF){

				if(($current_semester != $result->fields['sigla']) && !$first_row){

					echo "</tbody></table>";

					echo "<hr />";

					echo "<br />";

					echo "<strong>Semestre ".$result->fields['sigla']."</strong><br /><br />";

					echo "<table width='1000' border='1'><thead><tr><th>Materia</th><th>Nota 01 - 30%</th><th>Nota 02 - 30%</th><th>Nota 03 - 40%</th><th>Definitiva</th><th>Habilitaci&oacute;n</th></tr></thead><tbody>";

					$current_semester = $result->fields['sigla'];

				}

				$first_row = false;

				echo "<tr>";

				echo "<td>".$result->fields[1]."</td>";

				$result_notes = $dao_notes->get_notes_by_subject($result->fields['id']);

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

					$result_notes->MoveNext();

					$total_notes++;

				}

				echo "<td>".$definitive."</td>";

				echo "<td>".$habilitacion."</td></tr>";

				$result->MoveNext();

			}

			echo "</tbody></table>";

			echo "<hr />";

			echo "<br />";

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

	$html2pdf->Output('HistoricoNotas.pdf');

}

catch(HTML2PDF_exception $e) {

	echo $e;

	exit;

}



?>