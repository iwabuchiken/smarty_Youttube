<?php

	class Genre {
		
		
		private $db_Id;
		
		private $created_at;
		
		private $updated_at;
		
		private $code;
		
		private $name;

		private $original_id;
		
		/*******************************
			functions: getter
		*******************************/
		function get_original_id() {
		
			return $this->original_id;
				
		}
		
		function get_db_Id() {
			
			return $this->db_Id;

		}
		
		function get_created_at() {
			
			return $this->created_at;

		}
		
		function get_updated_at() {
			
			return $this->updated_at;

		}
		
		function get_name() {
			
			return $this->name;

		}
		
		function get_code() {
			
			return $this->code;

		}
		
		/*******************************
			setter
		*******************************/
		function set_db_Id($db_Id) {
			
			
			$this->db_Id	= $db_Id;
			
			return $this;

		}
		
		function set_created_at($created_at) {
			
			
			$this->created_at	= $created_at;

			return $this;

		}
		
		function set_updated_at($updated_at) {
			
			
			$this->updated_at	= $updated_at;

			return $this;

		}
		
		function set_name($name) {
			
			
			$this->name		= $name;

			return $this;

		}
		
		function set_code($code) {
			
			
			$this->code		= $code;

			return $this;

		}
		
		function set_original_id($original_id) {
		
			$this->original_id		= $original_id;
				
			return $this;
		
		}
		
	}