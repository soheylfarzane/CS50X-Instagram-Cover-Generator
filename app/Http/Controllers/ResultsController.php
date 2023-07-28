<?php

namespace App\Http\Controllers;

use App\Models\Font;
use App\Models\Results;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ResultsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function resultsList()
    {
        $results = DB::table('results')->paginate('20');
        return view('admin.resultsList',[
            'results' => $results,
        ]);
    }
    public function resultsDelete($id)
    {

        $results = Results::find($id);
        File::delete($results->path);
        Results::find($id)->update([
           'path' => '#',
           'updated_at' => Carbon::now(),
        ]);
        return redirect()->route('resultsList')->with('status', 'فایل با موفقیت حذف شد');
    }
}
