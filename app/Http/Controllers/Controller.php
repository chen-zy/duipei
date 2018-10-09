<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Overtrue\EasySms\EasySms;
use Overtrue\EasySms\Strategies\OrderStrategy;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $aliyunSms;

    public function __construct()
    {
        $this->aliyunSms = new EasySms([
            'timeout' => 5.0,
            'default' => [
                'strategy' => OrderStrategy::class,
                'gateways' => ['aliyun'],
            ],
            'gateways' => [
                'aliyun' => [
                    'access_key_id' => env('ALIYUN_ID'),
                    'access_key_secret' => env('ALIYUN_SECRET'),
                    'sign_name' => env('ALIYUN_SMS_SIGN_NAME'),
                ],
            ],
        ]);
    }
}
