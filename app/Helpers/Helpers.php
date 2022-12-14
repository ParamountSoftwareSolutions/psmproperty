<?php

namespace App\Helpers;

use App\Models\Building;
use App\Models\BuildingAssignUser;
use App\Models\BuildingCustomer;
use App\Models\BuildingMobileApplication;
use App\Models\BuildingPaymentPlan;
use App\Models\BuildingSale;
use App\Models\BuildingSaleInstallment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Spatie\Permission\Models\Role;

class Helpers
{
    public static function user_login_route()
    {
        if (Auth::user()->roles[0]->name == 'property_admin') {
            $panel = 'property';
            $file = 'property';
        } elseif (Auth::user()->roles[0]->name == 'property_manager') {
            $panel = 'property-manager';
            $file = 'property_manager';
        } elseif (Auth::user()->roles[0]->name == 'sale_manager') {
            $panel = 'sale-manager';
            $file = 'sale_manager';
        } elseif (Auth::user()->roles[0]->name == 'sale_person') {
            $panel = 'sale-person';
            $file = 'sale_person';
        } else {
            return false;
        }
        return ['panel' => $panel, 'file' => $file];
    }

    public static function user_admin()
    {
        $id = Auth::id();
        if (Auth::user()->roles[0]->name == 'property_admin') {
            $user = User::findOrFail($id)->id;
        } elseif (Auth::user()->roles[0]->name == 'property_manager') {
            $user = User::findOrFail($id)->property_admin_id;
        } elseif (Auth::user()->roles[0]->name == 'sale_manager') {
            $user = User::findOrFail($id)->property_admin_id;
        } elseif (Auth::user()->roles[0]->name == 'sale_person') {
            $user = User::findOrFail($id)->property_admin_id;
        } else {
            return false;
        }

        return $user;
    }

    public static function building_assign_user()
    {
        $building_assign_user = BuildingAssignUser::where('user_id', Auth::id())->get();
        return $building_assign_user;
    }

    public static function building_detail_single($id)
    {
        $building_assign_user = Helpers::building_assign_user();
        $building = Building::whereIn('id', $building_assign_user->pluck('building_id')->toArray())->findOrFail($id);

        //dd($building);
        return $building;
    }

    public static function building_detail()
    {
        $building_assign_user = Helpers::building_assign_user();
        $building = Building::whereIn('id', $building_assign_user->pluck('building_id')->toArray())->get();

        //dd($building);
        return $building;
    }

    public static function installment($request)
    {
        $payment_plan = BuildingPaymentPlan::findOrFail($request->payment_plan_id);
        $a1 = [];
        $a2 = [];
        $a3 = [];
        $a4 = [];
        $total = [];
        $date = Carbon::now();
        $total_per_year_price = 0;
        // Calculation Payment Plan
        $total_month = $payment_plan->total_month_installment;
        $extra_total_price = [
            'booking' => [$payment_plan->booking_price, $date],
            'balloting' => [$payment_plan->balloting_price, $date],
            'possession' => [$payment_plan->possession_price, $date->addMonths($total_month)->format('Y-m-d')],
        ];

        foreach ($extra_total_price as $key => $data) {
            array_push($a1, [
                'title' => $key,
                'amount' => $data[0],
                'due_date' => $data[1],
                'created_at' => Carbon::now()
            ]);
        }

        if ($payment_plan->half_year_installment !== null && $total_month > 12) {
            $price_per_year = $payment_plan->half_year_installment;
            $yearly_month = $total_month / 6;
            for ($i = 0; $yearly_month > $i; $i++) {
                $a2[$i] = $price_per_year;
            }
            foreach ($a2 as $data) {
                array_push($a1, [
                    'title' => 'yearly',
                    'amount' => $data,
                    'due_date' => $date->addMonths(6)->format('Y-m-d'),
                    'created_at' => Carbon::now()->addMonths(6),
                ]);
            }
        } elseif ($payment_plan->quarterly_payment !== null && $total_month > 12) {
            $quarterly_price = $payment_plan->quarterly_payment;
            $quarterly_month = $total_month / 3;
            for ($i = 0; $quarterly_month > $i; $i++) {
                $a3[$i] = $quarterly_price;
            }
            foreach ($a3 as $data) {
                array_push($a1, [
                    'title' => 'quarterly',
                    'amount' => $data,
                    'due_date' => $date->addMonths(3)->format('Y-m-d'),
                    'created_at' => Carbon::now()->addMonths(3),
                ]);
            }
        }

        $date = Carbon::now();
        for ($i = 0; $total_month > $i; $i++) {
            $a4[$i] = $payment_plan->per_month_installment;
        }
        foreach ($a4 as $key => $data) {
            array_push($a1, [
                'title' => 'installment',
                'amount' => $data,
                'due_date' => $date->addMonth()->format('Y-m-d'),
                'created_at' => Carbon::now()->addMonths($key),
            ]);
        }

        $amount = $a1;
        $total_price = array_sum(array_column($a1, 'amount'));

        /*for ($i = 0; $total_per_year_price > $i; $i++) {
            array_push($a1, [
                'half_year_installment'
            ]);
            $b2[$i] = 'Yearly Price';
            $a2[$i] = $price_per_year;
        }*/
        /*$total_price = count($extra_total_price) + $total_per_year_price;
        for ($i = 0; count($extra_total_price) > $i; $i++) {
            $b1[$i] = 'Extra Price';
            $a1[$i] = $extra_total_price[$i];
        }*/

        return $data = [
            'amount' => $amount,
            'total_price' => $total_price,
            'payment_plan' => $payment_plan,
        ];
    }

