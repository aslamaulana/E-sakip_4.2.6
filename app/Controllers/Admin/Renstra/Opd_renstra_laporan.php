<?php

namespace App\Controllers\Admin\Renstra;

use App\Controllers\BaseController;
use App\Models\Admin\User\Model_bidang;

class Opd_renstra_laporan extends BaseController
{
	protected $opd;

	public function __construct()
	{
		$this->opd = new Model_bidang();
	}

	public function index()
	{
		if (has_permission('Admin')) :
			$opd = $this->opd->notLike('auth_groups.id', '0001')->get()->getResultArray();
			$data = [
				'gr' => 'A_Renstra',
				'mn' => 'A_opd_laporan',
				'title' => 'Admin | Laporan',
				'lok' => '<b>Laporan Renstra</b>',
				'opd' => $opd,
				'db' => \Config\Database::connect(),
			];
			// dd($data);
			echo view('admin/Renstra/opd_laporan', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function cetak()
	{
		if (has_permission('Admin')) {
			$type = $this->request->getVar('type');
			if ($type == 'excel') {
				$i = $_SESSION['perubahan'] == 'Murni' ? 'Penetapan Ke I' : 'Penetapan Ke II';
				$filename = "Renstra " . $i . " - " . date('Y-m-d') . ".xls";
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment; filename="' . $filename . '";');

				$data = [
					'gr' => 'A_Renstra',
					'mn' => 'A_opd_laporan',
					'title' => 'Admin | Laporan',
					'lok' => '<b>Laporan Renstra</b>',
					'db' => \Config\Database::connect(),
					'opd_data' => $this->request->getVar('opd'),

				];
				return view('admin/Renstra/opd_laporan_print', $data);
			}
		} else {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}
	}
}
