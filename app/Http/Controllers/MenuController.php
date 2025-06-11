<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::latest()->get();
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.menus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'resep' => 'required|string',
        ]);

        Menu::create($request->only('nama_menu', 'resep', 'tanggal'));
        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil ditambahkan.');
    }
        public function show(Menu $menu)
        {
            return view('admin.menus.show', compact('menu'));
        }

    public function edit(Menu $menu)
    {
        return view('admin.menus.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'resep' => 'required|string',
        ]);

        $menu->update($request->only('nama_menu', 'resep'));
        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil dihapus.');
    }

}
