<?php
class ResourceBase{

    var $api;
    var $errors;
    function __construct(){
        $this->api = new HttpRequest;
    }
    function all() {
        $results = $this->api->get($this->host.'/'.$this->name.'.'.$this->response_type);
        return $results['response'];
    } 
    function show($id) {
        $results = $this->api->get($this->host.'/'.$this->name.'/'.$id.'.'.$this->response_type);
        return $results['response'];
    }
    function create($params) {
        $results = $this->api->post($this->host.'/'.$this->name.'.'.$this->response_type,$params);
        return $results;
    }
    function update($params) {
        $results = $this->api->put($this->host.'/'.$this->name.'.'.$this->response_type,$params);
        return $reults;
    }
    function edit() {
            
    }
    function destroy($id) {
        $results = $this->api->delete($this->host.'/'.$this->name.'/'.$id.'.'.$this->response_type);
        return $results['response'];
    }
    function search($params) {
        $results = $this->api->post($this->host.'/searches/'.$this->name.'.'.$this->response_type, $params);
        return $results['response'];
    }
}

?>
