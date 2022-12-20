<?php

namespace App\Models\Admin\RPJMD;

use CodeIgniter\Model;

class Model_kegiatan_90 extends Model
{
	protected $table = 'set_kegiatan_90';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_kegiatan';
	protected $allowedFields = ['kegiatan', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function kegiatan()
	{
		return $this->db->table('set_kegiatan_90')
			->notLike('set_kegiatan_90.id_kegiatan', 'X')->get()->getResultArray();
	}
}
