<?php

class G_Pictures extends CI_Model {

	function get_category_row($game_id, $category)
	{
		return $this->db
			->from("pictures p")
			->join("picture_categories bc", "p.category_id=bc.id", "left")
			->where("game_id", $game_id)
			->where("p.is_active", 1)
			->where("category", $category)
			->where("now() between p.start_time and p.end_time", null, false)
			->order_by("rand()")->get()->row();
	}
	
	function get_list($game_id, $category_id, $limit=0, $offset=0, $order='')
	{
		if ($category_id) $this->db->where("p.category_id", $category_id);
		
		if ($offset) $this->db->limit($limit, $offset);
		else if ($limit) $this->db->limit($limit);
		
		if ($order) $this->db->order_by($order);
		else $this->db->order_by("p.priority", "desc");
        
		return $this->db->select("p.*, bc.category")
			->where("bc.game_id", $game_id)
			->where("p.is_active", 1)
            ->where("now() between p.start_time and p.end_time", null, false)
			->from("pictures p")
			->join("picture_categories bc", "p.category_id=bc.id", "left")
			->get();
	}
	
	function get_list_by_category($game_id, $category)
	{
        $category_id = $this->db->select("id")->where("game_id", $game_id)->where("category", $category)->from("picture_categories")->get()->row();
        
		return $this->get_list($game_id, $category_id->id);
	}
	
	function get_count($game_id, $category_id)
	{
		if ($category_id) $this->db->where("category_id", $category_id);
		return $this->db->where("game_id", $game_id)->from("pictures p")->join("picture_categories bc", "p.category_id=bc.id", "left")->count_all_results();
	}
	
	function get_category($category_id) 
	{
		return $this->db->where("category_id", $category_id)->where("is_active", 1)->get("pictures");
	}
}

