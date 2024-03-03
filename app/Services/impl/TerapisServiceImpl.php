<?php

namespace App\Services\impl;

use App\Helpers\File;
use App\Models\Terapis;
use App\Services\TerapisService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TerapisServiceImpl implements TerapisService
{
    function list()
    {
        return  Terapis::all()->filter(function ($terapis) {
            return $terapis->deleted == 0;
        })->values();
    }

    function add(Request $request)
    {
        // validate code 
        $exist_terapis =  Terapis::where('code', $request->code)->where('deleted', 0)->first();
        if($exist_terapis){
            dd("Terapis dengan kode ".$request->code." sudah ada !");     
        }

        // upload foto
        $filename = File::uploadSingleFileV2($request->foto, config('constants.file_folder_terapis'));
        $terapis['nama'] = $request->nama;
        $terapis['foto'] = $filename;
        $terapis['status'] = array_key_first(config('constants.status_terapis'));
        $terapis['is_active'] = true;

        $terapis = Terapis::create($terapis);
        $terapis['code'] = $request->code;
        $terapis['deleted'] = 0;
        $terapis->save();
    }

    public function get(int $id)
    {
        return  Terapis::where('id', $id)->firstOrFail();
    }

    public function delete(int $id)
    {
        $terapis =  Terapis::where('id', $id)->firstOrFail();
        if ($terapis->status == 'PROGRESING' || $terapis->status == 'FINISHING') {
            dd("Terapis masih terpakai");
        }
        if ($terapis->foto != null) {
            $this->deleteFile($terapis->foto);
        }
        $terapis->deleted = 1;
        $terapis->save();
    }

    public function edit(Request $request)
    {
        // get by id
        $terapis =  Terapis::where('id', $request->id)->firstOrFail();

        if ($request->foto != null) {
            $filename = $this->editFile($terapis->foto, $request->foto);
            $terapis->foto = $filename;
        }
        $terapis->nama = $request->nama;
        $terapis->code =  $request->code;
        $terapis->status = $request->status;
        $terapis->is_active = $request->is_active == "on" ? true : false;
        $terapis->save();
    }

    function editFile($oldFile, $newFile)
    {
        // delete old file if exists
        if ($oldFile != null) {
            $this->deleteFile($oldFile);
        }
        return File::uploadSingleFileV2($newFile, config('constants.file_folder_terapis'));
    }
    function deleteFile($file)
    {
        Storage::delete('public' . config('constants.file_folder_terapis') . '/' . $file);
    }
}
