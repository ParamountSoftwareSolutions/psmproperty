<?php

namespace App\Helpers;

use App\Models\EmployeePermission;
use App\Models\SocietySection;

class Permission
{

    public static function hasPermission($user, $section ,$permission){
            //get Employee from user and check his permission

        $societySection = SocietySection::where('name', $section)->first(); // get ID and now goto Permissions
        if($societySection != null){

            $employee = $user->Employee;
            if($employee == null){
                return true;
            }else{
                $sectPermissions = EmployeePermission::where('society_section_id', $societySection->id)->where('employee_id', $user->Employee->id)->first();
                dd($sectPermissions);
                if($sectPermissions == null){
                    return false;
                }
                else if($sectPermissions->$permission == 1){
                    return true;
                }else{
                    return false;
                }
            }
        }else{
            return false;
        }

    }

}
