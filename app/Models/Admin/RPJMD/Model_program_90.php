<?php

namespace App\Models\Admin\RPJMD;

use CodeIgniter\Model;

class Model_program_90 extends Model
{
	protected $table = 'set_program_90';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_program';
	protected $allowedFields = ['program', 'created_by', 'updated_by', 'created_at', 'updated_at'];
}
