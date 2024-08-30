<?php

namespace App\Http\Controllers;

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
                    ->cc(['sales@thewoodlandsresort.com', 'alertsthewoodlands@gmail.com', 'smenon66@gmail.com', 'sales.team@thewoodlandsresort.com', 'Annie.john@thewoodlandsresort.com', 'gail.kapson@thewoodlandsresort.com', 'marketing@thewoodlandsresort.com', 'Abigail.V@thewoodlandsresort.com', 'kadir@easylinkindia.com','easylinkamerica@gmail.com','info@easylinkindia.com'])
                    ->bcc(['webmaster@easylinkindia.com', 'dev@easylinkindia.com']);
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
}
