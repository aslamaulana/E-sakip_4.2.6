<?php

namespace App\Models\User\Renstra;

use CodeIgniter\Model;

class Model_opd_kegiatan extends Model
{
	protected $table = 'tb_renstra_kegiatan';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_opd_kegiatan';
	protected $allowedFields = [
		'opd_kegiatan_n',
		'opd_kegiatan_sasaran_n',
		'opd_program_n',
		'opd_indikator_kegiatan',
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

	public function kegiatan()
	{
		return $this->db->table('tb_renstra_kegiatan')
			->join('set_kegiatan_90', 'tb_renstra_kegiatan.opd_kegiatan_n = set_kegiatan_90.kegiatan', 'left')
			->join('set_program_90', 'tb_renstra_kegiatan.opd_program_n = set_program_90.program', 'left')
			->orderBy('id_program ASC')
			->orderBy('id_kegiatan ASC')
			->getWhere(['tb_renstra_kegiatan.perubahan' => $_SESSION['perubahan'], 'opd_id' => user()->opd_id])->getResultArray();
	}
	public function getKegiatanSasaran()
	{
		return $this->db->table('tb_renstra_kegiatan_sasaran')
			->distinct('tb_renstra_kegiatan_sasaran.opd_kegiatan_sasaran')
			->select('tb_renstra_kegiatan_sasaran.opd_kegiatan_sasaran')
			->getWhere(['tb_renstra_kegiatan_sasaran.opd_id' => user()->opd_id])->getResultArray();
	}
	public function getOpdProgram()
	{
		return $this->db->table('tb_renstra_program')
			->distinct('tb_renstra_program.opd_program_n, tb_renstra_program.opd_id, set_program_90.id_program')
			->select('tb_renstra_program.opd_program_n, tb_renstra_program.opd_id, set_program_90.id_program')
			->join('set_program_90', 'tb_renstra_program.opd_program_n = set_program_90.program', 'LEFT')
			->getWhere(['tb_renstra_program.perubahan' => $_SESSION['perubahan'], 'tb_renstra_program.opd_id' => user()->opd_id])->getResultArray();
	}
	public function getKegiatan($program)
	{
		return $this->db->table('set_kegiatan_90')
			->select('set_kegiatan_90.id_kegiatan, set_kegiatan_90.kegiatan')
			->join('set_program_90', 'set_kegiatan_90.program_id = set_program_90.id_program', 'LEFT')
			->getWhere(['set_program_90.program' => $program])->getResult();
	}
	public function getKegiatanExport()
	{
		return $this->db->table('tb_renstra_program')
			->distinct('tb_renstra_program.opd_program_n, set_kegiatan_90.kegiatan')
			->select('tb_renstra_program.opd_program_n, set_kegiatan_90.kegiatan')
			->join('set_program_90', 'tb_renstra_program.opd_program_n = set_program_90.program', 'LEFT')
			->join('set_kegiatan_90', 'set_program_90.id_program = set_kegiatan_90.program_id', 'LEFT')
			->getWhere(['tb_renstra_program.perubahan' => $_SESSION['perubahan'], 'tb_renstra_program.opd_id' => user()->opd_id])->getResultArray();
	}
}
