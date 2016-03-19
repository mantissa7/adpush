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

    private $page = "201102313595004";

    public function __construct(){
      session_start();

      $test = false;

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
            $_SESSION['facebook_access_token'] = (string) $helper->getAccessToken('http://adpush.binsym.com/');
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
          $fblogin = "<p class='middle'>You are logged in!</p>";
        } else {
          $permissions = ['publish_pages', 'manage_pages', 'read_insights'];
          $loginUrl = $helper->getLoginUrl('http://adpush.binsym.com/', $permissions);

          $fblogin = '<a class="middle" href="' . $loginUrl . '">Log in with Facebook</a>';
        }

        return view('home', ["fblogin" => $fblogin]);
    }

    public function permissions(){
      //data for feed

      $return = $this->fb->get('/me/permissions', $_SESSION['facebook_access_token']);

      return $return->getDecodedBody();
      // return $_SESSION['facebook_access_token'];
    }

    public function revokePermission(){
      //data for feed

      $this->fb->delete('/me/permissions', 'publish_actions', $_SESSION['facebook_access_token']);

      return 'deleted';
      // return $_SESSION['facebook_access_token'];
    }

    public function getFeed(){
      //data for feed

      $return = $this->fb->get('/'.$this->page.'/feed', $_SESSION['facebook_access_token']);

      return $return->getDecodedBody();
      // return $_SESSION['facebook_access_token'];
    }

    public function feed(){
      //page view for feed

      $return = $this->fb->get('/'.$this->page.'/feed', $_SESSION['facebook_access_token']);


      return view('feed', ["data" => $return->getDecodedBody()]);
    }

    public function submitStock(Request $request){


      $link = "http://adpush.binsym.com".$request->input('img');
      $message = $request->input('message');

      $this->fb->post('/'.$this->page.'/feed', 
        ['message' => $message], 
        $_SESSION['facebook_access_token']);


      return redirect('http://adpush.binsym.com/stock');

    }

    public function stock(){

      //get last feed post to show insights for
      $postID = $this->fb->get('/'.$this->page.'/feed', $_SESSION['facebook_access_token'])->getDecodedBody()['data'][0]['id'];


      //get feed data to return
      $insight = $this->fb->get('/'.$postID.'/insights', $_SESSION['facebook_access_token'])->getDecodedBody();

      return view('stock', ["data" => $insight]);

    }

    public function token(){
      return $this->page."<br><br>".$_SESSION['facebook_access_token'];
    }

    public function insights(){
      return $this->fb->get('/'.$this->page.'/insights', $_SESSION['facebook_access_token'])->getDecodedBody();
    }


    public function logout(){
       session_destroy();
       return "logout";
    }
    

}
