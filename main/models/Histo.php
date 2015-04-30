<?php

	class Histo {
		
		private $histo;
		
		private $form;
		
		private $hin;
		
		private $hin_1;
		private $hin_2;
		private $hin_3;
		
		private $yomi;
		
		private $db_id;
		
		function get_db_id() {

			return $this->db_id;
			
		}
		
		function get_histo() {

			return $this->histo;
			
		}
		
		function get_yomi() {

			return $this->yomi;
			
		}
		
		function get_form() {
			
			return $this->form;

		}
		
		function get_hin() {
			
			return $this->hin;

		}

		function get_hin_1() {

			return $this->hin_1;

		}
		function get_hin_2() {

			return $this->hin_2;

		}
		function get_hin_3() {

			return $this->hin_3;

		}
		
		/*******************************
			setter
		*******************************/
		function set_db_id($db_id) {
			
			
			$this->db_id		= $db_id;

			return $this;

		}
		
		function set_histo($histo) {
			
			
			$this->histo		= $histo;

			return $this;

		}
		
		function set_form($form) {
			
			
			$this->form		= $form;

			return $this;

		}
		
		function set_hin($hin) {
			
			
			$this->hin		= $hin;

			return $this;

		}

		function set_hin_1($hin_1) {
		
			$this->hin_1	= $hin_1;
			
			return $this;
		
		}
		function set_hin_2($hin_2) {
		
			$this->hin_2	= $hin_2;
			
			return $this;
		
		}
		function set_hin_3($hin_3) {
		
			$this->hin_3	= $hin_3;
			
			return $this;
		
		}
		
		// new ones
		
		
		function set_yomi($yomi) {
		
			$this->yomi			= $yomi;
			
			return $this;
				
		}
		
	}