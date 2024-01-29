<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Facades\Storage;
use App\Models\ImportCsvData;


class ImportDataController extends Controller
{
    public function importCsvData(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,xlsx|max:500000|',
        ]);

        $file = $request->file('csv_file');
        $folderName = 'csv_file';

        if (!Storage::exists($folderName)) {
            Storage::makeDirectory($folderName);
        }

        $uploadedFilePath = $file->storeAs($folderName, $file->getClientOriginalName(), 'public');
        $filePath = storage_path("app/public/{$uploadedFilePath}");
        // dd($filePath);
        $chunkSize = 5000; // Adjust the chunk size based on your needs

        LazyCollection::make(function () use ($filePath) {
            $file = fopen($filePath, 'r');

            while ($row = fgetcsv($file)) {
                yield $row;
            }

            fclose($file);
        })
        ->skip(1) // Skip header row
        ->chunk($chunkSize)
        ->each(function ($rows) {
            DB::beginTransaction();
            try {
                $transformedRows = $this->transformData($rows->toArray());

                DB::table('csv_files')->insert($transformedRows);

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }
        });

        return redirect()->back()->with('success', 'CSV imported successfully');
    }

    private function transformData($rows)
    {
        $transformedRows = [];

        foreach ($rows as $row) {
            $transformedRows[] = [
                'date' => $row[0],
                'academic_yr' => $row[1],
                'session' => $row[2],
                'alloted_category' => $row[3],
                'voucher_type' => $row[4],
                'voucher_no' => $row[5],
                'roll_no' => $row[6],
                'admno_uniqueId' => $row[7],
                'status' => $row[8],
                'fee_category' => $row[9],
                'faculty' => $row[10],
                'program' => $row[11],
                'department' => $row[12],
                'batch' => $row[13],
                'receipt_no' => $row[14],
                'fee_head' => $row[15],
                'due_amount' => $row[16],
                'paid_amount' => $row[17],
                'concession_amount' => $row[18],
                'scholarship_amount' => $row[19],
                'reverse_concession_amount' => $row[20],
                'write_off_amount' => $row[21],
                'adjusted_amount' => $row[22],
                'refund_amount' => $row[23],
                'fund_transfer_amount' => $row[24],
                'remarks' => $row[25],
            ];
        }

        return $transformedRows;
    }
}
