<?php

namespace App\Models\User\Renstra;

use CodeIgniter\Model;

class Model_opd_arah_kebijakan extends Model
{
	protected $table = 'tb_renstra_arah_kebijakan';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_opd_arah_kebijakan';
	protected $allowedFields = ['opd_arah_kebijakan', 'opd_strategi_n', 'opd_id', 'tahun', 'perubahan', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function getStrategi()
	{
		return $this->db->table('tb_renstra_strategi')
			->distinct('tb_renstra_strategi.opd_strategi')
			->select('tb_renstra_strategi.opd_strategi')
			->getWhere(['tb_renstra_strategi.perubahan' => $_SESSION['perubahan'], 'tb_renstra_strategi.opd_id' => user()->opd_id])->getResultArray();
	}
	public function ArahKebijakan()
	{
		return $this->db->table('tb_renstra_arah_kebijakan')
			->distinct('tb_renstra_strategi.opd_strategi')
			->select('tb_renstra_strategi.opd_strategi')
			->join('tb_renstra_strategi', 'tb_renstra_arah_kebijakan.opd_strategi_n = tb_renstra_strategi.opd_strategi', 'left')
			->getWhere(['tb_renstra_arah_kebijakan.perubahan' => $_SESSION['perubahan'], 'tb_renstra_arah_kebijakan.opd_id' => user()->opd_id])->getResultArray();
	}
	public function ArahKebijakanEdit($id)
	{
		return $this->db->table('tb_renstra_arah_kebijakan')
			->select('tb_renstra_arah_kebijakan.*')
			->select('tb_renstra_strategi.opd_strategi')

			->join('tb_renstra_strategi', 'tb_renstra_strategi.opd_strategi = tb_renstra_arah_kebijakan.opd_strategi_n', 'left')
			->getWhere(['tb_renstra_arah_kebijakan.perubahan' => $_SESSION['perubahan'], 'tb_renstra_arah_kebijakan.id_opd_arah_kebijakan' => $id, 'tb_renstra_arah_kebijakan.opd_id' => user()->opd_id])->getRowArray();
	}
}
