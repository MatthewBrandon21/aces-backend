<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Labscategory;
use App\Models\Repositorylabs;
use App\Models\Imagefolder;
use App\Models\Ticket;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'sendResetLink', 'resetPassword']]);
    }
    
    public function register(){
        $validator = Validator::make(request()->all(),[
            'name' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255',
            'passwordconfirm' => 'required|same:password|min:5|max:255'
        ]);
        if($validator->fails()){
            return response()->json($validator->messages());
        }
        $user = User::create([
            'name' => request('name'),
            'username' => request('username'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
        ]);
        if($user){
            return response()->json(['message' => 'Successful Registration!']);
        } else {
            return response()->json(['message' => 'Registration Failed!']);
        }
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    public function labs_list_member()
    {
        if(request('labscategory')){
            $labscategory = Labscategory::firstWhere('slug', request('labscategory'));
        }
        if(request('author')){
            $author = User::firstWhere('username', request('author'));
        }
        $repositories = Repositorylabs::where('user_id', auth()->user()->id)->latest()->filter(request(['search', 'labscategory', 'author']))->paginate(10)->withQueryString();
        foreach ($repositories as $repository){
            if($repository->image != null){
                $repository->image = asset('storage/' . $repository->image);
            }
        }
        return $repositories;
    }

    public function labs_create_member()
    {
        $validator = Validator::make(request()->all(),[
            'title' => 'required|max:255',
            'slug' => 'required|unique:repositorylabs',
            'labscategory_id' => 'required',
            'image' => 'image|file|max:2048',
            'body' => 'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->messages());
        }
        $image = null;
        if(request()->file('image')){
            $image = request()->file('image')->store('repositories-images');
        }
        $user_id = auth()->user()->id;
        $excerpt = Str::limit(strip_tags(request('body')), 200);
        $repositorylabs = Repositorylabs::create([
            'title' => request('title'),
            'slug' => request('slug'),
            'labscategory_id' => request('labscategory_id'),
            'body' => request('body'),
            'image' => $image,
            'user_id' => $user_id,
            'excerpt' => $excerpt
        ]);
        if($repositorylabs){
            return response()->json(['message' => 'New repository has been added!']);
        } else {
            return response()->json(['message' => 'Data creation failed!']);
        }
    }

    public function labs_show_member(Repositorylabs $repositorylabs)
    {
        if($repositorylabs->user_id != auth()->user()->id){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $repositorylabs->image = asset('storage/' . $repositorylabs->image);
        return $repositorylabs;
    }

    public function labs_update_member(Repositorylabs $repositorylabs)
    {
        if($repositorylabs->user_id != auth()->user()->id){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $rules = [
            'title' => 'required|max:255',
            'labscategory_id' => 'required',
            'image' => 'image|file|max:2048',
            'body' => 'required'
        ];
        if(request('slug') != $repositorylabs->slug){
            $rules['slug'] = 'required|unique:repositorylabs';
        }
        $validator = Validator::make(request()->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->messages());
        }
        $image = $repositorylabs->image;
        if(request()->file('image')){
            if($repositorylabs->image){
                Storage::delete($repositorylabs->image);
            }
            $image = request()->file('image')->store('repositories-images');
        }
        $user_id = auth()->user()->id;
        $excerpt = Str::limit(strip_tags(request('body')), 200);
        $repositorylabs = Repositorylabs::where('id', $repositorylabs->id)->update([
            'title' => request('title'),
            'slug' => request('slug'),
            'labscategory_id' => request('labscategory_id'),
            'body' => request('body'),
            'image' => $image,
            'user_id' => $user_id,
            'excerpt' => $excerpt
        ]);
        if($repositorylabs){
            return response()->json(['message' => 'Repository has been updated!']);
        } else {
            return response()->json(['message' => 'Data updation failed!']);
        }
    }

    public function labs_delete_member(Repositorylabs $repositorylabs)
    {
        if($repositorylabs->user_id != auth()->user()->id){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        if($repositorylabs->image){
            Storage::delete($repositorylabs->image);
        }
        Repositorylabs::destroy($repositorylabs->id);
        return response()->json(['message' => 'Repository has been deleted!']);
    }

    public function labs_checkSlug(Request $request){
        $slug = SlugService::createSlug(Repositorylabs::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }

    public function imagefolder_list_member()
    {
        if(request('author')){
            $author = User::firstWhere('username', request('author'));
            $title = ' by ' . $author->name;
        }
        $imagefolders = Imagefolder::where('user_id', auth()->user()->id)->latest()->filter(request(['author']))->paginate(6)->withQueryString();
        foreach ($imagefolders as $imagefolder){
            if($imagefolder->image != null){
                $imagefolder->image = asset('storage/' . $imagefolder->image);
            }
        }
        return $imagefolders;
    }

    public function imagefolder_create_member()
    {
        $validator = Validator::make(request()->all(),[
            'image' => 'required|image|file|max:2048',
        ]);
        if($validator->fails()){
            return response()->json($validator->messages());
        }
        $image = null;
        if(request()->file('image')){
            $image = request()->file('image')->store('images-folder');
        }
        $user_id = auth()->user()->id;
        $imagefolders = Imagefolder::create([
            'image' => $image,
            'user_id' => $user_id
        ]);
        if($imagefolders){
            return response()->json(['message' => asset('storage/' . $image)]);
        } else {
            return response()->json(['message' => 'Image upload failed!']);
        }
    }

    public function imagefolder_delete_member(Imagefolder $imagefolder)
    {
        if($imagefolder->user_id != auth()->user()->id){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        if($imagefolder->image){
            Storage::delete($imagefolder->image);
        }
        Imagefolder::destroy($imagefolder->id);
        return response()->json(['message' => 'Image has been deleted!']);
    }

    public function ticket_list_member()
    {
        if(request('author')){
            $author = User::firstWhere('username', request('author'));
        }
        $tickets = Ticket::where('user_id', auth()->user()->id)->get();
        return $tickets;
    }

    public function ticket_create_member()
    {
        $validator = Validator::make(request()->all(),[
            'title' => 'required|max:255',
            'slug' => 'required|unique:repositorylabs',
            'body' => 'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->messages());
        }
        $status = "Pending";
        $user_id = auth()->user()->id;
        $ticket = Ticket::create([
            'title' => request('title'),
            'slug' => request('slug'),
            'body' => request('body'),
            'status' => $status,
            'user_id' => $user_id,
        ]);
        if($ticket){
            return response()->json(['message' => 'New ticket has been added! We will contact you shortly!']);
        } else {
            return response()->json(['message' => 'Data creation failed!']);
        }
    }

    public function ticket_show_member(Ticket $ticket)
    {
        if($ticket->user_id != auth()->user()->id){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $ticket;
    }

    public function ticket_checkSlug(Request $request){
        $slug = SlugService::createSlug(Ticket::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }

    public function sendResetLink(Request $request){
        $validator = Validator::make(request()->all(),[
            'email'=>'required|email|exists:users,email'
        ]);
        if($validator->fails()){
            return response()->json($validator->messages());
        }

        $token = \Str::random(64);
        \DB::table('password_resets')->insert([
              'email'=>$request->email,
              'token'=>$token,
              'created_at'=>Carbon::now(),
        ]);
        
        $action_link = "https://aces.umn.ac.id/forgot-password";
        $body = "We are received a request to reset the password for <b>ACES UMN Website </b> account associated with ".$request->email.". You can reset your password by clicking the link below";

       \Mail::send('email-forgot-api',['action_link'=>$action_link,'body'=>$body, 'token'=>$token, 'email'=>$request->email], function($message) use ($request){
             $message->from('aces@umn.ac.id','ACES UMN Website');
             $message->to($request->email,'ACES UMN Website')
                     ->subject('Reset Password Account for ACES UMN Website');
       });

       return response()->json(['message' => 'We have e-mailed your password reset instruction!']);
    }

    public function resetPassword(Request $request){
        $request->validate([
            'email'=>'required|email|exists:users,email',
            'password'=>'required|min:5|confirmed',
            'password_confirmation'=>'required',
        ]);

        $check_token = \DB::table('password_resets')->where([
            'email'=>$request->email,
            'token'=>$request->token,
        ])->first();

        if(!$check_token){
            return response()->json(['message' => 'Invalid token!']);
        }else{

            User::where('email', $request->email)->update([
                'password'=>\Hash::make($request->password)
            ]);

            \DB::table('password_resets')->where([
                'email'=>$request->email
            ])->delete();

            return response()->json(['message' => 'Your password have been changed!']);
        }
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
