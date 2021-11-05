<?php
// Singleton Pattern
// Imagine you have a config class
class Config {
    private $data;
    private static $instance;
    /**
     * Config constructor.
     * @param $data
     */
    private function __construct()
    {
        echo "Load file" . PHP_EOL;
        // load configuration
        $json_data = json_decode(file_get_contents(__DIR__ . '/application.json'), true);
        $this->data = $json_data;
    }

    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new Config();
        }
        return self::$instance;
    }

    public function get($key){
        if(!isset($key)){
            throw new Exception("Key $key not in config");
        }
        return $this->data[$key];
    }
}

function level1(){
    echo "START Level 1" . PHP_EOL;
    $config = Config::getInstance();
    echo "PAGE_SIZE : " . $config->get('PAGE_SIZE') .PHP_EOL;
    // how to access config instance?
    level2();    
}

function level2(){
    echo "START Level 2" . PHP_EOL;
    $config = Config::getInstance();
    echo "PAGE_SIZE : " . $config->get('PAGE_SIZE') .PHP_EOL;
    // how to access config instance?
    level3();
}

function level3(){
    echo "START Level 3" . PHP_EOL;
    $config = Config::getInstance();
    echo "PAGE_SIZE : " . $config->get('PAGE_SIZE') .PHP_EOL;
    // how to access config instance?
}

function singleton_main(){
    $config = Config::getInstance();
    echo "DB_HOST : " . $config->get('DB_HOST') .PHP_EOL;
    level1();
}

singleton_main();