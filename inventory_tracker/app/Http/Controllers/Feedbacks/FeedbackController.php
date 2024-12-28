<?php

namespace App\Http\Controllers\Feedbacks;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'manager' || Auth::user()->role === 'employee') {
            return view('contents.admin.feedbacks.index');
        } elseif (Auth::user()->role === 'admin') {
            return view('contents.admin.feedbacks.index');
        }
    }

    public function view($id)
    {
        $viewing = true;
        $feedback = Feedback::findOrFail($id);
        if (Auth::user()->role === 'admin') {
            return view('contents.admin.feedbacks.index', compact('viewing', 'feedback'));
        }
    }
}
