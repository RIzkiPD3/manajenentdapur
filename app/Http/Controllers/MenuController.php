<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        return Menu::latest()->get(); // untuk debugging JSON
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'nama_menu' => 'required|string|max:255',
            'resep' => 'required|string'
        ]);

        $menu = Menu::create($validated);
        return response()->json($menu, 201);
    }

    public function edit(Menu $menu)
    {
        return response()->json($menu);
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'nama_menu' => 'required|string|max:255',
            'resep' => 'required|string'
        ]);

        $menu->update($validated);
        return response()->json($menu);
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return response()->json(['message' => 'Menu deleted']);
    }
}
