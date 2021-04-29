<?php
/**
 * Connects to Greenhouse.io webservice endpoints to pull career data
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 * 
 */

class SYNCareer
{
    /**
     * The API Endpoint to retreive data
     * @var string
     */
    protected  $careerEndpoint = 'https://api.greenhouse.io/v1/boards/synack/embed/job?id=';

    /**
     * The job opportunity ID
     * @var null
     */
    protected $jobID = null;

    /**
     * A data sent back from the API
     * 
     * @var null
     */
    private $data = null;

    /**
     * An error flag if there is a response error
     * 
     * @var null
     */
    public $error = null;

    /**
     * Constructor
     * Assign the career ID to the protected var
     *
     * @since 1.0
     */
    public function __construct($jobID)
    {
        if (intval($jobID)) {
            $this->jobID = $jobID;
        } else {
            return;
        }

        $this->getJobData();
    }

    /**
     * Get the JSON response from the API endpoint
     * 
     * @return [type] [description]
     */
    private function getJobData()
    {
        $response = wp_remote_get( $this->careerEndpoint . $this->jobID );
        if(is_wp_error($response)){
            //If there is a WP error flag for an error
            $this->error = true;
        }elseif(isset($response['response']['code']) &&  $response['response']['code'] == '404') {
            //If there is a 404 response, flag for an error
            $this->error = true;
        }else {
            $this->data = json_decode($response['body']);
            
        }
    }

    /**
     * Get Job Title
     * 
     * @return String
     */
    public function getJobTitle()
    {
        if(isset($this->data->title)){
            return $this->data->title;
        }
    }

    /**
     * Get Job Content
     * 
     * @return String
     */
    public function getJobContent()
    {
        if(isset($this->data->content)){
            return $this->data->content;
        }
    }

    /**
     * Get Job Location
     * 
     * @return String
     */
    public function getJobLocation()
    {
        if(isset($this->data->location->name)){
            return $this->data->location->name;
        }
    }

    /**
     * Get Job URL on Greenhouse.io
     * 
     * @return String
     */
    public function getJobURL(){
        if(isset($this->data->absolute_url)){
            return $this->data->absolute_url;
        }
    }

    /**
     * Get Job Department 
     * 
     * @return String
     */
    public function getJobDepartment()
    {
        if(isset($this->data->departments[0]->name)){
            return $this->data->departments[0]->name;
        }
    }
}
