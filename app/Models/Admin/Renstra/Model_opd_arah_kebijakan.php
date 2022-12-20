<?php

namespace App\Models\Admin\Renstra;

use CodeIgniter\Model;

class Model_opd_arah_kebijakan extends Model
{
	protected $table = 'tb_renstra_arah_kebijakan';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_opd_arah_kebijakan';
	protected $allowedFields = ['opd_arah_kebijakan', 'opd_strategi_n', 'opd_id', 'tahun', 'perubahan', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function ArahKebijakan()
	{
		return $this->db->table('tb_renstra_arah_kebijakan')
			->distinct('tb_renstra_strategi.opd_strategi')
			->select('tb_renstra_strategi.opd_strategi')
			->join('tb_renstra_strategi', 'tb_renstra_arah_kebijakan.opd_strategi_n = tb_renstra_strategi.opd_strategi', 'left')
			->getWhere(['tb_renstra_arah_kebijakan.perubahan' => $_SESSION['perubahan'], 'tb_renstra_arah_kebijakan.opd_id' => $_SESSION['opd_set']])->getResultArray();
	}
	public function opd()
	{
		return $this->db->table('auth_groups')
			->notLike('auth_groups.id', '0001')->get()->getResultArray();
	}
}
