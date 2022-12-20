<?php

namespace App\Models\Admin\User;

use CodeIgniter\Model;

class Model_opd_bidang extends Model
{
	protected $table = 'tb_opd_bidang';
	protected $useAutoIncrement = false;
	protected $primaryKey = 'user_id';
	protected $allowedFields = [
		'id_opd_bidang',
		'user_id',
		'kode',
		'nama_singkat_bidang',
		'nama_panjang_bidang',
		'nama',
		'nip',
		'jabatan',
		'golongan',
		'eselon',
		'opd_id',
		'created_by',
		'updated_by',
		'created_at',
		'updated_at'
	];
}
