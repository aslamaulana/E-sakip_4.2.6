<?php

namespace App\Models\User\User;

use CodeIgniter\Model;

class Model_users extends Model
{
	protected $table = 'users';
	protected $useTimestamps = true;
	protected $useAutoIncrement = false;
	protected $primaryKey = 'id';
	protected $allowedFields = [
		'id', 'email', 'username', 'password_hash', 'full_name', 'user_image', 'active', 'opd_id',
		'nama_singkat_bidang',
		'nama_panjang_bidang',
		'sub_bidang',
		'nip',
		'jabatan',
		'level',
		'golongan',
		'eselon',
	];

	public function Users()
	{
		return $this->db->table('users')
			->select('users.*')
			->select('auth_groups.name as group_name')
			->join('auth_groups_users', 'auth_groups_users.user_id = users.id', 'left')
			->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id', 'left')
			->notLike('users.id', '0001')->get()->getResultArray();
	}
	public function Users2()
	{
		return $this->db->table('users')
			->select('users.*')
			->select('auth_groups.name as group_name')
			->join('auth_groups_users', 'auth_groups_users.user_id = users.id', 'left')
			->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id', 'left')
			->notLike('users.id', '0001')->getWhere(['opd_id' => user()->opd_id, 'level' => '1'])->getResultArray();
	}
	public function UsersBidang()
	{
		return $this->db->table('users')
			->select('users.*')
			->select('auth_groups.name as group_name')
			->join('auth_groups_users', 'auth_groups_users.user_id = users.id', 'left')
			->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id', 'left')
			->notLike('users.id', '0001')->getWhere(['opd_id' => user()->opd_id])->getResultArray();
	}
	public function UsersKaban()
	{
		return $this->db->table('users')
			->select('users.*')
			->select('auth_groups.name as group_name')
			->join('auth_groups_users', 'auth_groups_users.user_id = users.id', 'left')
			->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id', 'left')
			->notLike('users.id', '0001')->get()->getResultArray();
	}
	public function Edit($id)
	{
		return $this->db->table('users')
			->select('users.*')
			->select('auth_groups.name as group_name')
			->select('auth_groups_users.*')
			->join('auth_groups_users', 'auth_groups_users.user_id = users.id', 'left')
			->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id', 'left')
			->getWhere(['users.id' => buka($id)])->getRowArray();
	}

	public function buat_kode()
	{

		$query = $this->db->table('users')
			->select('RIGHT(users.id,4) as kode', FALSE)
			->orderBy('id', 'DESC')
			->limit(1)->get();

		if ($query->getRowArray() <> 0) {
			//jika kode ternyata sudah ada.      
			$data = $query->getRow();
			$kode = intval($data->kode) + 1;
		} else {
			//jika kode belum ada      
			$kode = 1;
		}

		$kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
		$kodejadi = $kodemax;    // hasilnya ODJ-9921-0001 dst.
		return $kodejadi;
	}
}
