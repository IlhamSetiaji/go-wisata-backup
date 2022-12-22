<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendEmailMobile extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function sendOtp(Request $request)
    {

        $receiver = $request->email;
        $name = $request->name;
        $body = 'Hallo ' . $name . ' silahkan gunakan Kode Otentifikasi untuk login di Go-Wisata.id ' . $request->code;
        $sendEmail = $this->sendEmail($receiver, $body);

        if ($sendEmail) {
            return response()->json('Email send Sucessfully');
        } else {
            return response()->json('Can\'t send email');
        }
    }

    public function sendEmail($receiver, $body)
    {
        if ($this->isOnline()) {
            $email = [
                'recepient' => $receiver,
                'fromEmail' => 'admin@go-wisata.com',
                'fromName' => 'Go-Wisata.id',
                'subject' => 'Verify your Go-Wisata.id Forms account',
                'body' => $body
            ];

            Mail::send('email-otp', ['body' => $email['body']], function ($message) use ($email) {
                $message->from($email['fromEmail'], $email['fromName']);
                $message->to($email['recepient']);
                $message->subject($email['subject']);
            });
        }
        return true;
    }

    public function isOnline($site = "https://www.youtube.com/")
    {
        if (@fopen($site, "r")) {
            return true;
        } else {
            return false;
        }
    }

    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}