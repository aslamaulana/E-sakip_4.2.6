<?php

namespace App\Models\User\Rkpd;

use CodeIgniter\Model;

class Model_opd_kegiatan extends Model
{
	protected $table = 'tb_rkpd_kegiatan';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_rkpd_kegiatan';
	protected $allowedFields = [
		'rkpd_program_n',
		'rkpd_kegiatan_n',
		// 'rkpd_kegiatan_sasaran_n',
		'rkpd_indikator_kegiatan',
		'lokasi',
		'sumber_dana',
		'satuan',
		't_tahun',
		'rp_tahun',
		't_tahun+n',
		'rp_tahun+n',
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
		return $this->db->table('tb_rkpd_kegiatan')
			->join('set_kegiatan_90', 'tb_rkpd_kegiatan.rkpd_kegiatan_n = set_kegiatan_90.kegiatan', 'left')
			->join('set_program_90', 'tb_rkpd_kegiatan.rkpd_program_n = set_program_90.program', 'LEFT')
			->orderBy('id_program ASC')
			->orderBy('id_kegiatan ASC')
			->getWhere(['perubahan' => $_SESSION['perubahan'], 'tahun' => $_SESSION['tahun'], 'opd_id' => user()->opd_id])->getResultArray();
	}
	public function getRenstraKegiatan()
	{
		return $this->db->table('tb_renstra_kegiatan')
			->getWhere(['perubahan' => $_SESSION['perubahan'], 'tb_renstra_kegiatan.opd_id' => user()->opd_id])->getResultArray();
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
