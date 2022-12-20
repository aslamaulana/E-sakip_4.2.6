<?php

namespace App\Models\Admin\Rb;

use CodeIgniter\Model;

class Model_rb_opd extends Model
{
	protected $table = 'tb_rb_opd';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_rb_opd';
	protected $allowedFields = [
		'id_rb_opd',
		'unit_utama',
		'unit_pendukung',
		'unit_tambahan',
		'sempel',
		'opd_id',
		'tahun',
		'created_by',
		'updated_by',
		'created_at',
		'updated_at'
	];
}
