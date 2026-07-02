<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function uploadContract(Request $request, $employeeId)
{
    // 1. Validate the incoming request
    // Ensures the user actually uploaded a PDF under 2MB.
    $request->validate([
        'contract_document' => 'required|file|mimes:pdf|max:2048',
    ]);

    // 2. Find the employee you are attaching this contract to
    $employee = Employee::findOrFail($employeeId);

    // 3. Handle the file upload
    if ($request->hasFile('contract_document')) {
        
        // Laravel automatically generates a unique hash for the filename.
        // It will save the file to: storage/app/public/contracts/
        $path = $request->file('contract_document')->store('contracts', 'public');

        // 4. Save the path to the database
        // $path will look something like: "contracts/XyZ123...pdf"
        $employee->contract_path = $path;
        $employee->save();
    }

    // 5. Return success
    return redirect()->back()->with('success', 'Contract uploaded successfully!');
}
}
