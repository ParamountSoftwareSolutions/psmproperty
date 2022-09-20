@extends('society.app')
@section('body')
    <div>
        <div>
            <form action="{{ route('faq.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="steps px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
                    <div class="font-medium text-base mt-5">Create Faq</div>
                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="input-wizard-2" class="form-label">Question</label>
                            <input name="question" type="text" class="form-control is-required" placeholder="Enter Question" required>
                        </div>

                    </div>
                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                        <div class="intro-y col-span-12 sm:col-span-12">
                            <label for="input-wizard-2" class="form-label">Answer</label>
                            <input name="answer" type="text" class="form-control is-required" placeholder="Enter Answer" required>
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