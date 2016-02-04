<?php

class WP_Customize_Checkbox_Control extends WP_Customize_Control {
	public $type = 'checkbox';
 
	public function render_content() {
		?>
		<label>
		<span class="customize-control-title"><?php
					echo esc_html($this->label);
		?></span>
		<input type="checkbox" value="true" <?php
			$this->link();
			if ($this->value()) echo 'checked="true"';
		?>>
		<?php
	}
}

?>
