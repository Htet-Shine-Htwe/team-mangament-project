<?php

namespace App\Http\Controllers\Api\Issues;

use App\Http\Controllers\Controller;
use App\Models\Issue;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => auth()->id()
        ]);
    }
    public function update(Request $request, $id)
    {
        $issue = Issue::find($id);

        return response()->json([
            'message' => 'Issue updated successfully',
            'data' => $issue
        ]);
    }
}
