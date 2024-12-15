<?php

namespace App\Http\Controllers;

use App\Imports\SondsImport;
use App\Imports\SondsImport2;
use App\Models\Song;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $songs = Song::all();
        return view('dashboard.songs.index', compact('songs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function import(Request $request)
    {
        Excel::import(new SondsImport, $request->file('file'));
        
        return redirect()->route('songs.index');
    }


    public function import2(Request $request)
    {
        $file = $request->file('file');    //fetch file 
        $filePath = $file->store('fileSong_excel');     //save it in storege
        $data = Excel::toArray(new SondsImport2, $file);     //foemat it to array

        $colums = array_keys($data[0][0]);    //page one 
        $db_fields = ['name', 'singer', 'year'];     //name of our colums from database

        $request->session()->put('file_excel_import', $filePath);     //fetch file from storage to session

        return view('dashboard.songs.select-colums', compact('db_fields', 'colums'));
        //return to page with page and name of colums 
    }


    public function store(Request $request)
    {
        $fields = $request->input('fields');  //returned from selection in blade
        $filePath = session('file_excel_import'); //retrive session
        $file = storage_path('app/public/' . $filePath); //retrieve file 

        $data = Excel::toArray(new SondsImport2, $file)[0];   //retrive data by page one

        foreach ($data as $row) {

            $data_insert = [];
            foreach ($fields as $excel_field => $db_value) {
               
                $data_insert[$db_value] = $row[$excel_field];
            }

            Song::create($data_insert);

        }

        return redirect()->route('songs.index');


    }
}
