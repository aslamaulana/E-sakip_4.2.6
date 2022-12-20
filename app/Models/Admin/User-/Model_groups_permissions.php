<?php

namespace App\Models\Admin\User;

use CodeIgniter\Model;

class Model_groups_permissions extends Model
{
	protected $table = 'auth_groups_permissions';
	// protected $useAutoIncrement = false;
	protected $primaryKey = 'id_g_p';
	protected $allowedFields = ['group_id', 'permission_id'];
}
