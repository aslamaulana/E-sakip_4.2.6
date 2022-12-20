<?php

use App\Models\Admin\User\Model_bidang;
use App\Models\Admin\Menu\Model_menu;
use App\Models\Admin\Model_konten;

function opd()
{
	$bidang = new Model_bidang();
	$nama = $bidang->namaBidang();
	return $nama;
}
function menu($name)
{
	$menu = new Model_menu();
	$nama = $menu->menu($name);
	return $nama;
}
// function konten($id)
// {
// 	$konten = new Model_konten();
// 	$nama = $konten->nama($id);
// 	return $nama;
// }
function formatBytes($bytes, $precision = 2)
{
	$units = array('B', 'KB', 'MB', 'GB', 'TB');

	$bytes = max($bytes, 0);
	$pow = floor(($bytes ? log($bytes) : 0) / log(1024));
	$pow = min($pow, count($units) - 1);

	// Uncomment one of the following alternatives
	// $bytes /= pow(1024, $pow);
	// $bytes /= (1 << (10 * $pow)); 

	return round($bytes, $precision) . ' ' . $units[$pow];
}
function formatBytes2($size, $precision = 2)
{
	$base = log($size, 1024);
	$suffixes = array('', 'K', 'M', 'G', 'T');

	return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
}
// -----------------Enkripsi---------------------
function kunci($name)
{
	$encrypter = \Config\Services::encrypter();
	return bin2hex($encrypter->encrypt($name));
}
function buka($name)
{
	$encrypter = \Config\Services::encrypter();
	return $encrypter->decrypt(hex2bin($name));
}
// -----------------/Enkripsi--------------------
