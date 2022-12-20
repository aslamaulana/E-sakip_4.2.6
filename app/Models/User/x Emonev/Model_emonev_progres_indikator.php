<?php

namespace App\Models\User\Emonev;

use CodeIgniter\Model;

class Model_emonev_progres_indikator extends Model
{
	protected $table = 'tb_emonev_progres_indikator';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_emonev_progres_indikator';
	protected $allowedFields = ['dpa_indikator_id', 'bulan', 'bulan_lapor', 'realisasi_dpa_indikator', 'tahun', 'opd_id', 'created_by', 'updated_by', 'created_at', 'updated_at'];
}
