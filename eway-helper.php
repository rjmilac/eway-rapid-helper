<?php

    class EwayRapidHelper{

        private $api_key, $api_password, $api_url, $sandbox_mode, $active_endpoint;
        protected $client;

        public function __construct(){

            $this->initializeClient();

        }

        private function initializeClient() {

            $this->api_key = get_field('eway_rapid_api_key', 'option');
            $this->api_password = get_field('eway_rapid_api_password', 'option');
            $this->api_endpoint = get_field('rapid_api_endpoint', 'option');
            $this->api_sandbox_endpoint = get_field('rapid_api_sandbox_endpoint', 'option');
            $this->sandbox_mode = get_field('rapid_api_sanbox_mode', 'option');

            $this->active_endpoint = ( !$this->sandbox_mode ) ? $this->api_endpoint : $this->api_sandbox_endpoint; 

            $this->client = \Eway\Rapid::createClient(
                $this->api_key, 
                $this->api_password, 
                $this->active_endpoint
            );

        }

        public function setEndpoint($endpoint) {

            $this->active_endpoint = $endpoint;
            return $this;

        }

        public function createNewClient() {

            $this->client = \Eway\Rapid::createClient(
                $this->api_key, 
                $this->api_password, 
                $this->active_endpoint
            );

            return $this->client;

        }

        public function getClient() {

            return $this->client;

        }


    }

?>