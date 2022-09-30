<?php

namespace App\Http\Controllers;

use App\Models\SaveFile;
use App\Http\Requests\StoreSaveFileRequest;
use App\Http\Requests\UpdateSaveFileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaveFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_file = DB::table('save_files')->whereNull('deleted_at')->get();
        return view(
            'savefile/file.saveFile',compact('list_file')
        );
    }

    public function add()
    {
        return view('savefile/file.addSaveFile');
    }

    public function history()
    {
         return view('savefile/file.logAddFile');
    }

    public function historydelete()
    {
        return view('savefile/file.logDeleteFile');
    }

    public function indeximg()
    {
        $list_img = DB::table('save_img')->whereNull('deleted_at')->get();

        return view(
            'savefile/filegambar.saveFileGambar',compact('list_img'));
    }
    public function downloadfile($id)
    {
        $list_file = DB::table('save_files')->where('id',$id)->first('file');
        // dd($list_file);
        return response()->download(public_path("file/app_admin/{$list_file->file}"));

    }

    public function viewimg($id)
    {
        $list_img = DB::table('save_img')->where('id',$id)->first();
        return view(
            'savefile/filegambar.viewGambar',compact('list_img')
        );
    }

    public function addimg()
    {
        return view('savefile/filegambar.addSaveFileGambar');
    }

    public function historyimg()
    {
        return view('savefile/filegambar.logAddFileGambar');
    }

    public function historydeleteimg()
    {
        return view('savefile/filegambar.logDeleteFileGambar');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSaveFileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSaveFileRequest $request)
    {
        // dd($request);
        Request()->validate([
            'name' => 'required',
            'file',
        ]);

        $filename = "";
        if (Request()->hasFile('file')) {
            if (Request()->file('file')) {
                $file = Request()->file('file');
                $filename = date('YmdHi').'_'.$file->getClientOriginalName();
                $file->move(public_path('file/app_admin/'), $filename);
            }
        }
        // dd($filename);
        DB::table('save_files')->insert([
            'name' => Request()->name,
            'file' => $filename,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::commit();
        return redirect('/save-file')->with("create_success", "File Berhasil Ditambah");
    }

    public function storeimg(Request $request)
    {
        Request()->validate([
            'name' => 'required',
            'file_img',
        ]);

        $filename = "";
        if (Request()->hasFile('file_img')) {
            if (Request()->file('file_img')) {
                $file = Request()->file('file_img');
                $filename = date('YmdHi').'_'.$file->getClientOriginalName();
                $file->move(public_path('images/app_admin/'), $filename);
            }
        }
        // dd($filename);
        DB::table('save_img')->insert([
            'name' => Request()->name,
            'file' => $filename,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::commit();
        return redirect('/save-file-gambar')->with("create_success", "File Berhasil Ditambah");
    }

    public function deleteimg($id)
    {
        DB::table('save_img')
        ->where('id', '=', $id)
        ->update([
            "deleted_at" => 1
        ]);
        DB::commit();
        return redirect('/save-file-gambar')->with("create_success", "File Berhasil Dihapus");
    }

    public function deletefile($id)
    {
        DB::beginTransaction();

        DB::table('save_files')
            ->where('id', '=', $id)
            ->update([
                "deleted_at" => 1
            ]);
            DB::commit();
        return redirect('/save-file')->with("create_success", "File Berhasil Dihapus");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SaveFile  $saveFile
     * @return \Illuminate\Http\Response
     */
    public function show(SaveFile $saveFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SaveFile  $saveFile
     * @return \Illuminate\Http\Response
     */
    public function edit(SaveFile $saveFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSaveFileRequest  $request
     * @param  \App\Models\SaveFile  $saveFile
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSaveFileRequest $request, SaveFile $saveFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SaveFile  $saveFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(SaveFile $saveFile)
    {
        //
    }
}
