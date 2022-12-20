<?php

namespace App\Models\Admin\Esakip;

use CodeIgniter\Model;

class Model_sakip_opd extends Model
{
	protected $table = 'tb_sakip_opd';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_sakip_opd';
	protected $allowedFields = [
		'id_sakip_opd',
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
