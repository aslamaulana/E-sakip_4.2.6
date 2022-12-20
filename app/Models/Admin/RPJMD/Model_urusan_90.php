<?php

namespace App\Models\Admin\RPJMD;

use CodeIgniter\Model;

class Model_urusan_90 extends Model
{
	protected $table = 'set_urusan_90';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_urusan';
	protected $allowedFields = ['urusan', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function Urusan()
	{
		return $this->db->table('set_urusan_90')
			//->notLike('set_urusan_90.id_urusan', 'X')->get()->getResultArray();
			->get()->getResultArray();
	}
}
