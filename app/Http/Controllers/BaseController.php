<?php

namespace App\Http\Controllers;


use App\Company;
use App\Helpers\BaseService;
use App\Language;
//use App\Setting;
use App\FunctionMenu;
use App\Constant;
use App\SiteSetting;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class BaseController extends Controller
{
    protected $company;
    protected $site_setting;
    protected $locale;
    protected $constants;
    public function __construct()
    {
        $this->locale = config('app.locale');

        $this->middleware(function ($request, $next) {
            $authUser = Auth::user();

            if(BaseService::redirectAgent($request)){
                return Redirect::to('login');
            }

            $listMenu = [];
            $activeMenu = [];
            $is_show_back_url = true;
            $currentFunction = BaseService::getCurrentFunction($request);

            if ($authUser) {

                $moduleId = BaseService::getCurrentModuleId($request);
                $listMenu = BaseService::getMenuListByUser($authUser, $moduleId);

                $request->session()->put('listMenu', $listMenu);

                $allow_access_menu = true;
                if(!$listMenu){$allow_access_menu = false;}

                $arr_access_menu = explode(',', $authUser->functions_access);
                if($currentFunction && !in_array($currentFunction['id'], $arr_access_menu)){$allow_access_menu = false;}

                if(
                    !$allow_access_menu &&
                    ($authUser->is_admin == Constant::MASTER_ADMIN || $authUser->is_admin == Constant::CUSTOMER_ADMIN)
                ){
                    $allow_access_menu = 1;
                }

                if(!$allow_access_menu){
//                    abort(404);
                }

                $activeMenu = BaseService::activeMenu($request);

                if(
                    $authUser->is_admin == Constant::EMPLOYEE_ADMIN && $currentFunction && $currentFunction['controller'] == 'user' && $currentFunction['action'] == 'profile'
                ){

                    $is_show_back_url = false;
                }

            }

            if(Session::has('locale')){
                $locale = Session::get('locale');
            }else{
                $locale = $authUser->lang_key ?? config('app.locale');
            }

            $this->locale = $locale;
            App::setLocale($locale);

            $listLanguage = Language::where('status', Constant::STATUS_ACTIVE)->get();

            $currentLanguage = [];
            foreach ($listLanguage as $language){
                if($language->code == $locale){
                    $currentLanguage = $language;
                    break;
                }
            }

            View::share([
                'listMenu'          => $listMenu,
                'currentFunction'   => $currentFunction,
                'activeMenu'        => $activeMenu,
                'locale'            => $locale,
                'currentLanguage'   => $currentLanguage,
                'listLanguage'      => $listLanguage,
                'is_show_back_url'  => $is_show_back_url,
                'current_domain'    => BaseService::getCurrentDomain(),
                'company_id'        => $authUser->company_id ?? ''
            ]);

            return $next($request);
        });

        $template = "trizen";
        View::share(['template' => $template]);

        $company = Company::find(Constant::MASTER_COMPANY_ID)->toArray();
        $this->company = $company;
        View::share(['company' => $company]);

        $setting = BaseService::getSetting();
        View::share(['setting' => $setting]);

        $current_page = BaseService::getCurrentPage();
        View::share(['current_page' => $current_page]);

    }

}
