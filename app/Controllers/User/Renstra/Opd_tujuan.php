<?php

namespace App\Controllers\User\Renstra;

use App\Controllers\BaseController;
// use App\Models\Admin\RPJMD\Model_visi;
use App\Models\Admin\RPJMD\Model_satuan;
use App\Models\User\Renstra\Model_opd_tujuan;
use App\Models\Admin\RPJMD\Model_tahun;

class Opd_tujuan extends BaseController
{
	protected $visi, $misi, $tujuan, $satuan, $tahun, $tujuan_indik_target;

	public function __construct()
	{
		// $this->visi = new Model_visi();
		$this->opd_tujuan = new Model_opd_tujuan();
		$this->satuan = new Model_satuan();
		$this->tahun = new Model_tahun();
	}
	public function index()
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_tujuan',
				'title' => 'User | OPD TUJUAN',
				'lok' => '<b>Tujuan</b>',
				'tahunA' => $this->tahun->tahunA(),
				'opd_tujuan' => $this->opd_tujuan->tujuan(),
				'db' => \Config\Database::connect(),
			];
			// dd($data);
			echo view('user/Renstra/opd_tujuan', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_tujuan_add()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_tujuan',
				'title' => 'User | OPD TUJUAN',
				'lok' => '<a href="/user/renstra/opd_tujuan">Tujuan</a> -> <b>Tambah Tujuan</b>',
				'satuan' => $this->satuan->satuan(),
				'validation' => \Config\Services::validation(),
			];
			echo view('user/Renstra/opd_tujuan_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_tujuan_create()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			if (!$this->validate([
				'tujuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'indikator_tujuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'satuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],

			])) {
				return redirect()->back()->withInput();
			}

			$this->opd_tujuan->save([
				'opd_tujuan' => preg_replace("/\r|\n/", "", $this->request->getVar('tujuan')),
				'opd_kode_tujuan' => $this->request->getVar('kode_tujuan'),
				'opd_indikator_tujuan' => preg_replace("/\r|\n/", "", $this->request->getVar('indikator_tujuan')),
				'satuan' => $this->request->getVar('satuan'),
				't_2021' => $this->request->getVar('t_2021'),
				't_2022' => $this->request->getVar('t_2022'),
				't_2023' => $this->request->getVar('t_2023'),
				't_2024' => $this->request->getVar('t_2024'),
				't_2025' => $this->request->getVar('t_2025'),
				't_2026' => $this->request->getVar('t_2026'),
				'opd_id' => user()->opd_id,
				'perubahan' => $_SESSION['perubahan'],
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/renstra/opd_tujuan');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_tujuan_edit()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_tujuan',
				'title' => 'User | OPD TUJUAN',
				'lok' => '<a href="/user/renstra/opd_tujuan">Tujuan</a> -> <b>Ubah Tujuan</b>',
				'tujuan' => $this->opd_tujuan->tujuanEdit()->getWhere(['tb_renstra_tujuan.opd_tujuan' => $_GET['p'], 'tb_renstra_tujuan.opd_kode_tujuan' => $_GET['k'], 'tb_renstra_tujuan.opd_id' => user()->opd_id])->getRowArray(),
				'validation' => \Config\Services::validation(),
			];
			// dd($data);
			echo view('user/Renstra/opd_tujuan_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_tujuan_update()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			if (!$this->validate([
				'tujuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],

			])) {
				return redirect()->back()->withInput();
			}

			$data = [
				'opd_tujuan' => preg_replace("/\r|\n/", "", $this->request->getVar('tujuan')),
				'opd_kode_tujuan' => $this->request->getVar('kode_tujuan'),
				'updated_by' => user()->full_name,
			];
			$dataw = [
				'opd_kode_tujuan' => $this->request->getVar('kode_tujuan_old'),
				'opd_tujuan' => $this->request->getVar('tujuan_old'),
				'perubahan' => $_SESSION['perubahan'],
				'opd_id' => user()->opd_id,
			];
			// dd($dataf);
			$this->opd_tujuan->set($data)->where($dataw)->update();

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/renstra/opd_tujuan');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	public function opd_tujuan_hapus($id)
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			try {
				$this->opd_tujuan->delete($id);
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->back();
			}
			session()->setFlashdata('pesan', 'Data berhasil di hapus.');
			return redirect()->to(base_url() . '/user/renstra/opd_tujuan');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	// ---------------------------------------------------------

	public function opd_tujuan_indik_add()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			$data = [
				'gr' => 'rpjmd',
				'mn' => 'tujuan',
				'title' => 'Admin | TUJUAN',
				'lok' => '<a onclick="history.back(-1)" href="#">Tujuan</a> -> <b>Tambah Indikator Tujuan</b>',
				'validation' => \Config\Services::validation(),
				'tujuan' => $_GET['p'],
				'kode_tujuan' => $_GET['k'],
				'satuan' => $this->satuan->satuan(),
			];
			echo view('user/Renstra/opd_tujuan_indik_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_tujuan_indik_create()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			if (!$this->validate([
				'indikator_tujuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'satuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],

			])) {
				return redirect()->back()->withInput();
			}

			$this->opd_tujuan->save([
				'opd_tujuan' => $this->request->getVar('tujuan'),
				'opd_kode_tujuan' => $this->request->getVar('kode_tujuan'),
				'opd_indikator_tujuan' => preg_replace("/\r|\n/", "", $this->request->getVar('indikator_tujuan')),
				'satuan' => $this->request->getVar('satuan'),
				't_2021' => $this->request->getVar('t_2021'),
				't_2022' => $this->request->getVar('t_2022'),
				't_2023' => $this->request->getVar('t_2023'),
				't_2024' => $this->request->getVar('t_2024'),
				't_2025' => $this->request->getVar('t_2025'),
				't_2026' => $this->request->getVar('t_2026'),
				'opd_id' => user()->opd_id,
				'perubahan' => $_SESSION['perubahan'],
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/renstra/opd_tujuan');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_tujuan_indik_edit($id)
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			$data = [
				'gr' => 'rpjmd',
				'mn' => 'tujuan',
				'title' => 'Admin | TUJUAN',
				'lok' => '<a onclick="history.back(-1)" href="#">Tujuan</a> -> <b>Ubah Indikator Tujuan</b>',
				'validation' => \Config\Services::validation(),
				'satuan' => $this->satuan->satuan(),
				'indikator' => $this->opd_tujuan->find($id),
			];
			echo view('user/Renstra/opd_tujuan_indik_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	public function opd_tujuan_indik_update()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			if (!$this->validate([
				'indikator_tujuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'satuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],

			])) {
				return redirect()->back()->withInput();
			}

			$this->opd_tujuan->save([
				'id_opd_tujuan' => $this->request->getVar('id_tujuan'),
				'opd_indikator_tujuan' => preg_replace("/\r|\n/", "", $this->request->getVar('indikator_tujuan')),
				'satuan' => $this->request->getVar('satuan'),
				't_2021' => $this->request->getVar('t_2021'),
				't_2022' => $this->request->getVar('t_2022'),
				't_2023' => $this->request->getVar('t_2023'),
				't_2024' => $this->request->getVar('t_2024'),
				't_2025' => $this->request->getVar('t_2025'),
				't_2026' => $this->request->getVar('t_2026'),
				'updated_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/renstra/opd_tujuan');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	// =======================================================================================================

	public function import_tujuan()
	{
		if (has_permission('User')) :

			$data = $this->opd_tujuan->where(['perubahan' => 'Murni', 'opd_id' => user()->opd_id])->findAll();
			foreach ($data as $key => $val) {
				$result[] = array(
					'opd_tujuan' => $data[$key]['opd_tujuan'],
					'opd_kode_tujuan' => $data[$key]['opd_kode_tujuan'],
					'opd_indikator_tujuan' => $data[$key]['opd_indikator_tujuan'],
					'satuan' => $data[$key]['satuan'],
					't_2021' => $data[$key]['t_2021'],
					't_2022' => $data[$key]['t_2022'],
					't_2023' => $data[$key]['t_2023'],
					't_2024' => $data[$key]['t_2024'],
					't_2025' => $data[$key]['t_2025'],
					't_2026' => $data[$key]['t_2026'],
					'opd_id' => user()->opd_id,
					'perubahan' => $_SESSION['perubahan'],
					'created_by' => user()->full_name,
				);
			}
			$this->opd_tujuan->insertBatch($result);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/renstra/opd_tujuan');

		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
}
