<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Lecturer;
use App\Models\Student;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;



class AuthController extends Controller
{
    public function login()
    {
        return view('pages/auth/login');
    }

    // Submit login
    public function submitLogin(Request $request)
    {
        $credentials = $request->only('email', 'password', 'role');
        $err = [
            'error' => 'Thông tin đăng nhập không chính xác',
            'role' => $credentials['role']
        ];

        if ($credentials['role'] == 0) {
            // Default login admin
            $user = User::where('email', $credentials['email'])->first();
            if ($user && $user->position == 1) {
                $credentials['role'] = 3;
            }
        } else if ($credentials['role'] == 1) {
            // Handle login lecturer
            $user = Lecturer::where('email', $credentials['email'])->first();
        } else if ($credentials['role'] == 2) {
            // Handle login student
            $user = Student::where('email', $credentials['email'])->first();
        }

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors($err);
        }

        $user->role = $credentials['role'];
        session(['user' => $user]);
        return redirect('/');
    }


    public function editPass()
    {
        return view('pages.auth.editPass');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePass(Request $request, $id)
    {

        $user = (new User());
        if (session()->get('user')['role'] == 1) {
            $user = (new Lecturer());
        } elseif (session()->get('user')['role'] == 2) {
            $user = (new Student());
        }
        $data = $user->getDetail($id);
        $req = $request->only('password_old', 'password');
        $pass_old = $req['password_old'];
        $params = [
            'password' => Hash::make($req['password']),
        ];

        $err = [
            'error' => 'Mật khẩu cũ không chính xác!',
        ];
        if (!password_verify($pass_old, $data['password'])) {
            return back()->withErrors($err);
        }

        $user->updateItem($id, $params);
        return Redirect::route('auth.editPass', ['id' => $id])->with('success', 'Cập nhật mật khẩu thành công');;
    }

    // logout
    public function logout()
    {
        session()->forget('user');
        return redirect('/login');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $id
     * @return \Illuminate\Http\Response
     */
    public function editProfile($id)
    {
        $role = 0;
        $model = (new User());
        if (session()->get('user')['role'] == 1) {
            $role = 1;
            $model = (new Lecturer());
        } elseif (session()->get('user')['role'] == 2) {
            $role = 2;
            $model = (new Student());
        }

        $data = $model->getDetail($id);
        $data->role = $role;
        $query = [
            'data' => $data,
        ];

        session(['user' => $data]);
        return view('pages.auth.editProfile', $query);
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request, $id)
    {
        $model = new User();
        $table = 'users';
        if (session()->get('user')['role'] == 1) {
            $model = new Lecturer();
            $table = 'lecturers';
        } elseif (session()->get('user')['role'] == 2) {
            $model = new Student();
            $table = 'students';
        }

        $params = $request->all();

        $data = $model->getDetail($id);
        // Tạo một Rule Validation custom giống như trong hàm store
        $uniqueEmailRule = Rule::unique($table, 'email')->where(function ($query) {
            return $query->where('delete', 0);
        })->ignore($id); // Loại trừ sinh viên hiện tại

        $validator = Validator::make($params, [
            'email' => ['required', 'email', $uniqueEmailRule],
        ]);

        if ($validator->fails()) {
            $err = [
                'error' => 'Email đã được sử dụng!',
            ];
            return back()->withErrors($err);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $imageName = $image->getClientOriginalName();

            $extension = $image->getClientOriginalExtension();

            $hashedName = sha1(time() . $imageName) . '.' . $extension;

            $image_path = "/img/" . ($data['image'] ?? '');  // Value is not URL but directory file path
            if (File::exists($image_path)) {
                File::delete($image_path);
            }

            $params['image'] = $hashedName;

            $request->image->move(public_path('img'), $hashedName);
        } else {
            unset($params['image']);
        }

        $model->updateItem($id, $params);


        return Redirect::route('profile.edit', ['id' => $id])->with('success', 'Cập nhật thông tin thành công');;
    }
}
