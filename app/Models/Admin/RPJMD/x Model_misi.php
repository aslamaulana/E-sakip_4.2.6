<?php

namespace App\Models\Admin\RPJMD;

use CodeIgniter\Model;

class Model_misi extends Model
{
	protected $table = 'tb_misi';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_misi';
	protected $allowedFields = ['misi', 'visi', 'kode_misi', 'created_by', 'updated_by', 'created_at', 'updated_at'];
}
