<?php

require_once __DIR__ . '/../core/Controller.php';

class Activities extends Controller
{
    public function index(): void
    {
        $data['page_title'] = 'All Activities';
        $data['activities'] = $this->model('HomeModel')->getAllActivities();
        $this->view('activities/index', $data);
    }

    public function detail(int $id = 0): void
    {
        if ($id === 0) {
            header('Location: ' . BASEURL . '/activities');
            exit;
        }

        $data['activity'] = $this->model('HomeModel')->getActivityById($id);

        if (!$data['activity']) {
            die('404: Activity not found!');
        }

        $data['page_title'] = $data['activity']['title'];
        $this->view('activities/detail', $data);
    }
}
