<?php

namespace App\Models\User\Renstra;

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
			->getWhere(['tb_renstra_kegiatan_sub.perubahan' => $_SESSION['perubahan'], 'opd_id' => user()->opd_id])->getResultArray();
	}
	public function getOpdKegiatan()
	{
		return $this->db->table('tb_renstra_kegiatan')
			->distinct('tb_renstra_kegiatan.opd_kegiatan_n, tb_renstra_kegiatan.opd_id, set_kegiatan_90.id_kegiatan')
			->select('tb_renstra_kegiatan.opd_kegiatan_n, tb_renstra_kegiatan.opd_id, set_kegiatan_90.id_kegiatan')
			->join('set_kegiatan_90', 'tb_renstra_kegiatan.opd_kegiatan_n = set_kegiatan_90.kegiatan', 'LEFT')
			->getWhere(['tb_renstra_kegiatan.perubahan' => $_SESSION['perubahan'], 'tb_renstra_kegiatan.opd_id' => user()->opd_id])->getResultArray();
	}
	public function getKegiatanSub($kegiatan)
	{
		return $this->db->table('set_sub_kegiatan_90')
			->select('set_sub_kegiatan_90.id_sub_kegiatan, set_sub_kegiatan_90.sub_kegiatan')
			->join('set_kegiatan_90', 'set_sub_kegiatan_90.kegiatan_id = set_kegiatan_90.id_kegiatan', 'LEFT')
			->getWhere(['set_kegiatan_90.kegiatan' => $kegiatan])->getResult();
	}
	public function getKegiatanExport()
	{
		return $this->db->table('tb_renstra_kegiatan')
			->distinct('tb_renstra_kegiatan.opd_kegiatan_n, set_sub_kegiatan_90.sub_kegiatan')
			->select('tb_renstra_kegiatan.opd_kegiatan_n, set_sub_kegiatan_90.sub_kegiatan')
			->join('set_kegiatan_90', 'tb_renstra_kegiatan.opd_kegiatan_n = set_kegiatan_90.kegiatan', 'LEFT')
			->join('set_sub_kegiatan_90', 'set_kegiatan_90.id_kegiatan = set_sub_kegiatan_90.kegiatan_id', 'LEFT')
			->getWhere(['tb_renstra_kegiatan.perubahan' => $_SESSION['perubahan'], 'tb_renstra_kegiatan.opd_id' => user()->opd_id])->getResultArray();
	}
}
