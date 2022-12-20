<?php

namespace App\Models\User\Rb;

use CodeIgniter\Model;

class Model_rb_5_pertanyaan_jawaban extends Model
{
	protected $table = 'tb_rb_5_pertanyaan_jawaban';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_rb_pertanyaan_jawaban';
	protected $allowedFields = [
		'id_rb_pertanyaan_jawaban',
		'rb_pertanyaan_id',
		'jawaban',
		'link_keterangan',
		'link_1',
		'link_2',
		'link_3',
		'catatan',
		'nilai',
		'opd_id',
		'tahun',
		'created_by',
		'updated_by',
		'created_at',
		'updated_at'
	];
}
