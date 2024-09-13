<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AIController extends Controller
{
    public function improveMessage(Request $request)
    {
        $message = $request->input('message');

        if (!$message) {
            return response()->json(['error' => 'No message provided'], 400);
        }

        $process = new Process(['python3', base_path('/chat.py'), $message]);
        $process->run();

        if (!$process->isSuccessful()) {
            return response()->json(['error' => 'Failed to process AI request'], 500);
        }

        $output = $process->getOutput();

        return response()->json(['improvedMessage' => $output]);
    }
}
