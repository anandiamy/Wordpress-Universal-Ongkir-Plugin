<?php 
/**
 * Adds AMY_ongkir_widget widget.
 */
class AMY_ongkir_widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'foo_widget', // Base ID
			__( 'AMY Ongkir Widget', 'text_domain' ), // Name
			array( 'description' => __( 'Ongkir widget on wordpress', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		
		?>

		<div class="amy-row">
			<select class="widefat company-name" name="company-name">
				<option value="" selected>Pilih jasa kurir</option>
				<option value="all">Semua</option>}
				option
				<option value="jne">JNE</option>
				<option value="pos">POS Indonesia</option>
				<option value="tiki">TIKI</option>
			</select>
		</div>

		<div class="amy-row">
			<select class="widefat from amy-select2" name="from">
				<option value="" selected>Pilih kota asal</option>
			</select>
			<img src="<?php echo esc_url( admin_url() . '/images/loading.gif' ); ?>" class="loading-animation-from">
		</div>

		<div class="amy-row">
			<select class="widefat to amy-select2" name="to">
				<option value="" selected>Pilih kota tujuan</option>
			</select>
			<img src="<?php echo esc_url( admin_url() . '/images/loading.gif' ); ?>" class="loading-animation-to">
		</div>

		<div class="amy-row">
			<input min="0" class="kg" type="number" value="" placeholder="Jumlah Kg">
		</div>

		<div class="amy-row amy-table">
			
		</div>

		<div class="amy-row">
			<button class="btn-amy-submit" type="submit"><?php echo __(esc_attr('See Ongkir'), 'text-domain') ?></button>
			<img src="<?php echo esc_url( admin_url() . '/images/loading.gif' ); ?>" class="loading-animation">
		</div>

		<?php
		
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'text_domain' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( esc_attr( 'Title:' ) ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

} // class AMY_ongkir_widget
 ?>