    public static function sale_and_customer($request, $building, $order_type, $data, $id = null)
    {
        //dd($request->interested_in, $request->source);
        if ($id == null || $id == '') {
            $sale = new BuildingSale();
            if ($order_type == 'lead') {
                $request->client_type = 'new';
                $sale->order_status = 'new';
                $sale->order_type = 'lead';
            } elseif ($order_type == 'sale') {
                $sale->order_status = 'active';
                $sale->order_type = 'sale';
            }



            if (isset($request->client_type) && $request->client_type == 'new') {
                $user = User::where('phone_number', $data['phone_number']);
                if($data['cnic'] !== null){
                    $user = $user->where('cnic',$data['cnic']);
                }
                if($data['email'] !== null){
                    $user = $user->where('email',$data['email']);
                }
                $user = $user->first();
                if ($user == null) {
                    $customer = new User();
                } else {
                    return response()->json(['status' => 'error', 'message' => 'Client already create. Please change client data or select old client!']);
                }
            } elseif ($request->client_type == 'old') {
                $customer = User::find($request->client_id);
            }

        } else {
            $sale = BuildingSale::findOrFail($id);
            $customer = User::where('id', $sale->customer_id)->first();
            if ($order_type == 'sale') {
                $sale->order_status = 'active';
                $sale->order_type = 'sale';
            }
        }
        if (array_key_exists("username", $data)) {
            $customer->username = $data['username'];
        }
        if (array_key_exists("father_name", $data)) {
            $customer->father_name = $data['father_name'];
        }
        if (array_key_exists("email", $data)) {
            $customer->email = $data['email'];
        }
        if (array_key_exists("cnic", $data)) {
            $customer->cnic = $data['cnic'];
        }
        if (array_key_exists("address", $data)) {
            $customer->address = $data['address'];
        }
        if (array_key_exists("password", $data)) {
            $customer->password = Hash::make($data['password']);
        }
        if (array_key_exists("phone_number", $data)) {
            $customer->phone_number = $data['phone_number'];
        }
        if (array_key_exists("alt_phone", $data)) {
            $customer->alt_phone = $data['alt_phone'];
        }
        if (array_key_exists("dob", $data)) {
            $customer->dob = $data['dob'];
        }
        if ($order_type == 'sale') {
            if (array_key_exists("country_id", $data)) {
                $customer->country_id = $data['country_id'];
            }
            if (array_key_exists("state_id", $data)) {
                $customer->state_id = $data['state_id'];
            }
            if (array_key_exists("city_id", $data)) {
                $customer->city_id = $data['city_id'];
            }
        } elseif ($order_type == 'lead') {
            $sale->interested_in = $request->interested_in;
            $sale->source = $request->source;
        }
        $customer->save();
        $role = Role::where('name', 'user')->first();
        $customer->assignRole($role);

        //lead
        $sale->building_id = $request->building_id;
        //Sale

        if ($request->floor_detail_id !== null) {
            $sale->floor_detail_id = $request->floor_detail_id;
        }
        $sale->customer_id = $customer->id;
        $sale->down_payment = $request->down_payment;
        $sale->payment_plan_id = $request->payment_plan_id;
        if (Auth::user()->roles[0]->name == 'employee') {
            $sale->user_id = Auth::id();
        } else {
            $sale->user_id = $request->sale_person_id;
        }

        $sale->save();
        return [
            'sale' => $sale,
            'customer' => $customer
        ];
    }

