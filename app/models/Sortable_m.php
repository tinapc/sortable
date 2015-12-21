<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sortable_m extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}

	public function menu($parent=0)
	{
		$items = [];
		$this->db->order_by('order', 'asc');
		$items = $this->db->get_where('menu', ['parent_id' => $parent])->result_array();

		if(count($items) > 0){
			echo '<ol class="dd-list">';
			foreach($items as $item){
				$childs = $this->child_menu($item['id']);

				echo '<li class="dd-item" data-id="'.$item['id'].'"><div class="dd-handle">'.$item['name'].'</div>'; 
				if(count($childs) > 0){
					self::menu($item['id']);
					echo "</li></ol>";
				} else{
					echo "</li>";
				}
			}
		}

	}

	public function child_menu($parent)
	{
		$items = $this->db->get_where('menu', ['parent_id' => $parent])->result_array();	
		return $items;
	}

	public function dd($data){
		echo "<pre>";
		print_r($data);
		echo "</pre>";
	}
}

/* End of file sortable.php */
/* Location: .//F/projects/ci3_tut/app/models/sortable.php */