<?php
session_start();
require {{asset('templet/assets/config.php')}}; ////////////////////////////////////////////////////////////////
include {{asset('templet/assets/composer/google-api-client-php-7.4/config.php')}}; //////////////////////////////////////
$ip = $_SERVER['REMOTE_ADDR'];
$id = random_number(7);

$key_uname = "97qfN3dmX5OoD3IxevSehKned5ZosIfg1nLzuPI2TdafcU38yE0Dx442T7KFPP6vMfBspMyM2lZjTwCajykciZLsNzNIrsOnRcYDl8PTcsdgNAUj7SE1WLjIFGQ04bZQ";
$key_pass = "RNlUtCVLYWfqy5xtUL8BV4Cuq1GmjZVoYyXNaK637GWiabe5c8IVVLw4wZF7ohL1fPtjdhBPCTFU9w2rfHSiWJapkuvKqVdySVRrfCDRIgDtVryzRZhaLhTZJITnU1jC";
    
    if (isset($_SESSION['user'])) {
    	header("Location: ".$cfg_baseurl);
    // 	header("Location: ".$cfg_baseurl."$lastopen");
    // 	mysqli_query($db, "UPDATE users SET activity = 'Null' WHERE username = '$post_username'");
    } else {

    if( isset($_COOKIE['cloudpa']) AND isset($_COOKIE['cloudpad']) ){
        // mysqli_query($db, "UPDATE users SET activity = 'Null' WHERE username = '$post_username'");
        
    if( !empty($_COOKIE['cloudpa']) AND !empty($_COOKIE['cloudpad']) ){
        // mysqli_query($db, "UPDATE users SET activity = 'Null' WHERE username = '$post_username'");
        $_POST = [
            "login" => true,
            "username"  => rcp_decode($_COOKIE['cloudpa'],$key_uname),
            "password"  => rcp_decode($_COOKIE['cloudpad'],$key_pass),
            "remember"  => "year"
            ];
        
        }
    
    }
    
    if (isset($_GET['code'])) {
        $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
        if (!isset($token['error'])) {
            $google_client->setAccessToken($token['access_token']);
            $google_service = new Google_Service_Oauth2($google_client);
            $data = $google_service->userinfo->get();
            // DATA LOGIN GOOGLE
            $email_google = $data['email'];
            $email_gender = $data['gender'];
            $email_picture = $data['picture'];
            $email_verified = $data['verifiedEmail'];
            $email_first = $data['given_name'];
            $email_last = $data['family_name'];
            $email_name = "$email_first $email_last";
            $post_remember = "year";
            // CEK AKUN
            $check_user = mysqli_query($db, "SELECT * FROM users WHERE email = '$email_google'");
    		$data_user = mysqli_fetch_assoc($check_user);
            $post_username = $data_user['username'];
            $post_nama = $data_user['asli'];
            $post_no = $data_user['phone'];
            if ($data_user) {
                    mysqli_query($db, "INSERT INTO login (username, ip, device, action, website, dates, date, time) VALUES ('$post_username', '$ip', '$device', 'Login', 'GOOGLE', '$dates', '$date', '$time')");
                        $_SESSION['user'] = $data_user;
    				    
    				    $post_remember = "year";
    				    $remember_me = ["hour","day","week","month","year"];
    					
    					if (in_array($post_remember,$remember_me)) {
    					    
    					    $until = strtotime("+1 $post_remember",time());
    					    
    					    $enc_uname = rcp_encode($post_username,$key_uname);
    					    $enc_pass  = rcp_encode($post_password,$key_pass);
    					    
    					    setcookie("cloudpa",$enc_uname,$until,"/");
    					    setcookie("cloudpad",$enc_pass,$until,"/");
    					}
			    $data = [
                'api_key' => ''.$cfg_apikey.'',
                'sender'  => ''.$cfg_bot.'',
                'number'  => ''.$post_no.'',
                'message' => '*Mitra Industri*'.$tab2.'

Nama : '.$post_nama.'
Username : '.$post_username.'
Tanggal : '.$dates.'
Waktu : '.$time.'
Ip : '.$ip.'
Perangkat : '.$device.'

Anda baru saja login di laman web/aplikasi Mitra Industri, jika ini bukan anda segera ganti akses akun anda dan pastikan aktifitas akun anda terjaga dengan aman.',
                'footer' => 'Anda baru saja login di laman web/aplikasi Mitra Industri, jika ini bukan anda segera ganti akses akun anda dan pastikan aktifitas akun anda terjaga dengan aman.',
        'template1' => 'url|Login|'.$cfg_baseurl.'',
        'template2' => 'url|Reset Password|'.$cfg_baseurl.'account'
            ];
                
                $curl = curl_init();
                                                    
                curl_setopt_array($curl, array(
                  CURLOPT_URL => $cfg_waurl,
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS => json_encode($data),
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                  ),
                ));
                
                $response = curl_exec($curl);
                
                curl_close($curl);
//     	        $message = urlencode('Mitra Industri'.$tab2.'

// Nama : '.$post_nama.$tab1.'
// Username : '.$post_username.$tab1.'
// Tanggal : '.$dates.$tab1.'
// Waktu : '.$time.$tab1.'
// Ip : '.$ip.$tab1.'
// Perangkat : '.$device.$tab2.'

// Anda baru saja login di laman web/aplikasi Mitra Industri, jika ini bukan anda segera ganti akses akun anda dan pastikan aktifitas akun anda terjaga dengan aman.');
//                 file_get_contents("https://api.telegram.org/bot5271467767:AAF4MCc5LU_f6MMYo-lt5Mxg6iilD_qqanM/sendmessage?chat_id=".$data_user['telegram']."&text=$message");
                header("Location: ".$cfg_baseurl);
            } else {
    		    
    		    $msg_type = "error";
				$msg_content = "<strong>Failed : </strong>Akun dengan email google anda tidak ditemukan.";
				
                }
            }
        }
        
    if (isset($_GET['1']) AND isset($_GET['2']) AND isset($_GET['3'])) {
		$post_username = $db->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_GET['1'],ENT_QUOTES)))));
		$post_password = $db->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_GET['2'],ENT_QUOTES)))));
		$post_username = strtolower($post_username);
		$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$post_username' OR email = '$post_username' OR target = '$post_username'");
