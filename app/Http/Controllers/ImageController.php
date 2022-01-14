<?php

namespace App\Http\Controllers;

use App\Elemento;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index($elemento_id){
        $images = Image::where('elemento_id',$elemento_id)->paginate(9);
        return view('admin.elemento.images.index',compact('elemento_id','images'));
    }

    public function create($elemento_id){
        return view('admin.elemento.images.create',compact('elemento_id'));
    }

    public function store(Request $request,$elemento_id){
        try {
            if($request->hasFile('images')){
                $files = $request->file('images');
                foreach ($files as $file) {
                    # code...
                    $filename = $file->getFileName().'.'.$file->getClientOriginalExtension();
                    Storage::disk('public')->put( $filename, File::get($file));
                    $image = new Image();
                    $image->elemento_id = $elemento_id;
                    $image->url = $filename;
                    $image->save();
                }
            }
            $output = ['success' => true,
            'msg' => "Imagen subida con exito"];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            $output = ['success' => false,
                    'msg' => "Ocurrio un problema, intentalo mas tarde"];
        }
        return $output;
    }

    public function destroy($id){
        try {
            DB::beginTransaction();
            $image = Image::find($id);
            $image_path = public_path().'/storage/'.$image->url;
            unlink($image_path);
            $image->delete();
            DB::commit();
            $output = ['success' => true,
            'msg' => "Imagen eliminada con exito"
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            $output = ['success' => false,
                    'msg' => "Ocurrio un problema, intentalo mas tarde: "];
        }
        return $output;

    }
}
