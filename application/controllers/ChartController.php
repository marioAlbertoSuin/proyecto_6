<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
   
class ChartController extends CI_Controller {
   
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
       $this->load->database();
       $this->load->helper('url');
    } 
  
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index(){
       

         $query = $this->db->query("SELECT x,y FROM Medidas2 ORDER BY id ASC"); 
         $data['todo'] = json_encode($query->result());

        
       
        $this->load->view('my_chart', $data);
    }

     
    public function ulti(){
        $query = $this->db->query("SELECT y,x FROM Medidas2 ORDER BY id DESC LIMIT 0,1"); 
        $ulti = json_encode($query->result());
       echo $ulti; 
    }
}
