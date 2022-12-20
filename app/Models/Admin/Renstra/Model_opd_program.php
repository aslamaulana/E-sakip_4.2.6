<?php

namespace App\Models\Admin\Renstra;

use CodeIgniter\Model;

class Model_opd_program extends Model
{
	protected $table = 'tb_renstra_program';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_opd_program';
	protected $allowedFields = [
		'opd_program_n',
		'opd_program_sasaran_n',
		'opd_sasaran_n',
		'opd_indikator_program',
		'satuan',
		't_2021',
		't_2022',
		't_2023',
		't_2024',
		't_2025',
		't_2026',
		'opd_id',
		'tahun',
		'perubahan',
		'created_by',
		'updated_by',
		'created_at',
		'updated_at'
	];

	public function program()
	{
		return $this->db->table('tb_renstra_program')
			->join('set_program_90', 'tb_renstra_program.opd_program_n = set_program_90.program', 'left')
			->getWhere(['tb_renstra_program.perubahan' => $_SESSION['perubahan'], 'opd_id' => $_SESSION['opd_set']])->getResultArray();
	}
	public function opd()
	{
		return $this->db->table('auth_groups')
			->notLike('auth_groups.id', '0001')->get()->getResultArray();
	}
}
