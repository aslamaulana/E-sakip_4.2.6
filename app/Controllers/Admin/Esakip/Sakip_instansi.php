<?php

namespace App\Controllers\Admin\Esakip;

use App\Controllers\BaseController;
use App\Models\Admin\User\Model_bidang;
use App\Models\Admin\Esakip\Model_sakip_instansi;
use App\Models\Admin\Esakip\Model_sakip_instansi_jawaban;
use App\Models\Admin\Esakip\Model_sakip_instansi_jawaban_verifikasi;

class Sakip_instansi extends BaseController
{
	protected $sakip;

	public function __construct()
	{
		$this->sakip = new Model_sakip_instansi();
		$this->jawaban = new Model_sakip_instansi_jawaban();
		$this->verifikasi = new Model_sakip_instansi_jawaban_verifikasi();
		$this->bidang = new Model_bidang(); /* model opd */
	}
	public function data($id)
	{
		if (has_permission('Admin') || has_permission('Verifikator')) :
			$data = [
				'gr' => 'esakip-v',
				'mn' => 'a-instansi',
				'title' => 'SAKIP-LKE-Instansi',
				'lok' => '<b>SAKIP-LKE-Instansi</b>',
				'sakip' => $this->sakip->sakip_instansi()->getWhere(['tb_sakip_instansi.tahun' => $_SESSION['tahun']])->getResultArray(),
				'opd_id' => $id,
				'bidang' => $this->bidang->find($id),
				'db' => \Config\Database::connect(),
			];
			// dd(current_url() . ' | ' . uri_string());
			echo view('admin/Esakip/sakip_instansi', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function sakip_instansi_history($id, $opd_id)
	{
		if (has_permission('Admin') || has_permission('Verifikator')) :
			$data = [
				'gr' => 'esakip-v',
				'mn' => 'a-instansi',
				'title' => 'SAKIP-LKE-Instansi',
				'lok' => '<a onclick="history.back(-1)" href="#">SAKIP-LKE-Instansi</a> -> <b>History</b>',
				'sakip' => $this->jawaban
					->select('tb_sakip_instansi_jawaban.*, tb_sakip_instansi_jawaban_verifikasi.verifikasi_keterangan')
					->distinct('tb_sakip_instansi_jawaban.*, tb_sakip_instansi_jawaban_verifikasi.verifikasi_keterangan')
					->orderBy('id_sakip_instansi_jawaban', 'ASC')
					->join('tb_sakip_instansi_jawaban_verifikasi', 'tb_sakip_instansi_jawaban.id_sakip_instansi_jawaban = tb_sakip_instansi_jawaban_verifikasi.sakip_instansi_jawaban_id', 'LEFT')
					->where(['sakip_instansi_id' => $id, 'tb_sakip_instansi_jawaban.opd_id' => $opd_id])->findAll(),
				'komponen' => $this->sakip->sakip_instansi()->getWhere(['id_sakip_instansi' => $id])->getRowArray(),
				'bidang' => $this->bidang->find($opd_id),
				'db' => \Config\Database::connect(),
			];
			// dd(current_url() . ' | ' . uri_string());
			// dd($data);
			echo view('admin/Esakip/sakip_instansi_history', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function sakip_jawaban_nilai()
	{
		if (has_permission('Admin') || has_permission('Verifikator')) :

			$this->jawaban->save([
				'id_sakip_instansi_jawaban' => $this->request->getVar('id'),
				'nilai' => $this->request->getVar('nilai'),
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->back();

		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
}
