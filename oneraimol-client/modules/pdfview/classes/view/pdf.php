<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Render a view as a PDF.
 *
 * @author     Woody Gilk <woody.gilk@kohanaphp.com>
 * @copyright  (c) 2009 Woody Gilk
 * @license    MIT
 */
class View_PDF extends View {

	public static function factory($file = NULL, array $data = NULL)
	{
		return new View_PDF($file, $data);
	}

	public function render($file = NULL)
	{
		// Render the HTML normally
		$html = parent::render($file);

		// Turn off strict errors, DOMPDF is stupid like that
		$ER = error_reporting(~E_STRICT);

		// Render the HTML to a PDF
		$pdf = new DOMPDF;
		$pdf->load_html($html);
		$pdf->render();

		// Restore error reporting settings
		error_reporting($ER);

		return $pdf->output();
	}

} // End View_PDF

if ( ! defined('DOMPDF_ENABLE_REMOTE'))
{
	// Unfortunately this is a define, not a setting
	define('DOMPDF_ENABLE_REMOTE', TRUE);
}

// Load DOMPDF configuration, this will prepare DOMPDF
require_once Kohana::find_file('vendor', 'dompdf/dompdf/dompdf_config.inc');
