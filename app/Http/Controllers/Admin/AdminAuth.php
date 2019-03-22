<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Mail\AdminResetPassword;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminAuth extends Controller
{
    /**
     * View Login Page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loginPage()
    {
        return view('admin.auth.login');
    }

    /**
     * Login admin guard
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login()
    {
        $remember_me = \request('remember_me') === 1 ? true : false;
        if (auth('admin')->attempt(['email' => \request('email'), 'password' => request('password')], $remember_me)) {
            return redirect('admin');
        } else {
            session()->flash('error', 'incorrect information login');
            return redirect('admin/login');
        }
    }

    /**
     * Logout Admin guard
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect(aurl('login'));
    }


    /**
     * Forgot password view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function forgot_password()
    {
        return view('admin.auth.passwords.email');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forgot_password_post(){
        $admin = Admin::where('email', request('email'))->first();
        if (!empty($admin)) {
            $token = app('auth.password.broker')->createToken($admin);
            $data  = DB::table('password_resets')->insert([
                'email'      => $admin->email,
                'token'      => $token,
                'created_at' => Carbon::now(),
            ]);
            Mail::to($admin->email)->send(new AdminResetPassword(['data' => $admin, 'token' => $token]));
            session()->flash('success', trans('admin.the_link_reset_sent'));
            return back();
        }
        return back();
    }

    /**
     * Check password entered by admin and redirect him to admin home page
     *
     * @method Post
     * @param $token
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function reset_password_final($token) {

        $this->validate(request(), [
            'password'              => 'required|confirmed',
            'password_confirmation' => 'required',
        ], [], [
            'password'              => 'Password',
            'password_confirmation' => 'Confirmation Password',
        ]);

        $check_token = DB::table('password_resets')->where('token', $token)->where('created_at', '>', Carbon::now()->subHours(2))->first();
        if (!empty($check_token)) {
            $admin = Admin::where('email', $check_token->email)->update([
                'email'    => $check_token->email,
                'password' => bcrypt(request('password'))
            ]);
            DB::table('password_resets')->where('email', request('email'))->delete();
            auth()->guard('admin')->attempt(['email' => $check_token->email, 'password' => request('password')], true);
            return redirect(aurl());
        } else {
            return redirect(aurl('forgot/password'));
        }
    }


    /**
     * Check token
     *
     * @method Get
     * @param $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function reset_password($token)
    {
        $check_token = DB::table('password_resets')->where('token', $token)->where('created_at', '>', Carbon::now()->subHours(2))->first();
        if (!empty($check_token)) {
            return view('admin.auth.passwords.reset', ['data' => $check_token]);
        } else {
            return redirect(aurl('forgot/password'));
        }
    }
}
