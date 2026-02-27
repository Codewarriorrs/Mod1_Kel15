<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // untuk menambah
    public function create()
    {
        return view('admin.add');
    }

    // untuk menyimpan data ke database
    public function store(Request $request)
    {
        $request->validate([
            // 'id_admin' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'username' => 'required|unique:admin,username',
            'password' => 'required',
        ]);
        DB::insert(
            'INSERT INTO admin(
            -- id_admin,
            nama, alamat, username, password) VALUES (
            -- :id_admin, 
            :nama, :alamat, :username, :password)',
            [
                // 'id_admin' => $request->id_admin, //gausah karena id_admin itu auto increment
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'username' => $request->username,
                'password' => $request->password,
            ]
        );

        return redirect()->route('admin.index')->with('success', 'Data Admin berhasil disimpan');
    }
    // untuk menampilkan data dari database

    public function index(Request $request)
    {
        $sort = $request->sort ?? 'id_admin';
        $order = $request->order ?? 'asc';
$datas = Admin::orderBy($request->sort ?? 'id_admin', $request->order ?? 'asc')->get();
        // $datas = DB::table('admin')
        //     ->orderBy($sort, $order)
        //     ->get();

        return view('admin.index', compact('datas'));
    }

    // untuk menampilkan data yang akan di edit
    public function edit($id)
    {
        $data = DB::table('admin')->where('id_admin', $id)->first();

        return view('admin.edit')->with('data', $data);
    }

    // untuk mengupdate data yang sudah di edit
    public function update($id, Request $request)
    {
        $request->validate([
            'id_admin' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);
        DB::update(
            'UPDATE admin SET id_admin = :id_admin, nama = :nama, alamat = :alamat, username = :username, password =:password WHERE id_admin = :id',
            [
                'id' => $id,
                'id_admin' => $request->id_admin,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'username' => $request->username,
                'password' => $request->password,
            ]
        );

        return redirect()->route('admin.index')->with('success', 'Data Admin berhasil diubah');
    }

    // untuk menghapus data dari database
    public function delete($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete(); 

    return redirect()->route('admin.index')->with('success', 'Data Admin masuk ke Trash');
        // DB::delete('DELETE FROM admin WHERE id_admin = :id_admin', ['id_admin' => $id]);

        // return redirect()->route('admin.index')->with('success', 'Data Admin berhasil dihapus');
    }

    // Menampilkan halaman Trash
    public function trash()
    {
        $datas = Admin::onlyTrashed()->get();

        return view('admin.trash', compact('datas'));
    }

    public function restore($id)
{
    $admin = Admin::withTrashed()->findOrFail($id);
    $admin->restore();

    return redirect()->route('admin.trash')->with('success', 'Data Admin berhasil dikembalikan');
}

public function restoreAll()
{
    Admin::onlyTrashed()->restore();
    return redirect()->route('admin.trash')->with('success', 'Semua data berhasil dikembalikan');
}

// Tambah function Hapus Permanen
public function forceDelete($id)
{
    $admin = Admin::withTrashed()->findOrFail($id);
    $admin->forceDelete();

    return redirect()->route('admin.trash')->with('success', 'Data Admin dihapus permanen');
}
}
