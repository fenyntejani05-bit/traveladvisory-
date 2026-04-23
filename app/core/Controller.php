<?php

/**
 * Base Controller Class
 * 
 * Provides common functionality for all controllers including
 * view rendering and model instantiation. All application
 * controllers should extend this class.
 * 
 * @package Core
 * @author TravelAdvisor Development Team
 * @version 1.0.0
 */
class Controller
{
    /**
     * Renders a view with optional data
     * 
     * Automatically determines whether to use admin or user layout
     * based on the view path. Includes header, view content, and footer.
     * 
     * @param string $view View file name (without .php extension)
     * @param array $data Data to pass to the view
     * @return void
     */
    public function view(string $view, array $data = []): void
    {
        $viewPath = '../app/views/' . $view . '.php';
        
        if (!file_exists($viewPath)) {
            die("View file not found: {$viewPath}");
        }

        if (strpos($view, 'admin/') === 0) {
            $this->renderAdminView($viewPath, $data);
        } else {
            $this->renderUserView($viewPath, $data);
        }
    }

    /**
     * Renders admin view with admin layout
     * 
     * @param string $viewPath Full path to view file
     * @param array $data Data to pass to view
     * @return void
     */
    protected function renderAdminView(string $viewPath, array $data): void
    {
        extract($data);
        require_once '../app/views/layouts/admin_header.php';
        require_once $viewPath;
        require_once '../app/views/layouts/admin_footer.php';
    }

    /**
     * Renders user view with user layout
     * 
     * @param string $viewPath Full path to view file
     * @param array $data Data to pass to view
     * @return void
     */
    protected function renderUserView(string $viewPath, array $data): void
    {
        extract($data);
        require_once '../app/views/layouts/header.php';
        require_once $viewPath;
        require_once '../app/views/layouts/footer.php';
    }

    /**
     * Instantiates and returns a model instance
     * 
     * @param string $model Model class name (without 'Model' suffix)
     * @return object Model instance
     * @throws Exception If model file not found
     */
    public function model(string $model): object
    {
        $modelFile = __DIR__ . '/../models/' . $model . '.php';

        if (!file_exists($modelFile)) {
            throw new Exception("Model '{$model}' not found at: {$modelFile}");
        }

        require_once $modelFile;
        return new $model();
    }
}
