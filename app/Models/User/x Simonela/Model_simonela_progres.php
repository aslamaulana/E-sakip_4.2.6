<?php

namespace App\Models\User\Simonela;

use CodeIgniter\Model;

class Model_simonela_progres extends Model
{
	protected $table = 'tb_simonela_progres';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_simonela_progres';
	protected $allowedFields = [
		'kegiatan',
		'kegiatan_sub',
		'indikator_kegiatan_sub',
		'bulan',
		'bulan_lapor',
		'tahap_aktifitas',
		'faktor_pendukung',
		'faktor_penghambat',
		'realisasi_keu',
		'realisasi_fisik',
		'opd_id',
		'tahun',
		'perubahan',
		'created_by',
		'updated_by',
		'created_at',
		'updated_at'
	];

	// public function progres_edit($b)
	// {
	// 	return $this->db->table('tb_emonev_progres')
	// 		->getWhere(['tb_emonev_progres.id_emonev_progres' => $b])->getRowArray();
	// }
}
