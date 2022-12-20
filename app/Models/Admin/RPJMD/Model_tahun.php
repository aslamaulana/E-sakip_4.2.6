<?php

namespace App\Models\Admin\RPJMD;

use CodeIgniter\Model;

class Model_tahun extends Model
{
	protected $table = 'tb_tahun';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_tahun';
	protected $allowedFields = ['tahun', 'aktif', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function TahunA()
	{
		return $this->db->table('tb_tahun')
			->orderBy('tahun', 'ASC')
			->getWhere(['tb_tahun.aktif' => 'Y'])->getResultArray();
	}
	public function TahunT()
	{
		return $this->db->table('tb_tahun')
			->getWhere(['tb_tahun.aktif' => 'N'])->getResultArray();
	}
}
