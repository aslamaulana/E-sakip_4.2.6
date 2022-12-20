<?php

namespace App\Models\Admin\User;

use CodeIgniter\Model;

class Model_bidang extends Model
{
	protected $table = 'auth_groups';
	protected $useAutoIncrement = false;
	protected $allowedFields = ['id', 'name', 'description'];

	public function skpd()
	{
		return $this->db->table('auth_groups')
			->notLike('auth_groups.id', '0001')->get()->getResultArray();
	}
	public function Groups()
	{
		return $this->db->table('auth_groups')
			->select('auth_groups.*')
			->notLike('auth_groups.id', '0001')->get()->getResultArray();
	}
	public function GroupsKepala()
	{
		return $this->db->table('auth_groups')
			->select('auth_groups.*')
			->join('auth_groups_permissions', 'auth_groups_permissions.group_id = auth_groups.id', 'left')
			->join('auth_permissions', 'auth_permissions.id = auth_groups_permissions.permission_id', 'left')
			->Like('auth_permissions.name', 'Kepala')->get()->getResultArray();
	}
	public function Groups_t_k()
	{
		return $this->db->table('auth_groups')
			->select('auth_groups.*')
			->select('auth_permissions.name as permission_name')
			->join('auth_groups_permissions', 'auth_groups_permissions.group_id = auth_groups.id', 'left')
			->join('auth_permissions', 'auth_permissions.id = auth_groups_permissions.permission_id', 'left')
			->notLike('auth_groups.id', '0001')
			->get()->getResultArray();
	}
	public function Edit($id)
	{
		return $this->table('auth_groups')
			->select('auth_groups.*')
			->select('auth_permissions.name as permission_name')
			->select('auth_permissions.id as permission_id')
			->select('auth_groups_permissions.id_g_p')
			->join('auth_groups_permissions', 'auth_groups_permissions.group_id = auth_groups.id', 'left')
			->join('auth_permissions', 'auth_permissions.id = auth_groups_permissions.permission_id', 'left')
			->getWhere(['auth_groups.id' => $id])->getRowArray();
	}
	public function namaBidang()
	{
		return $this->db->table('auth_groups')
			->getWhere(['auth_groups.id' => user()->opd_id])->getRow();
	}
	public function buat_kode()
	{

		$query = $this->db->table('auth_groups')
			->select('RIGHT(auth_groups.id,4) as kode', FALSE)
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
