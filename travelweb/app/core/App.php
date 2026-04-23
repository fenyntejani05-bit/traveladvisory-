<?php

/**
 * Application Core Class
 * 
 * Handles URL routing and controller instantiation.
 * This class is responsible for parsing the URL and directing
 * requests to the appropriate controller and method.
 * 
 * @package Core
 * @author TravelAdvisor Development Team
 * @version 1.0.0
 */
class App
{
    /**
     * Default controller name
     * 
     * @var string
     */
    protected $controller = 'Home';

    /**
     * Default method name
     * 
     * @var string
     */
    protected $method = 'index';

    /**
     * URL parameters array
     * 
     * @var array
     */
    protected $params = [];

    /**
     * Controller directory path
     * 
     * @var string
     */
    protected $controllerPath;

    /**
     * App constructor
     * 
     * Initializes the application by parsing the URL and
     * instantiating the appropriate controller and method.
     */
    public function __construct()
    {
        $this->controllerPath = __DIR__ . '/../controllers/';
        $url = $this->parseURL();

        $this->resolveController($url);
        $this->resolveMethod($url);
        $this->resolveParams($url);
        $this->execute();
    }

    /**
     * Resolves and instantiates the controller from URL
     * 
     * @param array $url Parsed URL segments
     * @return void
     */
    protected function resolveController(array &$url): void
    {
        if (isset($url[0])) {
            $controllerName = ucfirst($url[0]);
            $controllerFile = $this->controllerPath . $controllerName . '.php';

            if (file_exists($controllerFile)) {
                $this->controller = $controllerName;
                unset($url[0]);
            }
        }

        require_once $this->controllerPath . $this->controller . '.php';
        $this->controller = new $this->controller;
    }

    /**
     * Resolves the method to call from URL
     * 
     * @param array $url Parsed URL segments
     * @return void
     */
    protected function resolveMethod(array &$url): void
    {
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }
    }

    /**
     * Resolves URL parameters
     * 
     * @param array $url Parsed URL segments
     * @return void
     */
    protected function resolveParams(array $url): void
    {
        $this->params = !empty($url) ? array_values($url) : [];
    }

    /**
     * Executes the controller method with parameters
     * 
     * @return void
     */
    protected function execute(): void
    {
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    /**
     * Parses the URL from GET parameter
     * 
     * Sanitizes and splits the URL into segments for routing.
     * 
     * @return array Array of URL segments
     */
    public function parseURL(): array
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
        return [];
    }
}
