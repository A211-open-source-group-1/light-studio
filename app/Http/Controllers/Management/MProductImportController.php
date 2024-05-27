<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\ImportReceipt;
use App\Models\ImportReceiptDetails;
use App\Models\PhoneDetails;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;

class MProductImportController extends Controller
{
    public function index()
    {
        $receiptsType1 = ImportReceipt::select(['import_receipts.*', 'users.name'])
            ->join('users', 'users.id', '=', 'import_receipts.user_id')
            ->where('import_receipts.receipt_status', '=', 'temp')
            ->withSum('ImportReceiptDetails', 'total_price')
            ->orderBy('import_receipts.created_at', 'desc')
            ->get();
        $receiptsType2 = ImportReceipt::select(['import_receipts.*', 'users.name'])
            ->withSum('ImportReceiptDetails', 'total_price')
            ->join('users', 'users.id', '=', 'import_receipts.user_id')
            ->where('import_receipts.receipt_status', '=', 'saved')
            ->orderBy('import_receipts.created_at', 'desc')
            ->get();
        $receiptsType4 = ImportReceipt::select(['import_receipts.*', 'users.name'])
            ->withSum('ImportReceiptDetails', 'total_price')
            ->join('users', 'users.id', '=', 'import_receipts.user_id')
            ->orderBy('import_receipts.created_at', 'desc')
            ->get();
        // return response()->json([$receiptsType1, $receiptsType2, $receiptsType3, $receiptsType4]);
        return view('admin.productimport.index', compact('receiptsType1', 'receiptsType2', 'receiptsType4'));
    }

    public function setCompletedImportReceipts(Request $request)
    {

    }

    public function getAllDetailsList()
    {
        $details = PhoneDetails::select('*')
            ->join('phones', 'phones.phone_id', '=', 'phone_details.phone_id')
            ->join('phone_specifics', 'phone_details.specific_id', '=', 'phone_specifics.specific_id')
            ->join('phone_colors', 'phone_details.color_id', '=', 'phone_colors.color_id')
            ->get();
        return response()->json($details);
    }

    public function addImportReceiptSubmit(Request $request)
    {
        $newImportReceipt = new ImportReceipt();
        $newImportReceipt->provider_name = $request->provider_name;
        $newImportReceipt->contact_name = $request->contact_name;
        $newImportReceipt->phone_number = $request->phone_number;
        $newImportReceipt->receipt_status = $request->receipt_status;
        $newImportReceipt->payment_status = $request->payment_status;
        $newImportReceipt->user_id = Auth::user()->id;
        $newImportReceipt->save();
        for ($i = 0; $i < count($request->input('details_id')); $i++) {
            $newImportReceiptDetails = new ImportReceiptDetails();
            $newImportReceiptDetails->import_receipt_id = $newImportReceipt->id;
            $newImportReceiptDetails->phone_details_id = $request->input('details_id')[$i];
            $newImportReceiptDetails->import_quantity = $request->input('import_quantity')[$i];
            $newImportReceiptDetails->import_price = $request->input('price')[$i];
            $newImportReceiptDetails->unit_name = $request->input('unit_name')[$i];
            $newImportReceiptDetails->total_price = $newImportReceiptDetails->import_quantity * $newImportReceiptDetails->price;
            $newImportReceiptDetails->save();
        }
        return redirect()->back();
    }

    public function printImportReceiptPdf($receipt_id)
    {
        $receipt = ImportReceipt::select(['import_receipts.*', 'users.name'])
            ->join('users', 'users.id', '=', 'import_receipts.user_id')
            ->where('import_receipts.id', '=', $receipt_id)
            ->first();
        $details = ImportReceiptDetails::
            join('phone_details', 'phone_details.phone_details_id', '=', 'import_receipts_details.phone_details_id')
            ->join('phones', 'phone_details.phone_id', '=', 'phones.phone_id')
            ->join('phone_colors', 'phone_details.color_id', '=', 'phone_colors.color_id')
            ->join('phone_specifics', 'phone_details.specific_id', '=', 'phone_specifics.specific_id')
            ->where('import_receipts_details.import_receipt_id', '=', $receipt->id)
            ->get();
        $timestamp = strtotime($receipt->created_at);
        $day = date('d', $timestamp);
        $month = date('m', $timestamp);
        $year = date('y', $timestamp);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('admin.productimport.pdfPrintingTemplate', compact('receipt', 'details', 'day', 'month', 'year'));
        return $pdf->stream();
    }

    public function downloadImportReceiptPdf($receipt_id)
    {
        $receipt = ImportReceipt::where('id', '=', $receipt_id)
            ->first();
        $details = $receipt->ImportReceiptDetails()
            ->get();
        $timestamp = strtotime($receipt->created_at);
        $day = date('d', $timestamp);
        $month = date('m', $timestamp);
        $year = date('y', $timestamp);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('admin.productimport.pdfPrintingTemplate', compact('receipt', 'details', 'day', 'month', 'year'));
        return $pdf->download();
    }
}
