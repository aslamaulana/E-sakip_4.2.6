<?php

namespace App\Controllers\User\Kla;

use App\Controllers\BaseController;
use App\Models\User\Kla\Model_jawaban;


class Pertanyaan extends BaseController
{
	protected $jawaban;

	public function __construct()
	{
		$this->jawaban = new Model_jawaban();
	}
	public function index()
	{
		if (has_permission('User')) {
			$indik = $this->jawaban->indik();
			$data = [
				'gr' => 'kla_u',
				'mn' => 'kla_pertanyaan_u',
				'title' => 'User | KLA Pertanyaan',
				'lok' => '<b>Pertanyaan</b>',
				'indik' => $indik,
				'db' => \Config\Database::connect(),
			];
			echo view('user/Kla/pertanyaan', $data);
		} else {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}
	}
	public function jawaban($id)
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'kla_u',
				'mn' => 'kla_pertanyaan_u',
				'title' => 'User | KLA Pertanyaan',
				'lok' => '<a href="..">KLA Pertanyaan</a> -> <b>Jawaban</b>',
				'id' => $id,
				'validation' => \Config\Services::validation(),
			];
			echo view('user/Kla/jawaban_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function jawaban_create()
	{
		if (!$this->validate([

			'jawaban_doc' => [
				'rules' => 'max_size[jawaban_doc,10100]|ext_in[jawaban_doc,doc,docx,pdf]',
				'errors' => [
					'max_size' => 'Maksimal Size 10Mb',
					'ext_in' => 'Format file Salah!'
				]
			],

		])) {
			return redirect()->to('/user/kla/pertanyaan/jawaban/' . $this->request->getVar('id_kla_pertanyaan') . '?p=' . $this->request->getVar('p'))->withInput();
		}

		$file = $this->request->getFile('jawaban_doc');
		if ($file->getError() == 4) {
			$namaFile = '';
		} else {

			$path = './FileBerkasData/' . user()->opd_id . '/KLA';
			if (!is_dir($path)) {
				mkdir($path, '0755', true);
			}

			$nama = $file->getName();
			$nama2 = $file->getRandomName();
			$namaFile = $nama . '-' . $nama2;
			$file->move('FileBerkasData/' . user()->opd_id . '/KLA/', $namaFile);
		}

		if (has_permission('User')) :
			$this->jawaban->save([
				'kla_pertanyaan_id' => $this->request->getVar('id_kla_pertanyaan'),
				'kla_jawaban' => $this->request->getVar('jawaban'),
				'kla_jawaban_doc' => $namaFile,
				'kla_jawaban_doc_size' => $file->getSize(),
				'opd_id' => user()->opd_id,
				'tahun' => $_SESSION['tahun'],
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/kla/pertanyaan');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function jawaban_edit($id)
	{
		$jawaban = $this->jawaban->jawabanEdit($id);
		if (has_permission('User')) :
			$data = [
				'gr' => 'kla_u',
				'mn' => 'kla_pertanyaan_u',
				'title' => 'User | KLA Pertanyaan',
				'lok' => '<a href="..">KLA Pertanyaan</a> -> <b>Jawaban Edit</b>',
				'jawaban' => $jawaban,
				'validation' => \Config\Services::validation(),
			];
			echo view('user/Kla/jawaban_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function jawaban_update()
	{
		if (!$this->validate([

			'jawaban_doc' => [
				'rules' => 'max_size[jawaban_doc,10100]|ext_in[jawaban_doc,doc,docx,pdf]',
				'errors' => [
					'max_size' => 'Maksimal Size 10Mb',
					'ext_in' => 'Format file Salah!'
				]
			],

		])) {
			return redirect()->to('/user/kla/pertanyaan/jawaban_edit/' . $this->request->getVar('id_kla_jawaban') . '?p=' . $this->request->getVar('p'))->withInput();
		}

		$file = $this->request->getFile('jawaban_doc');

		if ($file->getError() == 4) {
			$namaFile = $this->request->getVar('jawaban_doc-lama');
			$size = $this->request->getVar('jawaban_doc_size-lama');
		} else {
			$size = $file->getSize();
			$nama = $file->getName();
			$nama2 = $file->getRandomName();
			$namaFile = $nama . '-' . $nama2;
			$file->move('FileBerkasData/' . user()->opd_id . '/KLA/', $namaFile);
			unlink('FileBerkasData/' . user()->opd_id . '/KLA/' . $this->request->getVar('jawaban_doc-lama'));
		}

		if (has_permission('User')) :
			$this->jawaban->save([
				'id_kla_jawaban' => $this->request->getVar('id_kla_jawaban'),
				'kla_jawaban' => $this->request->getVar('jawaban'),
				'kla_jawaban_doc' => $namaFile,
				'kla_jawaban_doc_size' => $size,
				'opd_id' => user()->opd_id,
				'update_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/kla/pertanyaan');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	public function jawaban_hapus($id)
	{
		$dt = $this->jawaban->PilihKla($id)->getRow();
		$dokumen = $dt->kla_jawaban_doc;
		try {
			unlink(base_url() . '/FileBerkasData/' . user()->opd_id . '/KLA/' . $dokumen);
		} catch (\Exception $e) {
		}

		try {
			$this->jawaban->delete($id);
		} catch (\Exception $e) {
			session()->setFlashdata('error', 'Data Gagal di hapus.');
			return redirect()->back();
		}

		session()->setFlashdata('pesan', 'Data berhasil di hapus.');
		return redirect()->back();
	}


	// ---------------------------------------------------------
}
