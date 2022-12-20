<?php

namespace App\Controllers\User\Renstra;

use App\Controllers\BaseController;
use App\Models\Admin\User\Model_bidang;
use App\Models\User\Renstra\Model_opd_tujuan;
use App\Models\User\Renstra\Model_opd_kegiatan_sub;
use App\Models\User\Renstra\Model_opd_kegiatan;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Opd_renstra_print extends BaseController
{
	protected $opd_kegiatan_sub, $satuan;

	public function __construct()
	{
		$this->opd = new Model_bidang();
		$this->opd_tujuan = new Model_opd_tujuan();
		$this->opd_kegiatan_sub = new Model_opd_kegiatan_sub();
		$this->opd_kegiatan = new Model_opd_kegiatan();
	}

	// ----------------------------------------------------------------------
	public function index()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			$i = $_SESSION['perubahan'] == 'Murni' ? 'Penetapan Ke I' : 'Penetapan Ke II';
			$filename = "Renstra " . $i . " - " . date('Y-m-d') . ".xls";
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment; filename="' . $filename . '";');

			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_program',
				'title' => 'User | Program',
				'lok' => '<b>Data</b>',
				'db' => \Config\Database::connect(),
			];
			return view('user/Renstra/opd_renstra_print', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
}
