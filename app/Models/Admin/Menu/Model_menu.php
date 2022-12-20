<?php

namespace App\Models\Admin\Menu;

use CodeIgniter\Model;

class Model_menu extends Model
{
	protected $table = 'tb_setting_menu';
	// protected $useTimestamps = true;
	protected $primaryKey = 'id_menu';
	protected $allowedFields = ['name', 'tahap', 'kunci', 'timer', 'timer_a', 'tahun'];

	public function menu($name)
	{
		return $this->db->table('tb_setting_menu')
			->getWhere(['tahun' => $_SESSION['tahun'], 'name' => $name])->getRow();
	}
}
