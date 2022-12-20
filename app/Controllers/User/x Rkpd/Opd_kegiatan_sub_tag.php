<?php

namespace App\Controllers\User\Rkpd;

use App\Controllers\BaseController;
use App\Models\User\Rkpd\Model_opd_kegiatan_sub;
use App\Models\User\Rkpd\Model_opd_kegiatan_sub_tag;
use App\Models\Admin\RPJMD\Model_tahun;
use App\Models\User\Rkpd\Model_tag;


class Opd_kegiatan_sub_tag extends BaseController
{
	protected $opd_kegiatan_sub, $satuan, $tahun, $tag;

	public function __construct()
	{
		$this->rkpd_kegiatan_sub = new Model_opd_kegiatan_sub();
		$this->rkpd_kegiatan_sub_tag = new Model_opd_kegiatan_sub_tag();
		$this->tag = new Model_tag();
		$this->tahun = new Model_tahun();
	}
	public function index()
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'rkpd',
				'mn' => 'rkpd_kegiatan_sub_tag',
				'title' => 'User | PD Sub Kegiatan',
				'lok' => '<b>RENJA Sub Kegiatan</b>',
				'rkpd_kegiatan' => $this->rkpd_kegiatan_sub->Kegiatan(),
				'tahunA' => $this->tahun->tahunA(),
				'db' => \Config\Database::connect(),
			];
			echo view('user/Rkpd/opd_kegiatan_sub_tag', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_kegiatan_sub_tag_add()
	{
		if (has_permission('User') && menu('renja')->kunci == 'tidak') :
			$data = [
				'gr' => 'rkpd',
				'mn' => 'rkpd_kegiatan_sub_tag',
				'title' => 'User | RENJA Sub Kegiatan',
				'lok' => '<a onclick="history.back(-1)" href="#">RENJA Sub Kegiatan</a> -> <b>Tambah RENJA Tag Sub Kegiatan</b>',
				'validation' => \Config\Services::validation(),
				'tag' => $this->tag->findAll(),
				'db' => \Config\Database::connect(),
			];
			echo view('user/Rkpd/opd_kegiatan_sub_tag_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_kegiatan_sub_tag_create()
	{
		if (has_permission('User') && menu('renja')->kunci == 'tidak') :

			if (isset($_POST['tag'])) {
				foreach ($_POST['tag'] as $key => $val) {
					$result[] = array(
						'tag' => $_POST['tag'][$key],
						'rkpd_kegiatan_sub_n' => $this->request->getVar('rkpd_kegiatan_sub'),
						'user_pengisi' => user()->id,
						'opd_id' => user()->opd_id,
						'tahun' => $_SESSION['tahun'],
						'perubahan' => $_SESSION['perubahan']
					);
				}
				$this->rkpd_kegiatan_sub_tag->insertBatch($result);
			} else {
				return redirect()->to(base_url() . '/user/rkpd/opd_kegiatan_sub_tag');
			}

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/rkpd/opd_kegiatan_sub_tag');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_kegiatan_sub_tag_edit()
	{
		if (has_permission('User') && menu('renja')->kunci == 'tidak') :
			$data = [
				'gr' => 'rkpd',
				'mn' => 'rkpd_kegiatan_sub_tag',
				'title' => 'User | RENJA Sub Kegiatan',
				'lok' => '<a onclick="history.back(-1)" href="#">RENJA Sub Kegiatan</a> -> <b>Ubah RENJA Tag Sub Kegiatan</b>',
				'validation' => \Config\Services::validation(),
				'tag' => $this->tag->findAll(),
				'db' => \Config\Database::connect(),
			];
			echo view('user/Rkpd/opd_kegiatan_sub_tag_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_kegiatan_sub_tag_update()
	{
		if (has_permission('User') && menu('renja')->kunci == 'tidak') :

			if (isset($_POST['tag'])) {

				try {
					$this->rkpd_kegiatan_sub_tag->where([
						'rkpd_kegiatan_sub_n' => $this->request->getVar('rkpd_kegiatan_sub'),
						'opd_id' => user()->opd_id,
						'tahun' => $_SESSION['tahun'],
						'perubahan' => $_SESSION['perubahan']
					])->delete();
				} catch (\Exception $e) {
					session()->setFlashdata('error', 'Data Gagal di hapus.');
					return redirect()->to(base_url() . '/user/rkpd/opd_kegiatan_sub_tag');
				}

				foreach ($_POST['tag'] as $key => $val) {
					$result[] = array(
						'tag' => $_POST['tag'][$key],
						'rkpd_kegiatan_sub_n' => $this->request->getVar('rkpd_kegiatan_sub'),
						'user_pengisi' => user()->id,
						'opd_id' => user()->opd_id,
						'tahun' => $_SESSION['tahun'],
						'perubahan' => $_SESSION['perubahan']
					);
				}
				$this->rkpd_kegiatan_sub_tag->insertBatch($result);
			} else {

				try {
					$this->rkpd_kegiatan_sub_tag->where([
						'rkpd_kegiatan_sub_n' => $this->request->getVar('rkpd_kegiatan_sub'),
						'opd_id' => user()->opd_id,
						'tahun' => $_SESSION['tahun'],
						'perubahan' => $_SESSION['perubahan']
					])->delete();
				} catch (\Exception $e) {
					session()->setFlashdata('error', 'Data Gagal di hapus.');
					return redirect()->to(base_url() . '/user/rkpd/opd_kegiatan_sub_tag');
				}
			}

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/rkpd/opd_kegiatan_sub_tag');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
}