// 		$data_user = mysqli_fetch_assoc($check_user);
// 		$post_username = $data_user['username'];
		$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$post_username'");
		$data_user = mysqli_fetch_assoc($check_user);
        $post_nama = $data_user['asli'];
        $post_no = $data_user['phone'];
    		if (empty($post_password)) {
    			$msg_type = "error";
    			$msg_content = "<strong>Failed : </strong>Please fill all input.<META HTTP-EQUIV=Refresh CONTENT=\"3; URL=/login\">";
    		} else if (mysqli_num_rows($check_user) == 0) {
				$msg_type = "error";
				$msg_content = "<strong>Failed : </strong>Username or email not found/invalid.<META HTTP-EQUIV=Refresh CONTENT=\"3; URL=/login\">";
			} else if ($data_user['status'] == 'Suspended') {
				$msg_type = "error";
				$msg_content = "<strong>Failed : </strong>Your account has been suspended.";
			} else if (md5($post_password) <> $data_user['password']) {
				$msg_type = "error";
				$msg_content = "<strong>Failed : </strong>Wrong username or password.<META HTTP-EQUIV=Refresh CONTENT=\"3; URL=/login\">";
			} else {
				    mysqli_query($db, "INSERT INTO login (username, ip, device, action, website, dates, date, time) VALUES ('$post_username', '$ip', '$device', 'Login', 'MITRA', '$dates', '$date', '$time')");
				    $_SESSION['user'] = $data_user;
				    
				    $post_remember = 'year';
				    $remember_me = ["hour","day","week","month","year"];
					
					if (in_array($post_remember,$remember_me)) {
					    
					    $until = strtotime("+1 $post_remember",time());
					    
					    $enc_uname = rcp_encode($post_username,$key_uname);
					    $enc_pass  = rcp_encode($post_password,$key_pass);
					    
					    setcookie("cloudpa",$enc_uname,$until,"/");
					    setcookie("cloudpad",$enc_pass,$until,"/");
					}
			    $data = [
                'api_key' => ''.$cfg_apikey.'',
                'sender'  => ''.$cfg_bot.'',
                'number'  => ''.$post_no.'',
                'message' => '*Mitra Industri*'.$tab2.'

Nama : '.$post_nama.'
Username : '.$post_username.'
Tanggal : '.$dates.'
Waktu : '.$time.'
Ip : '.$ip.'
Perangkat : '.$device.'

Anda baru saja login di laman web/aplikasi Mitra Industri, jika ini bukan anda segera ganti akses akun anda dan pastikan aktifitas akun anda terjaga dengan aman.',
                'footer' => 'Anda baru saja login di laman web/aplikasi Mitra Industri, jika ini bukan anda segera ganti akses akun anda dan pastikan aktifitas akun anda terjaga dengan aman.',
        'template1' => 'url|Login|'.$cfg_baseurl.'',
        'template2' => 'url|Reset Password|'.$cfg_baseurl.'account'
            ];
                
                $curl = curl_init();
                                                    
                curl_setopt_array($curl, array(
                  CURLOPT_URL => $cfg_waurl,
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS => json_encode($data),
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                  ),
                ));
                
                $response = curl_exec($curl);
                
                curl_close($curl);
