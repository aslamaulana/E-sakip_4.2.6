<?php

namespace App\Controllers\User\Simonela;

use App\Controllers\BaseController;
use App\Models\User\Ropk\Model_ropk_keuangan_kegiatan_sub;
use App\Models\User\Simonela\Model_simonela_progres;
use App\Models\User\Simonela\Model_simonela_dokumen;
// use Google\Client;
// use Google\Client\driv
require_once '../vendor/google_api/vendor/autoload.php';

use Google\Service\Drive;

class Simonela extends BaseController
{
	protected $sub_kegiatan;

	public function __construct()
	{
		$this->sub_kegiatan = new Model_ropk_keuangan_kegiatan_sub(); // Miroring dari sub Kegiatan keuangan
		$this->simonela = new Model_simonela_progres();
		$this->simonela_dokumen = new Model_simonela_dokumen();
	}
	/*
	 * ---------------------------------------------------
	 * Menu sub kegiatan e-monev
	 * Sub kegiatan di ambil dari ropk keuangan sub kegiatan
	 * ---------------------------------------------------
	 */
	public function bb()
	{
		// setting config untuk layanan akses ke google drive
		$client = new  \Google_Client();
		$client->setAuthConfig("../client_secret_855629369243-7fj6h9jpireodpnaahukmv454s6fofph.apps.googleusercontent.com.json");
		// $client->setApplicationName("Sigenah");
		// $client->setDeveloperKey("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");
		$client->addScope("https://www.googleapis.com/auth/drive");
		// $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
		// $client->setRedirectUri($redirect_uri);
		// $service = new \Google_Service($client);

		// mengecek keberadaan token session
		if (empty($_SESSION['upload_token'])) {
			echo "jika token belum ada, maka lakukan login via oauth";
			$authUrl = $client->createAuthUrl();
			header("Location:" . $authUrl);
		} else {
			echo "sudah ada";
		}
		if (has_permission('User')) :
			$data = [
				'gr' => 'simonela',
				'mn' => 'simonela',
				'title' => 'User | Si-Monela',
				'lok' => '<b>Si-Monela</b>',
				'sub_kegiatan' => $this->sub_kegiatan->Kegiatan(), //Miroring dari sub Kegiatan keuangan
				'db' => \Config\Database::connect(),
			];
			echo view('user/Simonela/simonela', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	/*
	 * ---------------------------------------------------
	 * Menu sub kegiatan e-monev
	 * Sub kegiatan di ambil dari ropk keuangan sub kegiatan
	 * ---------------------------------------------------
	 */
	public function index()
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'simonela',
				'mn' => 'simonela',
				'title' => 'User | Si-Monela',
				'lok' => '<b>Si-Monela</b>',
				'sub_kegiatan' => $this->sub_kegiatan->Kegiatan(), //Miroring dari sub Kegiatan keuangan
				'db' => \Config\Database::connect(),
			];
			echo view('user/Simonela/simonela', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	/*
	 * ---------------------------------------------------
	 * Progres berdasarkan sub kegiatan
	 * ---------------------------------------------------
	 */
	public function progres($id)
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'simonela',
				'mn' => 'simonela',
				'title' => 'User | Si-Monela',
				'lok' => '<a onclick="history.back(-1)" href="#">Si-Monela</a> -> <b>Progres</b>',
				'DT' => $this->sub_kegiatan->find($id),
				'db' => \Config\Database::connect(),
			];
			echo view('user/Simonela/simonela_progres', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	/*
	 * ---------------------------------------------------
	 * Tambah Progres berdasarkan sub kegiatan
	 * ---------------------------------------------------
	 */
	public function progres_add($id, $b = '', $nm = '')
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'simonela',
				'mn' => 'simonela',
				'title' => 'User | Si-Monela',
				'lok' => 'Si-Monela -> <a onclick="history.back(-1)" href="#">Progres</a> -> <b>Tambah Progres</b>',
				'DT' => $this->sub_kegiatan->find($id),
				'b' => $b,
				'nm' => $nm,
				'db' => \Config\Database::connect(),
			];
			echo view('user/Simonela/simonela_progres_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	/*
	 * ---------------------------------------------------
	 * Tambah Progres
	 * ---------------------------------------------------
	 */
	public function progres_create()
	{
		if (has_permission('User')) :
			$this->simonela->save([
				'kegiatan' => $this->request->getVar('kegiatan'),
				'kegiatan_sub' => $this->request->getVar('kegiatan_sub'),
				'indikator_kegiatan_sub' => $this->request->getVar('indikator_kegiatan_sub'),
				'bulan' => $this->request->getVar('bulan'),
				'bulan_lapor' => date('m'),
				'tahap_aktifitas' => $this->request->getVar('tahap_aktifitas'),
				'faktor_pendukung' => $this->request->getVar('pendukung'),
				'faktor_penghambat' => $this->request->getVar('penghambat'),
				'realisasi_keu' => $this->request->getVar('keu'),
				'realisasi_fisik' => $this->request->getVar('fis'),
				'opd_id' => user()->opd_id,
				'tahun' => $_SESSION['tahun'],
				'perubahan' => $_SESSION['perubahan'],
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/simonela/simonela/progres/' . $this->request->getVar('id'));
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	/*
	 * ---------------------------------------------------
	 * Ubah Progres berdasarkan sub kegiatan
	 * ---------------------------------------------------
	 */
	public function progres_edit($id, $p, $b = '', $nm = '')
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'simonela',
				'mn' => 'simonela',
				'title' => 'User | Si-Monela',
				'lok' => 'Si-Monela -> <a onclick="history.back(-1)" href="#">Progres</a> -> <b>Ubah Progres</b>',
				'DT' => $this->sub_kegiatan->find($id),
				'simonela' => $this->simonela->find($p),
				'b' => $b,
				'nm' => $nm,
				'db' => \Config\Database::connect(),
			];
			echo view('user/Simonela/simonela_progres_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	/*
	 * ---------------------------------------------------
	 * Ubah Progres
	 * ---------------------------------------------------
	 */
	public function progres_update()
	{
		if (has_permission('User')) :
			$this->simonela->save([
				'id_simonela_progres' => $this->request->getVar('id_progres'),
				'kegiatan' => $this->request->getVar('kegiatan'),
				'kegiatan_sub' => $this->request->getVar('kegiatan_sub'),
				'indikator_kegiatan_sub' => $this->request->getVar('indikator_kegiatan_sub'),
				'bulan' => $this->request->getVar('bulan'),
				'bulan_lapor' => date('m'),
				'tahap_aktifitas' => $this->request->getVar('tahap_aktifitas'),
				'faktor_pendukung' => $this->request->getVar('pendukung'),
				'faktor_penghambat' => $this->request->getVar('penghambat'),
				'realisasi_keu' => $this->request->getVar('keu'),
				'realisasi_fisik' => $this->request->getVar('fis'),
				'opd_id' => user()->opd_id,
				'tahun' => $_SESSION['tahun'],
				'perubahan' => $_SESSION['perubahan'],
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/simonela/simonela/progres/' . $this->request->getVar('id'));
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	/*
	 * ---------------------------------------------------
	 * Tambah Progres Dokument
	 * ---------------------------------------------------
	 */
	public function dokumen_add($id, $b = '', $nm = '')
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'simonela',
				'mn' => 'simonela',
				'title' => 'User | Si-Monela',
				'lok' => 'Si-Monela -> <a href="/user/simonela/simonela/progres/' . $id . '">Progres</a> -> <b>Tambah Dokemen</b>',
				'DT' => $this->sub_kegiatan->find($id),
				'b' => $b,
				'nm' => $nm,
				'validation' => \Config\Services::validation(),
				'db' => \Config\Database::connect(),
			];
			echo view('user/Simonela/simonela_progres_dokumen_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	/*
	 * ---------------------------------------------------
	 * Tambah Progres Dokument
	 * ---------------------------------------------------
	 */
	public function dokumen_create()
	{
		if (!$this->validate([
			'file' => [
				'rules' => 'uploaded[file]|max_size[file,20100]|ext_in[file,doc,docx,Doc,Docx,xls,xlsx,Xls,Xlsx,pdf,jpg,jpeg,png]',
				'errors' => [
					'uploaded' => 'Pilih Berkas',
					'max_size' => 'Maksimal Size 20Mb',
					'ext_in' => 'Format file Salah!'
				]
			]
		])) {
			return redirect()->back()->withInput();
		}

		$file = $this->request->getFile('file');

		if ($file->getError() == 4) {
			$namaFile = '';
		} else {

			$path = './FileBerkasData/' . user()->opd_id . '/Si-Monela';
			if (!is_dir($path)) {
				mkdir($path, '0755', true);
			}

			$nama = $this->request->getVar('nama');
			$nama2 = $file->getRandomName();
			$namaFile = $nama . '-' . $nama2;
			$file->move('FileBerkasData/' . user()->opd_id . '/Si-Monela/', $namaFile);
		}

		$this->simonela_dokumen->save([
			'kegiatan' => $this->request->getVar('kegiatan'),
			'kegiatan_sub' => $this->request->getVar('kegiatan_sub'),
			'indikator_kegiatan_sub' => $this->request->getVar('indikator_kegiatan_sub'),
			'bulan' => $this->request->getVar('bulan'),
			'dokumen' => $namaFile,
			'size' => $file->getSize(),
			'keterangan' => $this->request->getVar('keterangan'),

			'opd_id' => user()->opd_id,
			'tahun' => $_SESSION['tahun'],
			'perubahan'  => $_SESSION['perubahan'],
		]);

		session()->setFlashdata('pesan', 'Data berhasil di simpan.');
		return redirect()->back();
	}
	/*
	 * ---------------------------------------------------
	 * Hapus Progres Dokument
	 * ---------------------------------------------------
	 */
	public function dokumen_hapus($id)
	{
		$dt = $this->simonela_dokumen->getwhere(['id_simonela_progres_berkas' => $id])->getRow();
		// dd($dt);
		$dokumen = $dt->dokumen;
		try {
			unlink('FileBerkasData/' . user()->opd_id . '/Si-Monela/' . $dokumen);
		} catch (\Exception $e) {
		}

		try {
			$this->simonela_dokumen->delete($id);
		} catch (\Exception $e) {
			session()->setFlashdata('error', 'Data Gagal di hapus.');
			return redirect()->back();
		}

		session()->setFlashdata('pesan', 'Data berhasil di hapus.');
		return redirect()->back();
	}
	/*
	 * ---------------------------------------------------
	 * Download Progres Dokument
	 * ---------------------------------------------------
	 */
	public function download($id)
	{
		$dt = $this->simonela_dokumen->getwhere(['id_simonela_progres_berkas' => $id])->getRow();
		$dokumen = $dt->dokumen;

		return $this->response->download('./FileBerkasData/' . user()->opd_id . '/Si-Monela/' . $dokumen, NULL);
	}
}
