<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocietyCategory;
use App\Models\StatusType;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class SocietyCategoryController extends Controller
{

    private $activePage;
    public function __construct(){
        $this->activePage = "society_category";
    }

    public function index(){
        $categories = SocietyCategory::all();
        $status  = StatusType::with('Status')->where('name', 'society')->get();
        return view('admin.societies.category.index', array('activePage' => $this->activePage, 'categories' => $categories, 'status'=>$status));
    }

    public function edit($id){
        $category = SocietyCategory::find($id);
        $categories = SocietyCategory::all();
        $status  = StatusType::with('Status')->where('name', 'society')->get();
        return view('admin.societies.category.edit', array('activePage' => $this->activePage, 'category' => $category, 'categories' => $categories, 'status'=>$status));
    }

    public function delete($category_id, $field_id){
        $category = SocietyCategory::find($category_id);
        $previousFields = json_decode($category->fields_json_array);
        $newFields = array();
        foreach ($previousFields as $field){
            if($field->id != $field_id){
                $newFields[] = $field;
            }
        }

        $category->fields_json_array = json_encode($newFields);

        $category->save();
        return back()->with('success', 'Category Fields Deleted Successfully');
    }

    public function create(Request $request){
        $category = new SocietyCategory();
        $category->name = $request->get('category_name');
        $category->status_id = $request->get('status_id');
        $category->created_by = auth()->user()->id;
        // add json values here....

        //get size, type, premium and store in database

        //make array of sizes
        $sizes = $request->get('size_val');
        $units =$request->get('size_unit');
        $sizesArray = array();
        $typesArray = array();
        $premiumArray = array();
        for ($i = 0; $i < count($sizes); $i++){
            $tempSizeArray = array(
                "value" => $sizes[$i],
                "unit" => $units[$i] );
            $sizesArray[] = $tempSizeArray;
        }


        $types = $request->get('types');
        foreach ($types as $type){
            $tempTypeArray = array(
                "value" => $type
            );
            $typesArray[] = $tempTypeArray;
        }


        $premium = $request->get('premium');
        foreach ($premium as $prem){
            $tempPremiumArray = array(
                "value" => $prem
            );
            $premiumArray[] = $tempPremiumArray;
        }

        $finaArray = array(
            "size" => $sizesArray,
            "type" => $typesArray,
            "premium" => $premiumArray
        );

        $category->fields_json_array = json_encode($finaArray);


        $category->save();
        return back()->with('success', 'Category Created Successfully');
    }

    public function addField($id, Request $request){
      $category = SocietyCategory::find($id);

        $sizes = $request->get('size_val');
        $units =$request->get('size_unit');
        $sizesArray = array();
        $typesArray = array();
        $premiumArray = array();
        for ($i = 0; $i < count($sizes); $i++){
            if($sizes[$i] != null) {
                $tempSizeArray = array(
                    "value" => $sizes[$i],
                    "unit" => $units[$i]);
                $sizesArray[] = $tempSizeArray;
            }
        }


        $types = $request->get('types');
        foreach ($types as $type){
            if($type != null){
                $tempTypeArray = array(
                    "value" => $type
                );
                $typesArray[] = $tempTypeArray;
            }

        }


        $premium = $request->get('premium');
        foreach ($premium as $prem){
            if($prem != null) {
                $tempPremiumArray = array(
                    "value" => $prem
                );
                $premiumArray[] = $tempPremiumArray;
            }
        }

        $finaArray = array(
            "size" => $sizesArray,
            "type" => $typesArray,
            "premium" => $premiumArray
        );

        $category->fields_json_array = json_encode($finaArray);
        $category->save();
      return back()->with('success', 'Category Fields Created Successfully');
    }

}
