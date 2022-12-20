<?php

namespace App\Models\User\User;

use CodeIgniter\Model;

class Model_permissions extends Model
{
	protected $table = 'auth_permissions';
	// protected $useAutoIncrement = false;
	protected $primaryKey = 'id';
	protected $allowedFields = ['name', 'description'];


	function get_permissions()
	{
		$query = $this->db->table('auth_permissions')
			->notLike(['id' => '1'])
			->notLike(['id' => '2'])
			->get()->getResultArray();
		return $query;
	}
}
