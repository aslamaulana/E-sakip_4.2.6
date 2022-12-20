<?php

namespace App\Models\Admin\RPJMD;

use CodeIgniter\Model;

class Model_tahun_triwulan extends Model
{
	protected $table = 'tb_tahun_triwulan';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_triwulan';
	protected $allowedFields = ['triwulan', 'tahun_id', 'aktif', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function Tahun_triwulanA()
	{
		return $this->db->table('tb_tahun_triwulan')
			->orderBy('id_triwulan', 'ASC')
			->getWhere(['tb_tahun_triwulan.aktif' => 'Y'])->getResultArray();
	}
	public function Tahun_triwulanT()
	{
		return $this->db->table('tb_tahun_triwulan')
			->getWhere(['tb_tahun_triwulan.aktif' => 'N'])->getResultArray();
	}
}
