<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\OTPMail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
    protected $redirectTo = '/';

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function verifyOtp(Request $request)
    {
        $user = $request->all();
        $otp = rand(100000, 999999);
        $otpExpiry = Carbon::now()->addMinutes(10);
        // Gửi OTP qua email
        Mail::to($request->get('email'))->send(new OTPMail($otp, $user['name'], url()->current()));

        // Lưu OTP và OTP expiry vào session để kiểm tra trong bước verify
        session(['otp' => $otp, 'otp_expiry' => $otpExpiry, 'user_data' => $user]);
        // Chuyển hướng tới trang verify OTP
        return redirect()->route('verifyOtp')->with('status', 'Mã OTP đã được gửi tới email của bạn.');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function showOtpForm()
    {
        return view('auth.verify-otp');
    }


    public function registerVerifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|integer']);

        $otp = session('otp');
        $otpExpiry = session('otp_expiry');
        $userData = session('user_data');

        if ($request->otp == $otp && Carbon::now()->lessThanOrEqualTo($otpExpiry)) {
            // Tạo tài khoản người dùng
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make($userData['password']),
            ]);

            // Xóa OTP và dữ liệu tạm
            session()->forget(['otp', 'otp_expiry', 'user_data']);

            // Đăng nhập và chuyển hướng người dùng
            auth()->login($user);

            return redirect($this->redirectTo);
        } else {
            return back()->withErrors(['otp' => 'Mã OTP không chính xác hoặc đã hết hạn']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resendOtp(Request $request)
    {
        $userData = session('user_data');
        // Kiểm tra xem người dùng đã đăng ký chưa
        if (!$userData['email']) {
            return redirect()->route('register')->withErrors(['session' => 'Không tìm thấy email trong session.']);
        }

        $otp = rand(100000, 999999);
        $otpExpiry = Carbon::now()->addMinutes(10);

        // Lưu OTP và OTP expiry vào session để kiểm tra trong bước verify
        session(['otp' => $otp, 'otp_expiry' => $otpExpiry, 'user_data' => $userData]);

        // Gửi OTP qua email
        try {
            // Gửi OTP qua email
            Mail::to($userData['email'])->send(new OTPMail($otp));
            return redirect()->route('verifyOtp')->with('status', 'Mã OTP mới đã được gửi tới email của bạn.');
        } catch (\Exception $e) {
            return redirect()->route('verifyOtp')->withErrors(['otp' => 'Đã xảy ra lỗi khi gửi email. Vui lòng thử lại.']);
        }
    }
}
