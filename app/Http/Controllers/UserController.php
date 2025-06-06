<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $name = "Afooboy";
        $school = "SQI";
        $username = "afolabi_ademola";

        // "With" Method
        // return view('home')->with('name', $name)->with('school', $school);

        // "Compact" Method
        // return view('home', compact('name', 'school', 'username'));

        // Direct Method
        return view('home', [
            'name' => $name,
            'school' => $school,
            'username' => $username
        ]);
    }

    public function createUser(Request $req)
    {
        $validation = Validator::make($req->all(), [
            'fullname' => 'required|max:20|min:5',
            'email' => ['required', 'email', 'unique:users', 'lowercase'],
            'password' => [
                'required',
                'min:8',
                'regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
            ],
        ], [
            'password' => 'Password must contain letters, numbers and special characters'
        ]);

        if ($validation->fails()) {
            // return $validation->errors();
            return json_encode([
            'status' => '201',
            'msg' => $validation->errors()
        ]);
            // return view('home')->with('errors', $validation->errors());
        }

        // return User::where('email', 'afolabiademola27@gmail.com')->first();
        // return User::get();
        // return User::all();

        $user = User::where('email', $req->email)->first();

        if ($user) {
             return json_encode([
            'status' => '401',
            'msg' => 'User already exists bro'
            ]);
            // return view('home')->with('message', 'User already exists bro')->with('status', false);
        }

        $save = User::create([
            'name' => $req->fullname,
            'email' => $req->email,
            'password' => $req->password,
            // 'password' => Hash::make($req->password), Hash Password Manually
        ]);

        if ($save) {
             return json_encode([
            'status' => '200',
            'msg' => 'Details saved successfully'
            ]);
            // return redirect('/login')->with('message', 'Details saved successfully');
        }


        // echo $req->full_name;
        // return view('home')->with('message', "Details received, will be processed soon");

        // echo $_POST['full_name'];
    }


    public function authUser(Request $req)
    {
        $validation = Validator::make($req->all(), [
            'email' => 'required|email',
            'password' => 'required|min:3',
        ]);
        // return $req; to check the request data and their values(token, email, password)

        if ($validation->fails()) {
            return view('login')->with('errors', $validation->errors());
        } else {
            $user = User::where('email', $req->email)->first();

            if ($user && Hash::check($req->password, $user->password)) {
                session(['user' => $user]);
                return redirect('/dashboard');
                // return $user;
                // return Hash::check($req->password, $user->password);
            } else {
                return view('login')->with('message', 'Invalid email or password')->with('status', false);
            }
        }
    }

    public function dashboard()
    {
        if (session()->has('user')) {
            $user = session('user');
            // $first_name = session('user')->name;
            // return session('user');
            // return session()->all();

            $notes = Note::where('user_id', $user->id)->get();

            return view('dashboard', [
                'user' => $user,
                'notes' => $notes
            ]);
        } else {
            return redirect('/login')->with('message', 'Please login to access the dashboard');
        }
    }

    public function deleteUser(Request $req)
    {
        $delete = User::where('id', $req->userId)->first()->delete();
        if ($delete) {
            // return $delete;
            $req->session()->flush();
            $req->session()->regenerateToken();
            return redirect('/login')->with('message', 'Account Deleted Successfully');
        } else {
            return view('dashboard');
        }
        // return $req->userId;
    }

    public function editUser($id)
    {
        $user = User::find($id);
        return view('edituser', compact('user'));
    }

    public function updateUser(Request $req, $id)
    {
        $user = User::find($id);

        $user->name = $req->input('editName');
        $user->email = $req->input('editEmail');
        $user->password = $req->input('editPassword');

        $user->save();
        session(['user' => $user]);
        return redirect('/dashboard')->with('success', 'User updated successfully');
    }

    public function logOut(Request $req)
    {
        $req->session()->flush();

        $req->session()->regenerateToken();

        return redirect('/login')->with('message', 'Logged out successfully');
    }

    public function forgotPassword(Request $req)
    {
        $validation = Validator::make($req->all(), [
            'email' => 'required|email',
        ]);

        if ($validation->fails()) {
            return view('forgot')->with('errors', $validation->errors());
        } else {
            $user = User::where('email', $req->email)->first();

            if ($user) {
                session(['userId' => $user->id]);
                return redirect('/resetpassword')->with('success', 'Email exists, proceed to reset password');
            } else {
                return view('forgot')->with('message', 'Email not found');
            }
        }
    }

    public function resetPassword(Request $req)
    {
        $validation = Validator::make($req->all(), [
            'newPassword' => 'required|min:4',
            'confirmPassword' => 'required|min:4',
        ]);

        if ($validation->fails()) {
            return view('resetpassword')->with('errors', $validation->errors());
        } else {
            if ($req->newPassword !== $req->confirmPassword) {
                $errormsg = "Please try again, passwords do not match";
                return redirect()->route('resetpassword')->with('error', $errormsg);
            } else {
                $userId = session('userId');
                if (!$userId) {
                    return redirect('/forgot')->with('error', 'Session expired. Please verify your email again.');
                }
                $user = User::find($userId);
                if ($user) {
                    $user->password = Hash::make($req->newPassword);
                    $user->save();
                    return redirect('/login')->with('message', 'Password reset successfully');
                } else {
                    return view('resetpassword')->with('message', 'User not found');
                }
            }
        }
    }

    public function allusers()
    {
        $users = User::with('Note')->get();
        // return $users;
        return view('/admin')->with('users', $users);
    }

    public function allnotes()
    {
        $notes = Note::with('User')->get();
        // return $notes;
        return view('/allnotes')->with('notes', $notes);
    }

    public function usernotes($id)
    {
        // return $id;
        $userNotes = User::find($id)->Note()->get(); // User here is a model, Note() is a function in the User Model
        return view('usernotes')->with('usernotes', $userNotes);
    }


    public function updatepfp(Request $req, $id){
        if ($req->hasFile('profilepic')) {
            $file = $req->file('profilepic');
            $filename = time().'_'.$file->getClientOriginalName();
            $move = $file->move(public_path('uploads/profile_pics'), $filename);

            if ($move) {
                $user = User::find($id);
                $user->profile_picture = $filename;
                $save = $user->save();
                session(['user' => $user->fresh()]);

                if ($save) {
                    return redirect('/dashboard')->with('profilemessage', 'Profile picture updated successfully!');
                } else {
                    return back()->with('profilemessage', 'Failed to save profile picture.');
                }
            } else {
                return back()->with('profilemessage', 'File not moved.');
            }
        } else {
            return back()->with('profilemessage', 'No file selected.');
        }
    }
};
