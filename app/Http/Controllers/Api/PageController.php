<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\PrivacyPolicy;
use App\Models\TermCondition;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        $about = About::findOrFail(1);
        return view('society.about.show', compact('about'));
    }

    public function termCondition()
    {
        $terms = TermCondition::findOrFail(1);
        return view('society.term.show', compact('terms'));
    }

    public function privacyPolicy()
    {
        $privacyPolicy = PrivacyPolicy::findOrFail(1);
        return view('society.privacyPolicy.show', compact('privacyPolicy'));
    }

    public function faq()
    {
        $faq = Faq::findOrFail(1);
        return view('society.faq.show', compact('faq'));
    }
}
