<?php

namespace App\Models\User\Rb;

use CodeIgniter\Model;

class Model_rb_5_pertanyaan extends Model
{
	protected $table = 'tb_rb_5_pertanyaan';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_rb_pertanyaan';
	protected $allowedFields = [
		'rb_komponen_sub_id',
		'pertanyaan',
		'penjelasan',
		'pilihan_jawaban',
		'opd_id',
		'tahun',
		'created_by',
		'updated_by',
		'created_at',
		'updated_at'
	];

	public function pertanyaan()
	{
		return $this->db->table('tb_rb_5_pertanyaan')
			->select('
			tb_rb_5_pertanyaan.*,
			tb_rb_4_komponen_sub.rb_komponen_sub, 
			tb_rb_3_komponen.rb_komponen, 
			tb_rb_2_tahap.rb_tahap, 
			tb_rb_1_urusan.rb_urusan')
			->join('tb_rb_4_komponen_sub', 'tb_rb_5_pertanyaan.rb_komponen_sub_id = tb_rb_4_komponen_sub.id_rb_komponen_sub', 'LEFT')
			->join('tb_rb_3_komponen', 'tb_rb_4_komponen_sub.rb_komponen_id = tb_rb_3_komponen.id_rb_komponen', 'LEFT')
			->join('tb_rb_2_tahap', 'tb_rb_3_komponen.rb_tahap_id = tb_rb_2_tahap.id_rb_tahap', 'LEFT')
			->join('tb_rb_1_urusan', 'tb_rb_2_tahap.rb_urusan_id = tb_rb_1_urusan.id_rb_urusan', 'LEFT');
	}
}
