<?php


namespace App\Mail;


use App\Company;
use App\Constant;
use App\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $company = Company::find(Constant::MASTER_COMPANY_ID);

        $setting = Setting::find(Constant::MASTER_COMPANY_ID);

        $mail_from = empty($setting->username_mail) ? env('MAIL_FROM_ADDRESS') : $setting->username_mail;

        $data = $this->data;

        $template   = $data['template'] ?? "Elements.EmailTemplates.test_mail";
        $subject    = $data['subject'] ?? "Test Email";
        $email_data = $data['email_data'] ?? [];

        return $this
            ->from($mail_from, $company->name)
            ->subject($subject)
            ->view($template)
            ->with(['email_data' => $email_data])
            ;
    }
}
