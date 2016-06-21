<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Backand {
    
    private function authenticate($auth_token, $auth_qpp, $configData) {
        
        //got to check the token in Backand with $auth_token and get subscription id
        $subObj = $this->getSubfromBackand($auth_token, $auth_qpp, $configData);
        
        if(!isset($subObj->subscriptionId)){
            //clear cookies
            $this->setSubscriptionId('');
            
            unset($_COOKIE['cb_portal_session_id']);
            setcookie('cb_portal_session_id', '', time() - 3600, '/'); // empty value and old timestamp
            
            unset($_COOKIE['cb_subscription_id']);
            setcookie('cb_subscription_id', '', time() - 3600, '/'); // empty value and old timestamp
            
            throw new Exception("Can't access backand");
            
        } 
            
        $subId = $subObj->subscriptionId;
        
        $this->setSubscriptionId($subId); //get from backand
                
        setcookie('cb_portal_session_id', 
            $auth_token, 
            time() + 60 *60, 
            $configData['COOKIE_PATH'], 
            $configData['COOKIE_DOMAIN'], 
            $configData['COOKIE_SECURE'], 
            $configData['COOKIE_HTTPONLY']
        );
    }
    
    public function setSubscriptionId($subscriptionId){
        $this->subscriptionId = $subscriptionId;
    }

    public function getSessionSubscriptionId(){
        return $subscriptionId = isset($_COOKIE['cb_subscription_id']) ? $_COOKIE['cb_subscription_id'] : null;
    }
    
    private function setSubscriptionCookie($configData){        
        setcookie('cb_subscription_id', 
            $this->subscriptionId, 
            time() + 60 *60, 
            $configData['COOKIE_PATH'], 
            $configData['COOKIE_DOMAIN'], 
            $configData['COOKIE_SECURE'], 
            $configData['COOKIE_HTTPONLY']
        );
    }
    
    public function authenticateSession($auth_token, $auth_qpp, $force, $configData){    
        //if (isset($params['cb_auth_session_id']) && isset($params['cb_auth_session_token']) && !$this->isLoggedIn()) {
        if (isset($auth_token) && ($force || !$this->isLoggedIn())) {
            try {
                $this->authenticate($auth_token, $auth_qpp, $configData);
                $this->setSubscriptionCookie($configData);
                $request_url = explode("://", $configData['SITE_URL'])[0] . "://" .
                        explode("://", $configData['SITE_URL'])[1] . $_SERVER["REQUEST_URI"];

                $redirect_url = removeQueryArg(
                    array(
                        "force",
                        "auth_id",
                        "auth_app",
                        "action", 
                        "do"
                    ), $request_url);
                header('Location: ' . $redirect_url);
                exit;
            } catch (Exception $e) {
                error_log("Exception : " . $e->getMessage());
            }
        }
    }
    
    public function isLoggedIn() {
        $cb_portal_session_id = isset($_COOKIE['cb_portal_session_id']) ? $_COOKIE['cb_portal_session_id'] : null;
        if (isset($cb_portal_session_id)) {
            return false;
        }
        return true;
    }
    
    
    private function getSubfromBackand($access_token, $app_name, $configData){
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $configData["BACKAND_URL"] . '/1/general/billingSubscriptionId');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, 
            array(
                'Accept: application/json', 
                'Content-Type: application/json',
                'Authorization: bearer ' . $access_token,
                'AppName: ' . $app_name
            )
        );

        $server_output = curl_exec ($ch);
        curl_close ($ch);
        return json_decode($server_output);
            
    }
}
