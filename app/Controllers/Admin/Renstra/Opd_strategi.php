<?php

namespace App\Controllers\Admin\Renstra;

use App\Controllers\BaseController;
use App\Models\Admin\Renstra\Model_opd_strategi;

class Opd_strategi extends BaseController
{
	protected $opd_strategi, $opd_sasaran;

	public function __construct()
	{
		$this->opd_strategi = new Model_opd_strategi();

		$this->session = \Config\Services::session();
		$this->session->start();
	}
	public function index()
	{
		if (has_permission('Admin')) :
			if (!isset($_SESSION['opd_set'])) {
				try {
					$this->session->set('opd_set', '0002');
				} catch (\Exception $e) {
				}
				return redirect()->to(base_url('/admin/renstra/opd_strategi'));
			}

			$data = [
				'gr' => 'A_Renstra',
				'mn' => 'A_opd_strategi',
				'title' => 'Admin | PD STRATEGI',
				'lok' => '<b>PD Strategi</b>',
				'opd_strategi' => $this->opd_strategi->Strategi(),
				'opd' => $this->opd_strategi->opd(),
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Renstra/opd_strategi', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	/*
	 * ---------------------------------------------------
	 * Set Opd
	 * ---------------------------------------------------
	 */
	public function opd($opd)
	{
		$this->session->set('opd_set', $opd);

		return redirect()->to(base_url('/admin/renstra/opd_strategi'));
	}
}
