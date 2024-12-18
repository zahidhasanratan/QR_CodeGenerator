<?php

namespace App\Http\Controllers\Superadmin\Driver;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Endroid\QrCode\Builder\Builder;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function index()
//    {
//        $driver = Trip::all();
//        return view('superadmin.Trip.index', compact('driver'));
//    }

    public function index()
    {
        $driver = Trip::all();

        foreach ($driver as $trip) {
            // Check if QR code exists
            if (empty($trip->qrcode) || !file_exists(public_path('qrcode/' . $trip->qrcode))) {
                // Generate VCard string
                $vcard = "BEGIN:VCARD\n";
                $vcard .= "VERSION:3.0\n";
                $vcard .= "FN:{$trip->name}\n";
                $vcard .= "EMAIL:{$trip->email}\n";
                $vcard .= "TEL:{$trip->phone}\n";
                $vcard .= "ORG:{$trip->description}\n";
                $vcard .= "TITLE:{$trip->fare}\n";
                $vcard .= "ADR:;;{$trip->driver};;;;;\n";
                $vcard .= "GENDER:{$trip->gender}\n";
                $vcard .= "END:VCARD";

                // Generate QR Code
                $qrcodePath = public_path('qrcode');
                if (!is_dir($qrcodePath)) {
                    mkdir($qrcodePath, 0755, true);
                }

                $qrcodeFileName = $trip->name . '_' . $trip->id . '.png';
                $result = Builder::create()
                    ->data($vcard)
                    ->size(300)
                    ->build();

                // Save QR Code to the desired path
                $result->saveToFile($qrcodePath . '/' . $qrcodeFileName);

                // Update QR code file name in the database
                $trip->qrcode = $qrcodeFileName;
                $trip->save();
            }
        }
        return view('superadmin.Trip.index', compact('driver'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin.Trip.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
//    public function store(Request $request)
//    {
//        // Validation
//        $this->validate($request, [
//            'name' => 'required',
//        ]);
//
//        // Save trip data
//        $trip = new Trip();
//        $trip->name = $request->name;
//        $trip->email = $request->email;
//        $trip->phone = $request->phone;
//        $trip->driver = $request->driver;
//        $trip->gender = $request->gender;
//        $trip->route = $request->route;
//        $trip->description = $request->description;
//        $trip->fare = $request->fare;
//        $trip->save();
//
//        // Generate VCard string
//        $vcard = "BEGIN:VCARD\n";
//        $vcard .= "VERSION:3.0\n";
//        $vcard .= "FN:{$request->name}\n"; // Full Name
//        $vcard .= "EMAIL:{$request->email}\n"; // Email Address
//        $vcard .= "TEL:{$request->phone}\n"; // Phone Number
//        $vcard .= "ORG:{$request->description}\n"; // Organization
//        $vcard .= "TITLE:{$request->fare}\n"; // Designation/Title
//        $vcard .= "ADR:;;{$request->driver};;;;;\n"; // Country (Address format: PO Box, Extended Address, Street, Locality, Region, Postal Code, Country)
//        $vcard .= "GENDER:{$request->gender}\n"; // Gender
//        $vcard .= "END:VCARD";
//
//        // Generate QR Code
//        $qrcodePath = public_path('qrcode');
//        if (!is_dir($qrcodePath)) {
//            mkdir($qrcodePath, 0755, true);
//        }
//
//        $qrcodeFileName = $trip->name.'_'. $trip->id . '.png';
//        $result = Builder::create()
//            ->data($vcard)
//            ->size(300)
//            ->build();
//
//        // Save QR Code to the desired path
//        $result->saveToFile($qrcodePath . '/' . $qrcodeFileName);
//
//        return redirect()->route('trip.index')->with('successMsg', 'Trip Successfully Saved with QR Code');
//    }

    public function store(Request $request)
    {
        // Validation
        $this->validate($request, [
            'name' => 'required',
        ]);

        // Save trip data
        $trip = new Trip();
        $trip->name = $request->name;
        $trip->email = $request->email;
        $trip->phone = $request->phone;
        $trip->driver = $request->driver;
        $trip->gender = $request->gender;
        $trip->route = $request->route;
        $trip->description = $request->description;
        $trip->fare = $request->fare;
        $trip->save(); // Save first to get the `id`

        // Generate VCard string
        $vcard = "BEGIN:VCARD\n";
        $vcard .= "VERSION:3.0\n";
        $vcard .= "FN:{$request->name}\n";
        $vcard .= "EMAIL:{$request->email}\n";
        $vcard .= "TEL:{$request->phone}\n";
        $vcard .= "ORG:{$request->description}\n";
        $vcard .= "TITLE:{$request->fare}\n";
        $vcard .= "ADR:;;{$request->driver};;;;;\n";
        $vcard .= "GENDER:{$request->gender}\n";
        $vcard .= "END:VCARD";

        // Generate QR Code
        $qrcodePath = public_path('qrcode');
        if (!is_dir($qrcodePath)) {
            mkdir($qrcodePath, 0755, true);
        }

        $qrcodeFileName = $trip->name . '_' . $trip->id . '.png';
        $result = Builder::create()
            ->data($vcard)
            ->size(300)
            ->build();

        // Save QR Code to the desired path
        $result->saveToFile($qrcodePath . '/' . $qrcodeFileName);

        // Update QR code file name in database
        $trip->qrcode = $qrcodeFileName;
        $trip->save();

        return redirect()->route('trip.index')->with('successMsg', 'Participant Successfully Saved with QR Code');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unit =   Trip::find($id);
        return view('superadmin.Trip.show',compact('unit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unit =   Trip::find($id);
        return view('superadmin.Trip.edit',compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validation rules based on the form inputs
        $this->validate($request, [
            'name' => 'required|string|max:255',
        ]);

        // Retrieve the trip record
        $trip = Trip::findOrFail($id);

        // Update fields based on form inputs
        $trip->name = $request->name; // Participant Name
        $trip->email = $request->email; // Email
        $trip->phone = $request->phone; // Phone
        $trip->driver = $request->driver; // Country (driver field)
        $trip->gender = $request->gender; // Gender
        $trip->description = $request->description; // Organization
        $trip->fare = $request->fare; // Designation
        $trip->route = $request->route; // Category

        // Save updated trip
        $trip->save();

        // Generate VCard string
        $vcard = "BEGIN:VCARD\n";
        $vcard .= "VERSION:3.0\n";
        $vcard .= "FN:{$request->name}\n";
        $vcard .= "EMAIL:{$request->email}\n";
        $vcard .= "TEL:{$request->phone}\n";
        $vcard .= "ORG:{$request->description}\n";
        $vcard .= "TITLE:{$request->fare}\n";
        $vcard .= "ADR:;;{$request->driver};;;;;\n";
        $vcard .= "GENDER:{$request->gender}\n";
        $vcard .= "END:VCARD";

        // Generate QR Code
        $qrcodePath = public_path('qrcode');
        if (!is_dir($qrcodePath)) {
            mkdir($qrcodePath, 0755, true);
        }

        $qrcodeFileName = $trip->name . '_' . $trip->id . '.png';
        $result = Builder::create()
            ->data($vcard)
            ->size(300)
            ->build();

        // Save QR Code to the desired path
        $result->saveToFile($qrcodePath . '/' . $qrcodeFileName);

        // Update QR code file name in the database
        $trip->qrcode = $qrcodeFileName;
        $trip->save();

        // Redirect back with success message
        return redirect()->route('trip.index')->with('successMsg', 'Participant Successfully Updated with QR Code');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function destroy($id)
//    {
//        $unitlist = Trip::find($id);
//        $unitlist->delete();
//        return redirect()->back()->with('dangerMsg','Trip Successfully Deleted');
//    }
    public function destroy($id)
    {
        // Find the trip record by ID
        $unitlist = Trip::find($id);

        if ($unitlist) {
            // Define the full path to the QR code file
            $qrcodePath = public_path('qrcode/' . $unitlist->qrcode);

            // Check if the QR code file exists and delete it
            if (file_exists($qrcodePath)) {
                unlink($qrcodePath); // Delete the file
            }

            // Delete the trip record from the database
            $unitlist->delete();

            // Redirect back with a success message
            return redirect()->back()->with('dangerMsg', 'QR code successfully deleted');
        } else {
            // If the trip does not exist, return an error message
            return redirect()->back()->with('errorMsg', 'QR Code not found');
        }
    }


}
