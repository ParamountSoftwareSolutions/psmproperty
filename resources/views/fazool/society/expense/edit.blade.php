@extends('society.app')
@section('body')
    <div>
        <div>
            <form action="{{ route('expense.update', $expense->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="steps px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
                    <div class="font-medium text-base mt-5">Edit Expense</div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                        <label for="input-wizard-1" class="form-label">Select Project</label>
                        <select id="type" name="project_id" class="form-select is-required" required>
                            <option value="{{ $expense->project_id }}">{{ $expense->project->name }}</option>
                            @foreach($project as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="input-wizard-2" class="form-label">Raw Material</label>
                            <input name="raw_material" type="text" class="form-control is-required"
                                   placeholder="Enter Raw Material Name" required value="{{ $expense->raw_material }}">
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="input-wizard-2" class="form-label">Qty</label>
                            <input name="qty" type="text" class="form-control is-required"
                                   placeholder="Enter Qty" required value="{{ $expense->qty }}">
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="input-wizard-2" class="form-label">Cost</label>
                            <input name="cost" type="text" class="form-control is-required"
                                   placeholder="Enter cost" required value="{{ $expense->cost }}">
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="input-wizard-2" class="form-label">Date</label>
                            <input name="date" type="date" class="form-control is-required" placeholder="Enter Answer" required value="{{ $expense->date }}">
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="input-wizard-2" class="form-label">Labor</label>
                            <input name="labor" type="number" class="form-control is-required" placeholder="Enter labor " value="{{ $expense->labor->labor }}">
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="input-wizard-2" class="form-label">Labor Cost</label>
                            <input name="cost" type="number" class="form-control is-required" placeholder="Enter Labour cost" value="{{ $expense->cost }}">
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