<?php

namespace App\Models\Admin\RPJMD;

use CodeIgniter\Model;

class Model_sasaran_indik_target extends Model
{
	protected $table = 'tb_sasaran_indikator_target';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_sasaran_indik_target';
	protected $allowedFields = ['sasaran_indik_id', 'tahun', 'target', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function indikEdit($id)
	{
		return $this->db->table('tb_sasaran_indikator')
			->select('tb_satuan.satuan')
			->select('tb_sasaran_indikator.*')

			->join('tb_satuan', 'tb_satuan.id_satuan = tb_sasaran_indikator.satuan_id', 'left')
			->getWhere(['tb_sasaran_indikator.id_sasaran_indik' => $id])->getRowArray();
	}
}
