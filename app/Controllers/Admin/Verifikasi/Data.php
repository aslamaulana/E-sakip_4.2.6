<?php

namespace App\Controllers\Admin\Verifikasi;

// require 'vendor/autoload.php';

use App\Controllers\BaseController;
use App\Models\Admin\Verifikasi\Model_sakip_verifikasi;

class Data extends BaseController
{
	protected $verifikasi, $verifikasi_ssh, $verifikasi_asb;

	public function __construct()
	{
		$this->verifikasi = new Model_sakip_verifikasi();
	}

	public function verifikasi()
	{
		if (has_permission('Admin') || has_permission('Verifikator')) {
			if (isset($_POST['lolos'])) {
				$this->verifikasi->save([
					'id_sakip_instansi_jawaban_verifikasi' => $this->request->getVar('id'),
					'verifikasi' => 'lolos',
					'nm_verifikator' => user()->full_name,
					'tahun' => $_SESSION['tahun'],
					'created_by' => user()->full_name,
				]);
				session()->setFlashdata('pesan', 'Data berhasil di simpan.');
				return redirect()->back();
			} elseif (isset($_POST['dikembalikan']) || isset($_POST['dikembalikan_lolos'])) {
				$this->verifikasi->save([
					'id_sakip_instansi_jawaban_verifikasi' => $this->request->getVar('id'),
					'verifikasi' => 'dikembalikan',
					'verifikasi_keterangan' => $this->request->getVar('verifikasi_keterangan'),
					'nm_verifikator' => user()->full_name,
					'tahun' => $_SESSION['tahun'],
					'created_by' => user()->full_name,
				]);
				session()->setFlashdata('pesan', 'Data berhasil di simpan.');
				return redirect()->back();
			}
		} else {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}
	}
}
