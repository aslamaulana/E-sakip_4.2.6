<?php

namespace App\Models\Api;

use CodeIgniter\Model;

class Model_token extends Model
{
	protected $table = 'api_token';
	protected $primaryKey = 'id';
	protected $allowedFields = ['token'];

	public function getToken($id)
	{
		return $this->db->table('api_token')
			->getWhere(['id' => $id])->getRow();
	}
}
