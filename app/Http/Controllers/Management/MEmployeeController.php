<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class MEmployeeController extends Controller
{
    public function index()
    {
        $employees = User::where('role_id', '!=', null)->get();
        return view('admin.employee.employee', compact('employees'));
    }

    public function getEmployee($id)
    {
        $employee = User::where('id', '=', $id)->first();
        if ($employee) {
            return response()->json($employee);
        } else {
            return response()->json(['message' => 'Không tìm thấy'], 404);
        }
    }
    public function editEmployee(Request $request)
    {
        $id = $request->only('employee_id');
        $user = User::where('id', $id)->update([
            'name' => $request->input('employee_fullname'),
            'address' => $request->input('employee_address'),
            'gender' => $request->input('employee_gender'),
            'email' => $request->input('employee_email')
        ]);
        return redirect()->back();
    }
    public function searchEmployee($searchTerm)
    {
        $employee = User::where(function ($query) use ($searchTerm) {
            $query->where('name', 'like', '%' . $searchTerm . '%')
                ->orWhere('email', 'like', '%' . $searchTerm . '%')
                ->orWhere('id', 'like', '%' . $searchTerm . '%')
                ->orWhere('address', 'like', '%' . $searchTerm . '%')
                ->orWhere('phone_number', 'like', '%' . $searchTerm . '%');
        })
            ->where('role_id', '!=', null)
            ->get();
        if ($employee->isEmpty()) {
            $employee = User::where('role_id', '!=', null)->get();
            return response()->json($employee);
        }
        return response()->json($employee);
    }
    public function deleteEmployee(Request $request)
    {
        try {
            $employee = User::find($request->deleteEmployeeId);
            if (!$employee) {
                throw new \Exception('Nhân viên không tìm thấy' . $request->deleteBrandID);
            }
            $employee->delete();
            $message = "Xóa thành công " . $employee->brand_id;
            return redirect()->back()->with('mess', $message);
        } catch (\Exception $e) {
            $message = "Xóa không thành công: " . $e->getMessage();
            return redirect()->back()->with('mess', $message);
        }
    }

}
