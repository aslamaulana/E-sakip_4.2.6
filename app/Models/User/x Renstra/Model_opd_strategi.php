<?php

namespace App\Models\User\Renstra;

use CodeIgniter\Model;

class Model_opd_strategi extends Model
{
	protected $table = 'tb_renstra_strategi';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_opd_strategi';
	protected $allowedFields = ['opd_strategi', 'opd_sasaran_n', 'opd_kode_sasaran_n', 'opd_id', 'tahun', 'perubahan', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function getSasaran()
	{
		return $this->db->table('tb_renstra_sasaran')
			->distinct('tb_renstra_sasaran.opd_sasaran, tb_renstra_sasaran.opd_kode_sasaran')
			->select('tb_renstra_sasaran.opd_sasaran, tb_renstra_sasaran.opd_kode_sasaran')
			->getWhere(['tb_renstra_sasaran.perubahan' => $_SESSION['perubahan'], 'tb_renstra_sasaran.opd_id' => user()->opd_id])->getResultArray();
	}
	public function Strategi()
	{
		return $this->db->table('tb_renstra_strategi')
			->orderBy('opd_kode_sasaran_n ASC')
			->getWhere(['tb_renstra_strategi.perubahan' => $_SESSION['perubahan'], 'tb_renstra_strategi.opd_id' => user()->opd_id])->getResultArray();
	}
	public function StrategiEdit($id)
	{
		return $this->db->table('tb_renstra_strategi')
			->select('tb_renstra_strategi.*')
			->select('tb_renstra_sasaran.opd_sasaran')
			->select('tb_renstra_sasaran.opd_kode_sasaran')

			->join('tb_renstra_sasaran', 'tb_renstra_sasaran.opd_sasaran = tb_renstra_strategi.opd_sasaran_n', 'left')
			->getWhere(['tb_renstra_strategi.perubahan' => $_SESSION['perubahan'], 'tb_renstra_strategi.id_opd_strategi' => $id, 'tb_renstra_strategi.opd_id' => user()->opd_id])->getRowArray();
	}
}
