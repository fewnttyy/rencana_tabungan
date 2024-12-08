<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TabunganModel;
use App\Models\MenabungModel;

class TabunganController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'judul_tabungan' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'target_nominal' => 'required|numeric|min:1',
            'target_tanggal' => 'required|date|after_or_equal:today',
            'status' => 'required|string',
        ]);

        $file = $request->file('foto');
        $fotoPath = 'tabungan/' . time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('tabungan'), $fotoPath);

        // Ambil id_user dari session
        $id_user = session('id_user');

        TabunganModel::create([
            'id_user' => $id_user,
            'judul_tabungan' => $request->judul_tabungan,
            'foto' => $fotoPath,
            'target_nominal' => $request->target_nominal,
            'target_tanggal' => $request->target_tanggal,
            'nominal' => 0,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Tabungan berhasil ditambahkan!');
    }

    public function getTabungan()
    {
        $id_user = session('id_user');

        if (!$id_user) {
            return redirect()->route('login.form')->with('error', 'Anda harus login terlebih dahulu.');
        }

        $tabungan = TabunganModel::where('id_user', $id_user)
        ->orderBy('updated_at', 'desc')
        ->get();

        $tabungan_status = TabunganModel::where('status', 'Belum Tercapai')
        ->where('id_user', $id_user)
        ->get();

        $total_tabungan = TabunganModel::where('id_user', $id_user)->count();

        $total_menabung = MenabungModel::whereHas('tabungan', function ($query) use ($id_user) {
            $query->where('id_user', $id_user);
        })->sum('nominal');

        $total_tercapai = TabunganModel::where('id_user', $id_user)
            ->where('status', 'Tercapai')
            ->count();

        return view('index', compact('tabungan', 'tabungan_status', 'total_tabungan', 'total_menabung', 'total_tercapai'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_tabungan' => 'required|string|max:255',
            'target_tanggal' => 'required|date',
            'target_nominal' => 'required|numeric',
            'nominal' => 'required|numeric',
            'status' => 'required|string',
        ]);

        $tabungan = TabunganModel::findOrFail($id);

        $remaining_nominal = $tabungan->target_nominal - $tabungan->nominal;

        if ($request->nominal > $request->target_nominal) {
            return back()->with('error', 'Nominal yang dapat diinputkan maksimal sebesar ' . $remaining_nominal);
        }

        $tabungan->judul_tabungan = $request->judul_tabungan;
        $tabungan->target_tanggal = $request->target_tanggal;
        $tabungan->target_nominal = $request->target_nominal;

        if ($tabungan->nominal == $tabungan->target_nominal) {
            $tabungan->status = 'Tercapai';
        } elseif ($tabungan->nominal < $tabungan->target_nominal) {
            $tabungan->status = 'Belum Tercapai';
        }

        $tabungan->save();

        return back()->with('success', 'Data tabungan berhasil diperbarui!');
    }

    public function menabung(Request $request)
    {
        $request->validate([
            'id_tabungan' => 'required|exists:tabungan,id_tabungan',
            'nominal' => 'required|numeric|min:1',
            'tanggal_menabung' => 'required|date',
        ]);

        $tabungan = TabunganModel::findOrFail($request->id_tabungan);

        $remaining_nominal = $tabungan->target_nominal - $tabungan->nominal;

        if ($request->nominal > $remaining_nominal) {
            return back()->with('error', 'Nominal yang dapat diinputkan maksimal sebesar ' . $remaining_nominal);
        }

        $tabungan->nominal += $request->nominal;

        if ($tabungan->nominal == $tabungan->target_nominal) {
            $tabungan->status = 'Tercapai';
        }

        $tabungan->save();

        $id_user = session('id_user');

        MenabungModel::create([
            'id_user' => $id_user,
            'id_tabungan' => $tabungan->id_tabungan,
            'nominal' => $request->nominal,
            'tanggal_menabung' => $request->tanggal_menabung,
        ]);

        return back()->with('success', 'Berhasil menabung!');
    }

    public function detail($id_tabungan)
    {
        $tabungan_detail = TabunganModel::findOrFail($id_tabungan);

        $menabung = MenabungModel::where('id_tabungan', $id_tabungan)
        ->orderBy('created_at', 'desc')
        ->get();

        $id_user = session('id_user');

        if (!$id_user) {
            return redirect()->route('login.form')->with('error', 'Anda harus login terlebih dahulu.');
        }

        $tabungan = TabunganModel::where('id_user', $id_user)->get();

        $tabungan_status = TabunganModel::where('status', 'Belum Tercapai')
        ->where('id_user', $id_user)
        ->get();

        return view('tabungan_detail', compact('tabungan', 'menabung', 'tabungan_status', 'tabungan_detail'));
    }

    public function deleteMenabung($id_menabung)
    {
        $menabung = MenabungModel::findOrFail($id_menabung);

        $tabungan = TabunganModel::findOrFail($menabung->id_tabungan);

        $tabungan->nominal -= $menabung->nominal;

        if ($tabungan->nominal < $tabungan->target_nominal) {
            $tabungan->status = 'Belum Tercapai';
        }

        $tabungan->save();

        $menabung->delete();

        return redirect()->back()->with('success', 'Data menabung berhasil dihapus dan tabungan diperbarui.');
    }

    public function deleteTabungan($id_tabungan)
    {
        $tabungan = TabunganModel::findOrFail($id_tabungan);

        $tabungan->menabung()->delete();

        $tabungan->delete();

        return redirect()->back()->with('success', 'Data tabungan dan riwayat menabung berhasil dihapus.');
    }

}