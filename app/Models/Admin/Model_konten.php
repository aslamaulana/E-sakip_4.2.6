<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class Model_konten extends Model
{
	protected $table = 'konten_set';
	protected $useTimestamps = true;
	protected $primaryKey = 'id';
	protected $allowedFields = ['id', 'nama', 'konten'];

	public function nama($id)
	{
		return $this->db->table('konten_set')
			->getWhere(['konten_set.nama' => $id])->getRow();
	}
}
