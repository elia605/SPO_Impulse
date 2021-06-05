<?php

namespace App\Http\Controllers\Admin;

use App\Models\Action;
use App\Models\News;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $newUsers = User::where('created_at', '<=', Carbon::now()->ceilDay())->count();
        $newActions = Action::where('created_at', '<=',Carbon::now()->ceilDay())->count();
        return view('admin.index', [
            'users' => $newUsers,
            'actions' => $newActions,
        ]);
    }

    public function users()
    {
        $users = User::all()->sortByDesc('created_at');
        return view('admin.users', ['users' => $users]);
    }
}
