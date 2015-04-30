<?php

	class Token {
		
		
		private $db_Id;
		
		private $created_at;
		
		private $updated_at;
		
		private $form;
		
		private $hin;
		
		private $hin_1;
		private $hin_2;
		private $hin_3;
		
		private $katsu_kei;
		
		private $katsu_kata;
		
		private $genkei;
		
		
		private $yomi;
		
		private $hatsu;
		
		
		private $history_id;
		
		private $category_id;
		
		private $genre_id;
		
		private $user_id;
		
		
		private $orig_id;
		
		function get_katsu_kei() {

			return $this->katsu_kei;
			
		}
		
		function get_katsu_kata() {

			return $this->katsu_kata;
			
		}
		
		function get_genkei() {

			return $this->genkei;
			
		}
		
		
		function get_yomi() {

			return $this->yomi;
			
		}
		
		function get_hatsu() {

			return $this->hatsu;
			
		}
		
		
		function get_history_id() {

			return $this->history_id;
			
		}
		
		function get_category_id() {

			return $this->category_id;
			
		}
		
		function get_genre_id() {

			return $this->genre_id;
			
		}
		
		function get_user_id() {

			return $this->user_id;
			
		}
		
		
		function get_orig_id() {

			return $this->orig_id;
			
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
		
		function set_katsu_kei($katsu_kei) {
		
			$this->katsu_kei	= $katsu_kei;
			
			return $this;
				
		}
		
		function set_katsu_kata($katsu_kata) {
		
			$this->katsu_kata	= $katsu_kata;
			
			return $this;
				
		}
		
		function set_genkei($genkei) {

			$this->genkei		= $genkei;
			
			return $this;
				
		}
		
		
		function set_yomi($yomi) {
		
			$this->yomi			= $yomi;
			
			return $this;
				
		}
		
		function set_hatsu($hatsu) {
		
			$this->hatsu		= $hatsu;
			
			return $this;
				
		}
		
		
		function set_history_id($history_id) {
		
			$this->history_id	= $history_id;
			
			return $this;
				
		}
		
		function set_category_id($category_id) {

			$this->category_id	= $category_id;
			
			return $this;
				
		}
		
		function set_genre_id($genre_id) {
		
			$this->genre_id		= $genre_id;
			
			return $this;
				
		}
		
		function set_user_id($user_id) {
		
			$this->user_id		= $user_id;
			
			return $this;
				
		}
		
		
		function set_orig_id($orig_id) {
		
			$this->orig_id		= $orig_id;
			
			return $this;
				
		}
		
		
	}