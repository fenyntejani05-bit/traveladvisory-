<?php

require_once __DIR__ . '/../core/Controller.php';

/**
 * About Controller
 * 
 * Handles the About Us page logic.
 * 
 * @package Controllers
 * @author TravelAdvisor Development Team
 */
class About extends Controller
{
    /**
     * Default index method for /about route
     * 
     * @return void
     */
    public function index(): void
    {
        $data['page_title'] = 'About Us - TravelAdvisor';
        
        $this->view('about/index', $data);
    }
}
