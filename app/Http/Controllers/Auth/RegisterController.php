<?php
/**
 * Class RegisterController
 *
 * @category Worketic
 *
 * @package Worketic
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @version <PHP: 1.0.0>
 * @link    http://www.amentotech.com
 */
namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;
use App\Helper;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Session;
use DB;
use App\SiteManagement;
use App\EmailTemplate;
use Illuminate\Support\Facades\Mail;
use App\Mail\GeneralEmailMailable;
use App\Mail\AdminEmailMailable;

/**
 * Class RegisterController
 *
 */
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Validate user input.
     *
     * @param mixed $request Request Attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());
        $server = Helper::worketicIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'server_error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator, 'register');
        } else {
            event(new Registered($user = $this->create($request->all())));
            if (empty(config('mail.username')) && empty(config('mail.password'))) {
                $json['email'] = $user['email'];
                $json['url'] = $user['url'];
            }
            $json['type'] = 'success';
            return $json;
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data return data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            [

            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $request returns request
     *
     * @return \App\User
     */
    protected function create($request)
    {
        $json = array();
        $user = new User();

        $register_form = SiteManagement::getMetaValue('reg_form_settings');
        $registration_type = !empty($register_form) && !empty($register_form[0]['registration_type']) ? $register_form[0]['registration_type'] : 'multiple';
        $verification_type = !empty($register_form) && !empty($register_form[0]['verification_type']) ? $register_form[0]['verification_type'] : 'admin_verify';
        $verification_code = '';
        if ($registration_type !== 'single' && $verification_type !== 'auto_verify') {
            $random_number = Helper::generateRandomCode(4);
            $verification_code = strtoupper($random_number);
        }

        $user_id = $user->storeUser($request, $verification_code, $registration_type, $verification_type);
        session()->put(['user_id' => $user_id]);
        session()->put(['email' => $request['email']]);
        session()->put(['password' => $request['password']]);
        if (!empty(config('mail.username')) && !empty(config('mail.password'))) {
            $email_params = array();
            if ($registration_type !== 'single' && $verification_type !== 'auto_verify') {
                $template = DB::table('email_types')->select('id')
                    ->where('email_type', 'verification_code')->get()->first();
                if (!empty($template->id)) {
                    $template_data = EmailTemplate::getEmailTemplateByID($template->id);
                    $email_params['verification_code'] = $user->verification_code;
                    $email_params['name'] = Helper::getUserName($user->id);
                    $email_params['email'] = $user->email;
                    Mail::to($user->email)
                        ->send(
                            new GeneralEmailMailable(
                                'verification_code',
                                $template_data,
                                $email_params
                            )
                        );
                }
            } else {
                $template = DB::table('email_types')->select('id')->where('email_type', 'new_user')->get()->first();
                if (!empty($template->id)) {
                    $template_data = EmailTemplate::getEmailTemplateByID($template->id);
                    $email_params['name'] = Helper::getUserName($user->id);
                    $email_params['email'] = $user->email;
                    $email_params['password'] = $request['password'];
                    Mail::to($user->email)
                        ->send(
                            new GeneralEmailMailable(
                                'new_user',
                                $template_data,
                                $email_params
                            )
                        );
                }
                $admin_template = DB::table('email_types')->select('id')->where('email_type', 'admin_email_registration')->get()->first();
                if (!empty($template->id)) {
                    $template_data = EmailTemplate::getEmailTemplateByID($admin_template->id);
                    $email_params['name'] = Helper::getUserName($user->id);
                    $email_params['email'] = $user->email;
                    $email_params['link'] = url('profile/' . $user->slug);
                    Mail::to(config('mail.username'))
                        ->send(
                            new AdminEmailMailable(
                                'admin_email_registration',
                                $template_data,
                                $email_params
                            )
                        );
                }
                session()->forget('password');
                session()->forget('email');
            }
        } else {
            $id = Session::get('user_id');
            $user = User::find($id);
            Auth::login($user);
            $json['email'] = 'not_configured';
            $json['url'] = url($user->getRoleNames()->first().'/dashboard');
        }
        $json['type'] = 'success';
        return $json;
    }
}
