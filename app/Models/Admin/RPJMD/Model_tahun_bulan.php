<?php

namespace App\Models\Admin\RPJMD;

use CodeIgniter\Model;

class Model_tahun_bulan extends Model
{
	protected $table = 'tb_tahun_bulan';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_bulan';
	protected $allowedFields = ['bulan', 'triwulan_id', 'tahun', 'aktif', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function Tahun_bulanA()
	{
		return $this->db->table('tb_tahun_bulan')
			->orderBy('id_bulan', 'ASC')
			->getWhere(['tb_tahun_bulan.aktif' => 'Y'])->getResultArray();
	}
	public function Tahun_bulanT()
	{
		return $this->db->table('tb_tahun_bulan')
			->getWhere(['tb_tahun_bulan.aktif' => 'N'])->getResultArray();
	}
}
