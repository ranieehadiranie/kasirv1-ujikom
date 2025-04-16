<?php
namespace App\Http\Controllers;

use App\Models\PetugasRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class PetugasRequestController extends Controller
{
    // Menampilkan daftar pendaftaran petugas
    public function index()
    {
        $users = User::all();
        return view('admin.auth.index', compact('users'));
    }

    public function create()
    {
        return view('admin.auth.create');
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|string'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('petugas-requests.index')->with('success', 'User berhasil ditambahkan');
    }


    public function edit($id)
    {
        $users = User::findOrFail($id);
        return view('admin.auth.edit', compact('users'));
    }
    
    public function update(Request $request, $id)
    {
        $users = User::findOrFail($id);
    
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required'
        ]);
    
        $users->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);
    
        return redirect()->route('petugas-requests.index')->with('success', 'User berhasil diupdate.');
    }
    
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    
        return redirect()->route('petugas-requests.index')->with('success', 'User berhasil dihapus.');
    }
    
    // Menyetujui pendaftaran petugas
    public function approve($id)
    {
        $request = PetugasRequest::findOrFail($id);

        // Pindahkan data ke tabel users
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'petugas',
        ]);

        // Hapus data dari tabel petugas_requests
        $request->delete();

        return redirect()->back()->with('success', 'Pendaftaran petugas berhasil disetujui.');
    }

    // Menolak pendaftaran petugas
    public function reject($id)
    {
        $request = PetugasRequest::findOrFail($id);
        $request->delete();

        return redirect()->back()->with('success', 'Pendaftaran petugas berhasil ditolak.');
    }


    public function datatable()
    {
        $users = User::all();

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $id = $row->id;

                // Tombol aksi: Detail, Edit, Hapus
                $data = '
                 <div class="d-flex flex-wrap gap-2">
                    
                    <a class="btn btn-sm btn-warning btn-icon edit-produk" data-id="' . $id . '" href="' . route('produk.edit', $id) . '">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <form action="' . route('produk.destroy', $id) . '" method="POST" style="display:inline-block;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-sm btn-danger btn-icon delete-produk" onclick="return confirm(\'Apakah Anda yakin ingin menghapus produk ini?\')">
                            <i class="fa fa-trash"></i>
                        </button>
                     </form>
                     
                 </div>';

                return $data;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}