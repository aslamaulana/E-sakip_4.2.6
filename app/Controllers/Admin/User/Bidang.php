<?php

namespace App\Controllers\Admin\User;

use CodeIgniter\HTTP\IncomingRequest;

/**
 * @property IncomingRequest $request
 */

use App\Controllers\BaseController;
use App\Models\Admin\User\Model_bidang;
use App\Models\Admin\User\Model_groups_permissions;

class Bidang extends BaseController
{
	protected $bidang, $group_permisi;
	public function __construct()
	{
		$this->bidang = new Model_bidang();
		$this->group_permisi = new Model_groups_permissions();
	}
	public function index()
	{
		if (in_groups('Superadmin')) :
			$bidang = $this->bidang->Groups();
			$data = [
				'gr' => 'skpd',
				'mn' => 'skpd',
				'title' => 'Admin | SKPD',
				'lok' => 'SKPD',
				'db' => \Config\Database::connect(),
				'bidang' => $bidang,
			];
			return view('admin/User/bidang', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function bidang_add()
	{
		if (in_groups('Superadmin')) :
			$bidang = $this->bidang->buat_kode();
			$data = [
				'gr' => 'skpd',
				'mn' => 'skpd',
				'title' => 'Admin | SKPD',
				'lok' => '<a href=".">SKPD</a> -> <b>Tambah SKPD</b>',
				'validation' => \Config\Services::validation(),
				'bidang' => $bidang,

			];
			return view('admin/User/bidang_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function bidang_create()
	{
		if (!$this->validate([

			'nm' => [
				'rules' => 'required|is_unique[auth_groups.name]',
				'errors' => [
					'required' => 'harus di isi',
					'is_unique' => 'Sudah Ada, Tidak boleh sama'
				]
			],
		])) {
			return redirect()->to('/admin/User/bidang/bidang_add')->withInput();
		}

		$this->bidang->save([
			'id' => $this->request->getVar('id'),
			'name' => $this->request->getVar('nm'),
			'description' => $this->request->getVar('detail'),
		]);

		$path = './FileBerkasData/' . $this->request->getVar('id');
		if (!is_dir($path)) {
			mkdir($path, '0755', true);
		}

		foreach ($_POST['akses'] as $key => $val) {
			$result[] = array(
				'group_id' => $this->request->getVar('id'),
				'permission_id' => $_POST['akses'][$key],
			);
		}
		$this->group_permisi->insertBatch($result);

		session()->setFlashdata('pesan', 'Data berhasil di simpan.');
		return redirect()->to(base_url() . '/admin/User/bidang');
	}
	public function bidang_edit($id)
	{
		if (in_groups('Superadmin')) :
			$bidang = $this->bidang->Edit(buka($id));
			$data = [
				'gr' => 'skpd',
				'mn' => 'skpd',
				'title' => 'Admin | SKPD',
				'lok' => '<a href="..">SKPD</a> -> <b>Ubah SKPD</b>',
				'validation' => \Config\Services::validation(),
				'db' => \Config\Database::connect(),
				'bidang' => $bidang,
			];
			return view('admin/User/bidang_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function bidang_update()
	{
		$id = buka($this->request->getVar('id'));
		$id_groups = $_POST['akses_old'];

		if (!$this->validate([
			'nm' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'harus di isi',
					'is_unique' => 'Sudah Ada, Tidak boleh sama'
				]
			],
		])) {
			return redirect()->to('/admin/User/bidang/bidang_edit/' . $id)->withInput();
		}

		try {
			$this->bidang->save([
				'id' => $id,
				'name' => $this->request->getVar('nm'),
				'description' => $this->request->getVar('detail'),
			]);
		} catch (\Exception $e) {
			session()->setFlashdata('error', 'Data gagal di updated.');
			return redirect()->back();
		}

		try {
			$this->group_permisi->delete($id_groups);
		} catch (\Exception $e) {
			session()->setFlashdata('error', 'Data gagal di updated.');
			return redirect()->back();
		}

		foreach ($_POST['akses'] as $key => $val) {
			$result[] = array(
				'group_id' => $id,
				'permission_id' => $_POST['akses'][$key],
			);
		}
		$this->group_permisi->insertBatch($result);

		session()->setFlashdata('pesan', 'Data berhasil di simpan.');
		return redirect()->to(base_url() . '/admin/User/bidang');
	}
	public function hapus($id)
	{
		try {
			$this->bidang->delete($id);
		} catch (\Exception $e) {
			session()->setFlashdata('error', 'Data Gagal di hapus.');
			return redirect()->back();
		}
		try {
			rmdir('./FileBerkasData/' . $id);
		} catch (\Exception $e) {
			session()->setFlashdata('error', 'Data Gagal di hapus.');
			return redirect()->back();
		}
		session()->setFlashdata('pesan', 'Data berhasil di hapus.');
		return redirect()->back();
	}
}
