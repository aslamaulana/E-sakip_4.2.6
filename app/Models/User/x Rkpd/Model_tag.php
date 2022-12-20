<?php

namespace App\Models\User\Rkpd;

use CodeIgniter\Model;

class Model_tag extends Model
{
	protected $table = 'tb_tag';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_tag';
	protected $allowedFields = [
		'tag',
		'keterangan',
		'created_by',
		'updated_by',
		'created_at',
		'updated_at'
	];
}
