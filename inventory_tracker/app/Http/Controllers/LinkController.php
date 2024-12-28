<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function createSymlink()
    {
        // Check if the symlink already exists
        if (!file_exists(public_path('storage'))) {
            // Create the symbolic link
            symlink(storage_path('app/public'), public_path('storage'));
            return redirect()->back()->with('success', 'Symbolic link created successfully!');
        }

        return redirect()->back()->with('error', 'Symbolic already created!');
    }
}
