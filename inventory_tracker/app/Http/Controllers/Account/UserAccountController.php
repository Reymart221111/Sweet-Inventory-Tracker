<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserAccountController extends Controller
{
    public function showAccountSettingsPage()
    {
        $showSettings = true;

        return view('contents.account-settings.index', compact('showSettings'));
    }

    public function showAccountPasswordPage()
    {
        $showPassword = true;

        return view('contents.account-settings.index', compact('showPassword'));
    }

    public function showAccountProfilePage()
    {
        $showProfile = true;

        return view('contents.account-settings.index', compact('showProfile'));
    }
}
