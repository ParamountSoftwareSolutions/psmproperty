<div id="add-employee-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content p-5 pt-0">
            <div class="intro-y box py-10 sm:py-20">
                <div class="flex justify-center">
                    <button id="steps-btn-1"  class="steps-btn intro-y w-10 h-10 rounded-full btn btn-primary mx-2">1</button>
                    <button id="steps-btn-2"  class="steps-btn intro-y w-10 h-10 rounded-full btn bg-gray-200 dark:bg-dark-1 text-gray-600 mx-2">2</button>
                    <button id="steps-btn-3"  class="steps-btn intro-y w-10 h-10 rounded-full btn bg-gray-200 dark:bg-dark-1 text-gray-600 mx-2">3</button>
                    <button id="steps-btn-4"  class="steps-btn intro-y w-10 h-10 rounded-full btn bg-gray-200 dark:bg-dark-1 text-gray-600 mx-2">4</button>
                </div>
                <div class="px-5 mt-10">
                    <div class="font-medium text-center text-lg">Add New Employee</div>
                    <div class="text-gray-600 text-center mt-2">To start off, please provide correct information.</div>
                </div>
                <form id="society-form" action="{{url('society/employee/add')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="society_id" id="society-id"/>
                    <div id="steps-1" class="steps px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
                        <div class="font-medium text-base mt-5">Basic Information</div>
                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="employee_id">Employee Id</label>
                                <input type="text" class="form-control" name="employee_id" id="employee_id" placeholder="Employee Id"/>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="job_title">Job Title</label>
                                <select class="form-control" id="job_title" name="job_title_id">
                                    <option value="-1">Select Job Title</option>
                                    @foreach($employeeRoles as $employeeRole)
                                        <option value="{{$employeeRole->id}}">{{$employeeRole->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="cnic_id">CNIC</label>
                                <input type="text" class="form-control" name="cnic_id" id="cnic_id" placeholder="Cnic Id"/>
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="account_no">Account #</label>
                                <input type="text" class="form-control" name="account_no" id="account_no" placeholder="Bank Account Number"/>
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" name="address" id="address" placeholder="Address Of Employee"/>
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="additional_file">Additional Document</label>
                                <input type="file" class="form-control" name="additional_file" id="additional_file"/>
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="address">Salary</label>
                                <input type="number" class="form-control" name="salary" id="salary" placeholder="Salary Of Employee"/>
                            </div>

                            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                <button class="btn btn-secondary w-24" type="button" disabled>Previous</button>
                                <button class="btn btn-primary w-24 ml-2" type="button" onclick="gotoStep('2', 'next')">Next</button>
                            </div>
                        </div>
                    </div>
                    <div id="steps-2"  class="steps px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5" style="display: none">

                        <div class="font-medium text-base mt-5">Login Details</div>
                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Username"/>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="email"/>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="password">password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="password"/>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="c-password">password</label>
                                <input type="password" class="form-control" name="c-password" id="c-password" placeholder="confirm password"/>
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="phone_number">Phone No</label>
                                <input type="number" class="form-control" name="phone_number" id="phone_number"/>

                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="profile">Profile Pic</label>
                                <input type="file" class="form-control" name="profile" id="profile"/>

                            </div>
                        </div>

                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                <button class="btn btn-secondary w-24" type="button" onclick="gotoStep('1', 'previous')">Previous</button>
                                <button class="btn btn-primary w-24 ml-2" type="button" onclick="gotoStep('submit', 'society')">Next</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">


</script>
