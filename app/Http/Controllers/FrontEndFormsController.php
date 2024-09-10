<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\FrontEndForms;
use Illuminate\Support\Facades\Mail;

class FrontEndFormsController extends Controller
{
    public function store(Request $request)
    {
        try {
            $form = FrontEndForms::create($request->all());
            $admin_subject = "New {$request->page_name} Request";
            $user_subject = "The Woodlands Inn {$request->page_name} Request Submitted";
            Mail::send('emails.admin', ['form' => $form], function ($message) use ($form, $admin_subject) {
                $message->to('sales@thewoodlandsresort.com')
                    ->cc(['sales@thewoodlandsresort.com', 'alertsthewoodlands@gmail.com', 'smenon66@gmail.com', 'sales.team@thewoodlandsresort.com', 'Annie.john@thewoodlandsresort.com', 'gail.kapson@thewoodlandsresort.com', 'marketing@thewoodlandsresort.com', 'Abigail.V@thewoodlandsresort.com', 'kadir@easylinkindia.com','easylinkamerica@gmail.com','info@easylinkindia.com']);
                $message->subject($admin_subject);
            });
            Mail::send('emails.user', ['form' => $form], function ($message) use ($form, $user_subject) {
                $message->to($form->email);
                $message->subject($user_subject);
            });
            return response()->json([
                'status' => true,
                'message' => 'Form requested saved successfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function index(Request $request) 
    {
        if ($request->has('start_date') && $request->has('end_date')) {
            $start_date = Carbon::parse($request->input('start_date'))->startOfDay();
            $end_date = Carbon::parse($request->input('end_date'))->endOfDay();
            $data['rfps'] = FrontEndForms::where('created_at', '>=', $start_date)
                ->where('created_at', '<=', $end_date)
                ->orderBy('id', 'desc')
                ->get();
        } else {
            $data['rfps'] = FrontEndForms::orderBy('id', 'desc')->get();
        }
        return view('rfps', $data);
        
    }
}
