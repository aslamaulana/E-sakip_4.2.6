<?php

namespace App\Controllers\Admin\Menu;

use App\Controllers\BaseController;
use App\Models\Admin\Menu\Model_menu;

class Menu extends BaseController
{
	protected $menu;

	public function __construct()
	{
		$this->menu = new Model_menu();
	}

	public function index()
	{
		if (has_permission('Admin')) :
			$menu = $this->menu->getWhere(['tahun' => $_SESSION['tahun']])->getResultArray();
			$data = [
				'gr' => 'menu',
				'mn' => 'menu',
				'title' => 'Admin | Setting',
				'lok' => '<b>Menu</b>',
				'menu' => $menu,
				'db' => \Config\Database::connect(),
			];
			echo date('M') . ', ' . date('d') . ' ' . date('Y') . ' ' . date('H') . ':' . date('i');
			echo view('admin/Menu/menu', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function create()
	{
		if (has_permission('Admin')) :

			if ($this->request->getVar('timer_a') == 'aktif') {
				$timer_a = 'aktif';
			} else {
				$timer_a = 'tidak';
			}

			$this->menu->save([
				'id_menu' => $this->request->getVar('id'),
				'kunci' => $this->request->getVar('kunci'),
				'timer' => $this->request->getVar('bulan') . ', ' . $this->request->getVar('hari') . ' ' . $this->request->getVar('tahun') . ' ' . $this->request->getVar('jam') . ':' . $this->request->getVar('menit'),
				'timer_a' => $timer_a,
				// 'tahun' => $_SESSION['tahun'],
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/admin/menu/menu');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function set($id)
	{
		// if (
		// 	menu('renstra')->timer == date('M') . ', ' . date('d') . ' ' . date('Y') . ' ' . date('H') . ':' . date('i') ||
		// 	menu('renja')->timer == date('M') . ', ' . date('d') . ' ' . date('Y') . ' ' . date('H') . ':' . date('i')
		// ) {
		$this->menu->save([
			'id_menu' => $id,
			'kunci' => 'ya',
			'timer' => '',
			'timer_a' => 'tidak',
		]);
		// }

		session()->setFlashdata('pesan', 'Waktu Habis');
		return redirect()->to(base_url('/logout'));
		// return redirect()->back();
		// return redirect()->to(base_url() . '/admin/User/users/users_add')->withInput();
	}
	// ---------------------------------------------------------
}
