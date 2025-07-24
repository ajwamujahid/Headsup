<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QueueController extends Controller
{
    public function index()
    {
        // Optionally, you can fetch any data here
        return view('queue-list');
    }
}
