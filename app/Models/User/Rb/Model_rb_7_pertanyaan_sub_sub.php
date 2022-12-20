<?php

namespace App\Models\User\Rb;

use CodeIgniter\Model;

class Model_rb_7_pertanyaan_sub_sub extends Model
{
	protected $table = 'tb_rb_7_pertanyaan_sub_sub';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_rb_pertanyaan_sub_sub';
	protected $allowedFields = [
		'rb_pertanyaan_sub_id',
		'pertanyan_sub_sub',
		'penjelasan_sub_sub',
		'pilihan_jawaban_sub_sub',
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
