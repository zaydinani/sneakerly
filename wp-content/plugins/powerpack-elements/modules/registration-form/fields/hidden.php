<?php
	$value = ! empty( $field['default_value'] ) ? $field['default_value'] : '';
?>
<input type="hidden" <?php echo wp_kses_post( $this->get_render_attribute_string( $field_key ) ); ?> value="<?php echo esc_attr( $value ); ?>" placeholder="<?php echo esc_attr( $field['placeholder'] ); ?>" />
