<?php

namespace App\Controllers\User\Esakip;

use App\Controllers\BaseController;
use App\Models\User\Esakip\Model_sakip_instansi;
use App\Models\User\Esakip\Model_sakip_instansi_jawaban;
use App\Models\User\Esakip\Model_sakip_instansi_jawaban_verifikasi;

class Sakip_instansi extends BaseController
{
	protected $sakip;

	public function __construct()
	{
		$this->sakip = new Model_sakip_instansi();
		$this->jawaban = new Model_sakip_instansi_jawaban();
		$this->verifikasi = new Model_sakip_instansi_jawaban_verifikasi();
	}
	public function index()
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'esakip',
				'mn' => 'instansi',
				'title' => 'SAKIP-LKE-Instansi',
				'lok' => '<b>SAKIP-LKE-Instansi</b>',
				//'sakip' => $this->sakip->sakip_instansi()->getWhere(['tb_sakip_instansi.tahun' => $_SESSION['tahun']])->getResultArray(),
				'sakip' => $this->sakip->sakip_instansi()->get()->getResultArray(),
				'db' => \Config\Database::connect(),
			];
			// dd(current_url() . ' | ' . uri_string());
			echo view('user/Esakip/sakip_instansi', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function sakip_instansi_history($id)
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
	public function sakip_instansi_add($id)
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'esakip',
				'mn' => 'instansi',
				'title' => 'SAKIP-LKE-Instansi',
				'lok' => '<a onclick="history.back(-1)" href="#">SAKIP-LKE-Instansi</a> -> <b>Jawaban</b>',
				'sakip' => $this->sakip->sakip_instansi()->getWhere(['id_sakip_instansi' => $id])->getRowArray(),
			];
			echo view('user/Esakip/sakip_instansi_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function sakip_instansi_edit($id, $id_jawaban)
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'esakip',
				'mn' => 'instansi',
				'title' => 'SAKIP-LKE-Instansi',
				'lok' => '<a onclick="history.back(-1)" href="#">SAKIP-LKE-Instansi</a> -> <b>Jawaban</b>',
				'sakip' => $this->sakip->sakip_instansi()->getWhere(['id_sakip_instansi' => $id])->getRowArray(),
				'jawaban' => $this->jawaban->find($id_jawaban),
			];
			echo view('user/Esakip/sakip_instansi_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function sakip_instansi_update()
	{
		if (has_permission('User')) :
			$this->jawaban->save([
				'id_sakip_instansi_jawaban' => $this->request->getVar('id_jawaban'),
				'jawaban' => $this->request->getVar('jawaban'),
				'link_1' => $this->request->getVar('e_1'),
				'link_2' => $this->request->getVar('e_2'),
				'link_3' => $this->request->getVar('e_3'),
				'opd_id' => user()->opd_id,
				'updated_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/esakip/sakip_instansi');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function sakip_instansi_create()
	{
		if (has_permission('User')) :
			$this->jawaban->save([
				'sakip_instansi_id' => $this->request->getVar('id'),
				'jawaban' => $this->request->getVar('jawaban'),
				'link_1' => $this->request->getVar('e_1'),
				'link_2' => $this->request->getVar('e_2'),
				'link_3' => $this->request->getVar('e_3'),
				'opd_id' => user()->opd_id,
				'tahun' => $_SESSION['tahun'],
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/esakip/sakip_instansi');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	/*
	 * ---------------------------------------------------
	 * Verifikasi ajukan
	 * ---------------------------------------------------
	 */
	public function sakip_instansi_verifikasi($id)
	{
		if (has_permission('User')) :
			$this->verifikasi->save([
				'id_sakip_instansi_jawaban_verifikasi' => $id,
				'verifikasi' => 'diajukan',
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/esakip/sakip_instansi');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function sakip_instansi_hapus($id)
	{
		if (has_permission('User')) :
			try {
				$this->jawaban->delete($id);
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->back();
			}
			session()->setFlashdata('pesan', 'Data berhasil di hapus.');
			return redirect()->back();
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
}
