<?php

namespace App\Models\Admin\Renstra;

use CodeIgniter\Model;

class Model_opd_tujuan extends Model
{
	protected $table = 'tb_renstra_tujuan';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_opd_tujuan';
	protected $allowedFields = [
		'opd_kode_tujuan',
		'opd_tujuan',
		'opd_indikator_tujuan',
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

	public function tujuan()
	{
		return $this->db->table('tb_renstra_tujuan')
			->select('opd_tujuan, opd_kode_tujuan, opd_id')
			->distinct('opd_tujuan, opd_kode_tujuan, opd_id')
			->getwhere(['opd_id' => $_SESSION['opd_set'], 'perubahan' => $_SESSION['perubahan']])->getResultArray();
	}
	public function opd()
	{
		return $this->db->table('auth_groups')
			->notLike('auth_groups.id', '0001')->get()->getResultArray();
	}
}
