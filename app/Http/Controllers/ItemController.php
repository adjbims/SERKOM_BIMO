<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Dompdf\Dompdf;
use Dompdf\Options;

class ItemController extends Controller
{
    /**
     * Menampilkan daftar semua item. (Ini akan menjadi halaman "SHOW" utama Anda)
     */
   public function index(Request $request)
{
    $query = Item::query();

    if ($request->has('search') && !empty($request->input('search'))) {
        $keyword = $request->input('search');
        $query->where('nama_barang', 'like', "%{$keyword}%")
              ->orWhere('deskrispi', 'like', "%{$keyword}%");
    }

    $items = $query->orderBy('created_at', 'desc')->get();

    return view('inventaris.index', [
        'items' => $items,
        'search' => $request->input('search')
    ]);
}


    /**
     * Menampilkan form untuk membuat item baru.
     */
    public function create()
    {
        return view('inventaris.create');
    }

    /**
     * Menyimpan item baru ke database.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required|string|max:255',
            'deskrispi'   => 'nullable|string',
            'jumlah'      => 'required|integer|min:0',
            'harga'       => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->route('items.create')
                        ->withErrors($validator)
                        ->withInput();
        }

        Item::create($request->only(['nama_barang', 'deskrispi', 'jumlah', 'harga']));

        return redirect()->route('items.index')
                         ->with('success', 'Barang berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit item.
     * Parameter $item akan otomatis di-resolve oleh Laravel (Route Model Binding)
     */
    public function edit(Item $item) // Menggunakan Route Model Binding
    {
        return view('inventaris.edit', ['item' => $item]);
    }

    /**
     * Memperbarui item yang ada di database.
     * Parameter $item akan otomatis di-resolve oleh Laravel (Route Model Binding)
     */
    public function update(Request $request, Item $item) // Menggunakan Route Model Binding
    {
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required|string|max:255',
            'deskrispi'   => 'nullable|string',
            'jumlah'      => 'required|integer|min:0',
            'harga'       => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->route('items.edit', $item->id)
                        ->withErrors($validator)
                        ->withInput();
        }

        $item->update($request->only(['nama_barang', 'deskrispi', 'jumlah', 'harga']));

        return redirect()->route('items.index')
                         ->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy(Item $item) // Menggunakan Route Model Binding
    {
        $item->delete();
        return redirect()->route('items.index')
                         ->with('success', 'Barang berhasil dihapus!');
    }

public function downloadPdf()
{
    $items = Item::orderBy('created_at', 'desc')->get();

    $options = new Options();
    $options->set('defaultFont', 'Courier');

    $dompdf = new Dompdf($options);

    $html = view('inventaris.pdf', compact('items'))->render();

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();

    return $dompdf->stream('items.pdf', ['Attachment' => 1]); // Attachment=1 supaya langsung download
}   
public function show(Item $item) // Menggunakan Route Model Binding
{
    return view('inventaris.show', ['item' => $item]);
}
}