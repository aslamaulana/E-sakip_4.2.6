<?php

namespace App\Models\User\Renstra;

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

	public function ProgramSasaran()
	{
		return $this->db->table('tb_renstra_program')
			->distinct('tb_renstra_program.opd_program_sasaran_n')
			->select('tb_renstra_program.opd_program_sasaran_n')
			->getWhere(['tb_renstra_program.perubahan' => $_SESSION['perubahan'], 'tb_renstra_program.opd_id' => user()->opd_id])->getResultArray();
	}
	public function program()
	{
		return $this->db->table('tb_renstra_program')
			->join('set_program_90', 'tb_renstra_program.opd_program_n = set_program_90.program', 'left')
			->getWhere(['tb_renstra_program.perubahan' => $_SESSION['perubahan'], 'opd_id' => user()->opd_id])->getResultArray();
	}
	public function getOpdProgramSasaran()
	{
		return $this->db->table('tb_renstra_program_sasaran')
			->distinct('tb_renstra_program_sasaran.opd_program_sasaran, tb_renstra_program_sasaran.opd_id')
			->select('tb_renstra_program_sasaran.opd_program_sasaran, tb_renstra_program_sasaran.opd_id')
			->getWhere(['tb_renstra_program_sasaran.opd_id' => user()->opd_id])->getResultArray();
	}
	public function getOpdSasaran()
	{
		return $this->db->table('tb_renstra_sasaran')
			->distinct('tb_renstra_sasaran.opd_sasaran, tb_renstra_sasaran.opd_kode_sasaran')
			->select('tb_renstra_sasaran.opd_sasaran, tb_renstra_sasaran.opd_kode_sasaran')
			->getWhere(['tb_renstra_sasaran.perubahan' => $_SESSION['perubahan'], 'tb_renstra_sasaran.opd_id' => user()->opd_id])->getResultArray();
	}
	public function getProgram()
	{
		return $this->db->table('tb_rpjmd_program')
			->distinct('set_program_90.id_program,tb_rpjmd_program.program_90,tb_rpjmd_program.opd_id')
			->select('set_program_90.id_program,tb_rpjmd_program.program_90,tb_rpjmd_program.opd_id')
			->join('set_program_90', 'tb_rpjmd_program.program_90 = set_program_90.program', 'LEFT')
			->getWhere(['tb_rpjmd_program.opd_id' => user()->opd_id])->getResultArray();
	}
}
