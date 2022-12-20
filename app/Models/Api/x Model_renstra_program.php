<?php

namespace App\Models\Api;

use CodeIgniter\Model;

class Model_renstra_program extends Model
{
	public function Api_program($perubahan)
	{
		return $this->db->table('tb_renstra_program')
			->join('set_program_90', 'tb_renstra_program.opd_program_n = set_program_90.program', 'left')
			->getWhere(['tb_renstra_program.perubahan' => $perubahan])->getResultArray();
	}
	public function Api_program_opd($perubahan, $opd_id)
	{
		return $this->db->table('tb_renstra_program')
			->join('set_program_90', 'tb_renstra_program.opd_program_n = set_program_90.program', 'left')
			->getWhere(['tb_renstra_program.perubahan' => $perubahan, 'opd_id' => $opd_id])->getResultArray();
	}
}
