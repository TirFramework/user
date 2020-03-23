<?php

namespace Tir\User\Controllers\Auth;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\VerifiesEmails;
use App\Modules\User\Events\UserRegistered;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }


    public function verificationByMobileOrEmail(Request $request)
    {

        $request->validate([
            'mobileOrEmail' => 'required',
        ]);

        if( $request->mobileOrEmail === 'email'){
            auth()->user()->sendEmailVerificationNotification();
            return redirect(route('verification.notice') );
        }

        if( $request->mobileOrEmail === 'mobile'){
            return $this->verificationByMobile();
        }

    }

        public function verificationByMobile()
        {
            return $this->createVerificationCode();
        }

        public function createVerificationCode()
        {
            if(!$this->checkLastOneMinuteCode()){
                //create random code for verification user
                $code =mt_rand(1000,9999);

                //delete old code(s)
                DB::table('verification_code')->Where('user_id',auth()->id())->delete();

                //insert code in db
                DB::table('verification_code')->insert([
                    'code'=>$code,
                    'user_id'=>auth()->id(),
                    'created_at'=>Carbon::now()
                    ]);

                // call our event here
                $message = event(new UserRegistered(auth()->user()));


                $message = trans('code_created_successfully');


            }else{
                $message = trans('please_wait_for_one_minute');
            }
                echo $message;
            //return view('');
        }

        public function checkLastOneMinuteCode()
        {
            $oneMinuteAgo = Carbon::now()->subMinutes(1);
            return DB::table('verification_code')
                        ->Where('created_at', '>' , $oneMinuteAgo)
                        ->Where('user_id', auth()->id())->count();
        }


        public function verificationCode(Request $request)
        {
            return 'ok';
            // return $request->all();
            // return DB::table('verification_code')->Where('user_id', auth()->id())->get();
        }
}
