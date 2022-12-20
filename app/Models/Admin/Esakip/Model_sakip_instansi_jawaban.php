<?php

namespace App\Models\Admin\Esakip;

use CodeIgniter\Model;

class Model_sakip_instansi_jawaban extends Model
{
	protected $table = 'tb_sakip_instansi_jawaban';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_sakip_instansi_jawaban';
	protected $allowedFields = [
		'id_sakip_instansi_jawaban',
		'sakip_instansi_id',
		'jawaban',
		'link_keterangan',
		'link_1',
		'link_2',
		'link_3',
		'catatan',
		'nilai',
		'opd_id',
		'tahun',
		'created_by',
		'updated_by',
		'created_at',
		'updated_at'
	];
}
