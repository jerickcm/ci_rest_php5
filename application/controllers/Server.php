<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Server extends Restserver_Controller {

    public function __construct() {
        parent::__construct();
        
        // Configuration
        $config = array(
            array(
                // Nom entrant (requis)
                'field' => 'lastname',

                // Modélisation interne (option)
                'alias' => 'user.lastname|famille.pere.nom',

                // Nom du champ (option)
                'label' => 'Nom',

                // Les règles (option)
                'rules' => 'required_post|alpha|min_length[2]|max_length[250]',

                // Documentation (option)
                'comment' =>
                    "Input: lastname".PHP_EOL.
                    "Label: Nom de famille".PHP_EOL.
                    "Type: string (min 2, max 250 caractères)".PHP_EOL.
                    "Requis: POST"
            )
        );
        
        $this->restserver->set_rules($config);
    }

    /**
     * Method POST
     */
    public function post() {
    
        $lastname = $this->restserver->post('lastname');
        
        // Récupération du champ modélisé
        $alias = $this->restserver->alias();
        
        // Espace de nom 1
        $lastname = $alias['user']['lastname'];
        
        // Espace de nom 2
        $lastname = $alias['famille']['pere']['nom'];
        
        // ---------- Réponse
        $response = $this->restserver->protocol();
        $response['status'] = TRUE;
        $response['error'] = NULL;
        $response['value'] = array(
            'lastname' => $lastname
        );
        

        $this->restserver->response($response, 201);
    }
    
    /**
     * Method GET
     */
    public function get() {   
       
       $response['value'] = array(
            'lastname' => "taxoffice"
        );


        $this->restserver->response($response, 200);
    }
        
    /**
     * Method PUT
     */
    public function put() {
        $this->restserver->response();
    }
    
    /**
     * Method DELETE
     */
    public function delete() {
        $this->restserver->response();
    }

    public function content() {  
       $response['value'] = array(
            'lastname' => "taxoffice"
        );


        $this->restserver->response($response, 200);
    }

}