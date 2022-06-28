<?php

namespace App;


class Constant

{
    const TYPE_CREDIT = 'CREDIT';

# Date
    const MODULE_A = 1;
    const YMD = 'Y-m-d';
    const YMD_FULL = 'Y-m-d H:i:s';
    const DMY = 'd-m-Y';
    const DEFAULT_NULL_DATE = '0000-00-00';

# Status
    const STATUS_NO = 0;
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const LIVE_MODE = 0;
    const START_MODE = 1;
    const CACHE_VARIABLE = 1;

    const MAX_FILE_UPLOAD = 1024;

    const PLUGIN_DEFAULT = 'admin';

    const GRAPH_FACEBOOK = 'https://graph.facebook.com/v3.1/me';
    const GOOGLE_MAP_API_KEY = 'AIzaSyBb4zaWGKmgPP10KHwu7qDgHXdRPD8ua6s';
    const GOOGLE_OAUTH_CLIENT_ID = '1002100458447-3ce64h24r4or4omb3kt3h4vjeloc9qvm.apps.googleusercontent.com';
    const GOOGLE_OAUTH_CLIENT_SECRET = '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';

    const REDIRECT_ADMIN_URL = '/admin/company/dashboard';
    const DEFAULT_DOMAIN = 'https://yacht.vtm-vn.com/';


# Sort
    const ORDER_ASC = 'asc';
    const ORDER_DESC = 'desc';

    const ACTION_INSERT  = 1;
    const ACTION_UPDATE  = 2;
    const ACTION_DELETE  = 3;
    const ACTION_IMPORT  = 4;
    const ACTION_EXPORT  = 5;

# Is Admin
    const MASTER_ADMIN = 1;
    const MASTER_COMPANY_ID = 1;
    const CUSTOMER_ADMIN = 2;
    const TA_ADMIN = 3;
    const EMPLOYEE_ADMIN = 4;



    const PAGE_ORIENTATION_LANDSCAPE = 'LANDSCAPE';
    const ORIENTATION_PORTRAIT = 'PORTRAIT';
    const PAGE_A3 = 'A3';
    const PAGE_A5 = 'A5';
    const SYSTEM_CACHE = 1;

///Register type
    const REGISTER_TYPE_EMAIL = 1;
    const REGISTER_TYPE_GOOGLE = 2;
    const REGISTER_TYPE_FACEBOOK = 3;
    const REGISTER_TYPE_PHONE = 4;

//GVIEW
    const GVIEW = "https://docs.google.com/gview?url=";
    const ACCEPTED_EXCEL = ".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel";



//Type file or folder
    const TYPE_FOLDER = 1;
    const TYPE_FILE = 2;
//Type delete
    const TYPE_DELETE = 1;
    const TYPE_EMPTY = 2;
//Number Character code
    const LENGTH_CODE = 8;

//HR SECTION
    const PAGE_SIZE = 20;


    /**
     * Social App Id
     */
    const GOOGLE_SITE_KEY = "6LcXc6MgAAAAAK3wiNeoLMJZ0nXRLAvScl-rsDtR";
    const GOOGLE_SECRET_KEY = "6LcXc6MgAAAAAI2hYa1bfiMcn-5oBU6uWehrR9sK";
    const FACEBOOK_APP_ID = "1054876942128083";
    const FACEBOOK_APP_SECRET = "bf8b5c30774aee8c631fa81a8c1c80cd";

    /**
     * Define all message of system here
     */

    /**********************************************************************************************************************/



    const LIST_ROLE = [
        ['id' => self::MASTER_ADMIN, 'name' => "Master admin"],
        ['id' => self::CUSTOMER_ADMIN, 'name' => "Customer admin"],
    ];

    const LIST_POSITION_FOR_RESUMES = [
        ['id' => 1, 'name' => "LEFT POSTION"],
        ['id' => 2, 'name' => "RIGHT POSITION"],
    ];

    const AGENT_DOMAIN = [
        "agent.yacht.org",
        "agent.vnyc.vn",
    ];


}
