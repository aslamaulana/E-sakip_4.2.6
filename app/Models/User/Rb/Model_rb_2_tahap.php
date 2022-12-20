<?php

namespace App\Models\User\Rb;

use CodeIgniter\Model;

class Model_rb_2_tahap extends Model
{
	protected $table = 'tb_rb_2_tahap';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_rb_tahap';
	protected $allowedFields = [
		'rb_urusan_id',
		'rb_tahap',
		'rb_tahap_bobot',
		'opd_id',
		'tahun',
		'created_by',
		'updated_by',
		'created_at',
		'updated_at'
	];

	// public function sakip_instansi()
	// {
	// 	return $this->db->table('tb_sakip_instansi')
	// 		->select('tb_sakip_komponen.komponen, tb_sakip_komponen_sub.komponen_sub, tb_sakip_instansi.*')
	// 		->join('tb_sakip_komponen_sub', 'tb_sakip_instansi.komponen_sub_n = tb_sakip_komponen_sub.komponen_sub', 'LEFT')
	// 		->join('tb_sakip_komponen', 'tb_sakip_komponen_sub.komponen_n = tb_sakip_komponen.komponen', 'LEFT');
	// }
}
