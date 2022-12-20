<?php

namespace App\Models\User\Opd;

use CodeIgniter\Model;

class Model_bidang_sub extends Model
{
	protected $table = 'tb_opd_bidang_sub';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_opd_bidang_sub';
	protected $allowedFields = ['kode_sub', 'nama_bidang_sub', 'opd_bidang_id', 'kepala_bidang_sub', 'nip_sub', 'golongan_sub', 'eselon_sub', 'aktif_sub', 'created_by', 'updated_by', 'created_at', 'updated_at'];
}