    public static function create_installment_plan($sale, $installment, $request)
    {
        $installment_check = BuildingSaleInstallment::where(['floor_detail_id' => $request->floor_detail_id])->first();
        if ($request->down_payment !== $installment['payment_plan']->total_price) {
            if ($installment_check == null) {
                foreach ($installment['amount'] as $data) {
                    BuildingSaleInstallment::create([
                        'floor_detail_id' => $request->floor_detail_id,
                        'building_sale_id' => $sale->id,
                        'title' => $data['title'],
                        'installment_amount' => $data['amount'],
                        'due_date' => $data['due_date'],
                        'type' => 'installment',
                        'status' => 'not_paid',
                        'created_at' => $data['created_at']
                    ]);
                }
            } else {
                return redirect()->route('property_manager.sale.client.index', (new Helpers)->user_login_route()['panel'])->with(Helpers::message('Property id already use in installment!', 'warning'));
            }
        } else {
            foreach ($installment['amount'] as $data) {
                BuildingSaleInstallment::create([
                    'floor_detail_id' => $request->floor_detail_id,
                    'building_sale_id' => $sale->id,
                    'title' => $data['title'],
                    'installment_amount' => $data['amount'],
                    'due_date' => $data['due_date'],
                    'type' => 'rent',
                    'status' => 'not_paid',
                    'created_ad' => $data['created_at']
                ]);
            }
        }
    }

    public static function customer_create($sale)
    {dd($sale);
        $admin = Helpers::user_admin();
        $building_app_key = BuildingMobileApplication::where('property_admin_id', $admin)->first();
        $customer_detail = BuildingCustomer::where('customer_id', $sale['customer']->id)->first();
        if ($customer_detail == null) {
            $customer_detail = new BuildingCustomer();
            $customer_detail->building_app_id = $building_app_key->id;
            $customer_detail->property_admin_id = $admin;
            $customer_detail->building_sale_id = $sale->id;
            $customer_detail->save();
        } else {
            $customer_detail->building_app_id = $building_app_key->id;
            $customer_detail->property_admin_id = $admin;
            $customer_detail->building_sale_id = $sale->id;
            $customer_detail->save();
        }
    }


    public static function message($message, $alert)
    {
        return [
            'message' => $message,
            'alert' => $alert,
        ];
    }

    public static function sendError($error_message, $code = 400)
    {
        return Response::json(['status' => $code, 'message' => $error_message], $code)->setStatusCode($code, $error_message);
    }

    public static function sendSuccess($message, $data = '')
    {
        return Response::json(['status' => 200, 'message' => $message, 'successData' => $data], 200, []);
    }

    public static function isSuperAdmin()
    {
        if (Auth::user()->roles[0]->name == 'admin') {
            return true;
        } else {
            return false;
        }
    }

    public static function isPropertyAdmin()
    {
        if (Auth::user()->roles[0]->name == 'property_admin') {
            return true;
        } else {
            return false;
        }
    }

    public static function isPropertyManager()
    {
        if (Auth::user()->roles[0]->name == 'property_manager') {
            return true;
        } else {
            return false;
        }
    }

    public static function isSaleManager()
    {
        if (Auth::user()->roles[0]->name == 'sale_manager') {
            return true;
        } else {
            return false;
        }
    }

    public static function isEmployee()
    {
        if (Auth::user()->roles[0]->name == 'employee') {
            return true;
        } else {
            return false;
        }
    }

}
