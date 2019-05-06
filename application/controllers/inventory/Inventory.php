<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {

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
        $this->load->model('Inventory_model');       
        $this->load->helper(array('form', 'url'));
    }

	public function index()
	{				
		
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('inventory');
		$this->load->view('footer');
	}

	public function getInvetoryList(){

		$data = $this->inventory_model->getList();		
		return print(json_encode($data));
	}

	public function getInvetoryDetail(){
		/*$_POST 	= 	json_decode(file_get_contents('php://input'), true);
		$posts 	= 	$this->input->post();*/
		$data = $this->inventory_model->getInventoryDetail();
			
		return print(json_encode($data));
	}

	public function getPopup(){
		$this->load->view('popup.html');
	}

	

}
