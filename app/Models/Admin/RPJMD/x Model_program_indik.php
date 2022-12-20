<?php

namespace App\Models\Admin\RPJMD;

use CodeIgniter\Model;

class Model_program_indik extends Model
{
	protected $table = 'tb_program_indikator';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_program_indik';
	protected $useAutoIncrement = false;
	protected $allowedFields = ['id_program_indik', 'program_indikator', 'program_id', 'satuan_id', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function indikEdit($id)
	{
		return $this->db->table('tb_program_indikator')
			->select('tb_satuan.satuan')
			->select('tb_program_indikator.*')

			->join('tb_satuan', 'tb_satuan.id_satuan = tb_program_indikator.satuan_id', 'left')
			->getWhere(['tb_program_indikator.id_program_indik' => $id])->getRowArray();
	}
}
