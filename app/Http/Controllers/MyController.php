<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;

use App\Exports\chidoanExport;
use App\Imports\chidoanImport;

use App\Exports\dantocExport;
use App\Imports\dantocImport;

use App\Exports\doanvienExport;
use App\Imports\doanvienImport;
class MyController extends Controller
{
    //
    public function importExportView()
	{
		return view('import');
	}
	public function export() 
	{
		return Excel::download(new chidoanExport, 'chidoan.xlsx');
	}
	public function import() 
	{
		Excel::import(new chidoanImport,request()->file('file'));

		return back();
	}
	public function mau()
    {
        $file= public_path(). "/mau_excel/mauchidoan.xlsx";
 
        $headers = array(
                  'Content-Type: chidoan/xls',
                );

        return Response::download($file, 'mauchidoan.xlsx', $headers);
    }



	 public function importExportViewdt()
	{
		return view('importdt');
	}
	public function exportdt() 
	{
		return Excel::download(new dantocExport, 'dantoc.xlsx');
	}
	public function importdt() 
	{
		Excel::import(new dantocImport,request()->file('file'));

		return back();
	}
	public function maudt()
    {
        $file= public_path(). "/mau_excel/maudantoc.xlsx";
 
        $headers = array(
                  'Content-Type: dantoc/xls',
                );

        return Response::download($file, 'maudantoc.xlsx', $headers);
    }


	 public function importExportViewdv()
	{
		return view('importdv');
	}
	public function exportdv() 
	{
		return Excel::download(new doanvienExport, 'doanvien.xlsx');
	}
	public function importdv() 
	{
		Excel::import(new doanvienImport,request()->file('file'));

		return back();
	}
	public function maudv()
    {
        $file= public_path(). "/mau_excel/maudoanvien.xlsx";
 
        $headers = array(
                  'Content-Type: doanvien/xls',
                );

        return Response::download($file, 'maudoanvien.xlsx', $headers);
    }
}
