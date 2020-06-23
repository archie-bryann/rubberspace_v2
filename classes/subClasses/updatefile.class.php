<?php

class UpdateFile extends Users {
	private $db_code;
	private $results;

	public function __construct($code){
		$this->db_code = $code;
		$this->results = $this->checkCode($this->db_code);
	}

    public function file_name() {
       return $this->results[0]['file_name'];
    }

    public function description() {
        return $this->results[0]['description'];
    }

    public function code() {
        return $this->results[0]['code'];
    }

    public function uploaded_by() {
    	return $this->results[0]['uploaded_by'];
    }	

    public function updated() {
        return $this->results[0]['updated'];
    }
}
