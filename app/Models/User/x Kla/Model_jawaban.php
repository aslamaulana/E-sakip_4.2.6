<?php

namespace App\Models\User\Kla;

use CodeIgniter\Model;

class Model_jawaban extends Model
{
	protected $table = 'tb_kla_jawaban';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_kla_jawaban';
	protected $allowedFields = ['kla_pertanyaan_id', 'kla_jawaban_doc_size', 'kla_jawaban', 'kla_jawaban_doc', 'opd_id', 'tahun', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function indik()
	{
		return $this->db->table('tb_kla_indikator')
			->select('tb_kla_indikator.id_kla_indik')
			->select('tb_kla_indikator.kla_indik')
			->select('tb_kla_opd.opd_id')

			->join('tb_kla_opd', 'tb_kla_indikator.id_kla_indik = tb_kla_opd.kla_indik_id', 'left')
			->getWhere(['tb_kla_opd.opd_id' => user()->opd_id, 'tb_kla_opd.tahun' => $_SESSION['tahun']])->getResultArray();
	}
	public function jawabanEdit($id)
	{
		return $this->db->table('tb_kla_jawaban')
			->getWhere(['tb_kla_jawaban.id_kla_jawaban' => $id])->getRowArray();
	}
	public function PilihKla($id)
	{
		$query = $this->getWhere(['id_kla_jawaban' => $id]);
		return $query;
	}
}
