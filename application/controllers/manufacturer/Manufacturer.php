<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manufacturer extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
 	public function __construct()
    {
        parent::__construct();
        $this->load->model('manufacturer_model');
    }
	public function index()
	{

		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('manufacturer');
		$this->load->view('footer');
	}

	public function addManufacturer()
	{
		
		$_POST 	= 	json_decode(file_get_contents('php://input'), true);
		$posts 	= 	$this->input->post();
		
		$res 	=	array();
		//CHECK FOR MANUFACTURER EXISTS
		if($this->manufacturer_model->isManufacturerExist($posts) > 0){
			$res['msg']	=	"Manufacturer already exist";
		}else{
			if($this->manufacturer_model->addManufacturer($posts)){
				$res['msg']	=	"Inserted Successfully";
			}else{
				$res['msg']	=	"Error occured while inserting into database";
			}

		}		
		
		return print(json_encode($res));
	}
}
