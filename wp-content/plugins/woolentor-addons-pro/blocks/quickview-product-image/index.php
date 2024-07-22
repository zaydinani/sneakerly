<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$settings = $attributes;

$is_editor = ( isset( $_GET['is_editor_mode'] ) && $_GET['is_editor_mode'] == 'yes' ) ? true : false;

$uniqClass 	 = 'woolentorblock-'.$settings['blockUniqId'];
$areaClasses = array( $uniqClass, 'woolentor_block_quickview_image' );
!empty( $settings['align'] ) ? $areaClasses[] = 'align'.$settings['align'] : '';
!empty( $settings['className'] ) ? $areaClasses[] = esc_attr( $settings['className'] ) : '';

if( $is_editor ){
    $product = wc_get_product( woolentor_get_last_product_id() );
} else{
    global $product;
    $product = wc_get_product();
}
if ( empty( $product ) ) { return; }

$post_thumbnail_id = $product->get_image_id();
if( ! $post_thumbnail_id ){
    $post_thumbnail_id = get_option( 'woocommerce_placeholder_image', 0 );
}
$attachment_ids = $product->get_gallery_image_ids();


echo '<div class="'.esc_attr( implode(' ', $areaClasses ) ).'">';
?>
    <div class="ht-quick-view-learg-img">
        <?php if ( $post_thumbnail_id ): ?>
            <div class="ht-quick-view-single images">
                <?php 
                    $html = wc_get_gallery_image_html( $post_thumbnail_id, true );
                    echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                ?>
            </div>
        <?php endif; 
            if ( $attachment_ids ) {
                foreach ( $attachment_ids as $attachment_id ) {
                    ?>
                        <div class="ht-quick-view-single">
                            <?php 
                                $html = wc_get_gallery_image_html( $attachment_id, true );
                                echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                            ?>
                        </div>
                    <?php
                }
            }
        ?>
    </div>

    <div class="ht-quick-view-thumbnails">
        <?php if ( $product->get_image_id() ): ?>
            
            <div class="ht-quick-thumb-single">
                <?php
                    $thumbnail_src = wp_get_attachment_image_src( $post_thumbnail_id, 'woocommerce_gallery_thumbnail' );
                    echo '<img src=" '.esc_url($thumbnail_src[0]).' " alt="'.esc_attr(get_the_title()).'">';
                ?>
            </div>
            
        <?php endif; ?>
        <?php
            if ( $attachment_ids && $product->get_image_id() ) {
                foreach ( $attachment_ids as $attachment_id ) {
                    ?>
                        <div class="ht-quick-thumb-single">
                            <?php
                                $thumbnail_src = wp_get_attachment_image_src( $attachment_id, 'woocommerce_gallery_thumbnail' );
                                echo '<img src=" '.esc_url($thumbnail_src[0]).' " alt="'.esc_attr(get_the_title()).'">';
                            ?>
                        </div>
                    <?php
                }
            }
        ?>
    </div>
<?php
echo '</div>';