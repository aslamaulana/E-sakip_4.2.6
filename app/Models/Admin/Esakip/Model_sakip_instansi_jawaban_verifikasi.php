<?php

namespace App\Models\Admin\Esakip;

use CodeIgniter\Model;

class Model_sakip_instansi_jawaban_verifikasi extends Model
{
	protected $table = 'tb_sakip_instansi_jawaban_verifikasi';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_sakip_instansi_jawaban_verifikasi';
	protected $allowedFields = [
		'sakip_instansi_jawaban_id',
		'verifikasi',
		'verifikasi_keterangan',
		'nm_verifikator',
		'opd_id',
		'tahun',
		'created_by',
		'updated_by',
		'created_at',
		'updated_at'
	];
}
