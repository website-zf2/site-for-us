<?php
/*
	A simple User SSO
	用户单点登录
	Author　Ray Zheng 201307
*/
ddd
date_default_timezone_set('Asia/Shanghai');
define("SOAP_CLIENT_BASEDIR", "soapclient");
require_once (SOAP_CLIENT_BASEDIR.'/SforceEnterpriseClient.php');
require_once (SOAP_CLIENT_BASEDIR.'/SforceHeaderOptions.php');
//any consts
session_start();
$debug = false;
$https = false; //是否要输出安全链接
if($debug)
	$toolsUrl = 'http://tools.linux.directhr.nb';
else
	$toolsUrl = 'http://newtools.directhr.net';
	
if($debug)
	$ssoUrl = 'http://sso.linux.directhr.nb';
else
	$ssoUrl = 'http://login.directhr.net';
	
$allowSite = array('directhr.net', 'directhr.cn', 'matchengine','ray.dhr');
$defaultPage = array(
	'tools.ray.dhr' => 'http://tools.ray.dhr/emailtrace/index',
	'macthengine.ray.dhr' => 'http://matchengine.ray.dhr',
	'sso.ray.dhr' => 'http://tools.ray.dhr/index',
	'newtools.directhr.net'=> 'http://newtools.directhr.net/emailtrace/index',
	'macthengine.directhr.net' => 'http://matchengine.directhr.net',
	
);
if($debug)
	$con = mysql_connect('172.31.20.1','root','Superman3000');
else
	$con = mysql_connect('172.32.100.53','cmliew_dhr','FnVrctd2fX8C5HNj');
if($debug)
	$memcache_options = array('IP'=>'172.31.20.1', 'port'=>'11211');
else
	$memcache_options = array('IP'=>'172.32.100.52', 'port'=>'11211');
$memcache = new Memcache();
$memcache->connect($memcache_options['IP'], $memcache_options['port']);

$db_selected=mysql_select_db('cmliew_dhr', $con);
$error = array('website'=>'the website [WEBSITE] error! Please contact r.zheng@directhr.cn',
	'datebase'=>'datebase [DATABASE] error! Please contact r.zheng@directhr.cn',
	'table'=>'table [TABLE] error! Please contact r.zheng@directhr.cn',
	'query'=>'query [QUERY] error! Please contact r.zheng@directhr.cn',
	'validate'=>'validate [VALIDATE] error! Please contact r.zheng@directhr.cn',
	'userNonExist'	=> 'Your account is not existed or not actived! Please contact r.zheng@directhr.cn',
	'password'		=> 'Password Incorrect!');
$errorMessage = '';

/*
 * action login page
 */
$action = isset($_GET['action'])?$_GET['action'] : null;
$from = '';
$fromForce = false;//检查是不是有force的sessionid,如果有，则向force提交验证请求。

if(isset($_GET['forcesessionid']))
{
	$fromForce = true;
	$forceSessionId = $_GET['forcesessionid'];
	$action = 'login';
	$forceEndUrl = $_GET['forceendurl'];
}
if(isset($_GET['gid']))
{
	$action = 'login';
}
if($action == 'login')
{
	$checkPassword = true;
	$loginQuery = false;
	if($fromForce)
	{
		try{
			$sfdc = new SforceEnterpriseClient();
			$sfdc_connection = $sfdc->createConnection("http://newtools.directhr.net/library/Dhr/Force/soapclient/enterprise.wsdl.xml");
			$sfdc->setSessionHeader($forceSessionId);
			$sfdc->setEndpoint($forceEndUrl);
			$userInfo = $sfdc->getUserInfo();
			if($userInfo)
			{
				$userName = $userInfo->userEmail;
				$checkPassword = false;
			}
		}catch (Exception $e)
		{
			var_dump($e);
		}

	}elseif(isset($_GET['gid']) && is_numeric($_GET['gid']))
	{
		$loginQuery = "SELECT * FROM users WHERE isActive=1 AND (GmailId='" . $_GET['gid']. "')" ;
		$checkPassword = false; //the password checking is not required when have gmial id from gmail content.
//		$https = true;
//		$toolsUrl = str_replace('http', 'https', $toolsUrl);
//		$ssoUrl = str_replace('http', 'https', $ssoUrl);
	}else
	{
		$userName = $_POST['username'];
		$password = $_POST['password'];
		$from = $_POST['from'];
	}
	if(!$loginQuery)//default query
		$loginQuery = "SELECT u.*, f.IdInForce FROM users u LEFT JOIN setting_force f ON u.Email = f.Email WHERE u.isActive=1 AND u.Email='$userName'" ;
		$result = mysql_query($loginQuery);
		$loginUser = mysql_fetch_array($result, MYSQL_ASSOC);

		if($loginUser)
		{
			if($loginUser['Password'] == md5($password) || !$checkPassword)
			{
				$userVerified = true;
				$memcachHash = uniqid('user');
				$_SESSION['Login_User'] = $memcachHash;
				$memcache->set($memcachHash, json_encode($loginUser));
				log_write('Write to Memcache: ' . serialize($loginUser) ."\nID:" . $memcachHash . "\nServer: " . serialize($_SERVER));
			}else
				$errorMessage = $error['password'];
	}
	else
	{
		$errorMessage = $error['userNonExist'];
		if(isset($_GET['gid']))
			$errorMessage .= '<br/>The Gid is ' . $_GET['gid'];
	}
}

if($action == 'logout')
{
	if(isset($_SESSION['Login_User']))
	{
		$memcache->delete($_SESSION['Login_User']);
		echo 'logout' . $memcache->get($_SESSION['Login_User']);
		unset($_SESSION['Login_User']);

	}

}

