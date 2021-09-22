<?php
class Crud extends CI_Model  {
	function read($table, $where=null, $order_by=null, $group_by=null, $limit=null, $offset=null){
		if($where) $this->db->where($where);
		if($order_by) $this->db->order_by($order_by);
		if($group_by) $this->db->group_by($group_by);
		if($limit) $this->db->limit($limit);
		if($offset) $this->db->offset($offset);

		return $this->db->get($table);
	}

	function get($tabel, $order, $by, $limit='')
    {
        $this->db->select('*');
        $this->db->from($tabel);
        $this->db->order_by($order, $by);
        if($limit!=''){
            $this->db->limit($limit);
        }
        $query = $this->db->get();
        return $query;
    }
	function create($table, $data){
		$this->db->insert($table, $data);

		return $this->db->insert_id();
		// $query = $this->db->insert($table, $data);

  //       if($query)
  //           return true;
  //       else
  //           return false;
	}

	function update($table, $data, $where=null){
		$this->db->set($data);
		if($where) $this->db->where($where);

		$this->db->update($table);
	}

	function delete($table, $where=null){
		if($where) $this->db->where($where);

		$this->db->delete($table);
	}

	function query($query){
		return $this->db->query($query);
	}
}
