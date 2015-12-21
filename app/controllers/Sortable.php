<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sortable extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('sortable_m');
	}

	public function index()
	{
		

		//$this->sortable_m->menu(0);	
		$data['title'] = 'Jquery Sortable';
		$data['footer'] = 'This is Footer';

		$this->render('sortable/index', $data);
	}

	public function render($view, $data, $header=true, $footer=true)
	{
		if($header && $header === true){
			$this->load->view('template/header', $data, FALSE);
		}
		$this->load->view($view, $data, FALSE);
		$this->load->view('template/footer', $data, FALSE);
	}

	public function retrieve()
	{
		$lists = $this->input->post('lists');
		//parse_str($lists, $array);
		//print_r($lists);
		//$this->sortable_m->dd($lists);
		foreach($lists as $k => $lv1)
		{
			$this->db->update('menu', ['parent_id' => 0, 'order' => $lv1['id']], ['id' => $lv1['id']]);

			//Level 2
			if(isset($lv1['children']) && is_array($lv1['children'])) {
				foreach ($lv1['children'] as $child => $lv2) {
					$this->db->update('menu', ['parent_id' => $lv1['id'], 'order' => $lv2['id']], ['id' => $lv2['id']]);

					//Level 3
					if( isset($lv2['children']) && is_array($lv2['children']) ){
						foreach ($lv2['children'] as $k_lv3 => $lv3) {
							$this->db->update('menu', ['parent_id' => $lv2['id'], 'order' => $lv3['id']], ['id' => $lv3['id']]);

							//Level 4
							if( isset($lv3['children']) && is_array($lv3['children']) ){
								foreach ($lv3['children'] as $k_lv4 => $lv4) {
									$this->db->update('menu', ['parent_id' => $lv3['id'], 'order' => $lv4['id']], ['id' => $lv4['id']]);

									//Level 5
									if( isset($lv4['children']) && is_array($lv4['children']) ){
										foreach ($lv4['children'] as $k_lv5 => $lv5) {
											$this->db->update('menu', ['parent_id' => $lv4['id'], 'order' => $lv5['id']], ['id' => $lv5['id']]);
										}
									} 
								}
							} 

						}
					} 
				}
			} 

			//self::retrieve($lists);
		}

		//$this->sortable_m->dd($menu);
	}

	// public function retrieve()
	// {
	// 	$lists = $this->input->post('lists');
	// 	//parse_str($lists, $array);
	// 	//print_r($lists);
	// 	$this->sortable_m->dd($lists);
	// 	foreach($lists as $k => $v)
	// 	{
	// 		//Level 2
	// 		if(isset($v['children']) && is_array($v['children'])) {
	// 			foreach ($v['children'] as $child => $c) {
	// 				$this->db->update('menu', ['parent_id' => $v['id'], 'order' => $c['id']], ['id' => $c['id']]);

	// 				//Level 3
	// 				if( isset($c['children']) && is_array($c['children']) ){
	// 					foreach ($c['children'] as $k_lv3 => $v_lv3) {
	// 						$this->db->update('menu', ['parent_id' => $c['id'], 'order' => $v_lv3['id']], ['id' => $v_lv3['id']]);

	// 						//Level 4
	// 						if( isset($v_lv3['children']) && is_array($v_lv3['children']) ){
	// 							foreach ($v_lv3['children'] as $k_lv4 => $v_lv4) {
	// 								$this->db->update('menu', ['parent_id' => $v_lv3['id'], 'order' => $v_lv4['id']], ['id' => $v_lv4['id']]);
	// 							}
	// 						} else {
	// 							$this->db->update('menu', ['parent_id' => $c['id'], 'order' => $v_lv3['id']], ['id' => $v_lv3['id']]);		
	// 						}

	// 					}
	// 				} else {
	// 					$this->db->update('menu', ['parent_id' => 0, 'order' => $v['id']], ['id' => $c['id']]);		
	// 				}
	// 			}
	// 		} else {
	// 			$this->db->update('menu', ['parent_id' => 0, 'order' => $v['id']], ['id' => $v['id']]);
	// 		}

	// 		//self::retrieve($lists);
	// 	}

	// 	//$this->sortable_m->dd($menu);
	// }

}

/* End of file Sortable.php */
/* Location: .//F/projects/ci3_tut/app/controllers/Sortable.php */