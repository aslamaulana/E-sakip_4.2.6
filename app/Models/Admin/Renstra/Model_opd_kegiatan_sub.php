<?php

namespace App\Models\Admin\Renstra;

use CodeIgniter\Model;

class Model_opd_kegiatan_sub extends Model
{
	protected $table = 'tb_renstra_kegiatan_sub';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_opd_kegiatan_sub';
	protected $allowedFields = [
		'opd_kegiatan_sub_n',
		'opd_kegiatan_n',
		'opd_indikator_kegiatan_sub',
		'satuan',
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
		'tahun',
		'perubahan',
		'created_by',
		'updated_by',
		'created_at',
		'updated_at'
	];

	public function kegiatan_sub()
	{
		return $this->db->table('tb_renstra_kegiatan_sub')
			->select('tb_renstra_kegiatan_sub.*, set_sub_kegiatan_90.id_sub_kegiatan, set_kegiatan_90.id_kegiatan')
			->join('set_kegiatan_90', 'tb_renstra_kegiatan_sub.opd_kegiatan_n = set_kegiatan_90.kegiatan', 'left')
			->join('set_sub_kegiatan_90', 'tb_renstra_kegiatan_sub.opd_kegiatan_sub_n = set_sub_kegiatan_90.sub_kegiatan AND set_kegiatan_90.id_kegiatan = set_sub_kegiatan_90.kegiatan_id', 'left')
			->orderBy('id_kegiatan ASC')
			->orderBy('id_sub_kegiatan ASC')
			->getWhere(['tb_renstra_kegiatan_sub.perubahan' => $_SESSION['perubahan'], 'opd_id' => $_SESSION['opd_set']])->getResultArray();
	}
	public function opd()
	{
		return $this->db->table('auth_groups')
			->notLike('auth_groups.id', '0001')->get()->getResultArray();
	}
}
