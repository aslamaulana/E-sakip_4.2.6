<?php

namespace App\Controllers\Admin\Renstra;

use App\Controllers\BaseController;
use App\Models\Admin\Renstra\Model_opd_arah_kebijakan;

class Opd_arah_kebijakan extends BaseController
{
	protected $opd_arah_kebijakan;

	public function __construct()
	{
		$this->opd_arah_kebijakan = new Model_opd_arah_kebijakan();

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
				return redirect()->to(base_url('/admin/renstra/opd_arah_kebijakan'));
			}

			$data = [
				'gr' => 'A_Renstra',
				'mn' => 'A_opd_arah_kebijakan',
				'title' => 'Admin | PD Arah Kebijakan',
				'lok' => '<b>PD Arah Kebijakan</b>',
				'opd_strategi' => $this->opd_arah_kebijakan->ArahKebijakan(),
				'opd' => $this->opd_arah_kebijakan->opd(),
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Renstra/opd_arah_kebijakan', $data);
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

		return redirect()->to(base_url('/admin/renstra/opd_arah_kebijakan'));
	}
}
