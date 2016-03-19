<?php

use Facebook\Facebook;
use Facebook\FacebookApp;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

	//TODO: move below php to lumen framework
	class FbMetrics{

		private $fb = null;

	    private $appID = null;
	    private $appSecret = null;

	    private $page = "201102313595004";

	    private $postID = null;

	    private $insight = null;

	    public function __construct($postID){

	    	$this->postID = $postID;

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


	      //get feed data to return
	      	
	      	$this->insight = $this->fb->get('/'.$postID.'/insights', $_SESSION['facebook_access_token'])->getDecodedBody();
	    }

	    public function test(){
	    	return "hello world";
	    }


		public function likes(){
			$likes = 0;

			foreach($this->insight['data'] as $metric){
				if($metric['name'] == "post_reactions_like_total"){
					return $metric['values'][0]['value'];
				}
			}
		}

	}
	
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>adPush feed</title>
	<link rel="stylesheet" type="text/css" href="/css/main.css">
	<link rel="stylesheet" type="text/css" href="/css/header.css">
	<link rel="stylesheet" type="text/css" href="/css/content.css">
	<link rel="stylesheet" type="text/css" href="/css/feed.css">
	<link rel="stylesheet" type="text/css" href="/css/bsmodal.css">
	
</head>
<body>
	<nav>
		<h1>Facebook Page Feed</h1>
	</nav>
	
	<div id="main">

		<?php if(count($data['data'] > 0)){ ;?>

			<?php foreach($data['data'] as $post){ 
			
				$info = new FbMetrics($post['id']);	
			?>
				<div class="box">
		  			<div class="heading"><h2><?php echo $post['created_time']; ?></h2></div>
		  			<div class="box-inner">
						<?php echo $post['message']; ?>
					</div>
					<div class="box-info">
						<span>Likes:&nbsp;<?php echo $info->likes();?></span>
						<span class="boost"><button>Boost</button></span>
					</div>
				</div>
			<?php }; ?>

		<?php } else {?>
			<div class="box">
				No Posts
			</div>
		<?php } ;?>

	</div>

	<div id="boostModal" class="modal-data">
		<div class="bsmodal-title">Disabled</div>
		<div class="bsmodal-body">
			<p>This feature has been disabled by the administrator</p>
		</div>
	</div>

	<script type="text/javascript" src="/js/bsTemplate.class.js"></script>
	<script type="text/javascript" src="/js/bsModal.js"></script>

	<script type="text/javascript">
	'use strict';
		
		var boosts = document.getElementsByClassName('boost');

		for(let i = 0; i < boosts.length; i++){

			boosts[i].addEventListener('click', function(e){

				var modal = new bsModal();

				modal.open('boostModal', {
					'type' : 'div'
				});
			});
		}

	</script>
</body>
</html>