<div id="salary-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content p-5 pt-0">
            <div class="intro-y box py-10 sm:py-20">
                <form id="salary-form" action="{{url('society/hrm/payroll/add')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="employee_id"  id="employee_id"/>
                    <div class="steps px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
                        <div class="font-medium text-base mt-5">Update Salary Status</div>
                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                            <div class="intro-y col-span-12 sm:col-span-12">
                                <label for="salary">Salary</label>
                                <input type="number" id="salary" required name="salary" class="form-control"/>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-12">
                                <label for="deduction">Deduction</label>
                                <input type="number" class="form-control" name="deduction" id="deduction" placeholder="Enter Amount if Deducted" value="0"/>
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-12">
                                <label for="bonus">Bonus</label>
                                <input type="number" class="form-control" name="bonus" id="bonus" placeholder="Enter Bonus If Applied" value="0"/>
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-12">
                                <label for="comments">Comments</label>
                                <input type="text" class="form-control" name="comments" id="comments" placeholder="Enter Comments If Applied"/>
                            </div>


                            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                <button class="btn btn-primary w-24 ml-2" type="submit">Salary Status</button>
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
