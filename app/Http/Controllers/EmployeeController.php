<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //Menampilkan seluruh data employees
    public function index()
    {
        $employees = Employee::all();

        //Jika data kosong
        if($employees->isEmpty()){
           $data =[
            'message' => 'Data Is Empty',
           ];

           return response()->json($data, 200);
        }

        //Jika data ditemukan
        $data = [
            'message' => 'Get All Resource',
            'data' => $employees
        ];

        return response()->json($data, 200);

    }

    //Menambahkan data employees
    public function store (Request $request){
        
        //Validasi data
        $validatedata = $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
            'email' => 'required|email',
            'status' => 'required',
            'hired_on' => 'required|date'
        ]);

        $employee = Employee::create($validatedata);
        
        $data = [
            'message' => 'Resource Is Added Successfully',
            'data' => $employee,
        ];

        return response()->json($data, 201);
    }

    //Menampilkan detail
    public function show ($id){
        $employees = Employee::find($id);

        if(!$employees){
            $data = [
                'message' => 'Resource Not Found',
            ];

            return response()->json($data, 404);
        
        }    

        $data = [
            'message' => 'Get Detail Resource',
            'data' => $employees
        ];

        return response()->json($data, 200);
    }

    //Update Resource
    public function update (Request $request, $id){
        $employees = Employee::find($id);

        if(!$employees){
            $data = [
                'message' => 'Resource Not Found',
            ];

            return response()->json($data, 404);
        }

        $employees->update([
            'name' => $request->name ?? $employees->name,
            'gender' => $request->gender ?? $employees->gender,
            'phone' => $request->phone ?? $employees->phone,
            'address' => $request->address ?? $employees->address,
            'email' => $request->email ?? $employees->email,
            'status' => $request->status ?? $employees->status,
            'hired_on' => $request->hired_on ?? $employees->hired_on
        ]);

        $data = [
            'message' => 'Resource Is Update Succesfully',
            'data' => $employees
        ];
            return response()->json($data, 200);
    }

    //menghapus data
    public function destroy($id){
        $employees = Employee::find($id);

        if(!$employees){
            $data = [
                'message' => 'Resource not found'
            ];

            return response()->json($data, 404);
        }

        $employees->delete();

        $data = [
            'message' => 'Resource is deleted succesfully',
            'data' => $employees
        ];

        return response()->json($data, 200);
    }

    //Mencari data
    public function search(string $name){
        $employee = Employee::where('name', 'like', "%{$name}%")->get();

        if(!$employee){
            $data = [
                'message' => 'Resource Not Found',
            ];

            return response()->json($data, 404);
        } else {
            
            $data = [
            'message' => 'Get Searched Resource',
            'data' => $employee
            ];

        return response()->json($data, 200);

        }
    }

    //Mendapatkan resource yang aktif
    public function active(){
        $employees = Employee::where('status', 'active')->get();

        //Menampilkan total resource aktif
        $total = Employee::where('status', 'active')->count();

        $data = [
            'message' => 'Get Active Resource',
            'total' => $total,
            'data' => $employees
        ];

        return response()->json($data, 200);
    }

    //Mendapatkan resource yang inaktif
    public function inactive(){
        $employees = Employee::where('status', 'inactive')->get();

        //Menampilkan total resource inaktif
        $total = Employee::where('status', 'inactive')->count();

        $data = [
            'message' => 'Get Inactive Resource',
            'total' => $total,
            'data' => $employees
        ];

        return response()->json($data, 200);
    }

    //Mendapatkan resource yang terminated
    public function terminated(){
        $employees = Employee::where('status', 'terminated')->get();

        //Menampilkan total resource terminated
        $total = Employee::where('status', 'terminated')->count();

        $data = [
            'message' => 'Get Terminated Resource',
            'total' => $total,
            'data' => $employees
        ];

        return response()->json($data, 200);
    }
}
