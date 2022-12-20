<?php

namespace App\Models\Admin\Renstra;

use CodeIgniter\Model;

class Model_opd_strategi extends Model
{
	protected $table = 'tb_renstra_strategi';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_opd_strategi';
	protected $allowedFields = ['opd_strategi', 'opd_sasaran_n', 'opd_kode_sasaran_n', 'opd_id', 'tahun', 'perubahan', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function Strategi()
	{
		return $this->db->table('tb_renstra_strategi')
			->orderBy('opd_kode_sasaran_n ASC')
			->getWhere(['tb_renstra_strategi.perubahan' => $_SESSION['perubahan'], 'tb_renstra_strategi.opd_id' => $_SESSION['opd_set']])->getResultArray();
	}
	public function opd()
	{
		return $this->db->table('auth_groups')
			->notLike('auth_groups.id', '0001')->get()->getResultArray();
	}
}
