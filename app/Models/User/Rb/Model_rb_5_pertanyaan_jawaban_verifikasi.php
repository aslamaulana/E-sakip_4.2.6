<?php

namespace App\Models\User\Rb;

use CodeIgniter\Model;

class Model_rb_5_pertanyaan_jawaban_verifikasi extends Model
{
	protected $table = 'tb_rb_5_pertanyaan_jawaban_verifikasi';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_rb_pertanyaan_jawaban_verifikasi';
	protected $allowedFields = [
		'rb_pertanyaan_jawaban_id',
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
