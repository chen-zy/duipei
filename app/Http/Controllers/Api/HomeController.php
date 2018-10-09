<?php

namespace App\Http\Controllers\Api;

use App\Rules\Mobile;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Overtrue\EasySms\Exceptions\NoGatewayAvailableException;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

class HomeController extends Controller
{
    public function verifyCode(Request $request)
    {
        $this->validate($request, [
            'mobile' => [new Mobile],
        ]);

        $mobile = $request->mobile;
        $vcode = str_pad(rand(1, 999999), 6, 0, STR_PAD_LEFT);

        $key_code = sprintf('verifyCode#%s', $mobile);
        $key_unique = sprintf('verifyCodeUnique#%s', $mobile);

        if (Cache::has($key_unique)) {
            throw new TooManyRequestsHttpException(5, '验证码请求过于频繁');
        }

        try {
            $this->aliyunSms->send($mobile, [
                'template' => env('ALIYUN_SMS_TEMPLATE_AVC'),
                'data' => [
                    'code' => $vcode
                ],
            ]);
        } catch (NoGatewayAvailableException $e) {
            if (app()->environment('production')) {
                throw new \Exception('短信发送失败');
            }
            throw $e->getLastException();
        }

        Cache::put($key_code, $vcode, 2);
        Cache::put($key_unique, '', 1);
    }
}
