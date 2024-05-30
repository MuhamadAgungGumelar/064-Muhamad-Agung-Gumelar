<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use App\Models\User;
 
class AuthController extends Controller
{
    public function loginPage(){
        return view('auth.login');
    }

    public function login(Request $request){
        $user = User::where("email", $request->email)->first();

        if($user == null){
            return redirect()->back()->with("error", "User Not Found!!");
        }

        if(!Hash::check($request->password, $user->password)){
            return redirect()->back()->with("error", "Password Invalid!!"); 
        }

        $request->session()->regenerate();
        $request->session()->put('isLogged', true);
        $request->session()->put('userId', $user->id);
        $request->session()->put('role', "user");

        return redirect()->route("dashboardIndex");
    }

    public function logout(Request $request){
        session()->flush();

        return redirect()->route("home");
    }

    public function registrationPage()
    {
        return view('auth.registration');
    }

    public function registration(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = 1;
        $user->save();

        return redirect()->route("login");
    }

    public function forgotPasswordPage(){
        return view('auth.forgot_password');
    }

    public function forgotPassword(Request $request){
        $request->validate([
            'email' => 'required|string|email|max:255|exists:users,email'
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
    }

    public function resetPasswordPage(string $token){
        return view('auth.reset_password', ['token' => $token]);
    }

    public function resetPassword(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ]);
    
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}