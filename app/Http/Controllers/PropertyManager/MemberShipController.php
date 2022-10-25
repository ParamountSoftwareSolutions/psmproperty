<?php

namespace App\Http\Controllers\PropertyManager;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\BuildingFile;
use App\Models\BuildingForm;
use App\Models\BuildingSale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberShipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $membership = BuildingForm::where('user_id', Helpers::user_admin())->Where('type', 'membership')->get();
        return view('property_manager.membership.index', compact('membership'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $building = Helpers::building_detail();
        $sale = BuildingSale::whereIn('building_id', $building->pluck('id')->toArray())->where(['order_type' => 'sale', 'order_status' => 'active'])->get();
        $user = User::whereIn('id', $sale->pluck('customer_id')->toarray())->get();
        return view('property_manager.membership.create', compact('user'));
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
            'project_name' => 'required',
            'project_logo' => 'required',
            'developer_logo' => 'required',
            'customer_id' => 'required',
        ]);
        $form = new BuildingForm();
        $form->user_id = Helpers::user_admin();
        $form->customer_id = $request->customer_id;
        $form->project_name = $request->project_name;
        $form->application_no = $request->application_no;
        $form->fee = $request->fee;
        $form->passport_no = $request->passport_no;
        $form->current_address = $request->current_address;
        $form->permanent_address = $request->permanent_address;
        $form->occupation = $request->occupation;
        $form->phone_no_office = $request->phone_no_office;
        $form->phone_no_res = $request->phone_no_res;
        $form->nominee_name = $request->nominee_name;
        $form->nominee_father_name = $request->nominee_father_name;
        $form->nominee_cnic = $request->nominee_cnic;
        $form->nominee_passport_no = $request->nominee_passport_no;
        $form->relationship = $request->relationship;
        $form->property_type = $request->property_type;
        $form->total_price = $request->total_price;
        $form->booking_price = $request->booking_price;
        $form->down_payment = $request->down_payment;
        $form->installment = $request->installment;
        $form->payment_type = $request->payment_type;
        $form->cash_receipt = $request->cash_receipt;
        $form->type = 'membership';
        if ($request->has('project_logo')) {
            foreach ($request->file('project_logo') as $file) {
                $filename = hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
                $file->move('public/images/form/', $filename);
                $file = 'public/images/form/' . $filename;
                //array_push($img_names, $file);
                $form->project_logo = $file;
            }
        }
        if ($request->has('developer_logo')) {
            foreach ($request->file('developer_logo') as $file) {
                $filename = hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
                $file->move('public/images/form/', $filename);
                $file = 'public/images/form/' . $filename;
                //array_push($img_names, $file);
                $form->developer_logo = $file;
            }
        }
        $form->save();
        if ($form) {
            return redirect()->route('property_manager.membership.index')->with($this->message('Membership Form created SuccessFully', 'success'));
        } else {
            return redirect()->back()->with($this->message("Membership Form create Error", 'error'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $form = BuildingForm::with('customer')->findOrFail($id);
        return view('property_manager.membership.show', compact('form'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $form = BuildingForm::findOrFail($id);
        $building = Helpers::building_detail();
        $sale = BuildingSale::whereIn('building_id', $building->pluck('id')->toArray())->get();
        $user = User::whereIn('id', $sale->pluck('customer_id')->toarray())->get();
        return view('property_manager.membership.edit', compact('form', 'user'));
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
            'project_name' => 'required',
            /*'project_logo' => 'required',
            'developer_logo' => 'required',*/
            'customer_id' => 'required',
        ]);
        $form = BuildingForm::findOrFail($id);
        $form->user_id = Helpers::user_admin();
        $form->customer_id = $request->customer_id;
        $form->project_name = $request->project_name;
        $form->application_no = $request->application_no;
        $form->fee = $request->fee;
        $form->passport_no = $request->passport_no;
        $form->current_address = $request->current_address;
        $form->permanent_address = $request->permanent_address;
        $form->occupation = $request->occupation;
        $form->phone_no_office = $request->phone_no_office;
        $form->phone_no_res = $request->phone_no_res;
        $form->nominee_name = $request->nominee_name;
        $form->nominee_father_name = $request->nominee_father_name;
        $form->nominee_cnic = $request->nominee_cnic;
        $form->nominee_passport_no = $request->nominee_passport_no;
        $form->relationship = $request->relationship;
        $form->property_type = $request->property_type;
        $form->total_price = $request->total_price;
        $form->booking_price = $request->booking_price;
        $form->down_payment = $request->down_payment;
        $form->installment = $request->installment;
        $form->payment_type = $request->payment_type;
        $form->cash_receipt = $request->cash_receipt;
        $form->type = 'membership';
        if ($request->has('project_logo')) {
            foreach ($request->file('project_logo') as $file) {
                $filename = hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
                $file->move('public/images/form/', $filename);
                $file = 'public/images/form/' . $filename;
                //array_push($img_names, $file);
                $form->project_logo = $file;
            }
        }
        if ($request->has('developer_logo')) {
            foreach ($request->file('developer_logo') as $file) {
                $filename = hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
                $file->move('public/images/form/', $filename);
                $file = 'public/images/form/' . $filename;
                //array_push($img_names, $file);
                $form->developer_logo = $file;
            }
        }
        $form->save();
        if ($form) {
            return redirect()->route('property_manager.membership.index')->with($this->message('Membership Form updated SuccessFully', 'success'));
        } else {
            return redirect()->back()->with($this->message("Membership Form update Error", 'error'));
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
        $form = BuildingForm::findOrFail($id);
        $form->delete();
        if ($form) {
            return redirect()->route('property_manager.membership.index')->with($this->message('Membership Form delete SuccessFully', 'success'));
        } else {
            return redirect()->back()->with($this->message("Membership Form delete Error", 'error'));
        }
    }

    public function printForm($id)
    {
        $form = BuildingForm::with('customer')->findOrFail($id);
        return view('property_manager.membership.form_print', compact('form'));
    }
}
