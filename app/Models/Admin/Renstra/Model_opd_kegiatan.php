<?php

namespace App\Models\Admin\Renstra;

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
			->getWhere(['tb_renstra_kegiatan.perubahan' => $_SESSION['perubahan'], 'opd_id' => $_SESSION['opd_set']])->getResultArray();
	}
	public function opd()
	{
		return $this->db->table('auth_groups')
			->notLike('auth_groups.id', '0001')->get()->getResultArray();
	}
}
