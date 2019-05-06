<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends CI_Controller {

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
        $this->load->model('Manufacturer_model');
        $this->load->helper(array('form', 'url'));
    }

	public function index()
	{				
		$data['manufacturer_data'] = $this->manufacturer_model->getManufacturer();
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('model',$data);
		$this->load->view('footer');
	}

	public function inventory()
	{				
		$data['inventory_data'] = $this->manufacturer_model->getManufacturer();
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('inventory',$data);
		$this->load->view('footer');
	}

	public function addModel()
	{
		$_POST 	= 	json_decode(file_get_contents('php://input'), true);
		$posts 	= 	$this->input->post();
		$res 	=	array();
		//CHECK FOR MODEL EXISTS
		if($this->inventory_model->isModelExist($posts['registration_no']) > 0){
			$res['msg']	=	"Model already exist";
		}else{
			if($this->inventory_model->addModel($posts)){
				$res['msg']	=	"Inserted Successfully";
			}else{
				$res['msg']	=	"Error occured while inserting into database";
			}

		}		
		
		return print(json_encode($res));
	}

	public function do_upload()
    {
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1024;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;
            $config['encrypt_name']           = true;
            $config['remove_spaces']           = true;

            $this->load->library('upload', $config);
            	/*echo "<pre>";
            		print_r($this->upload->do_upload('image'));
            		echo "</pre>";die;*/
            if ( ! $this->upload->do_upload('filedata'))
            {
                $error = array('error' => $this->upload->display_errors());
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
                   
            }

            return print_r(isset($data)? json_encode($data):json_encode($error));
    }

}
