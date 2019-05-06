<?php
class Manufacturer_model extends CI_Model {

	function getManufacturer(){
		$query = $this->db->get('manufacturer');
			
		return $query->result_array();
	}
	
	public function addManufacturer($data){

		//$this->db->get_where('manufacturer', $data);
		$this->db->insert('manufacturer', $data);

		$query = $this->db->affected_rows();

		return $query;
	}

	function isManufacturerExist($data){

		$query = $this->db->get_where('manufacturer', $data);

		return $query->num_rows();
	}
}

?>