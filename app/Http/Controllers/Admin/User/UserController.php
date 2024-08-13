<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Repositories\Roles\RolesRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
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
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index(Request $request)
    {
        try {
            $sortField = $request->get('sort', 'id');
            $sortOrder = $request->get('order', 'asc');
            $perPage = $request->get('perPage', 10);
            $searchKey = $request->get('searchKey');
            if ($searchKey) {
                $user_data = $this->userRepository->searchMultipleColumn($searchKey, $perPage, $sortField, $sortOrder);
            } else {
                $user_data = $this->userRepository->orderBy($sortField, $sortOrder)->paginate($perPage);
            }
            $countTotal = $this->userRepository->countTotal();
            $currentTotal = $user_data->count();
            $roles = $this->rolesRepository->getAll();
            return view('admin.page.user.index', compact(
                'user_data',
                'sortField',
                'sortOrder',
                'perPage',
                'countTotal',
                'currentTotal',
                'searchKey',
                'roles'
            ));
        } catch (\Exception $e) {
            return view('admin.page.common.error_page');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function AjaxEditUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'roles_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => self::ERROR_STATUS,
                'message' => $validator->errors()
            ], 400);
        }
        try {
            $id = $request->get('id');
            $nameChange = $request->get('name');
            $emailChange = $request->get('email');
            $rolesChange = $request->get('roles_id');
            $UserNew = $this->userRepository->update(
                $id,
                [
                    "name" => $nameChange,
                    "email" => $emailChange,
                    "roles_id" => $rolesChange
                ]
            );
            return response()->json([
                'status' => self::SUCCESS_STATUS,
                'data' => $UserNew
            ], Response::HTTP_OK);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => self::ERROR_STATUS,
                'message' => self::MSG_ERROR_EXCEPTION
            ], 500);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function AjaxDeleteUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => self::ERROR_STATUS,
                'message' => $validator->errors()
            ], 400);
        }

        try {
            $id = $request->get('id');
            $this->userRepository->delete($id);
            return response()->json([
                'status' => self::SUCCESS_STATUS
            ], Response::HTTP_OK);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => self::ERROR_STATUS,
                'message' => self::MSG_ERROR_EXCEPTION
            ], 500);
        }
    }
}
