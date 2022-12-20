<?php

namespace App\Models\Admin\RPJMD;

use CodeIgniter\Model;

class Model_sasaran extends Model
{
	protected $table = 'tb_rpjmd_sasaran';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_sasaran';
	protected $allowedFields = [
		'tujuan_n',
		'kode_sasaran',
		'sasaran',
		'indikator_sasaran',
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

	public function sasaranEdit($p, $k, $m)
	{
		return $this->db->table('tb_rpjmd_sasaran')
			->select('tb_rpjmd_sasaran.*')
			->getWhere(['tb_rpjmd_sasaran.sasaran' => $p, 'tb_rpjmd_sasaran.kode_sasaran' => $k, 'tb_rpjmd_sasaran.tujuan_n' => $m])->getRowArray();
	}
	public function tujuan()
	{
		return $this->db->table('tb_rpjmd_sasaran')
			->distinct('tb_rpjmd_tujuan.tujuan, tb_rpjmd_tujuan.kode_tujuan')
			->select('tb_rpjmd_tujuan.tujuan, tb_rpjmd_tujuan.kode_tujuan')

			->join('tb_rpjmd_tujuan', 'tb_rpjmd_sasaran.tujuan_n = tb_rpjmd_tujuan.tujuan', 'left')
			->orderBy('tb_rpjmd_tujuan.kode_tujuan', 'ASC')
			->get()->getResultArray();
	}
	public function getTujuan()
	{
		return $this->db->table('tb_rpjmd_tujuan')
			->distinct('tb_rpjmd_tujuan.tujuan, tb_rpjmd_tujuan.kode_tujuan')
			->select('tb_rpjmd_tujuan.tujuan, tb_rpjmd_tujuan.kode_tujuan')
			->get()->getResultArray();
	}

	// data untuk tujuan renstra berdasarkan sasaran rpjmd, maping opd program (misi)
	public function TujuanMisiOpd()
	{
		return $this->db->table('tb_rpjmd_program')
			->distinct('tb_rpjmd_tujuan.misi_n,	tb_misi.kode_misi')
			->select('tb_rpjmd_tujuan.misi_n,	tb_misi.kode_misi')
			->join('tb_rpjmd_sasaran', 'tb_rpjmd_program.sasaran_n = tb_rpjmd_sasaran.sasaran', 'LEFT')
			->join('tb_rpjmd_tujuan', 'tb_rpjmd_sasaran.tujuan_n = tb_rpjmd_tujuan.tujuan`', 'LEFT')
			->join('tb_misi', 'tb_rpjmd_tujuan.misi_n = tb_misi.misi', 'LEFT');
	}
}
