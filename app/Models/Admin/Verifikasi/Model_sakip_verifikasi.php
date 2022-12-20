<?php

namespace App\Models\Admin\Verifikasi;

use CodeIgniter\Model;

class Model_sakip_verifikasi extends Model
{
	protected $table = 'tb_sakip_instansi_jawaban_verifikasi';
	protected $useTimestamps = true;
	protected $useAutoIncrement = false;
	protected $primaryKey = 'id_sakip_instansi_jawaban_verifikasi';
	protected $allowedFields = ['sakip_instansi_jawaban_id', 'verifikasi', 'verifikasi_keterangan', 'nm_verifikator', 'tahun', 'opd_id', 'created_by', 'updated_by', 'created_at', 'updated_at'];
}
