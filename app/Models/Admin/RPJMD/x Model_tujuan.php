<?php

namespace App\Models\Admin\RPJMD;

use CodeIgniter\Model;

class Model_tujuan extends Model
{
	protected $table = 'tb_rpjmd_tujuan';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_tujuan';
	protected $allowedFields = [
		'misi_n',
		'kode_tujuan',
		'tujuan',
		'indikator_tujuan',
		'satuan',
		't_2021',
		't_2022',
		't_2023',
		't_2024',
		't_2025',
		't_2026',
		'created_by',
		'updated_by',
		'created_at',
		'updated_at'
	];

	public function tujuanEdit($p, $k, $m)
	{
		return $this->db->table('tb_rpjmd_tujuan')
			->select('tb_rpjmd_tujuan.*')
			->getWhere(['tb_rpjmd_tujuan.tujuan' => $p, 'tb_rpjmd_tujuan.kode_tujuan' => $k, 'tb_rpjmd_tujuan.misi_n' => $m])->getRowArray();
	}
	public function visi()
	{
		return $this->db->table('tb_rpjmd_tujuan')
			->distinct('tb_visi.visi')
			->select('tb_visi.visi')
			->select('tb_visi.kode_visi')
			->select('tb_visi.visi')
			->join('tb_misi', 'tb_rpjmd_tujuan.misi_n = tb_misi.misi', 'left')
			->join('tb_visi', 'tb_misi.visi = tb_visi.visi', 'left')
			->get()->getResultArray();
	}
	function getMisi($visi)
	{
		$query = $this->db->table('tb_misi')->getWhere(['visi' => $visi])->getResult();
		return $query;
	}
}
