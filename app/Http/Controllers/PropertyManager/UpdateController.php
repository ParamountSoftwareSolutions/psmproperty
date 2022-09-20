<?php

namespace App\Http\Controllers\PropertyManager;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\BuildingUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class UpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $update = BuildingUpdate::get();
        $building = Helpers::building_detail();
        return view('property_manager.update.index', compact('building', 'update'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $building = Helpers::building_detail();
        return view('property_manager.update.create', compact('building'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'building_id' => 'required',
        ]);
        $images = [];
        $update = new BuildingUpdate();
        $update->building_id = $request->building_id;
        $update->title = $request->title;
        $update->price = $request->price;
        $update->address = $request->address;
        $update->area = $request->area;
        $update->description = $request->description;
        if ($request->file('main_image')) {
            $file = $request->file('main_image');
            $filename = hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
            $file->move('public/images/update/main_image/', $filename);
            $update->main_image = 'public/images/update/main_image/' . $filename;
        }
        $img_names = [];
        if (!empty($request->file('images'))) {
            foreach ($request->file('images') as $file) {
                $filename = hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
                $file->move('public/images/update/', $filename);
                $file = 'public/images/update/' . $filename;
                //$images[] = $file;
                array_push($img_names, $file);
            }
            $image_data = json_encode($img_names);
            $update->banner_images = json_encode($img_names);
        } else {
            $image_data = json_encode([]);
        }
        $update->video = $request->video_path;
        $update->save();

        if ($update) {
            return redirect()->route('property_manager.update.index')->with($this->message('Building Create SuccessFully', 'success'));
        } else {
            return redirect()->back()->with($this->message("Building Create Error", 'error'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $update = BuildingUpdate::findOrfail($id);
        $building = Helpers::building_detail();
        return view('property_manager.update.edit', compact('update','building'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'building_id' => 'required',
        ]);
        $update = BuildingUpdate::findOrFail($id);
        $update->building_id = $request->building_id;
        $update->title = $request->title;
        $update->price = $request->price;
        $update->address = $request->address;
        $update->area = $request->area;
        $update->description = $request->description;
        if ($request->file('main_image')) {
            $file = $request->file('main_image');
            $filename = hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
            $file->move('public/images/update/main_image/', $filename);
            $update->main_image = 'public/images/update/main_image/' . $filename;
        }
        $img_names = [];
        if($update->banner_images !== null){
            $images = json_decode($update->banner_images);
            if (!empty($request->file('images'))) {
                foreach ($request->images as $file) {
                    $filename = hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
                    $file->move('public/images/update/', $filename);
                    $file = 'public/images/update/' . $filename;
                    array_push($images, $file);
                }

            }
        } else {
            $images = [];
            if (!empty($request->file('images'))) {
                foreach ($request->images as $file) {
                    $filename = hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
                    $file->move('public/images/update/', $filename);
                    $file = 'public/images/update/' . $filename;
                    array_push($images, $file);
                }

            }
        }

        $update->banner_images = json_encode($images);
        $update->video = $request->video_path;
        $update->save();

        if ($update) {
            return redirect()->route('property_manager.update.index')->with($this->message('Update edit SuccessFully', 'success'));
        } else {
            return redirect()->back()->with($this->message("Update edit Error", 'error'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $update = BuildingUpdate::findOrFail($id);
        $update->delete();
        if ($update) {
            return redirect()->route('property_manager.update.index')->with($this->message('Update edit SuccessFully', 'success'));
        } else {
            return redirect()->back()->with($this->message("Update edit Error", 'error'));
        }
    }


    public function uploadLargeFiles(Request $request) {
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        if (!$receiver->isUploaded()) {
            // file not uploaded
        }

        $fileReceived = $receiver->receive(); // receive file
        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded

            $file = $fileReceived->getFile();
            $fileName = hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
//            $file->move('public/images/update/video/', $fileName);
//            $path = asset('public/images/update/video/' . $fileName);
            $disk = Storage::disk(config('filesystems.default'));
            $path = $disk->putFileAs('videos', $file, $fileName);

            // delete chunked file
            unlink($file->getPathname());
            return [
                'path' => asset('storage/app/' . $path),
                'filename' => $fileName
            ];
        }

        // otherwise return percentage informatoin
        $handler = $fileReceived->handler();
        return [
            'done' => $handler->getPercentageDone(),
            'status' => true
        ];
    }

    public function remove_image(Request $request)
    {
        //$filename = explode('/', $request->name);dd($filename);
        unlink($request->name);

        $update = BuildingUpdate::find($request->id);
        $img_arr = [];
        foreach (json_decode($update->banner_images, true) as $img) {
            if (strcmp($img, $request->name) != 0) {
                array_push($img_arr, $img);
            }
        }

        BuildingUpdate::where(['id' => $request->id])->update([
            'banner_images' => json_encode($img_arr),
        ]);

        return json_encode($request->name);
    }
}
