<?php
class Inventory_model extends CI_Model {

	

	public function addModel($data){

		//$this->db->get_where('manufacturer', $data);
		$this->db->insert('model', $data);

		$query = $this->db->affected_rows();

		return $query;
	}

	function isModelExist($reg_no){

		$query = $this->db->get_where('model', array('registration_no' => $reg_no));

		return $query->num_rows();
	}

	function getList(){

	$query = $this->db->query("SELECT m.manufacturer_id,m.name as manufacturer_name,mo.name as model_name,count(mo.model_id) as count from manufacturer m inner join model mo on m.manufacturer_id=mo.manufacturer_id group by m.manufacturer_id");

		foreach($query->result_array() as $row){
			$data[] = array('manufacturer_id' => $row['manufacturer_id'],
							'manufacturer_name' => $row['manufacturer_name'],
							'model_name' => $row['model_name'],
							'count' => $row['count'],
							'manufacturer_detail' => $this->getInventoryDetail($row['manufacturer_id'])
							);
		}
				
		return $data;
	}

	function getInventoryDetail($manufacturer_id){
		$query = $query = $this->db->query("SELECT mo.model_id,mo.name as model_name,mo.color,mo.manufacturing_year,mo.registration_no,mo.note,mo.image,m.name as manufacturer_name  from manufacturer m inner join model mo on m.manufacturer_id=mo.manufacturer_id where m.manufacturer_id = '".$manufacturer_id."' AND sold_status='onsell' ");
		if($query->num_rows()){

			return $query->result_array();

		}else{
			
			return false;
		}
	}
}

?>