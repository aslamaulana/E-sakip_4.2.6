<?php

namespace App\Models\User\Rb;

use CodeIgniter\Model;

class Model_rb_3_komponen extends Model
{
	protected $table = 'tb_rb_3_komponen';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_rb_komponen';
	protected $allowedFields = [
		'id_rb_komponen',
		'rb_tahap_id',
		'rb_komponen',
		'rb_komponen_bobot',
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
