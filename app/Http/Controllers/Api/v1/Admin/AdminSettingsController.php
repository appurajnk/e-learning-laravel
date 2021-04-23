<?php

namespace App\Http\Controllers\Api\v1\Admin;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ICurrency;
use App\Repositories\Contracts\ILanguage;


class AdminSettingsController extends Controller
{

    private $currencies;
    private $languages;

    public function __construct(ICurrency $currencies, ILanguage $languages)
    {
        $this->currencies = $currencies;
        $this->languages = $languages;
    }
    
    public function fetchSettings(){
        return response()->json(setting()->all(), 200);
    }


    public function save_payment_settings(Request $request)
    {
        if(is_envato()){
            return response()->json(null, 200);
        }

        $paypal_sandbox_rule = Rule::requiredIf(function() use ($request){
            return $request->enable_paypal == true && $request->paypal_mode == 'sandbox';
        });
        $paypal_live_rule = Rule::requiredIf(function() use ($request){
            return $request->enable_paypal == true && $request->paypal_mode == 'live';
        });
        $stripe_sandbox_rule = Rule::requiredIf(function() use ($request){
            return $request->enable_credit_card == true && $request->credit_card_processor == 'stripe' && $request->stripe_mode == 'sandbox';
        });
        $stripe_live_rule = Rule::requiredIf(function() use ($request){
            return $request->enable_credit_card == true && $request->credit_card_processor == 'stripe' && $request->stripe_mode == 'live';
        });
        $razorpay_sandbox_rule = Rule::requiredIf(function() use ($request){
            return $request->enable_credit_card == true && $request->credit_card_processor == 'razorpay' && $request->razorpay_mode == 'sandbox';
        });
        $razorpay_live_rule = Rule::requiredIf(function() use ($request){
            return $request->enable_credit_card == true && $request->credit_card_processor == 'razorpay' && $request->razorpay_mode == 'live';
        });

        $this->validate($request, [
            'paypal_sandbox_secret' => $paypal_sandbox_rule,
            'paypal_sandbox_client_id' => $paypal_sandbox_rule,
            'paypal_live_secret' => $paypal_live_rule,
            'paypal_live_client_id' => $paypal_live_rule,

            'stripe_sandbox_public_key' => $stripe_sandbox_rule,
            'stripe_sandbox_secret_key' => $stripe_sandbox_rule,
            'stripe_live_public_key' => $stripe_live_rule,
            'stripe_live_secret_key' => $stripe_live_rule,

            'razorpay_sandbox_public_key' => $razorpay_sandbox_rule,
            'razorpay_sandbox_secret_key' => $razorpay_sandbox_rule,
            'razorpay_live_public_key' => $razorpay_live_rule,
            'razorpay_live_secret_key' => $razorpay_live_rule
        ]);

        $data = $request->all();

        collect($data)->each(function ($v, $key) {
            setting(["payments.{$key}" => $v]);
        });
        setting()->save();
        return response()->json(setting()->all(), 200);
    }


    public function save_site_settings(Request $request)
    {
        
        $cur = $request->site_currency;
        if($cur){
            $currency = $this->currencies->findByCode($cur);
            if( ! $currency->is_primary){
                $this->currencies->markAsPrimary($currency->id);
            }
        }

        $lang = $request->site_language;
        if($lang){
            $language = $this->languages->findByCode($lang);
            if(! $language->is_default){
                $this->languages->markAsDefault($language->id);
            }
        }
        
        if($request->type=='video'){
            $this->validate($request, [
                's3_access_id' => 'required_if:video_upload_location,s3',
                's3_secret_access_key' => 'required_if:video_upload_location,s3',
                's3_default_region' => 'required_if:video_upload_location,s3',
                's3_bucket' => 'required_if:video_upload_location,s3'
            ]);
        }
        

        $data = $request->all();

        collect($data)->each(function ($v, $key) {
            if($key !== 'type'){
                setting(["site.{$key}" => $v]);
            }
        });
        setting()->save();
        return response()->json(setting()->all(), 200);
    }


    public function save_mail_settings(Request $request)
    {
        if(is_envato()){
            return response()->json(null, 200);
        }
        $data = $request->all();

        collect($data)->each(function ($v, $key) {
            setting(["mail.{$key}" => $v]);
        });
        setting()->save();
        return response()->json(setting()->all(), 200);
    }

    public function uploadLogo(Request $request)
    {
        $file = $request->file('photo');
        $extension = $request->file('photo')->extension();
        $name = "{$request->icon_type}.{$extension}";

        $path = $file->storeAs('images', $name, 'icons'); // folder, filename, disk
        
        if($path){
            setting(["site.{$request->icon_type}" => '/'.$path]);
            setting()->save();
        }
        
        return response()->json(setting()->all(), 200);
    }


    // Site theme colors
    public function getStyles()
    {
        $styles = file_get_contents(public_path('css/theme.css'));
        return $styles;
    }
    public function saveStyles(Request $request)
    {
        $this->validate($request, [
            'code' => ['required']
        ]);

        $styles = file_put_contents(public_path('css/theme.css'), $request->code);
        return $styles;
    }

}
