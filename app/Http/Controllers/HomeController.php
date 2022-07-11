<?php

namespace App\Http\Controllers;

use App\Constant;
use App\Helpers\BaseService;
use App\Jobs\SendContactEmail;
use App\Jobs\SendContactEmailServer;
use App\SiteMenu;
use App\SiteResume;
use App\SiteSkill;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $siteMenu = SiteMenu::orderBy("ordinal", Constant::ORDER_ASC)
            ->where([
                ['status', Constant::STATUS_ACTIVE],
                ['is_public', Constant::STATUS_ACTIVE],
            ])
            ->get()
            ->toArray();
        $projects = SiteResume::orderBy("ordinal", Constant::ORDER_ASC)->get()->toArray();
        $skills = SiteSkill::orderBy("ordinal", Constant::ORDER_ASC)->get()->toArray();
        $countProjects = count($projects);
        foreach($projects as $key => $project){
            $from = explode("-", $project['from']) ?? '';
            $to = explode("-", $project['to'])  ?? '';
            $projects[$key]['from_year'] = $from[1]."/".$from[0];
            $projects[$key]['to_year'] = $to[1]."/".$to[0];
        }


        return view('home.index', compact('siteMenu', 'projects', 'countProjects', 'skills'));
    }

    public function sendContactMail(Request $request){
        $data = $request->all();

        $name  = $data['name'] ?? "";
        $email = $data['email'] ?? "";
        $subject = $data['subject'] ?? "";
        $message = $data['message'] ?? "";
        $recaptcha = $data["g-recaptcha-response"] ?? null;
        if(!isset($recaptcha) || $recaptcha == 'null'){
            return json_encode(array('success' => false, 'message' => __('Captcha is incorrect').'!'));
        }
        $company = $this->company;
        $contentSmsServer = [
            'company' => $company,
            'email' => $email,
            'name' => $name,
            'message' => $message,
        ];
        SendContactEmailServer::dispatch($contentSmsServer)->delay(now()->addSecond(30));
        $contentSmsSender = [
            'company' => $company,
            'email' => $email,
            'name' => $name,
            'message' => $message,
        ];
        SendContactEmail::dispatch($contentSmsSender)->delay(now()->addSecond(30));
        return json_encode([
            'success' => true,
            'message' => __("Sent successfully")
        ]);

    }
}
