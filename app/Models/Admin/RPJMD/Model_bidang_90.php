<?php

namespace App\Models\Admin\RPJMD;

use CodeIgniter\Model;

class Model_bidang_90 extends Model
{
	protected $table = 'set_bidang_90';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_bidang';
	protected $allowedFields = ['bidang', 'created_by', 'updated_by', 'created_at', 'updated_at'];
}
