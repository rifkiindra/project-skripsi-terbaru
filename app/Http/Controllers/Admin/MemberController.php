<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;


class MemberController extends Controller
{
 public function index(Request $request)
{
    $query = \App\Models\Member::with('user'); // tambahkan relasi user

    // Fitur pencarian
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('nama', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
        });
    }

    // Urutkan: admin dulu, lalu member
    $members = $query->get()->sortBy(function ($member) {
        return $member->user->role === 'admin' ? 1 : 2;
    });

    return view('admin.members.index', compact('members'));
}



    public function create()
    {
        // Menampilkan form tambah anggota
        $memberInstance = Member::getInstance();
        $members = $memberInstance->all();
        $members = Member::all();
        return view('admin.members.index', compact('members'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|unique:members,email',
            'telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'role' => 'required|in:direktur,admin,tim,member',
        ]);

        // Buat akun user terlebih dahulu
        $user = \App\Models\User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt('123'), // Password default
            'role' => 'member', // Role default untuk member
        ]);

        // Ambil instance singleton dari Member
        $memberInstance = Member::getInstance();

        // Buat data member
        $memberInstance->create([
            'user_id' => $user->id, // Relasi ke tabel users
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.members.index')->with('success', 'Member dan akun berhasil ditambahkan!');
    }

    public function show($id)
    {

        // Menampilkan detail anggota
        $memberInstance = Member::getInstance();
        $memberInstance = Member::All();
        $members = $memberInstance->findOrFail($id);
        return view('admin.members.show', compact('members'));
    }

    public function edit($id)
    {
        // Menampilkan form edit anggota
        $memberInstance = Member::getInstance();
        $member = Member::with('user')->findOrFail($id);
        $members = $memberInstance->findOrFail($id);
        return view(
            'admin.members.edit',
            array_merge(compact('members'), ['member' => $members])
        );
    }

    public function update(Request $request, $id)
    {
        $member = Member::with('user')->findOrFail($id);
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email,' . $id,
            'telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'role' => 'required|in:direktur,admin,tim,member',
        ]);

        $member->update([
            'nama'    => $request->nama,
            'telepon' => $request->telepon,
            'alamat'  => $request->alamat,
            'role'    => $request->role,
        ]);

        $member->user->update([
            'name'    => $request->nama,
            'email'   => $request->email,
        ]);

        // Ambil instance dari Member menggunakan singleton
        $memberInstance = Member::getInstance();

        // Cari anggota berdasarkan ID
        $member = $memberInstance->findOrFail($id);

        // Ambil data dari request
        $data = $request->only(['nama', 'email', 'telepon', 'alamat', 'status']);
        $data['user_id'] = $member->user_id; // Atur user_id ke nilai yang sudah ada

        // Update data anggota
        $member->update($data);

        // ✅ UPDATE DATA DI TABEL MEMBERS
        $member->update(['status' => $request->status,]);

        // update role di tabel users
        $member->user->update(['role' => $request->role]);

        return redirect()->route('admin.members.index')->with('success', 'Member updated successfully!');
    }

    public function destroy($id)
    {
        // Ambil instance dari Member menggunakan singleton
        $memberInstance = Member::getInstance();

        // Cari anggota berdasarkan ID
        $member = $memberInstance->findOrFail($id);

        // Hapus user terkait secara manual
        if ($member->user) {
            $member->user()->delete(); // Hapus data user terkait
        }

        // Hapus data anggota
        $member->delete();

        return redirect()->route('admin.members.index')->with('success', 'Member dan user terkait berhasil dihapus!');
    }



    public function toggleStatus($id)
    {
        // Ambil anggota berdasarkan ID
        $memberInstance = Member::getInstance();
        $member = $memberInstance->findOrFail($id);

        return redirect()->route('admin.members.index')
            ->with('success', 'Status anggota berhasil diperbarui.');
    }
}
