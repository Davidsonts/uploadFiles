<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Flash;
use Response;
use App\Upload;
use Illuminate\Support\Facades\Storage;

class UploadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input = $request->all();

        // UPLOAD
        if ($request->hasFile('fileToUpload')){

            //Validate the uploaded file
            $Validation = $request->validate([
                'fileToUpload' => 'required|file|mimes:png,jpg,jpeg|max:30000'
            ]);

            // cache the file
            $file = $Validation['fileToUpload'];

            // generate a new filename. getClientOriginalExtension() for the file extension
            $filename = 'Imgs-' . time() . '.' . $file->getClientOriginalExtension();

            // save to storage/app/Imgstructure as the new $filename
            $ImgFileName = $file->storeAs('uploads', $filename, 'archive');

            $input['fileToUpload'] = $filename;
        }else{
            $input['fileToUpload'] = 'ZERO';
        }


        // UPLOAD END
        $upload = new Upload();
        $upload->fileToUpload = $input['fileToUpload'];

        if($input['fileToUpload'] !== 'ZERO' && $upload->save()){

            $up = Upload::findOrFail($upload->id);

            return response()
                ->json(['id' => $up->id, 'name' => url('/') . '/storage/uploads/' . $up->fileToUpload])
                ->withCallback($request->input('callback'));

        }

        // Flash::success('Upload saved successfully.');
        //return redirect(route('api'));


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
