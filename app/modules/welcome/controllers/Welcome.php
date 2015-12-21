<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

    /**
     * @throws HTML2PDF_exception
     */
    public function html2pdf()
	{
		 $content = "
		<page>
		    <h1>Exemple d'utilisation</h1>
		    <br>
		    Ceci est un <b>exemple d'utilisation</b>
		    de <a href='http://html2pdf.fr/'>HTML2PDF</a>.<br>
		</page>";

	    //require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
	    $html2pdf = new HTML2PDF('P','A4','fr');
	    $html2pdf->WriteHTML( file_get_contents($this->load->view('htmlpdf')) );
	    $html2pdf->Output('exemple.pdf');

	}

}
