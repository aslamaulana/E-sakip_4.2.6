<?php

namespace App\Models\User\Rb;

use CodeIgniter\Model;

class Model_rb_6_pertanyaan_sub extends Model
{
	protected $table = 'tb_rb_6_pertanyaan_sub';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_rb_pertanyaan_sub';
	protected $allowedFields = [
		'id_rb_pertanyaan_sub',
		'rb_pertanyaan_id',
		'pertanyan_sub',
		'penjelasan_sub',
		'pilihan_jawaban_sub',
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
