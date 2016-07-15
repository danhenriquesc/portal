<?php
	class Tab{
		public $text;
		public $icon;
		public $id;
		public $classes = null;
		public $options = null;

		function __construct($t, $ic, $i, $c = null){
			$this->text    = $t;
			$this->icon    = $ic;
			$this->id      = $i;
			$this->classes = $c;
		}

		public function addOption($type, $id, $title, $description, $default = null, $options = null, $classes = null){
			$this->options[] = array(
				'type' 			=> $type,
				'id'   			=> $id,
				'title'			=> $title,
				'description'	=> $description,
				'default'		=> $default,
				'options'		=> $options,
				'classes'		=> $classes
			);
		}
	}
?>