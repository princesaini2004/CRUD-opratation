<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Support\Str;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $otpdata;


    public function __construct($user, $otp)
    {
        $this->data = $user;
        $this->otpdata = $otp;
    }



    public function build()
    {
        $address = 'sainiprince122004@gmail.com';
        $subject = "Your OTP is $this->otpdata";
        $name = 'prince';

        $headerData = [
            'category' => 'category',
            'unique_args' => [
                'variable_1' => 'abc'
            ]
        ];

        $header = $this->asString($headerData);

        $this->withSwiftMessage(function ($message) use ($header) {
            $message->getHeaders()
                ->addTextHeader('X-SMTPAPI', $header);
        });
        $content = str_replace('{{otp}}', $this->otpdata, $this->getTemplate());
        $content = str_replace('{{firstname}}', $this->data['FirstName'], $content);
        $content = str_replace('{{lastname}}', $this->data['LastName'], $content);
        $content = str_replace('{{id}}', $this->data['id'], $content);

        return $this->html($content)
            ->from($address, $name)
            ->cc($address, $name)
            ->bcc($address, $name)
            ->replyTo($address, $name)
            ->subject($subject)
            ->with(['data' => $this->data, 'otp' => $this->otpdata]);
    }

    public function getTemplate()
    {
        return <<<EOT
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
        <div style="font-family: Helvetica,Arial,sans-serif;min-width:700px;overflow:auto;line-height:2">
            <div style="margin:50px auto;width:600px;padding:20px 0">
            <div style="border-bottom:1px solid #eee">
                <a href="" style="font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600">Reset Password</a>
            </div>
            <p style="font-size:1.1em">Hi {{firstname}} {{lastname}},</p>
            <p>We received a request to verify your email address. <br/>Your verification code is:</p>
            <h2 style="background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">{{otp}}</h2>
            <p style="font-size:0.9em;">
                This OTP is valid for 5 minutes.
                <br/>
                If you did not request this code, it is possible that someone else is trying to access your account. <br/><b>Do not forward or give this code to anyone.</b>
                <br/>
                <br/>
                Sincerely yours,
                <br/>
                The Qifl Al Baab team</p>
            <hr style="border:none;border-top:1px solid #eee" />
            <div style="padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
                <p>This email can't receive replies.</p>
            </div>
            <div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
                <p>Think Real Ventures</p>
                <p>Bangalore, KA</p>
                <p>India</p>
            </div>
            </div>
        </div>
    </body>
    </html>
    EOT;
    }

    private function asJSON($data)
    {
        $json = json_encode($data);
        $json = preg_replace('/(["\]}])([,:])(["\[{])/', '$1$2 $3', $json);

        return $json;
    }


    private function asString($data)
    {
        $json = $this->asJSON($data);

        return wordwrap($json, 76, "\n   ");
    }
}
