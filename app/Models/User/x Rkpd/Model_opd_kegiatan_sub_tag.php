<?php

namespace App\Models\User\Rkpd;

use CodeIgniter\Model;

class Model_opd_kegiatan_sub_tag extends Model
{
	protected $table = 'tb_rkpd_kegiatan_sub_tag';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_rkpd_tag';
	protected $allowedFields = [
		'rkpd_kegiatan_sub_n',
		'opd_id',
		'tag',
		'tahun',
		'perubahan',
		'created_by',
		'updated_by',
		'created_at',
		'updated_at'
	];
}
