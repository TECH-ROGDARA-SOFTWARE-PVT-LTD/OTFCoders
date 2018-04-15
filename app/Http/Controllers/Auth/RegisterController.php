<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use File;
use Illuminate\Support\Facades\Mail;

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
    protected $redirectTo = '/home';

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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|digits:10|max:10|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $target_dir = "images/".$data['first_name']."_".$data['phone_number']."/";
        $path = $_FILES['image_path']['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $target_file = $target_dir .$data['first_name'].'_user-profile.'.$ext;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["image_path"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
// Check if file already exists

        /*if (file_exists($target_dir)) {
            $userDirectory = $target_dir;
            if (file_exists($userDirectory)) {

                $size = 0;
                foreach (glob(rtrim($userDirectory, '/').'/*', GLOB_NOSORT) as $each) {
                    $size += is_file($each) ? filesize($each) : folderSize($each);
                }
                // here is to remove already exists pic of user
                if ( $size > 0 ) {
                    $dirPath = $userDirectory;
                    if (! is_dir($dirPath)) {
                        throw new InvalidArgumentException("$dirPath must be a directory");
                    }
                    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
                        $dirPath .= '/';
                    }
                    $files = glob($dirPath . '*', GLOB_MARK);
                    foreach ($files as $file) {
                        if (is_dir($file)) {
                            self::deleteDir($file);
                        } else {
                            unlink($file);
                        }
                    }
                    rmdir($dirPath);
                    File::makeDirectory($target_dir, 0775, true);
                }
            } else {
                File::makeDirectory($target_dir, 0775, true);
            }
        } else {
            File::makeDirectory($target_dir, 0775, true);
        }*/
// Check file size
        if ($_FILES["image_path"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
// Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
        } else {
            File::makeDirectory($target_dir, 0775, true);
            if (move_uploaded_file($_FILES["image_path"]["tmp_name"], $target_file)) {
                //echo "The file ". basename( $_FILES["image_path"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        session()->flash('message', 'We have sent you an email confirmation on '.$data['email']);
        $data['token'] = str_random(25);
        $data['image_path'] = $target_file;
        Mail::send('mails.userconfirmation',$data,function($message) use($data) {
            $message->from('inforameshgodara351@gmail.com', "OTFCoder");
            $message->subject(" E-mail from inquiry form of website ");
            $message->to("inforameshgodara351@gmail.com");
        });
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone_number' => $data['phone_number'],
            'email' => $data['email'],
            'image_path' => $data['image_path'],
            'token' => $data['token'],
            'password' => bcrypt($data['password']),
        ]);
    }
    protected function userRegistration(Request $request) {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));


        /**return $this->registered($request, $user)
        ?: redirect('registered');*/

        return $this->registered($request, $user)
            ?: redirect('welcome');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

     public function confirmation($token) {
         $user = User::where('token',$token)->first();
         if ( !is_null($user) ) {
             $user->confirmed = 1;
             $user->token= '';
             $user->save();
             session()->flash('message', 'Your account has been activated successfully');
             return redirect(route('login'));
         }
         session()->flash('message', 'There is something wrong');
         return redirect(route('login'));
     }
     public function updateUserReg( Request $request ) {

     }
}
