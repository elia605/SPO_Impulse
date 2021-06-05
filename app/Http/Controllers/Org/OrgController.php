<?php

namespace App\Http\Controllers\Org;

use App\Models\Action;
use App\Models\Member;
use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use PDF;

class OrgController extends Controller
{
    public function news()
    {
        return view('org.news');
    }

    public function actions()
    {
        $actions = Action::all();
        return view('org.actions', ['actions' => $actions]);
    }

    public function requests()
    {
        $actions = Action::where('status', 'unread')->get();
        $members = Member::where('status', 'unread')->get();
        return view('org.requests', ['actions' => $actions, 'members' => $members]);
    }

    public function members()
    {
        $members = News::all();
        return view('org.members', ['members' => $members]);
    }

    public function pdfview(Request $request)
    {
        $items = DB::table("items")->get();
        view()->share('items',$items);
        if($request->has('download')){
            $pdf = PDF::loadView('org.pdfview');
            return $pdf->download('pdfview.pdf');
        }
        return view('org.pdfview');
    }

    public function documents()
    {
        return view('org.documents');
    }

    public function carousel()
    {
        return view('org.carousel');
    }
}
