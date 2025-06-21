<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.menus.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sesi' => 'required|string|in:pagi,siang,malam',
        ]);

        Menu::create([
            'nama_menu' => $validated['name'],
            'sesi' => $validated['sesi'],
            'tanggal' => now()->format('Y-m-d'),
        ]);

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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sesi' => 'required|string|in:pagi,siang,malam',
        ]);

        $menu->update([
            'nama_menu' => $validated['name'],
            'sesi' => $validated['sesi'],
            'tanggal' => $menu->tanggal ?? now()->format('Y-m-d'),
        ]);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil dihapus.');
    }
}