if($action == 'validate')
{
	$secret=$_GET['validate'];  //validate number
	$sessionId=$_GET["sessionid"];
	$website=$_GET["website"];

	if(in_array($website, $allowSite) || $debug)   //if moodle or matchengine post
	{
		if ($con)
		{

			if ($db_selected)
			{
				$result = mysql_query("SELECT * FROM users where LoginId= '$sessionId' AND IsActive='1' ");
				if($result)
				{
					$row = mysql_fetch_array($result);
					date_default_timezone_set("PRC");
					$tokenKey = $date=date("dYH"); //Y=2012 m=12月 d=17号 H=14时 i=分

					$clientValidate=md5($sessionId.$website.'directhr2012'.$date);
					if($clientValidate==$secret || substr($_SERVER['REMOTE_ADDR'],0,6) == '172.32')
					{
						if($website=="matchengine")
						{
							echo json_encode ($row['Email']);
						}

						else
						{
							echo json_encode($row);
						}

					}
					else
					{
						echo json_encode(array("error"=>$errorLog['validate']));
					}
				}
				else
					echo json_encode(array("error"=>$errorLog['query']));
			}else
				echo json_encode(array("error"=>$errorLog['table']));
		}
		else
			echo json_encode(array("error"=>$errorLog['datebase']));
	}
	else
	{
		echo json_encode(array("error"=>$errorLog['website']));
	}
}else
{
	if($from == '')
	{
		if(isset($_GET['from']))
			$from = $_GET['from'];
		elseif('http://' . $_SERVER['HTTP_HOST'] != $ssoUrl)
			$from = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	}
	$from = checkHttp($from, $allowSite, $defaultPage, $debug);
	if(isset($_SESSION['Login_User']) && $from)
	{
		$memcachHash = $_SESSION['Login_User'];
		$loginUser = $memcache->get($memcachHash);
		if($loginUser)
		{
			$parameters = parse_url($from, PHP_URL_QUERY);
			log_write('Parameters: ' . serialize($parameters) ."\nSession: " . serialize($_SESSION) . "\nServer: " . serialize($_SERVER));
			if($parameters)
				http_redirect(urldecode($from) . "&sessionid=$memcachHash");
				//echo($from . '&sessionid=' . $memcachHash);
				//header("Location:" . urldecode($from) . "&sessionid=$memcachHash");
				//var_dump(urldecode($from) . "&sessionid=$memcachHash");
			else
				//echo(str_replace('#', '%23', $from) . '?sessionid=' . $memcachHash);
				//header("Location:" . urldecode($from) . "?sessionid=$memcachHash");
				http_redirect(str_replace('#', '%23', urldecode($from)) . '?sessionid=' . $memcachHash);
				//var_dump(urldecode($from) . "?sessionid=$memcachHash");
			exit();
		}

	}
	
	$loginHTML = file_get_contents(realpath('login.html'));
	if($from)
	{
		$loginHTML = str_replace(array('[TOOLSURL]', '[FROM]', '[ERROR]'), array($toolsUrl, repairHttp($from), $errorMessage), $loginHTML);
		echo $loginHTML;
	}


}

function checkHttp($httpUrl, $allowSites, $defaultPages, $debug=false)
{
	if($httpUrl == '') return false;
	$httpUrl = repairHttp($httpUrl);
	$host = parseHost($httpUrl);
	if(strpos($httpUrl, 'logout')!==false)
	{
		$httpUrl = $defaultPages[$host[2]];
		$host = parseHost($httpUrl);
	}

	if(in_array($host[1], $allowSites) || $debug)
		return $httpUrl;
	else
		return false;
}

function repairHttp($httpUrl)
{
	$httpUrl = str_ireplace(array('http%3A%2F%2F', 'https%3A%2F%2F','%2F','%3F','%3D','%26'), array('http://', 'https://', '/','?','=','&'), $httpUrl);
	$httpUrl = preg_replace('/[&\?]sessionid=\w+/i', '', $httpUrl);
	if(substr($httpUrl,0,7) != 'http://' && substr($httpUrl,0,8) != 'https://')
		return 'http://' . $httpUrl;
	else
		return $httpUrl;
}
function parseHost($httpUrl)
{

	$httpUrl = strtolower( trim($httpUrl) );
	if(empty($httpUrl)) return ;
	$regx1 = '/https?:\/\/(([^\/\?#&]+\.)?([^\/\?#&\.]+\.)(com\.cn|org\.cn|net\.cn|com\.jp|co\.jp|com\.kr|com\.tw)(\:[0-9]+)?)\/?/i';
	$regx2 = '/https?:\/\/(([^\/\?#&]+\.)?([^\/\?#&\.]+\.)(cn|com|org|info|us|fr|de|tv|net|cc|biz|hk|jp|kr|name|me|tw|la|dhr)(\:[0-9]+)?)\/?/i';
	$host = $tophost = '';
	if(preg_match($regx1,$httpUrl,$matches))
	{
		$host = $matches[1];
	} elseif(preg_match($regx2, $httpUrl, $matches)) {
		$host = $matches[1];
	}
	if($matches)
	{
		$tophost = $matches[3].$matches[4];
		$domainLevel = $matches[2] == 'www.' ? 1:(substr_count($matches[2],'.')+1);
	} else {
		$tophost = '';
		$domainLevel = 0;
	}
	return array($domainLevel,$tophost,$host);
}
function log_write($content)
{
	$filename = realpath('log') . "/login_log.txt";
	if (!is_file($filename)) {
		$file = fopen($filename, 'x');
	} else {
		$file = fopen($filename, 'a');
	}
	$stamp = "\n+++ " . date('r') . " : " . time() . " : +++\n";
	fwrite($file, $stamp);
	fwrite($file, $content);
	fwrite($file, "\n---------------------------------------------------\n");
	$retVal = fclose($file);
}
