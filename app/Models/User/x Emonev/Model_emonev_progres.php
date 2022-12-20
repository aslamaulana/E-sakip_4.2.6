<?php

namespace App\Models\User\Emonev;

use CodeIgniter\Model;

class Model_emonev_progres extends Model
{
	protected $table = 'tb_emonev_progres';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_emonev_progres';
	protected $allowedFields = ['dpa_id', 'bulan', 'bulan_lapor', 'tahap_pekerjaan_fisik', 'faktor_pendukung', 'faktor_penghambat', 'realisasi_keu', 'realisasi_fisik', 'opd_id', 'tahun', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function progres_edit($b)
	{
		return $this->db->table('tb_emonev_progres')
			->getWhere(['tb_emonev_progres.id_emonev_progres' => $b])->getRowArray();
	}
	// public function PilihKla($id)
	// {
	// 	$query = $this->getWhere(['id_kla_jawaban' => $id]);
	// 	return $query;
	// }
	// public function indik()
	// {
	// 	return $this->db->table('tb_kla_indikator')
	// 		->select('tb_kla_indikator.id_kla_indik')
	// 		->select('tb_kla_indikator.kla_indik')
	// 		->select('tb_kla_opd.opd_id')

	// 		->join('tb_kla_opd', 'tb_kla_indikator.id_kla_indik = tb_kla_opd.kla_indik_id', 'left')
	// 		->getWhere(['tb_kla_opd.opd_id' => user()->opd_id, 'tb_kla_opd.tahun' => $_SESSION['tahun']])->getResultArray();
	// }
}
