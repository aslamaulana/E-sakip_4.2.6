<?php

namespace App\Models\User\User;

use CodeIgniter\Model;

class Model_groups_users extends Model
{
	protected $table = 'auth_groups_users';
	// protected $useAutoIncrement = false;
	protected $primaryKey = 'id_g_u';
	protected $allowedFields = ['group_id', 'user_id'];
}
