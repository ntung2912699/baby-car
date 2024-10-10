<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetSuccess;
use App\Repositories\Roles\RolesRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    const MSG_ERROR_EXCEPTION = 'Đã xảy ra lỗi hệ thống! Vui lòng thử lại sau';
    const SUCCESS_STATUS = 'SUCCESS';
    const ERROR_STATUS = 'ERROR';

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var RolesRepository
     */
    protected $rolesRepository;

    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     * @param RolesRepository $rolesRepository
     */
    public function __construct(
        UserRepository $userRepository,
        RolesRepository $rolesRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->rolesRepository = $rolesRepository;
    }

    /**
     * @return \Illuminate\Container\Container|mixed|object
     */
    public function userProfile() {
        $user = Auth::user();
        return view('client.page.user-profile', compact('user'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Container\Container|mixed|object
     */
    public function updateUserProfile(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            session()->flash('error', 'Đã có lỗi xảy ra khi cập nhật.');
            return redirect()->route('user-profile');  // chuyển hướng về trang hồ sơ
        }
        try {
            $id = Auth::id();
            $nameChange = $request->get('name');
            $emailChange = $request->get('email');
            $file_name = Auth::user()->avatar;
            // Upload avatar nếu có
            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $source = 'upload/user/';
                $file_name = $this->userRepository->upload($file, $source);
            }

            // Cập nhật thông tin người dùng
            $this->userRepository->update(
                $id,
                [
                    "name" => $nameChange,
                    "email" => $emailChange,
                    "avatar" => $file_name
                ]
            );

            // Lưu thông báo thành công vào session
            session()->flash('success', 'Cập nhật thông tin thành công!');
            return redirect()->route('user-profile');  // chuyển hướng về trang hồ sơ

        } catch (\Exception $exception) {
            // Lưu thông báo lỗi vào session
            session()->flash('error', 'Đã có lỗi xảy ra khi cập nhật.');
            return redirect()->route('user-profile');  // chuyển hướng về trang hồ sơ
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function updateUserPassword(Request $request) {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed'
        ]);

        // Xác thực mật khẩu hiện tại
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            session()->flash('error', 'Mật khẩu hiện tại không chính xác.');
            return redirect()->route('user-profile');
        }

        try {
            // Cập nhật mật khẩu mới
            $user = Auth::user();
            $user->password = Hash::make($request->new_password);
            $user->save();
            // Get current date and time
            $datetime = Carbon::now()->toDateTimeString();

            // Get device information (this is a simple example, you might want to use a library like jenssegers/agent for more detailed device info)
            $device = request()->header('User-Agent');

            // Send the password reset success email
            Mail::to($user->email)->send(new PasswordResetSuccess($user, $datetime, $device));

            session()->flash('success', 'Đổi mật khẩu thành công!');
            return redirect()->route('user-profile');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->route('user-profile');
        }
    }
}
