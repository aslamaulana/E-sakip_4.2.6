<?php

namespace App\Controllers\Admin\Rb;

use App\Controllers\BaseController;
use App\Models\Admin\User\Model_bidang;
use App\Models\User\Rb\Model_rb_1_urusan;
use App\Models\User\Rb\Model_rb_5_pertanyaan;
use App\Models\User\Rb\Model_rb_5_pertanyaan_jawaban;
use App\Models\User\Rb\Model_rb_5_pertanyaan_jawaban_verifikasi;
use App\Models\User\Rb\Model_rb_6_pertanyaan_sub_jawaban;
use App\Models\User\Rb\Model_rb_7_pertanyaan_sub_sub_jawaban;

class Rb_pertanyaan extends BaseController
{
	protected $rb;

	public function __construct()
	{
		$this->rb_urusan = new Model_rb_1_urusan();
		$this->rb_pertanyaan = new Model_rb_5_pertanyaan();
		$this->rb_pertanyaan_jawaban = new Model_rb_5_pertanyaan_jawaban();
		$this->rb_pertanyaan_sub_jawaban = new Model_rb_6_pertanyaan_sub_jawaban();
		$this->rb_pertanyaan_sub_sub_jawaban = new Model_rb_7_pertanyaan_sub_sub_jawaban();
		$this->verifikasi = new Model_rb_5_pertanyaan_jawaban_verifikasi();
		$this->bidang = new Model_bidang(); /* model opd */
	}
	public function data($id)
	{
		if (has_permission('Admin') || has_permission('Verifikator')) :
			$data = [
				'gr' => 'rb-v',
				'mn' => 'opd',
				'title' => 'RB Pertanyaan',
				'lok' => '<b>RB Pertanyaan</b>',
				//'sakip' => $this->sakip->sakip_instansi()->getWhere(['tb_sakip_instansi.tahun' => $_SESSION['tahun']])->getResultArray(),
				'rb_urusan' => $this->rb_urusan->findAll(),
				'db' => \Config\Database::connect(),
				'opd_id' => $id,
				'bidang' => $this->bidang->find($id),
			];
			// dd(current_url() . ' | ' . uri_string());
			echo view('admin/Rb/rb_pertanyaan', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function rb_pertanyaan_detail($id, $id_jawaban)
	{
		if (has_permission('Admin') || has_permission('Verifikator')) :
			$data = [
				'gr' => 'rb-v',
				'mn' => 'opd',
				'title' => 'RB Pertanyaan',
				'lok' => '<a onclick="history.back(-1)" href="#">RB Pertanyaan</a> -> <b>Detail</b>',
				'pertanyaan' => $this->rb_pertanyaan->pertanyaan()->getWhere(['id_rb_pertanyaan' => $id])->getRowArray(),
				'jawaban' => $this->rb_pertanyaan_jawaban->find($id_jawaban),
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Rb/rb_pertanyaan_detail', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function rb_pertanyaan_history($id)
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'esakip',
				'mn' => 'instansi',
				'title' => 'SAKIP-LKE-Instansi',
				'lok' => '<a onclick="history.back(-1)" href="#">SAKIP-LKE-Instansi</a> -> <b>History</b>',
				'sakip' => $this->jawaban->select('tb_sakip_instansi_jawaban.*, tb_sakip_instansi_jawaban_verifikasi.verifikasi_keterangan')->orderBy('id_sakip_instansi_jawaban', 'ASC')->join('tb_sakip_instansi_jawaban_verifikasi', 'tb_sakip_instansi_jawaban.id_sakip_instansi_jawaban = tb_sakip_instansi_jawaban_verifikasi.sakip_instansi_jawaban_id', 'LEFT')->where(['sakip_instansi_id' => $id, 'tb_sakip_instansi_jawaban.opd_id' => user()->opd_id])->findAll(),
				'komponen' => $this->sakip->sakip_instansi()->getWhere(['id_sakip_instansi' => $id])->getRowArray(),
				'db' => \Config\Database::connect(),
			];
			// dd(current_url() . ' | ' . uri_string());
			echo view('user/Esakip/sakip_instansi_history', $data);
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
