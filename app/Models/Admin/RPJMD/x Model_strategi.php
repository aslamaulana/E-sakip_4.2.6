<?php

namespace App\Models\Admin\RPJMD;

use CodeIgniter\Model;

class Model_strategi extends Model
{
	protected $table = 'tb_rpjmd_strategi';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_strategi';
	protected $allowedFields = ['strategi', 'sasaran_n', 'tahun', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function getSasaran()
	{
		return $this->db->table('tb_rpjmd_sasaran')
			->distinct('tb_rpjmd_sasaran.sasaran, tb_rpjmd_sasaran.kode_sasaran')
			->select('tb_rpjmd_sasaran.sasaran, tb_rpjmd_sasaran.kode_sasaran')
			->get()->getResultArray();
	}
	public function Strategi()
	{
		return $this->db->table('tb_rpjmd_strategi')
			->distinct('tb_rpjmd_sasaran.sasaran, tb_rpjmd_sasaran.kode_sasaran')
			->select('tb_rpjmd_sasaran.sasaran, tb_rpjmd_sasaran.kode_sasaran')
			->join('tb_rpjmd_sasaran', 'tb_rpjmd_strategi.sasaran_n = tb_rpjmd_sasaran.sasaran', 'left')
			->get()->getResultArray();
	}
	public function StrategiEdit($id)
	{
		return $this->db->table('tb_rpjmd_strategi')
			->select('tb_rpjmd_strategi.*')
			->select('tb_rpjmd_sasaran.sasaran')
			->select('tb_rpjmd_sasaran.kode_sasaran')

			->join('tb_rpjmd_sasaran', 'tb_rpjmd_sasaran.sasaran = tb_rpjmd_strategi.sasaran_n', 'left')
			->getWhere(['tb_rpjmd_strategi.id_strategi' => $id])->getRowArray();
	}
}
