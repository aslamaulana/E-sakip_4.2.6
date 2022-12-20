<?php

namespace App\Models\Admin\Renstra;

use CodeIgniter\Model;

class Model_opd_sasaran extends Model
{
	protected $table = 'tb_renstra_sasaran';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_opd_sasaran';
	protected $allowedFields = [
		'opd_tujuan_n',
		'rpjmd_sasaran_n',
		'opd_kode_sasaran',
		'opd_sasaran',
		'opd_indikator_sasaran',
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
	public function sasaran()
	{
		return $this->db->table('tb_renstra_sasaran')
			->select('tb_renstra_sasaran.*, tb_rpjmd_sasaran.kode_sasaran, tb_renstra_tujuan.opd_kode_tujuan')
			->distinct('tb_renstra_sasaran.*, tb_rpjmd_sasaran.kode_sasaran, tb_renstra_tujuan.opd_kode_tujuan')
			->join('tb_rpjmd_sasaran', 'tb_renstra_sasaran.rpjmd_sasaran_n = tb_rpjmd_sasaran.sasaran', 'left')
			->join('tb_renstra_tujuan', 'tb_renstra_sasaran.opd_id = tb_renstra_tujuan.opd_id AND tb_renstra_sasaran.opd_tujuan_n = tb_renstra_tujuan.opd_tujuan AND tb_renstra_sasaran.perubahan = tb_renstra_tujuan.perubahan', 'left')
			->orderBy('tb_renstra_sasaran.opd_kode_sasaran', 'ASC')
			->getWhere(['tb_renstra_sasaran.opd_id' => $_SESSION['opd_set'], 'tb_renstra_sasaran.perubahan' => $_SESSION['perubahan']])->getResultArray();
	}
	public function opd()
	{
		return $this->db->table('auth_groups')
			->notLike('auth_groups.id', '0001')->get()->getResultArray();
	}
}
