<?php

namespace App\Models\Admin\RPJMD;

use CodeIgniter\Model;

class Model_tujuan_indik extends Model
{
	protected $table = 'tb_tujuan_indikator';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_tujuan_indik';
	protected $useAutoIncrement = false;
	protected $allowedFields = ['id_tujuan_indik', 'tujuan_indikator', 'tujuan_id', 'satuan_id', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function indikEdit($id)
	{
		return $this->db->table('tb_tujuan_indikator')
			->select('tb_satuan.satuan')
			->select('tb_tujuan_indikator.*')

			->join('tb_satuan', 'tb_satuan.id_satuan = tb_tujuan_indikator.satuan_id', 'left')
			->getWhere(['tb_tujuan_indikator.id_tujuan_indik' => $id])->getRowArray();
	}
}