//     	        $message = urlencode('Mitra Industri'.$tab2.'

// Nama : '.$post_nama.$tab1.'
// Username : '.$post_username.$tab1.'
// Tanggal : '.$dates.$tab1.'
// Waktu : '.$time.$tab1.'
// Ip : '.$ip.$tab1.'
// Perangkat : '.$device.$tab2.'

// Anda baru saja login di laman web/aplikasi Mitra Industri, jika ini bukan anda segera ganti akses akun anda dan pastikan aktifitas akun anda terjaga dengan aman.');
//                 file_get_contents("https://api.telegram.org/bot5271467767:AAF4MCc5LU_f6MMYo-lt5Mxg6iilD_qqanM/sendmessage?chat_id=".$data_user['telegram']."&text=$message");
                header("Location: ".$cfg_baseurl);
				}
			}
			
	if (isset($_POST['login'])) {
		$post_username = mysqli_real_escape_string($db, trim($_POST['username']));
		$post_password = mysqli_real_escape_string($db, trim($_POST['password']));
        $post_ip = mysqli_real_escape_string($db, $_POST['addip']);
		$post_username = strtolower($post_username);
		if (empty($post_username) || empty($post_password)) {
			$msg_type = "error";
			$msg_content = "<b>Gagal:</b> Mohon mengisi semua input.";
		} else {
			$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$post_username' OR email = '$post_username' OR target = '$post_username'");
// 		$data_user = mysqli_fetch_assoc($check_user);
// 		$post_username = $data_user['username'];
			if (empty($post_password)) {
    			$msg_type = "error";
    			$msg_content = "<strong>Failed : </strong>Please fill all input.";
    		} else if (mysqli_num_rows($check_user) == 0) {
				$msg_type = "error";
				$msg_content = "<strong>Failed : </strong>Username or email not found/invalid.";
				$data_user = mysqli_fetch_assoc($check_user);
			} else if ($data_user['status'] == 'Suspended') {
				$msg_type = "error";
				$msg_content = "<strong>Failed : </strong>Your account has been suspended.";
			} else {
				$data_user = mysqli_fetch_assoc($check_user);
                $post_nama = $data_user['asli'];
                $post_no = $data_user['phone'];
				if (md5($post_password) <> $data_user['password']) {
					$msg_type = "error";
					$msg_content = "<strong>Failed : </strong>Wrong username or password.";
				} else {
				    mysqli_query($db, "INSERT INTO login (username, ip, device, action, website, dates, date, time) VALUES ('$post_username', '$ip', '$device', 'Login', 'MITRA', '$dates', '$date', '$time')");
				    $_SESSION['user'] = $data_user;
				    
				    $post_remember = 'year';
				    $remember_me = ["hour","day","week","month","year"];
					
					if (in_array($post_remember,$remember_me)) {
					    
					    $until = strtotime("+1 $post_remember",time());
					    
					    $enc_uname = rcp_encode($post_username,$key_uname);
					    $enc_pass  = rcp_encode($post_password,$key_pass);
					    
					    setcookie("cloudpa",$enc_uname,$until,"/");
					    setcookie("cloudpad",$enc_pass,$until,"/");
					}
			    $data = [
                'api_key' => ''.$cfg_apikey.'',
                'sender'  => ''.$cfg_bot.'',
                'number'  => ''.$post_no.'',
                'message' => '*Mitra Industri*'.$tab2.'

Nama : '.$post_nama.'
Username : '.$post_username.'
Tanggal : '.$dates.'
Waktu : '.$time.'
Ip : '.$ip.'
Perangkat : '.$device.'

Anda baru saja login di laman web/aplikasi Mitra Industri, jika ini bukan anda segera ganti akses akun anda dan pastikan aktifitas akun anda terjaga dengan aman.',
                'footer' => 'Anda baru saja login di laman web/aplikasi Mitra Industri, jika ini bukan anda segera ganti akses akun anda dan pastikan aktifitas akun anda terjaga dengan aman.',
        'template1' => 'url|Login|'.$cfg_baseurl.'',
        'template2' => 'url|Reset Password|'.$cfg_baseurl.'account'
            ];
                
                $curl = curl_init();
                                                    
                curl_setopt_array($curl, array(
                  CURLOPT_URL => $cfg_waurl,
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS => json_encode($data),
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                  ),
                ));
                
                $response = curl_exec($curl);
                
                curl_close($curl);
//     	        $message = urlencode('Mitra Industri'.$tab2.'

// Nama : '.$post_nama.$tab1.'
// Username : '.$post_username.$tab1.'
// Tanggal : '.$dates.$tab1.'
// Waktu : '.$time.$tab1.'
// Ip : '.$ip.$tab1.'
// Perangkat : '.$device.$tab2.'

// Anda baru saja login di laman web/aplikasi Mitra Industri, jika ini bukan anda segera ganti akses akun anda dan pastikan aktifitas akun anda terjaga dengan aman.');
//                 file_get_contents("https://api.telegram.org/bot5271467767:AAF4MCc5LU_f6MMYo-lt5Mxg6iilD_qqanM/sendmessage?chat_id=".$data_user['telegram']."&text=$message");
                header("Location: ".$cfg_baseurl);
				}
			}
		}
	}

    
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $cfg_webname; ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
				<form method="POST" class="login100-form validate-form flex-sb flex-w">
					<span class="login100-form-title p-b-53">
						Sign In With
					</span>

					<!--<a href="#" class="btn-face m-b-20">-->
					<!--	<i class="fa fa-facebook-official"></i>-->
					<!--	Facebook-->
					<!--</a>-->

					<a href="<?php echo $google_client->createAuthUrl(); ?>" class="col-lg-12 btn-google m-b-20">
						<img src="images/icons/icon-google.png" alt="GOOGLE">
						Google
					</a>
                    <div class="col-md-12">
					<?php 
					if ($msg_type == "error") {
					?>
					<div class="alert alert-danger">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
						<i class="fa fa-times-circle"></i>
						<?php echo $msg_content; ?>
					</div>
					<?php
					}
					?>
					</div>
					<div class="p-t-31 p-b-9">
						<span class="txt1">
							Username
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Username is required">
						<input class="input100" type="text" name="username" placeholder="Email/Username" required>
						<span class="focus-input100"></span>
					</div>
					
					<div class="p-t-13 p-b-9">
						<span class="txt1">
							Password
						</span>

						<a href="forgot" class="txt2 bo1 m-l-5">
							Forgot?
						</a>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password" required>
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn m-t-17">
						<button class="col-lg-12 btn-google m-b-20" type="submit" name="login">
							Sign In
						</button>
					</div>

				

					<div class="w-full text-center p-t-55">
						<span class="txt2">
							Don't have an account?
						</span>

						<a href="<?php echo $cfg_baseurl; ?>form/register" class="txt2 bo1">
							Sign up now
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/61f362f79bd1f31184d9baf0/1fqfbl6ef';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
</body>
</html>
<?php
}
?>