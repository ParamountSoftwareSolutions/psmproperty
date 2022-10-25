<?php

namespace App\Http\Controllers\PropertyManager;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\BuildingDetail;
use App\Models\BuildingDetailFile;
use App\Models\BuildingProperty;
use App\Models\BuildingPropertyFile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $property = BuildingProperty::Where('user_id', Helpers::user_admin())->get();
        return view('property_manager.property.index', compact('property'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('property_manager.property.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $property = new BuildingProperty();
        $property->user_id = Helpers::user_admin();
        $property->title = $request->title;
        $property->address = $request->address;
        $property->size = $request->size;
        $property->price = $request->price;
        $property->latitude = $request->latitude;
        $property->longitude = $request->longitude;
        $property->bath = $request->bath;
        $property->bed = $request->bed;
        $property->type = $request->type;
        $property->status = $request->status;
        $property->description = $request->description;
        $property->plot_feature = json_encode(['sewerage' => $request->sewerage, 'electricity' => $request->electricity, 'water_supply' => $request->water]);
        $property->business_feature = json_encode(['broadband' => $request->broadband, 'atm' => $request->atm]);
        $property->community_feature = json_encode(['gym' => $request->gym]);
        $property->healthcare_feature = json_encode(['swimming_pool' => $request->swimming_pool, 'suna' => $request->suna, 'jacuzzi' => $request->jacuzzi]);
        $property->other_facilities = json_encode(['school' => $request->school, 'hospital' => $request->hospital, 'shopping_mall' => $request->shopping_mall, 'restaurant' => $request->restaurant, 'transport' => $request->transport, 'services' => $request->services, 'maintenance' => $request->maintenance, 'security' => $request->security]);
        $property->save();
        if ($request->has('main_images')) {
            foreach ($request->file('main_images') as $file) {
                $filename = hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
                $file->move('public/images/property/', $filename);
                $file = 'public/images/property/' . $filename;
                //array_push($img_names, $file);
                BuildingPropertyFile::create([
                    'property_id' => $property->id,
                    'image' => $file,
                    'type' => 'main'
                ]);
            }
        }
        if ($request->has('images')) {
            foreach ($request->file('images') as $file) {
                $filename = hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
                $file->move('public/images/property/', $filename);
                $file = 'public/images/property/' . $filename;
                //array_push($img_names, $file);
                BuildingPropertyFile::create([
                    'property_id' => $property->id,
                    'image' => $file,
                    'type' => 'image'
                ]);
            }
        }
        if ($request->video_path !== null) {
            BuildingPropertyFile::create([
                'property_id' => $property->id,
                'image' => $request->video_path,
                'type' => 'video'
            ]);
        }
        if ($property) {
            return redirect()->route('property_manager.property.index')->with($this->message('Property create SuccessFully', 'success'));
        } else {
            return redirect()->back()->with($this->message("Property create Error", 'error'));
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
        $property = BuildingProperty::findOrFail($id);
        $video = ($property->property_video !== null) ? $property->property_video->image : '';
        return view('property_manager.property.edit', compact('property', 'video'));
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
        $property = BuildingProperty::findOrFail($id);
        $property->user_id = Helpers::user_admin();
        $property->title = $request->title;
        $property->address = $request->address;
        $property->size = $request->size;
        $property->price = $request->price;
        $property->latitude = $request->latitude;
        $property->longitude = $request->longitude;
        $property->bath = $request->bath;
        $property->bed = $request->bed;
        $property->description = $request->description;
        $property->plot_feature = json_encode(['sewerage' => $request->sewerage, 'electricity' => $request->electricity, 'water_supply' => $request->water]);
        $property->business_feature = json_encode(['broadband' => $request->broadband, 'atm' => $request->atm]);
        $property->community_feature = json_encode(['gym' => $request->gym]);
        $property->healthcare_feature = json_encode(['swimming_pool' => $request->swimming_pool, 'suna' => $request->suna, 'jacuzzi' => $request->jacuzzi]);
        $property->other_facilities = json_encode(['school' => $request->school, 'hospital' => $request->hospital, 'shopping_mall' => $request->shopping_mall, 'restaurant' => $request->restaurant, 'transport' => $request->transport, 'services' => $request->services, 'maintenance' => $request->maintenance, 'security' => $request->security]);
        $property->save();

        $img_names = [];
        if ($request->has('main_images')) {
            foreach ($request->file('main_images') as $file) {
                $filename = hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
                $file->move('public/images/property/', $filename);
                $file = 'public/images/property/' . $filename;
                //array_push($img_names, $file);
                BuildingPropertyFile::where('property_id', $property->id)->update([
                    'image' => $file,
                    'type' => 'main'
                ]);
            }
        }
        if ($request->has('images')) {
            foreach ($request->file('images') as $file) {
                $filename = hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
                $file->move('public/images/property/', $filename);
                $file = 'public/images/property/' . $filename;
                //array_push($img_names, $file);
                BuildingPropertyFile::create([
                    'property_id' => $property->id,
                    'image' => $file,
                    'type' => 'image'
                ]);
            }

        }
        if ($request->video_path !== null) {
            BuildingPropertyFile::create([
                'property_id' => $property->id,
                'image' => $request->video_path,
                'type' => 'video'
            ]);
        }
        if ($property) {
            return redirect()->route('property_manager.property.index')->with($this->message('Property update SuccessFully', 'success'));
        } else {
            return redirect()->back()->with($this->message("Property update Error", 'error'));
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
        $property = BuildingProperty::with('property_image')->findOrFail($id);
        $property->delete();
        if ($property) {
            return redirect()->route('property_manager.property.index')->with($this->message('Property Delete SuccessFully', 'success'));
        } else {
            return redirect()->back()->with($this->message("Property Delete Error", 'error'));
        }
    }

    public function uploadPropertyFiles(Request $request) {
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        if (!$receiver->isUploaded()) {
            // file not uploaded
        }

        $fileReceived = $receiver->receive(); // receive file
        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded

            $file = $fileReceived->getFile();
            $fileName = hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
            $disk = Storage::disk(config('filesystems.default'));
            $path = $disk->putFileAs('property/videos', $file, $fileName);

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

    public function removeImage(Request $request)
    {
        $building_property_file = BuildingPropertyFile::where(['property_id' => $request->property_id, 'type' => $request->type])->findOrFail($request->id);
        $building_property_file->delete();
        if($building_property_file !== null){
            unlink($building_property_file->image);
        }

        return json_encode('success');
    }
}
