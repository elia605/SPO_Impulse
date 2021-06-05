<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Carousel;
use App\Models\Member;
use App\Models\MemberAction;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index()
    {
        return view('home');
    }

    public function welcome()
    {
        $news = News::all()->sortByDesc('created_at')->take(1);
        $carousels = Carousel::all();
        return view('welcome', ['news' => $news, 'carousels' => $carousels]);
    }

    public function members()
    {
        return view('members');
    }

    public function actions()
    {
        return view('actions');
    }

    public function actionView(Action $action)
    {
        $members = MemberAction::where('action_id', $action->id)->get();
        return view ('action', ['action' => $action, 'members' => $members]);
    }

    public function profile()
    {
        $profile = Auth::user();
        return view('profile');
    }

    public function news()
    {
        $news = News::get()->orderBy('created_at', 'desc');
        return view('news');
    }

    public function newView(News $new)
    {
        return view('new', ['new' => $new]);
    }
}
