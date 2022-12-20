<?php

namespace App\Models\User\Rb;

use CodeIgniter\Model;

class Model_rb_6_pertanyaan_sub_jawaban extends Model
{
	protected $table = 'tb_rb_6_pertanyaan_sub_jawaban';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_rb_pertanyaan_sub_jawaban';
	protected $allowedFields = [
		'rb_pertanyaan_sub_id',
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
