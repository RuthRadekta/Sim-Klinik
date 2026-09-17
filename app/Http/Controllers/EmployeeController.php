<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('admin.employees.index', compact('employees'));
    }

    public function create()
    {
        return view('admin.employees.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required',
            'position' => 'required'
        ]);
        
        // 1. PASTIKAN MASUK KE TABEL EMPLOYEES DULU
        Employee::create([
            'name' => $request->name,
            'position' => $request->position,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        
        // 2. Jika jabatannya Resepsionis, buatkan juga akun di TABEL USERS
        if ($request->position == 'Resepsionis' && $request->email && $request->password) {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => \Illuminate\Support\Facades\Hash::make($request->password),
                'role' => 'resepsionis',
            ]);
        }
        
        return redirect('/admin/employees')->with('success', 'Karyawan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('admin.employees.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['name' => 'required', 'position' => 'required']);
        
        $employee = Employee::findOrFail($id);
        $employee->update($request->all()); // Memperbarui data yang diubah
        
        return redirect('/admin/employees');
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        
        return redirect('/admin/employees');
    }
}