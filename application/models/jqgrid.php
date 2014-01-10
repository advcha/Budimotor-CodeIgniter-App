<?php
Class Jqgrid extends CI_Model{
	function get_data($table,$query,$param)
    {
 		if($param['search'] != null && $param['search'] === 'true'){
            $wh = $param['search_field'];
            switch ($param['search_operator']) {
                case "bw": // begin with
                    $wh .= " LIKE '".$param['search_str']."%'";
                    break;
                case "ew": // end with
                    $wh .= " LIKE '%".$param['search_str']."'";
                    break;
                case "cn": // contain %param%
                    $wh .= " LIKE '%".$param['search_str']."%'";
                    break;
                case "eq": // equal =
                    if(is_numeric($param['search_str'])) {
                        $wh .= " = ".$param['search_str'];
                    } else {
                        $wh .= " = '".$param['search_str']."'";
                    }
                    break;
                case "ne": // not equal
                    if(is_numeric($param['search_str'])) {
                        $wh .= " <> ".$param['search_str'];
                    } else {
                        $wh .= " <> '".$param['search_str']."'";
                    }
                    break;
                case "lt":
                    if(is_numeric($param['search_str'])) {
                        $wh .= " < ".$param['search_str'];
                    } else {
                        $wh .= " < '".$param['search_str']."'";
                    }
                    break;
                case "le":
                    if(is_numeric($param['search_str'])) {
                        $wh .= " <= ".$param['search_str'];
                    } else {
                        $wh .= " <= '".$param['search_str']."'";
                    }
                    break;
                case "gt":
                    if(is_numeric($param['search_str'])) {
                        $wh .= " > ".$param['search_str'];
                    } else {
                        $wh .= " > '".$param['search_str']."'";
                    }
                    break;
                case "ge":
                    if(is_numeric($param['search_str'])) {
                        $wh .= " >= ".$param['search_str'];
                    } else {
                        $wh .= " >= '".$param['search_str']."'";
                    }
                    break;
                default :
                    $wh = "";
            }
            $this->db->where($wh);
        }
        ($param['limit'] != null ? $this->db->limit($param['limit']['end'], $param['limit']['start']) : '');
 
        ($param['sort_by'] != null) ? $this->db->order_by($param['sort_by'], $param['sort_direction']) :'';
 
        //returns the query string
        if($query != '')
			return $this->db->query($query);
		else
			return $this->db->get($table);
    }
//fungsi ini digunakan melakukan create, update, dan delete yang nantinya akan dipanggil di controller
    function crud($table, $key, $id, $arr){
        $oper=$this->input->post('oper');
        $id_=$this->input->post($id);
        $count=count($arr);
        for($i=0;$i<$count;$i++){
			$data[$arr[$i]]=$this->input->post($arr[$i]);
	 
			switch ($oper) {
				case 'add':
				$this->db->insert($table,$data);
				break;
				case 'edit':
				$this->db->where($key,$id_);
				$this->db->update($table, $data);
				break;
				case 'del':
				$this->db->where($key,$id_);
				$this->db->delete($table);
				break;
			}
		}
	}
}
