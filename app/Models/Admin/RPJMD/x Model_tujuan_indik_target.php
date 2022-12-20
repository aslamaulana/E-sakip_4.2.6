<?php

namespace App\Models\Admin\RPJMD;

use CodeIgniter\Model;

class Model_tujuan_indik_target extends Model
{
	protected $table = 'tb_tujuan_indikator_target';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_tujuan_indik_target';
	protected $allowedFields = ['tujuan_indik_id', 'tahun', 'target', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function indikEdit($id)
	{
		return $this->db->table('tb_tujuan_indikator')
			->select('tb_satuan.satuan')
			->select('tb_tujuan_indikator.*')

			->join('tb_satuan', 'tb_satuan.id_satuan = tb_tujuan_indikator.satuan_id', 'left')
			->getWhere(['tb_tujuan_indikator.id_tujuan_indik' => $id])->getRowArray();
	}
}
