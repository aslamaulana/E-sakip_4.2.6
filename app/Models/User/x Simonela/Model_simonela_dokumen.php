<?php

namespace App\Models\User\Simonela;

use CodeIgniter\Model;

class Model_simonela_dokumen extends Model
{
	protected $table = 'tb_simonela_progres_dokumen';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_simonela_progres_berkas';
	protected $allowedFields = [
		'kegiatan',
		'kegiatan_sub',
		'indikator_kegiatan_sub',
		'bulan',
		'bulan_lapor',
		'dokumen',
		'keterangan',
		'opd_id',
		'tahun',
		'size',
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
