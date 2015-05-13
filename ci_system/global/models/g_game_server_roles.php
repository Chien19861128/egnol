<?php

class G_Game_Server_Roles extends CI_Model {

	function create_role($server, $data)
	{
		if (is_array($server)) $server = (object)$server;
		if ($data["uid"] == "0") return false; 
		
		$create_status = 1;
		$cnt = $this->db->from("characters gr")->where("uid", $data["uid"])->count_all_results();

    	if ($cnt > 0) {
	    	$query = $this->db->from("characters gr")->join("servers gi", "gr.server_id=gi.id")
	    					->where("gi.game_id", $server->game_id)->where("uid", $data["uid"])->get();
	
	    	if ($query->num_rows() > 0) {
	    		foreach($query->result() as $row) {
	    			if ($row->server_id == $server->id) {
	    				$create_status = 0;
	    				break;
	    			}
	    		}
	    	}
	    	else $create_status = 2;
    	}
    	else $create_status = 3;
		
		$data['server_id'] = $server->id;
		$data['create_status'] = $create_status;		
		if (empty($data["ad"])) $data["ad"] = ""; //預設放空白
		if (empty($data["create_time"])) $this->db->set("create_time", "now()", false);
		
		$this->db->insert("characters", $data);
		return $this->db->insert_id();
	}
	
	function chk_role_exists($server, $uid, $character_name)
	{
		$this->db->from("characters")
			->where("uid", $uid)
			->where("character_name", $character_name)
			->where("server_id", $server->id);
		
		return $this->db->count_all_results() > 0;
	}	
}