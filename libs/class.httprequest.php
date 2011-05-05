<?php

class HttpRequest {
    var $verbose = 0;
    var $status_codes = array(
        0                => 'Could Not Connect',
        100              => 'Continue',
        101              => 'Switching Protocols',
        102              => 'Processing',
        200              => 'OK',
        201              => 'Created',
        202              => 'Accepted',
        203              => 'Non-Authoritative Information',
        204              => 'No Content',
        205              => 'Reset Content',
        206              => 'Partial Content',
        207              => 'Multi-Status',
        226              => 'IM Used',
        300              => 'Multiple Choices',
        301              => 'Moved Permanently',
        302              => 'Found',
        303              => 'See Other',
        304              => 'Not Modified',
        305              => 'Use Proxy',
        306              => 'Reserved',
        307              => 'Temporary Redirect',
        400              => 'Bad Request',
        401              => 'Unauthorized',
        402              => 'Payment Required',
        403              => 'Forbidden',
        404              => 'Not Found',
        405              => 'Method Not Allowed',
        406              => 'Not Acceptable',
        407              => 'Proxy Authentication Required',
        408              => 'Request Timeout',
        409              => 'Conflict',
        410              => 'Gone',
        411              => 'Length Required',
        412              => 'Precondition Failed',
        413              => 'Request Entity Too Large',
        414              => 'Request-URI Too Long',
        415              => 'Unsupported Media Type',
        416              => 'Requested Range Not Satisfiable',
        417              => 'Expectation Failed',
        422              => 'Unprocessable Entity',
        423              => 'Locked',
        424              => 'Failed Dependency',
        426              => 'Upgrade Required',
        500              => 'Internal Server Error',
        501              => 'Not Implemented',
        502              => 'Bad Gateway',
        503              => 'Service Unavailable',
        504              => 'Gateway Timeout',
        505              => 'HTTP Version Not Supported',
        506              => 'Variant Also Negotiates',
        507              => 'Insufficient Storage',
        510              => 'Not Extended'
    );
    
    /**
     * put
     * 
     * @param mixed $url 
     * @param mixed $fields 
     * @access public
     * @return void
     */
    function put($url, $fields) {
        $result       = array();
        $fields       = (is_array($fields)) ? http_build_query($fields) : $fields;
        $fp           = fopen('fields.txt', 'w');
        fwrite($fp, $fields);
        if ($ch = curl_init($url)) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_VERBOSE, $this->verbose);
            //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Length: ' . strlen($fields)));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            ob_start();
            $result['response_raw'] = curl_exec($ch);
            $result['response'] = json_decode($result['response_raw']);
            ob_end_clean();
            $result['info'] = curl_getinfo($ch);
            $result['status'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            $result['status_message'] = $this->status_codes[$result['status']];
            fclose($fp);
            return $result;
        }
        else {
            fclose($fp);
            return false;
        }
    }
    
    /**
     * post
     * 
     * @param mixed $url 
     * @param mixed $fields 
     * @access public
     * @return void
     */
    function post($url, $fields) {
        $result = array();
        $fields = (is_array($fields)) ? http_build_query($fields) : $fields;
        if ($ch     = curl_init($url)) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_VERBOSE, $this->verbose);
            //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Length: ' . strlen($fields)));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            ob_start();
            $result['response_raw'] = curl_exec($ch);
            $result['response'] = json_decode($result['response_raw']);
            ob_end_clean();
            $result['info'] = curl_getinfo($ch);
            $result['status'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            $result['status_message'] = $this->status_codes[$result['status']];
            return $result;
        }
        else {
            return false;
        }
    }
    function get($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        // SSL verifier should be set to true for higher
        // security, but causes issues on some platforms
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, $this->verbose);
        ob_start();
        $result['response_raw'] = curl_exec($ch);
        $result['response'] = json_decode($result['response_raw']);
        ob_end_clean();
        $result['info'] = curl_getinfo($ch);
        $result['status'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $result['status_message'] = $this->status_codes[$result['status']];
        return $result;
    }
    function delete($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        // SSL verifier should be set to true for higher
        // security, but causes issues on some platforms
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, $this->verbose);
        ob_start();
        $result['response_raw'] = curl_exec($ch);
        $result['response'] = json_decode($result['response_raw']);
        ob_end_clean();
        $result['info'] = curl_getinfo($ch);
        $result['status'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $result;
    }
}
?>
