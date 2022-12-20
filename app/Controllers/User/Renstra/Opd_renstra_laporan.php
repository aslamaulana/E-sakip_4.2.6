<?php

namespace App\Controllers\User\Renstra;

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
		if (has_permission('User')) :
			$opd = $this->opd->find(user()->opd_id);
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_laporan',
				'title' => 'User | Laporan',
				'lok' => '<b>Laporan Renstra</b>',
				'opd' => $opd,
				'db' => \Config\Database::connect(),
			];
			// dd($data);
			echo view('user/Renstra/opd_laporan', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function cetak()
	{
		if (has_permission('User')) {
			$type = $this->request->getVar('type');
			if ($type == 'excel') {
				$i = $_SESSION['perubahan'] == 'Murni' ? 'Penetapan Ke I' : 'Penetapan Ke II';
				$filename = "Renstra " . $i . " - " . date('Y-m-d') . ".xls";
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment; filename="' . $filename . '";');

				$data = [
					'gr' => 'Renstra',
					'mn' => 'opd_laporan',
					'title' => 'User | Laporan',
					'lok' => '<b>Laporan Renstra</b>',
					'db' => \Config\Database::connect(),
					'opd_data' => $this->request->getVar('opd'),

				];
				return view('user/Renstra/opd_laporan_print', $data);
			}
		} else {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}
	}
}
