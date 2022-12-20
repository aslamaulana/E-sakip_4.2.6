<?php

namespace App\Models\Admin\RPJMD;

use CodeIgniter\Model;

class Model_visi extends Model
{
	protected $table = 'tb_visi';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_visi';
	protected $allowedFields = ['visi', 'kode_visi', 'created_by', 'updated_by', 'created_at', 'updated_at'];
}
