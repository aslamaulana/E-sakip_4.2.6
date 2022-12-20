<?php

namespace App\Models\Admin\RPJMD;

use CodeIgniter\Model;

class Model_sasaran_indik extends Model
{
	protected $table = 'tb_sasaran_indikator';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_sasaran_indik';
	protected $useAutoIncrement = false;
	protected $allowedFields = ['id_sasaran_indik', 'sasaran_indikator', 'sasaran_id', 'satuan_id', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function indikEdit($id)
	{
		return $this->db->table('tb_sasaran_indikator')
			->select('tb_satuan.satuan')
			->select('tb_sasaran_indikator.*')

			->join('tb_satuan', 'tb_satuan.id_satuan = tb_sasaran_indikator.satuan_id', 'left')
			->getWhere(['tb_sasaran_indikator.id_sasaran_indik' => $id])->getRowArray();
	}
}
