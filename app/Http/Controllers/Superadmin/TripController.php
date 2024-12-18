<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Imports\TripsImport;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\StockIn;
use Illuminate\Http\Request;

class TripController extends Controller
{
//    public function import(Request $request)
//    {
//        // Validate file input
//        $request->validate([
//            'file' => 'required|mimes:xlsx,csv',
//        ]);
//
//        // Use Excel::import to process the uploaded file
//        Excel::import(new TripsImport(), $request->file('file'));
//
//        return redirect()->route('trip.index')->with('successMsg', 'Trips imported successfully!');
//    }

//    public function import(Request $request)
//    {
//        // Validate file input
//        $request->validate([
//            'file' => 'required|mimes:xlsx,csv',
//        ]);
//
//        // Check if the file is present
//        if ($request->hasFile('file')) {
//            $file = $request->file('file');
//
//            // Check if the file is valid
//            if ($file->isValid()) {
//                // Log file details for debugging
//                \Log::info('File uploaded successfully:', ['file' => $file->getClientOriginalName()]);
//
//                try {
//                    // Use Excel::import to process the uploaded file
//                    Excel::import(new TripsImport(), $file);
//
//                    // Return a success message
//                    return response()->json(['message' => 'Trips imported successfully!']);
//                } catch (\Exception $e) {
//                    // Log any error that happens during import
//                    \Log::error('Error importing trips: ' . $e->getMessage());
//
//                    return response()->json(['message' => 'There was an error importing the trips. Please try again.'], 500);
//                }
//            } else {
//                \Log::error('Uploaded file is not valid.');
//
//                return response()->json(['message' => 'The uploaded file is invalid. Please try again.'], 400);
//            }
//        } else {
//            \Log::error('No file uploaded.');
//
//            return response()->json(['message' => 'No file uploaded. Please try again.'], 400);
//        }
//    }


    public function import(Request $request)
    {
        // Validate file input
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        // Check if the file is present
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // Check if the file is valid
            if ($file->isValid()) {
                // Log file details for debugging
                \Log::info('File uploaded successfully:', ['file' => $file->getClientOriginalName()]);

                try {
                    // Use Excel::import to process the uploaded file
                    Excel::import(new TripsImport(), $file);

                    // Flash success message to session
                    session()->flash('successMsg', 'Trips imported successfully!');

                    // Redirect to the trip index page
                    return redirect()->route('trip.index');
                } catch (\Exception $e) {
                    // Log any error that happens during import
                    \Log::error('Error importing trips: ' . $e->getMessage());

                    // Flash error message to session
                    session()->flash('errorMsg', 'There was an error importing the trips. Please try again.');

                    return redirect()->route('trip.index');
                }
            } else {
                \Log::error('Uploaded file is not valid.');

                // Flash error message to session
                session()->flash('errorMsg', 'The uploaded file is invalid. Please try again.');

                return redirect()->route('trip.index');
            }
        } else {
            \Log::error('No file uploaded.');

            // Flash error message to session
            session()->flash('errorMsg', 'No file uploaded. Please try again.');

            return redirect()->route('trip.index');
        }
    }


}
