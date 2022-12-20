<?php

namespace App\Controllers\Admin\user;

use CodeIgniter\HTTP\IncomingRequest;

/**
 * @property IncomingRequest $request
 */

use App\Controllers\BaseController;
use App\Models\Admin\User\Model_permissions;
use App\Models\Admin\User\Model_bidang;
use App\Models\Admin\User\Model_groups_permissions;

class Modul extends BaseController
{
	protected $skpd, $permission, $group_permission;

	public function __construct()
	{
		$this->permission = new Model_permissions();
		$this->group_permission = new Model_groups_permissions();
		$this->skpd = new Model_bidang();
	}
	public function index()
	{
		if (in_groups('Superadmin')) :
			$permission = $this->permission->get_permissions();
			// $skpd = $this->skpd->Groups();
			$skpd = $this->skpd->skpd();
			$data = [
				'gr' => 'skpd',
				'mn' => 'skpd_akses',
				'title' => 'Akses',
				'lok' => 'Akses',
				'permission' => $permission,
				'db' => \Config\Database::connect(),
				'skpd' => $skpd,
			];
			// dd($data);
			return view('admin/User/skpd_akses', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function akses_update()
	{
		$data = [
			// $this->group_permission->save([
			// 'id_akses' => $this->request->getVar('id_akses'),
			'skpd' => $_POST['skpd'],
			'akses' => $_POST['akses'],
		];
		// ]);

		dd($data);

		// $this->users->save([
		// 	'id' => $this->request->getVar('id'),
		// 	'username' => $this->request->getVar('username'),
		// 	'full_name' => $this->request->getVar('nm'),
		// 	'email' => $this->request->getVar('email'),
		// 	'active' => $this->request->getVar('active'),
		// 	'opd_id' => $this->request->getVar('akses'),
		// ]);

		// foreach ($_POST['skpd'] as $key => $val) {
		// 	$result[] = array(
		// 		'group_id' => $_POST['skpd'][$key],
		// 		foreach ($_POST['id_akses'] as $kex => $val) {
		// 			$result[] = array(
		// 				'id_g_p' => $_POST['id_akses'][$kex],
		// 				foreach ($_POST['akses'] as $kem => $val) {
		// 					$result[] = array(
		// 						'permission_id' => isset($_POST['akses'][$kem]) ? $_POST['akses'][$kem] : '',
		// 					);
		// 				}
		// 			);
		// 		}
		// 	);
		// }

		// dd($result);
		// $this->group_permission->insertBatch($result);
		// session()->setFlashdata('pesan', 'Data berhasil di simpan.');
		// return redirect()->to(base_url() . '/admin/user/modul');


		// foreach ($_POST['id_akses'] as $key => $val) {
		// }

		// foreach ($_POST['id_akses'] as $key => $val) {
		// 	if ($_POST['id_akses'][$key] != '') {
		// 		if (empty($_POST['akses'][$key])) {
		// 			foreach ($_POST['id_akses'] as $key => $val) {
		// 				$result[] = array(
		// 					'id_g_p' => $_POST['id_akses'][$key],
		// 				);
		// 			}
		// 			$this->group_permission->delete($result);
		// 			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
		// 			return redirect()->to(base_url() . '/admin/user/modul');
		// 		} elseif ($_POST['id_akses'][$key] == '') {
		// 			if (isset($_POST['akses'][$key])) {
		// 				foreach ($_POST['id_akses'] as $key => $val) {
		// 					$result[] = array(
		// 						'group_id' => $this->request->getVar('skpd'),
		// 						'permission_id' => $_POST['akses'][$key],
		// 					);
		// 				}
		// 				dd($result);
		// 				$this->group_permission->insertBatch($result);
		// 				session()->setFlashdata('pesan', 'Data berhasil di simpan.');
		// 				return redirect()->to(base_url() . '/admin/user/modul');
		// 			}
		// 		}
		// 	}
		// }

		// foreach ($_POST['id_akses'] as $key => $val) {
		// 	if ($_POST['id_akses'][$key] != '') {
		// 		if (empty($_POST['akses'][$key])) {
		// 			foreach ($_POST['id_akses'] as $key => $val) {
		// 				$result[] = array(
		// 					'id_g_p' => $_POST['id_akses'][$key],
		// 				);
		// 			}
		// 			$this->group_permission->delete($result);
		// 			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
		// 			return redirect()->to(base_url() . '/admin/user/modul');
		// 		}
		// 	}
		// }
		// foreach ($_POST['akses'] as $key => $val) {
		// 	if (isset($_POST['akses'][$key])) {
		// 		if ($_POST['id_akses'] == '') {
		// 			foreach ($_POST['id_akses'] as $key => $val) {
		// 				$result[] = array(
		// 					'group_id' => $this->request->getVar('skpd'),
		// 					'permission_id' => $_POST['akses'][$key],
		// 				);
		// 			}
		// 			dd($result);
		// 			$this->group_permission->insertBatch($result);
		// 			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
		// 			return redirect()->to(base_url() . '/admin/user/modul');
		// 		}
		// 	}
		// }
	}

	public function users_add()
	{
		if (in_groups('Superadmin')) :
			$bidang = $this->bidang->Groups();
			$users = $this->users->buat_kode();
			$data = [
				'gr' => 'skpd',
				'mn' => 'users',
				'title' => 'Users',
				'lok' => '<a href=".">User Skpd</a> -> <b>Tambah User Skpd</b>',
				'validation' => \Config\Services::validation(),
				'bidang' => $bidang,
				'users_id' => $users,

			];
			return view('admin/User/users_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function users_create()
	{
		if (!$this->validate([
			'akses' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'harus di isi',
				]
			],
			'username' => [
				'rules' => 'required|is_unique[users.username]',
				'errors' => [
					'required' => 'harus di isi',
					'is_unique' => 'Username Sudah Ada'
				]
			],
			'password' => [
				'rules' => 'required|min_length[8]',
				'errors' => [
					'required' => 'harus di isi',
					'min_length' => 'Password Min 8 Digit'
				]
			],
			'password_k' => [
				'rules' => 'required|matches[password]',
				'errors' => [
					'required' => 'harus di isi',
					'matches' => 'Password Tidak Sama'
				]
			],
			'email' => [
				'rules' => 'required|valid_email|is_unique[users.email]',
				'errors' => [
					'required' => 'harus di isi',
					'is_unique' => 'Email Sudah Ada',
					'valid_email' => 'Isikan email dengan benar'
				]
			],
		])) {
			return redirect()->to(base_url() . '/admin/User/users/users_add')->withInput();
		}

		$options = $this->request->getVar('password');
		$hus = password_hash(base64_encode(hash('sha384', $options, true)), PASSWORD_DEFAULT);
		$this->users->save([
			'id' => $this->request->getVar('id'),
			'username' => $this->request->getVar('username'),
			'password_hash' => $hus,
			'full_name' => $this->request->getVar('nm'),
			'email' => $this->request->getVar('email'),
			'active' => $this->request->getVar('active'),
			'opd_id' => $this->request->getVar('akses'),
		]);
		$this->group_users->save([
			'group_id' => $this->request->getVar('akses'),
			'user_id' => $this->request->getVar('id'),
		]);

		session()->setFlashdata('pesan', 'Data berhasil di simpan.');
		return redirect()->to(base_url() . '/admin/User/users');
	}
	public function users_edit($id)
	{
		if (in_groups('Superadmin')) :
			$bidang = $this->bidang->Groups();
			$users = $this->users->Edit($id);
			$data = [
				'gr' => 'skpd',
				'mn' => 'users',
				'title' => 'Users',
				'lok' => '<a href="..">User Skpd</a> -> <b>Ubah User Skpd</b>',
				'validation' => \Config\Services::validation(),
				'bidang' => $bidang,
				'users' => $users,
			];
			return view('admin/User/users_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function users_update()
	{
		if (!$this->validate([
			'akses' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'harus di isi',
				]
			],
			'username' => [
				'rules' => 'required|is_unique[users.username,id,{id}]',
				'errors' => [
					'required' => 'harus di isi',
					'is_unique' => 'Username Sudah Ada'
				]
			],
			'email' => [
				'rules' => 'required|valid_email|is_unique[users.email,id,{id}]',
				'errors' => [
					'required' => 'harus di isi',
					'is_unique' => 'Email Sudah Ada',
					'valid_email' => 'Isikan email dengan benar'
				]
			],
		])) {
			return redirect()->to(base_url() . '/admin/User/users/users_add')->withInput();
		}

		$options = $this->request->getVar('password');
		$hus = password_hash(base64_encode(hash('sha384', $options, true)), PASSWORD_DEFAULT);
		$this->users->save([
			'id' => $this->request->getVar('id'),
			'username' => $this->request->getVar('username'),
			'full_name' => $this->request->getVar('nm'),
			'email' => $this->request->getVar('email'),
			'active' => $this->request->getVar('active'),
			'opd_id' => $this->request->getVar('akses'),
		]);
		$this->group_users->save([
			'id_g_u' => $this->request->getVar('id_g_u'),
			'group_id' => $this->request->getVar('akses'),
			'user_id' => $this->request->getVar('id'),
		]);

		session()->setFlashdata('pesan', 'Data berhasil di simpan.');
		return redirect()->to(base_url() . '/admin/User/users');
	}
	public function hapus($id)
	{
		try {
			$this->users->delete($id);
		} catch (\Exception $e) {
			session()->setFlashdata('error', 'Data Gagal di hapus.');
			return redirect()->back();
		}

		session()->setFlashdata('pesan', 'Data berhasil di hapus.');
		return redirect()->back();
	}
}
