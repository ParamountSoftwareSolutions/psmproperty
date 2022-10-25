@extends('society.app')
@section('body')
    <div>
        <div>
            <form action="{{ route('expense.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="steps px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
                    <div class="font-medium text-base mt-5">Add Expense</div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                        <label for="input-wizard-1" class="form-label">Select Project</label>
                        <select id="type" name="project_id" class="form-select is-required" required>
                            @foreach($project as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="input-wizard-2" class="form-label">Raw Material</label>
                            <input name="raw_material" type="text" class="form-control is-required"
                                   placeholder="Enter Raw Material Name" required>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="input-wizard-2" class="form-label">Qty</label>
                            <input name="qty" type="text" class="form-control is-required"
                                   placeholder="Enter Qty" required>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="input-wizard-2" class="form-label">Cost</label>
                            <input name="cost" type="text" class="form-control is-required"
                                   placeholder="Enter cost" required>
                        </div>

                    </div>

                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="input-wizard-2" class="form-label">Date</label>
                            <input name="date" type="date" class="form-control is-required" placeholder="Enter Answer"
                                   required>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="input-wizard-2" class="form-label">Labor</label>
                            <input name="labor" type="number" class="form-control is-required" placeholder="Enter labor ">
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="input-wizard-2" class="form-label">Labor Cost</label>
                            <input name="cost" type="number" class="form-control is-required" placeholder="Enter Labour cost">
                        </div>
                    </div>
                    <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                        <button class="btn btn-primary w-24 ml-2" type="submit">Submit</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection