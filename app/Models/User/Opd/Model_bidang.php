<?php

namespace App\Models\User\Opd;

use CodeIgniter\Model;

class Model_bidang extends Model
{
	protected $table = 'tb_opd_bidang';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_opd_bidang';
	protected $allowedFields = ['kode', 'nama_bidang', 'kepala_bidang', 'nip', 'golongan', 'opd_id', 'eselon', 'aktif', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function bidang()
	{
		return $this->db->table('tb_opd_bidang')
			->select('tb_opd_bidang.*')

			->getWhere(['tb_opd_bidang.opd_id' => user()->opd_id])->getResultArray();
	}
}
