<?php

namespace App\Models\User\Dpa;

use CodeIgniter\Model;

class Model_dpa_indikator extends Model
{
	protected $table = 'tb_dpa_indikator';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_dpa_indikator';
	protected $allowedFields = ['dpa_id', 'indikator', 'type', 'satuan_id', 'target_akhir', 'opd_id', 'tahun', 'created_by', 'updated_by', 'created_at', 'updated_at'];

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
			->getWhere(['tb_opd_program.opd_id' => user()->opd_id])->getResultArray();
	}
	public function id_dpa_indikator($id_sub)
	{
		return $this->db->table('tb_dpa_indikator')
			->select('tb_dpa_indikator.*')
			->select('tb_satuan.satuan')
			->select('tb_satuan.id_satuan')

			->join('tb_satuan', 'tb_dpa_indikator.satuan_id = tb_satuan.id_satuan', 'left')
			->getWhere(['id_dpa_indikator' => $id_sub, 'tb_dpa_indikator.tahun' => $_SESSION['tahun']])->getRowArray();
	}
}
