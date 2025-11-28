<?php

namespace App\Http\Controllers;

use App\Imports\CibestImport;
use App\Models\CibestForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CibestFormController extends Controller
{
    public function uploadCibest(Request $request)
    {
        // dd($request);
        $request->validate([
            'file' => [
                'required',
                'mimes:xlsx,xls,csv',
                'max:5120' // maksimal 5MB
            ]
        ]);

        $file = $request->file('file');
        $import = new CibestImport();
        $import->import($file);

        if ($import->failures()->isNotEmpty()) {
            $errors = [];
            foreach ($import->failures() as $failure) {
                $errors[] = [
                    'row' => $failure->row(),
                    'attribute' => $import->mapping($failure->attribute()),
                    'error' => collect($failure->errors())->map(function ($err) {
                        $clean = preg_replace('/^\d+\s*/', '', $err);
                        return ucfirst($clean);
                    })->join(', '),
                    'value' => ($failure->values())[$failure->attribute()]
                ];
            }

            return redirect()->back()->with([
                'importError' => $errors,
                'error' => "Gagal menambahkan data dari file {$file->getClientOriginalName()}"
            ]);
        }

        foreach ($import->data as $row) {
            CibestForm::create([
                ...$row,
                'user_id' => Auth::user()->id,
            ]);
        }

        return redirect()->back()->with('success', "Berhasil upload file {$file->getClientOriginalName()}");
    }
}
