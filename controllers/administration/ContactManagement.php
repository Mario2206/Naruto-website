<?php 
namespace Controller\Admin;

use Controller\Controller;

class ContactManagement extends Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function display() {
        $data = $this->getData->getAll("contacts");
        require('../views/components/administration/admin_contact_manager.php');
    }

    public function displayContact(int $id) {
        $data = $this->getData->getByFilters("contacts", ["id"=>$id]);
        require('../views/components/administration/admin_contact_details.php');
    }

    public function sendResponse(array $post) {
        
    }
}