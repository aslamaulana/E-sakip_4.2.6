<?php

namespace App\Models\User\Dpa;

use CodeIgniter\Model;

class Model_dpa extends Model
{
	protected $table = 'tb_dpa';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_dpa';
	protected $allowedFields = ['opd_kegiatan_sub_id', 'bidang_sub_id', 'pagu_dpa', 'lokasi', 'sasaran_sub_kegiatan', 'satuan', 'tgl_mulai', 'tgl_selesai', 'opd_id', 'tahun', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function dpa_program()
	{
		return $this->db->table('tb_dpa')
			->distinct('set_program_90.id_program')
			->orderBy('set_program_90.id_program', 'ASC')
			->select('tb_opd_program.id_opd_program')
			->select('set_program_90.id_program')
			->select('set_program_90.program')

			->join('tb_opd_kegiatan_sub', 'tb_dpa.opd_kegiatan_sub_id = tb_opd_kegiatan_sub.id_opd_kegiatan_sub', 'left')
			->join('tb_opd_kegiatan', 'tb_opd_kegiatan_sub.opd_kegiatan_id = tb_opd_kegiatan.id_opd_kegiatan', 'left')
			->join('tb_opd_program', 'tb_opd_kegiatan.opd_program_id = tb_opd_program.id_opd_program', 'left')
			->join('tb_program', 'tb_opd_program.program_id = tb_program.id_program', 'left')
			->join('set_program_90', 'tb_program.program_id = set_program_90.id_program', 'left')
			->getWhere(['tb_opd_program.opd_id' => user()->opd_id, 'tb_dpa.tahun' => $_SESSION['tahun']])->getResultArray();
	}
	public function emonev_program($id)
	{
		return $this->db->table('tb_dpa')
			->select('set_kegiatan_90.id_kegiatan')
			->select('set_kegiatan_90.kegiatan')
			->select('set_sub_kegiatan_90.id_sub_kegiatan')
			->select('set_sub_kegiatan_90.sub_kegiatan')
			->select('set_program_90.program')

			->join('tb_opd_kegiatan_sub', 'tb_dpa.opd_kegiatan_sub_id = tb_opd_kegiatan_sub.id_opd_kegiatan_sub', 'left')
			->join('tb_opd_kegiatan', 'tb_opd_kegiatan_sub.opd_kegiatan_id = tb_opd_kegiatan.id_opd_kegiatan', 'left')
			->join('set_sub_kegiatan_90', 'tb_opd_kegiatan_sub.kegiatan_sub_id = set_sub_kegiatan_90.id_sub_kegiatan', 'left')
			->join('set_kegiatan_90', 'tb_opd_kegiatan.kegiatan_id = set_kegiatan_90.id_kegiatan', 'left')
			->join('tb_opd_program', 'tb_opd_kegiatan.opd_program_id = tb_opd_program.id_opd_program', 'left')
			->join('tb_program', 'tb_opd_program.program_id = tb_program.id_program', 'left')
			->join('set_program_90', 'tb_program.program_id = set_program_90.id_program', 'left')
			->getWhere(['tb_dpa.id_dpa' => $id, 'tb_dpa.tahun' => $_SESSION['tahun']])->getRowArray();
	}
	public function opd_program()
	{
		return $this->db->table('tb_opd_program')
			->select('tb_opd_program.id_opd_program')
			->select('tb_opd_program.opd_id')
			->select('set_program_90.id_program')
			->select('set_program_90.program')

			->join('tb_program', 'tb_opd_program.program_id = tb_program.id_program', 'left')
			->join('set_program_90', 'tb_program.program_id = set_program_90.id_program', 'left')
			->getWhere(['tb_opd_program.opd_id' => user()->opd_id])->getResultArray();
	}
	public function opd_bidang_sub()
	{
		return $this->db->table('tb_opd_bidang')
			->select('tb_opd_bidang.nama_bidang')
			->select('tb_opd_bidang_sub.nama_bidang_sub')
			->select('tb_opd_bidang_sub.id_opd_bidang_sub')
			->select('tb_opd_bidang.opd_id')

			->join('tb_opd_bidang_sub', 'tb_opd_bidang.id_opd_bidang = tb_opd_bidang_sub.opd_bidang_id', 'left')
			->getWhere(['tb_opd_bidang.opd_id' => user()->opd_id])->getResultArray();
	}
	public function get_kegiatan($id)
	{
		return $this->db->table('tb_opd_kegiatan')
			->select('tb_opd_kegiatan.id_opd_kegiatan')
			->select('set_kegiatan_90.id_kegiatan')
			->select('set_kegiatan_90.kegiatan')
			->select('tb_opd_kegiatan.opd_program_id')

			->join('set_kegiatan_90', 'tb_opd_kegiatan.kegiatan_id = set_kegiatan_90.id_kegiatan', 'left')
			->getWhere(['tb_opd_kegiatan.opd_program_id' => $id])->getResultArray();
	}
	public function get_kegiatan_sub($id)
	{
		return $this->db->table('tb_opd_kegiatan_sub')
			->select('tb_opd_kegiatan_sub.id_opd_kegiatan_sub')
			->select('tb_opd_kegiatan_sub.opd_kegiatan_id')
			->select('tb_opd_kegiatan_sub.kegiatan_sub_id')
			->select('set_sub_kegiatan_90.id_sub_kegiatan')
			->select('set_sub_kegiatan_90.sub_kegiatan')

			->join('set_sub_kegiatan_90', 'tb_opd_kegiatan_sub.kegiatan_sub_id = set_sub_kegiatan_90.id_sub_kegiatan', 'left')
			->getWhere(['tb_opd_kegiatan_sub.opd_kegiatan_id' => $id])->getResultArray();
	}
	public function dpa_edit($id)
	{
		return $this->db->table('tb_dpa')
			->select('tb_dpa.*')
			->select('tb_opd_kegiatan_sub.id_opd_kegiatan_sub')
			->select('set_sub_kegiatan_90.id_sub_kegiatan')
			->select('set_sub_kegiatan_90.sub_kegiatan')
			->select('tb_opd_kegiatan.id_opd_kegiatan')
			->select('set_kegiatan_90.id_kegiatan')
			->select('set_kegiatan_90.kegiatan')
			->select('tb_opd_program.id_opd_program')
			->select('set_program_90.id_program')
			->select('set_program_90.program')
			->select('tb_opd_bidang_sub.id_opd_bidang_sub')
			->select('tb_opd_bidang_sub.nama_bidang_sub')
			->select('tb_opd_bidang.nama_bidang')

			->join('tb_opd_kegiatan_sub', 'tb_dpa.opd_kegiatan_sub_id = tb_opd_kegiatan_sub.id_opd_kegiatan_sub', 'left')
			->join('set_sub_kegiatan_90', 'tb_opd_kegiatan_sub.kegiatan_sub_id = set_sub_kegiatan_90.id_sub_kegiatan', 'left')
			->join('tb_opd_kegiatan', 'tb_opd_kegiatan_sub.opd_kegiatan_id = tb_opd_kegiatan.id_opd_kegiatan', 'left')
			->join('set_kegiatan_90', 'tb_opd_kegiatan.kegiatan_id = set_kegiatan_90.id_kegiatan', 'left')
			->join('tb_opd_program', 'tb_opd_kegiatan.opd_program_id = tb_opd_program.id_opd_program', 'left')
			->join('tb_program', 'tb_opd_program.program_id = tb_program.id_program', 'left')
			->join('set_program_90', 'tb_program.program_id = set_program_90.id_program', 'left')
			->join('tb_opd_bidang_sub', 'tb_dpa.bidang_sub_id = tb_opd_bidang_sub.id_opd_bidang_sub', 'left')
			->join('tb_opd_bidang', 'tb_opd_bidang_sub.opd_bidang_id = tb_opd_bidang.id_opd_bidang', 'left')
			->getWhere(['tb_dpa.id_dpa' => $id])->getRowArray();
	}
}
