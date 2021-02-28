<?php
/*
Here i 

*/

class IndexController
{

    public static $title, $content, $date, $url;
    public static $domainToClass = [
        'vnexpress.net' => 'VNexpressParser',
        'dantri.com.vn'=>'DanTriParser',
        'vietnamnet.vn'=>'VietNamNetParser'
    ];

    private function setData()
    {

        $url = trim(strtolower($_GET['url']??'' ))??'';
        if  ( !empty($url) )
        {

            $this::$url = $url;
            $domain = trim(parse_url($url, PHP_URL_HOST));
            $data = new $this::$domainToClass[$domain]($url);
            $this::$title = $data->getTitle();
            $this::$content = $data->getContent();
            $this::$date = $data->getDate();
            
            $servername = getenv("servername");
            $username = getenv("username");
            $password = getenv("password");
            $dbname = getenv("dbname");
            $db = new Article($servername, $username, $password, $dbname);
            $db->store($this::$date,$this::$title,$this::$content,'article');
        }
        }
        
        public function doAction()
        {
            $this->setData();
        //Call view of controller
        require_once './App/Views/index.php';
    }
}