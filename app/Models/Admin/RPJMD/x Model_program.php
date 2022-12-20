<?php

namespace App\Models\Admin\RPJMD;

use CodeIgniter\Model;

class Model_program extends Model
{
	protected $table = 'tb_rpjmd_program';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_program';
	protected $allowedFields = [
		'kode_urusan_90',
		'urusan_90',
		'kode_bidang_90',
		'bidang_90',
		'kode_program_90',
		'program_90',
		'sasaran_n',
		'indikator_program',
		't_2021',
		'rp_2021',
		't_2022',
		'rp_2022',
		't_2023',
		'rp_2023',
		't_2024',
		'rp_2024',
		't_2025',
		'rp_2025',
		't_2026',
		'rp_2026',
		'opd_id',
		'created_by',
		'updated_by',
		'created_at',
		'updated_at',
		'satuan'
	];

	public function programEdit($id)
	{
		return $this->db->table('vw_program')
			->getWhere(['vw_program.id_program' => $id])->getRowArray();
	}

	public function getSasaran()
	{
		return $this->db->table('tb_rpjmd_sasaran')
			->distinct('tb_rpjmd_sasaran.kode_sasaran, tb_rpjmd_sasaran.sasaran')
			->select('tb_rpjmd_sasaran.kode_sasaran, tb_rpjmd_sasaran.sasaran')
			->get()->getResultArray();
	}
	public function sasaran()
	{
		return $this->db->table('tb_rpjmd_program')
			->distinct('tb_rpjmd_sasaran.kode_sasaran, tb_rpjmd_sasaran.sasaran')
			->select('tb_rpjmd_sasaran.kode_sasaran, tb_rpjmd_sasaran.sasaran')

			->join('tb_rpjmd_sasaran', 'tb_rpjmd_program.sasaran_n = tb_rpjmd_sasaran.sasaran', 'LEFT')
			->orderBy('tb_rpjmd_sasaran.kode_sasaran', 'ASC')
			->get()->getResultArray();
	}
	public function program($id)
	{
		return $this->db->table('tb_program')
			->select('set_program_90.program')
			->select('tb_program.id_program')
			->select('tb_program.program_id')
			->join('set_program_90', 'tb_program.program_id = set_program_90.id_program', 'LEFT')
			->getWhere(['tb_program.id_program' => $id])->getRowArray();
	}

	function getBidang($urusan)
	{
		$query = $this->db->table('set_bidang_90')
			->join('set_urusan_90', 'set_bidang_90.urusan_id = set_urusan_90.id_urusan', 'LEFT')
			->getWhere(['urusan' => $urusan])->getResult();
		return $query;
	}

	function getProgram($bidang)
	{
		$query = $this->db->table('set_program_90')
			->join('set_bidang_90', 'set_program_90.bidang_id = set_bidang_90.id_bidang', 'LEFT')
			->Where(['bidang' => $bidang])->get()
			->getResult();
		return $query;
	}
}
