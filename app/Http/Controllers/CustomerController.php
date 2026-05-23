<?php

namespace App\Http\Controllers;

use App\Models\User; // Ensure the User model is imported at the top
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the drivers.
     */
    public function index()
    {
        // 1. Fetch your user table records ordered by their blacklist ranking hierarchy
        $users = User::orderBy('blacklist_rank', 'asc')->get();

        // 2. Return the customers index view while feeding it our dynamic collection array
        return view('customers.index', compact('users'));
    }
}