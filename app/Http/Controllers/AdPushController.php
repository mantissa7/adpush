<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Facebook\Facebook;
use Facebook\FacebookApp;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;


class AdPushController extends Controller{

    private $fb = null;

    private $appID = null;
    private $appSecret = null;

    public function __construct(){
      session_start();

      $test = true;

      if($test){
        //adpush - Test 1
        $this->appID = "487468384786729";
        $this->appSecret = "112c93383f3f1ac884c70c130791dd20";
      } else {
        //adpush main app
        $this->appID = "486804008186500";
        $this->appSecret = "210acafebc995e707e3b702b8c9c29e9";
      }

      $this->fb = new Facebook([
          'app_id' => $this->appID,
          'app_secret' => $this->appSecret,
          'default_graph_version' => 'v2.5'
        ]);

      //$this->fb->setDefaultAccessToken('user-access-token');
    }

    public function facebookConnect(){

        $helper = $this->fb->getRedirectLoginHelper();

        // return (string) $helper->getAccessToken();
        // exit;

        if (!isset($_SESSION['facebook_access_token'])) {
          $_SESSION['facebook_access_token'] = null;
        }

        if (!$_SESSION['facebook_access_token']) {
          $helper = $this->fb->getRedirectLoginHelper();
          try {
            $_SESSION['facebook_access_token'] = (string) $helper->getAccessToken('http://adpush.dev/feed/');
          } catch(FacebookResponseException $e) {
            // When Graph returns an error
            return 'Graph returned an error: ' . $e->getMessage();
            exit;
          } catch(FacebookSDKException $e) {
            // When validation fails or other local issues
            return 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
          }
        }

        if ($_SESSION['facebook_access_token']) {
          return "You are logged in!";
        } else {
          $permissions = ['publish_actions', 'manage_pages', 'status_update', 'pages_manage_cta', 'read_insights'];
          $loginUrl = $helper->getLoginUrl('http://adpush.dev/feed/', $permissions);
          return '<a href="' . $loginUrl . '">Log in with Facebook</a>';
        } 
    }

    public function getFeed(){

      $return = $this->fb->get('/233563893656195/feed', $_SESSION['facebook_access_token']);

      return $return->getDecodedBody();
      // return $_SESSION['facebook_access_token'];
    }

    public function submitStock(/*Request $request*/){

      $this->fb->post('/233563893656195/feed', ['message' => 'hello'], $_SESSION['facebook_access_token']);


      return "posted";

    }

    public function token(){
      return $_SESSION['facebook_access_token'];
    }

    public function insights(){
      return $this->fb->get('/233563893656195/', $_SESSION['facebook_access_token'])->getDecodedBody();
    }


    public function logout(){
       session_destroy();
       return "logout";
    }
    

}
