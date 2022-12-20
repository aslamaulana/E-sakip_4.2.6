<?php

namespace App\Controllers\Admin\user;

use CodeIgniter\HTTP\IncomingRequest;

/**
 * @property IncomingRequest $request
 */

use App\Controllers\BaseController;
use App\Models\Admin\User\Model_users;
use App\Models\Admin\User\Model_bidang;
use App\Models\Admin\User\Model_groups_users;

class Users extends BaseController
{
	protected $users, $bidang, $group_users;

	public function __construct()
	{
		$this->users = new Model_users();
		$this->bidang = new Model_bidang(); /* model opd */
		$this->group_users = new Model_groups_users();
	}
	public function index()
	{
		if (in_groups('Superadmin')) :
			$users = $this->users->Users();
			$data = [
				'gr' => 'skpd',
				'mn' => 'users',
				'title' => 'Users',
				'lok' => 'User Skpd',
				'users' => $users,
			];
			return view('admin/User/users', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function user($id)
	{
		if (in_groups('Superadmin')) :
			$users = $this->users->Users2($id);
			$data = [
				'gr' => 'skpd',
				'mn' => 'skpd',
				'title' => 'Admin | OPD',
				'lok' => '<a href="/admin/user/bidang">OPD</a> -> <b>User OPD</b>',
				'users' => $users,
				'opd_id' => $id,
				'nama_opd' => $this->bidang->find(buka($id)),
				'db' => \Config\Database::connect(),
			];
			return view('admin/User/users', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	// public function users_add($id = '', $jabatan = 'kepala_opd', $id_user = '')
	// {
	// 	if (in_groups('Superadmin')) :
	// 		$users = date("YmdHis");
	// 		$data = [
	// 			'gr' => 'skpd',
	// 			'mn' => 'skpd',
	// 			'title' => 'Admin | OPD',
	// 			'lok' => 'OPD -> <a onclick="history.back(-1)" href="#">User OPD</a> -> <b>Tambah User OPD</b>',
	// 			'validation' => \Config\Services::validation(),
	// 			'users_id' => $users,
	// 			'opd_id' => $id,
	// 			'jabatan' => $jabatan,
	// 			'nama_bidang' => $this->users->find($id_user)
	// 		];
	// 		return view('admin/User/users_add', $data);
	// 	else :
	// 		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
	// 	endif;
	// }
	/*
	 * ---------------------------------------------------
	 * Tambah user
	 * Menuju form tambah user
	 * ---------------------------------------------------
	 */
	public function users_add($id = '', $level = '1', $id_user = '')
	{
		if (in_groups('Superadmin')) :
			$users = date("YmdHis");
			$data = [
				'gr' => 'skpd',
				'mn' => 'skpd',
				'title' => 'Admin | OPD',
				'lok' => 'OPD -> <a onclick="history.back(-1)" href="#">User OPD</a> -> <b>Tambah User OPD</b>',
				'validation' => \Config\Services::validation(),
				'users_id' => $users,
				'level' => $level,
				'opd_id' => $id,
				'nama_bidang' => $this->users->find($id_user)
			];
			return view('admin/User/users_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	// public function users_create()
	// {
	// 	if (!$this->validate([
	// 		'akses' => [
	// 			'rules' => 'required',
	// 			'errors' => [
	// 				'required' => 'harus di isi',
	// 			]
	// 		],
	// 		'username' => [
	// 			'rules' => 'required|is_unique[users.username]',
	// 			'errors' => [
	// 				'required' => 'harus di isi',
	// 				'is_unique' => 'Username Sudah Ada'
	// 			]
	// 		],
	// 		'password' => [
	// 			'rules' => 'required|min_length[8]',
	// 			'errors' => [
	// 				'required' => 'harus di isi',
	// 				'min_length' => 'Password Min 8 Digit'
	// 			]
	// 		],
	// 		'password_k' => [
	// 			'rules' => 'required|matches[password]',
	// 			'errors' => [
	// 				'required' => 'harus di isi',
	// 				'matches' => 'Password Tidak Sama'
	// 			]
	// 		],
	// 		// 'email' => [
	// 		// 	'rules' => 'required|valid_email|is_unique[users.email]',
	// 		// 	'errors' => [
	// 		// 		'required' => 'harus di isi',
	// 		// 		'is_unique' => 'Email Sudah Ada',
	// 		// 		'valid_email' => 'Isikan email dengan benar'
	// 		// 	]
	// 		// ],
	// 	])) {
	// 		return redirect()->to(base_url() . '/admin/User/users/users_add/' . $this->request->getVar('akses'))->withInput();
	// 	}

	// 	$options = $this->request->getVar('password');
	// 	// $hus = password_hash(base64_encode(hash('sha384', $options, true)), PASSWORD_DEFAULT);
	// 	$hus = \Myth\Auth\Password::hash($options); //has password
	// 	$this->users->save([
	// 		'id' => buka($this->request->getVar('akses')) . buka($this->request->getVar('id')),
	// 		'username' => $this->request->getVar('username'),
	// 		'password_hash' => $hus,
	// 		'full_name' => $this->request->getVar('nm'),
	// 		// 'email' => $this->request->getVar('email'),
	// 		'active' => $this->request->getVar('active'),
	// 		'opd_id' => buka($this->request->getVar('akses')),/* akses adalah opd_id */
	// 		'nip' => $this->request->getVar('nip'),
	// 		'jabatan' => $this->request->getVar('jabatan'),
	// 		'nama_singkat_bidang' => $this->request->getVar('nama_singkat_bidang'),
	// 		'nama_panjang_bidang' => $this->request->getVar('nama_panjang_bidang'),
	// 		'golongan' => $this->request->getVar('golongan'),
	// 		'eselon' => $this->request->getVar('eselon'),
	// 	]);
	// 	$this->group_users->save([
	// 		'group_id' => buka($this->request->getVar('akses')), /* akses adalah opd_id */
	// 		'user_id' => buka($this->request->getVar('akses')) . buka($this->request->getVar('id')),
	// 	]);


	// 	session()->setFlashdata('pesan', 'Data berhasil di simpan.');
	// 	return redirect()->to(base_url() . '/admin/user/users/user/' . $this->request->getVar('akses'));
	// }
	/*
	 * ---------------------------------------------------
	 * Tambah user
	 * ---------------------------------------------------
	 */
	public function users_create()
	{
		if (!$this->validate([
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
		])) {
			return redirect()->back()->withInput();
		}

		$options = $this->request->getVar('password');
		// $hus = password_hash(base64_encode(hash('sha384', $options, true)), PASSWORD_DEFAULT);
		$hus = \Myth\Auth\Password::hash($options); //has password
		$this->users->save([
			'id' => buka($this->request->getVar('akses')) . buka($this->request->getVar('id')),
			'username' => $this->request->getVar('username'),
			'password_hash' => $hus,
			'full_name' => $this->request->getVar('nm'),
			'active' => $this->request->getVar('active'),
			'opd_id' =>  buka($this->request->getVar('akses')),/* akses adalah opd_id */
			'nip' => $this->request->getVar('nip'),
			'level' => $this->request->getVar('level'),
			'sub_bidang' => $this->request->getVar('sub_bidang'),
			'nama_singkat_bidang' => $this->request->getVar('nama_singkat_bidang'),
			'nama_panjang_bidang' => $this->request->getVar('nama_panjang_bidang'),
			'golongan' => $this->request->getVar('golongan'),
			'jabatan' => $this->request->getVar('jabatan'),
		]);
		$this->group_users->save([
			'group_id' =>  buka($this->request->getVar('akses')), /* akses adalah opd_id */
			'user_id' => buka($this->request->getVar('akses')) . buka($this->request->getVar('id')),
		]);


		session()->setFlashdata('pesan', 'Data berhasil di simpan.');
		return redirect()->to(base_url() . '/admin/user/users/user/' . $this->request->getVar('akses'));
	}
	// public function users_edit($bidang, $id, $jabatan = 'kepala_opd')
	// {
	// 	if (in_groups('Superadmin')) :
	// 		// $bidang = $this->bidang->Groups();
	// 		$users = $this->users->Edit($id);
	// 		$data = [
	// 			'gr' => 'skpd',
	// 			'mn' => 'skpd',
	// 			'title' => 'Admin | OPD',
	// 			'lok' => 'OPD -> <a href="/admin/user/users/user/' . $bidang . '">User OPD</a> -> <b>Ubah User OPD</b>',
	// 			'validation' => \Config\Services::validation(),
	// 			'bidang' => $bidang,
	// 			'users' => $users,
	// 			'jabatan' => $jabatan,
	// 		];
	// 		return view('admin/User/users_edit', $data);
	// 	else :
	// 		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
	// 	endif;
	// }
	/*
	 * ---------------------------------------------------
	 * Ubah user
	 * Menuju form ubah user
	 * ---------------------------------------------------
	 */
	public function users_edit($bidang, $id, $level = '1')
	{
		if (in_groups('Superadmin')) :
			// $bidang = $this->bidang->Groups();
			$users = $this->users->Edit($id);
			$data = [
				'gr' => 'skpd',
				'mn' => 'skpd',
				'title' => 'Admin | OPD',
				'lok' => 'OPD -> <a href="/admin/user/users/user/' . $bidang . '">User OPD</a> -> <b>Ubah User OPD</b>',
				'validation' => \Config\Services::validation(),
				'bidang' => $bidang,
				'users' => $users,
				'level' => $level,
			];
			return view('admin/User/users_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	// public function users_update()
	// {
	// 	$this->users->save([
	// 		'id' => buka($this->request->getVar('id')),
	// 		'username' => $this->request->getVar('username'),
	// 		'full_name' => $this->request->getVar('nm'),
	// 		// 'email' => $this->request->getVar('email'),
	// 		'active' => $this->request->getVar('active'),
	// 		// 'opd_id' => buka($this->request->getVar('akses')),/* akses adalah opd_id */
	// 		'nip' => $this->request->getVar('nip'),
	// 		'jabatan' => $this->request->getVar('jabatan'),
	// 		'nama_singkat_bidang' => $this->request->getVar('nama_singkat_bidang'),
	// 		'nama_panjang_bidang' => $this->request->getVar('nama_panjang_bidang'),
	// 		'golongan' => $this->request->getVar('golongan'),
	// 		'eselon' => $this->request->getVar('eselon'),
	// 	]);
	// 	if ($this->request->getVar('nama_singkat_bidang') != $this->request->getVar('nama_singkat_bidang_old') || $this->request->getVar('nama_panjang_bidang') != $this->request->getVar('nama_panjang_bidang_old')) {
	// 		$data = [
	// 			'nama_singkat_bidang' => $this->request->getVar('nama_singkat_bidang'),
	// 			'nama_panjang_bidang' => $this->request->getVar('nama_panjang_bidang'),
	// 		];
	// 		$dataw = [
	// 			'nama_singkat_bidang' => $this->request->getVar('nama_singkat_bidang_old'),
	// 			'nama_panjang_bidang' => $this->request->getVar('nama_panjang_bidang_old'),
	// 		];
	// 		// dd($dataf);
	// 		$this->users->set($data)->where($dataw)->update();
	// 	}

	// 	session()->setFlashdata('pesan', 'Data berhasil di simpan.');
	// 	return redirect()->to(base_url() . '/admin/user/users/user/' . $this->request->getVar('opd_id'));
	// }
	/*
	 * ---------------------------------------------------
	 * Ubah user
	 * ---------------------------------------------------
	 */
	public function users_update()
	{
		$this->users->save([
			'id' => buka($this->request->getVar('id')),
			'username' => $this->request->getVar('username'),
			'full_name' => $this->request->getVar('nm'),
			// 'email' => $this->request->getVar('email'),
			'active' => $this->request->getVar('active'),
			// 'opd_id' => buka($this->request->getVar('akses')),/* akses adalah opd_id */
			'nip' => $this->request->getVar('nip'),
			'jabatan' => $this->request->getVar('jabatan'),
			'nama_singkat_bidang' => $this->request->getVar('nama_singkat_bidang'),
			'nama_panjang_bidang' => $this->request->getVar('nama_panjang_bidang'),
			'golongan' => $this->request->getVar('golongan'),
			// 'eselon' => $this->request->getVar('eselon'),
		]);
		if ($this->request->getVar('level') == '2') {
			if (
				$this->request->getVar('nama_singkat_bidang') != $this->request->getVar('nama_singkat_bidang_old') ||
				$this->request->getVar('nama_panjang_bidang') != $this->request->getVar('nama_panjang_bidang_old')
			) {
				$data = [
					'nama_singkat_bidang' => $this->request->getVar('nama_singkat_bidang'),
					'nama_panjang_bidang' => $this->request->getVar('nama_panjang_bidang')
				];
				$dataw = [
					'nama_singkat_bidang' => $this->request->getVar('nama_singkat_bidang_old'),
					'nama_panjang_bidang' => $this->request->getVar('nama_panjang_bidang_old')
				];
				// dd($dataf);
				$this->users->set($data)->where($dataw)->update();
			}
		} elseif ($this->request->getVar('level') == '3') {
			if (
				$this->request->getVar('nama_singkat_bidang') != $this->request->getVar('nama_singkat_bidang_old') ||
				$this->request->getVar('nama_panjang_bidang') != $this->request->getVar('nama_panjang_bidang_old') ||
				$this->request->getVar('sub_bidang') != $this->request->getVar('sub_bidang_old')
			) {
				$data = [
					'nama_singkat_bidang' => $this->request->getVar('nama_singkat_bidang'),
					'nama_panjang_bidang' => $this->request->getVar('nama_panjang_bidang'),
					'sub_bidang' => $this->request->getVar('sub_bidang'),
				];
				$dataw = [
					'nama_singkat_bidang' => $this->request->getVar('nama_singkat_bidang_old'),
					'nama_panjang_bidang' => $this->request->getVar('nama_panjang_bidang_old'),
					'sub_bidang' => $this->request->getVar('sub_bidang_old'),
				];
				// dd($dataf);
				$this->users->set($data)->where($dataw)->update();
			}
		}

		session()->setFlashdata('pesan', 'Data berhasil di simpan.');
		return redirect()->to(base_url() . '/user/user/users/user/' . $this->request->getVar('opd_id'));
	}
	public function hapus($id, $level = '')
	{
		if ($level == '2') {
			try {
				$this->users->where(['nama_singkat_bidang' => $_GET['nsb'], 'nama_panjang_bidang' => $_GET['npb']])->delete();
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->back();
			}
		} else {
			try {
				$this->users->delete($id);
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->back();
			}
		}
		session()->setFlashdata('pesan', 'Data berhasil di hapus.');
		return redirect()->back();
	}
	/*
	 * ---------------------------------------------------
	 * Ubah Password
	 * Menuju form Ubah Pasword
	 * ---------------------------------------------------
	 */
	public function ubah_password()
	{
		if (has_permission('Admin')) :
			$data = [
				'gr' => 'opd',
				'mn' => 'bidang',
				'title' => 'User | OPD',
				'lok' => '<b>Ubah Password</b>',
				'validation' => \Config\Services::validation(),
			];
			return view('admin/User/password_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	/*
	 * ---------------------------------------------------
	 * Ubah Password
	 * ---------------------------------------------------
	 */
	public function password_update()
	{
		if (!$this->validate([
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
		])) {
			return redirect()->back()->withInput();
		}

		$options = $this->request->getVar('password');
		$hus = \Myth\Auth\Password::hash($options); //has password
		$this->users->save([
			'id' => user()->id,
			'password_hash' => $hus,
		]);

		session()->setFlashdata('pesan', 'Data berhasil di simpan.');
		return redirect()->to(base_url() . '/logout');
	}
	/*
	 * ---------------------------------------------------
	 * Reser Password
	 * ---------------------------------------------------
	 */
	public function password_reset($id)
	{
		$options = 'perencanaan';
		$hus = \Myth\Auth\Password::hash($options); //has password
		$this->users->save([
			'id' => $id,
			'password_hash' => $hus,
		]);

		session()->setFlashdata('pesan', 'Data berhasil di simpan.');
		return redirect()->back();
	}
}
