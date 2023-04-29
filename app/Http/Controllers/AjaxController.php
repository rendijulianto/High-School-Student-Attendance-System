<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Subject, Teach};
class AjaxController extends Controller
{
    public function teach($subject_id) {
        $teaches = Teach::where('subject_id', $subject_id)->with('teacher')->get();
        return response()->json($teaches);
    }
}
