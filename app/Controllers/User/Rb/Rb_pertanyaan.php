<?php

namespace App\Controllers\User\Rb;

use App\Controllers\BaseController;
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
	}
	public function index()
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'rb',
				'mn' => 'rb_pertanyaan',
				'title' => 'RB Pertanyaan',
				'lok' => '<b>RB Pertanyaan</b>',
				//'sakip' => $this->sakip->sakip_instansi()->getWhere(['tb_sakip_instansi.tahun' => $_SESSION['tahun']])->getResultArray(),
				'rb_urusan' => $this->rb_urusan->findAll(),
				'db' => \Config\Database::connect(),
			];
			// dd(current_url() . ' | ' . uri_string());
			echo view('user/Rb/rb_pertanyaan', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function rb_pertanyaan_history($id)
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'rb',
				'mn' => 'rb_pertanyaan',
				'title' => 'RB Pertanyaan',
				'lok' => '<a onclick="history.back(-1)" href="#">RB Pertanyaan</a> -> <b>History</b>',
				'sakip' => $this->jawaban->select('tb_sakip_instansi_jawaban.*, tb_sakip_instansi_jawaban_verifikasi.verifikasi_keterangan')
					->orderBy('id_sakip_instansi_jawaban', 'ASC')
					->join('tb_sakip_instansi_jawaban_verifikasi', 'tb_sakip_instansi_jawaban.id_sakip_instansi_jawaban = tb_sakip_instansi_jawaban_verifikasi.sakip_instansi_jawaban_id', 'LEFT')
					->where(['sakip_instansi_id' => $id, 'tb_sakip_instansi_jawaban.opd_id' => user()->opd_id])->findAll(),
				'komponen' => $this->sakip->sakip_instansi()->getWhere(['id_sakip_instansi' => $id])->getRowArray(),
				'db' => \Config\Database::connect(),
			];
			// dd(current_url() . ' | ' . uri_string());
			echo view('user/Esakip/sakip_instansi_history', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function rb_pertanyaan_add($id)
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'rb',
				'mn' => 'rb_pertanyaan',
				'title' => 'RB Pertanyaan',
				'lok' => '<a onclick="history.back(-1)" href="#">RB Pertanyaan</a> -> <b>Jawaban</b>',
				'pertanyaan' => $this->rb_pertanyaan->pertanyaan()->getWhere(['id_rb_pertanyaan' => $id])->getRowArray(),
				'db' => \Config\Database::connect(),
			];
			echo view('user/Rb/rb_pertanyaan_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function rb_pertanyaan_edit($id, $id_jawaban)
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'rb',
				'mn' => 'rb_pertanyaan',
				'title' => 'RB Pertanyaan',
				'lok' => '<a onclick="history.back(-1)" href="#">RB Pertanyaan</a> -> <b>Ubah Jawaban</b>',
				'pertanyaan' => $this->rb_pertanyaan->pertanyaan()->getWhere(['id_rb_pertanyaan' => $id])->getRowArray(),
				'jawaban' => $this->rb_pertanyaan_jawaban->find($id_jawaban),
				'db' => \Config\Database::connect(),
			];
			echo view('user/Rb/rb_pertanyaan_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function rb_pertanyaan_detail($id, $id_jawaban)
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'rb',
				'mn' => 'rb_pertanyaan',
				'title' => 'RB Pertanyaan',
				'lok' => '<a onclick="history.back(-1)" href="#">RB Pertanyaan</a> -> <b>Ubah Jawaban</b>',
				'pertanyaan' => $this->rb_pertanyaan->pertanyaan()->getWhere(['id_rb_pertanyaan' => $id])->getRowArray(),
				'jawaban' => $this->rb_pertanyaan_jawaban->find($id_jawaban),
				'db' => \Config\Database::connect(),
			];
			echo view('user/Rb/rb_pertanyaan_detail', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function rb_pertanyaan_update()
	{
		if (has_permission('User')) :

			$this->rb_pertanyaan_jawaban->save([
				'id_rb_pertanyaan_jawaban' => $this->request->getVar('id_rb_pertanyaan_jawaban'),
				'jawaban' => $this->request->getVar('jawaban_pertanyaan'),
				'link_keterangan' => $this->request->getVar('link_keterangan'),
				'link_1' => $this->request->getVar('e_1'),
				'link_2' => $this->request->getVar('e_2'),
				'link_3' => $this->request->getVar('e_3'),
				'opd_id' => user()->opd_id,
				'tahun' => $_SESSION['tahun'],
				'created_by' => user()->full_name,
			]);

			if (isset($_POST['id_rb_pertanyaan_sub_jawaban'])) {
				foreach ($_POST['id_rb_pertanyaan_sub_jawaban'] as $key => $val) {
					$pertanyaan_sub_jawaban[] = array(
						'id_rb_pertanyaan_sub_jawaban' => $_POST['id_rb_pertanyaan_sub_jawaban'][$key],
						'jawaban' =>  $_POST['jawaban_pertanyaan_sub'][$key],
						'opd_id' => user()->opd_id,
						'tahun' => $_SESSION['tahun'],
						'created_by' => user()->full_name,
					);
				}
				$this->rb_pertanyaan_sub_jawaban->updateBatch($pertanyaan_sub_jawaban, 'id_rb_pertanyaan_sub_jawaban');
			}

			if (isset($_POST['id_rb_pertanyaan_sub_sub_jawaban'])) {
				foreach ($_POST['id_rb_pertanyaan_sub_sub_jawaban'] as $key => $val) {
					$pertanyaan_sub_sub_jawaban[] = array(
						'id_rb_pertanyaan_sub_sub_jawaban' => $_POST['id_rb_pertanyaan_sub_sub_jawaban'][$key],
						'jawaban' =>  $_POST['jawaban_pertanyaan_sub_sub'][$key],
						'opd_id' => user()->opd_id,
						'tahun' => $_SESSION['tahun'],
						'created_by' => user()->full_name,
					);
				}
				$this->rb_pertanyaan_sub_sub_jawaban->updateBatch($pertanyaan_sub_sub_jawaban, 'id_rb_pertanyaan_sub_sub_jawaban');
			}

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/esakip/sakip_instansi');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function rb_pertanyaan_create()
	{
		if (has_permission('User')) :

			$this->rb_pertanyaan_jawaban->save([
				'rb_pertanyaan_id' => $this->request->getVar('id'),
				'jawaban' => $this->request->getVar('jawaban_pertanyaan'),
				'link_keterangan' => $this->request->getVar('link_keterangan'),
				'link_1' => $this->request->getVar('e_1'),
				'link_2' => $this->request->getVar('e_2'),
				'link_3' => $this->request->getVar('e_3'),
				'opd_id' => user()->opd_id,
				'tahun' => $_SESSION['tahun'],
				'created_by' => user()->full_name,
			]);

			if (isset($_POST['jawaban_pertanyaan_sub'])) {
				foreach ($_POST['jawaban_pertanyaan_sub'] as $key => $val) {
					$pertanyaan_sub_jawaban[] = array(
						'rb_pertanyaan_sub_id' => $_POST['rb_pertanyaan_sub_id'][$key],
						'jawaban' =>  $_POST['jawaban_pertanyaan_sub'][$key],
						'opd_id' => user()->opd_id,
						'tahun' => $_SESSION['tahun'],
						'created_by' => user()->full_name,
					);
				}
				$this->rb_pertanyaan_sub_jawaban->insertBatch($pertanyaan_sub_jawaban);
			}

			if (isset($_POST['jawaban_pertanyaan_sub'])) {
				foreach ($_POST['jawaban_pertanyaan_sub_sub'] as $key => $val) {
					$pertanyaan_sub_sub_jawaban[] = array(
						'rb_pertanyaan_sub_sub_id' => $_POST['rb_pertanyaan_sub_sub_id'][$key],
						'jawaban' =>  $_POST['jawaban_pertanyaan_sub_sub'][$key],
						'opd_id' => user()->opd_id,
						'tahun' => $_SESSION['tahun'],
						'created_by' => user()->full_name,
					);
				}
				$this->rb_pertanyaan_sub_sub_jawaban->insertBatch($pertanyaan_sub_sub_jawaban);
			}

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/rb/rb_pertanyaan');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	/*
	 * ---------------------------------------------------
	 * Verifikasi ajukan
	 * ---------------------------------------------------
	 */
	public function rb_pertanyaan_verifikasi($id)
	{
		if (has_permission('User')) :
			$this->verifikasi->save([
				'id_rb_pertanyaan_jawaban_verifikasi' => $id,
				'verifikasi' => 'diajukan',
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->back();
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
