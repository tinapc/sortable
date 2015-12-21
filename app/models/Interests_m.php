<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Interests_m extends MY_Model {
	public function __construct()
	{	
		$this->table = 'interests';
		
		parent::__construct();
	}
}

/* End of file Interests_m.php */
/* Location: .//E/projects/ci3_tut/app/models/Interests_m.php */