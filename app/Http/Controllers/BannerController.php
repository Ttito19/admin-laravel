<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
class BannerController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('banners.index');
    }
    public function fechtBanners()
    {
        $banner = Banner::all();

        return datatables()->of($banner)->addColumn('action', function ($row) {
            $html = '<a data-id="' . $row->id . '" id="btn-edit"  data-toggle="modal" data-target="#editBanners" ><i class="fas fa-edit"></i></a> ';
            $html .= '<a data-id="' . $row->id . '" id="btn-delete"     ><i class="fas fa-trash text-danger"></i> </a></a>';
            return $html;
        })->toJson();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
        $validator = Validator::make($request->All(), [
            'txtname' => 'required|max:50',
            'txtimage' => 'required|image|mimes:jpeg,png,svg|max:1024',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator
                // 'errors' => $validator->message()
            ]);
        } else {
            $brands = new Banner;
            $brands->name = $request->input('txtname');
            if ($request->hasFile('txtimage')) {
                $file = $request->file('txtimage');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/banners/', $filename);
                $brands->image = $filename;
            }
            $brands->save();
            return response()->json([
                'status' => 200,
                'message' => 'Banner agregado correctamente',
            ]);
        }
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = Banner::find($id);
        if ($banner) {
            return response()->json([
                'status' => 200,
                'banner' => $banner
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'banner not found'
            ]);
        }
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
        $banner = Banner::find($id);

        if ($banner) {
            $banner->name = $request->input('txtname');
            if ($request->hasFile('txtimage')) {
                $path = 'uploads/banners/' . $banner->image;
                if (File::exists($path)) {
                    File::delete($path);
                }

                $file = $request->file('txtimage');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/banners/', $filename);
                $banner->image = $filename;
            }
            $banner->save();
            return response()->json([
                'status' => 200,
                'message' => 'Banner actualizado correctamente',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Banner no encontrada',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);
        if ($banner) {
            $path = 'uploads/banners/' . $banner->image;
            if (File::exists($path)) {
                File::delete($path);
            }

            $banner->delete();
            return response()->json([
                'status' => 200,
                'message' => "Banners eliminado correctamente"
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Banners no encontrada'
            ]);
        }

    }
}
