<?php

namespace App\Models\Admin\RPJMD;

use CodeIgniter\Model;

class Model_program_indik_target extends Model
{
	protected $table = 'tb_program_indikator_target';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_program_indik_target';
	protected $allowedFields = ['program_indik_id', 'tahun', 'target', 'target_rp', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function indikEdit($id)
	{
		return $this->db->table('tb_program_indikator')
			->select('tb_satuan.satuan')
			->select('tb_program_indikator.*')

			->join('tb_satuan', 'tb_satuan.id_satuan = tb_program_indikator.satuan_id', 'left')
			->getWhere(['tb_program_indikator.id_program_indik' => $id])->getRowArray();
	}
}
