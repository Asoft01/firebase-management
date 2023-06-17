<?php

namespace App\Http\Controllers;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Illuminate\Http\Request;

class FirebaseAuthController extends Controller
{
    protected $auth; 
    public function __construct(){
        $this->auth = Firebase::auth();

        $uid = 'some-uid';

        $customToken = $auth->createCustomToken($uid);
        
        $idTokenString = 'the custom token';

        try {
            $verifiedIdToken = $auth->verifyIdToken($idTokenString);
        } catch (FailedToVerifyToken $e) {
            echo 'The token is invalid: '.$e->getMessage();
        }

        $uid = $verifiedIdToken->claims()->get('sub');
        $user = $auth->getUser($uid);
    }

    public function auth(Request $request){
        $email = $request->input('email'); 
        $password = $request->input('password'); 

        $response = $this->auth()->signInWithEmailPassword($email, $password);
        return $response;
    }
}
