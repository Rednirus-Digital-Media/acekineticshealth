<?php
namespace WglAddons\Controls;

use Elementor\Plugin;
use Elementor\Controls_Manager;
use Elementor\Base_Data_Control;

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
* Wgl Elementor Custom Icon Control
*
*
* @class        Wgl_Icon
* @version      1.0
* @category Class
* @author       WebGeniusLab
*/

class Wgl_Icon extends Base_Data_Control{

    /**
     * Get radio image control type.
     *
     * Retrieve the control type, in this case `radio-image`.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Control type.
     */
    public function get_type() {
        return 'wgl-icon';
    }

    public function enqueue() {
        // Scripts
        wp_enqueue_script( 'wgl-elementor-extensions', WGL_ELEMENTOR_ADDONS_URL . 'assets/js/wgl_elementor_extenstions.js');

        // Style
        wp_enqueue_style( 'wgl-elementor-extensions', WGL_ELEMENTOR_ADDONS_URL . 'assets/css/wgl_elementor_extenstions.css');
    }

    public static function get_flaticons( ) {
        return array(
            'flaticon-doctor' => 'doctor',
            'flaticon-pills' => 'pills',
            'flaticon-play' => 'play',
            'flaticon-call' => 'call',
            'flaticon-pharmacy' => 'pharmacy',
            'flaticon-pin' => 'pin',
            'flaticon-find' => 'find',
            'flaticon-pin-1' => 'pin-1',
            'flaticon-hospital' => 'hospital',
            'flaticon-mail' => 'mail',
            'flaticon-email' => 'email',
            'flaticon-at' => 'at',
            'flaticon-mail-1' => 'mail-1',
            'flaticon-mail-2' => 'mail-2',
            'flaticon-shopping-bag' => 'shopping-bag',
            'flaticon-paper-bag' => 'paper-bag',
            'flaticon-web-link' => 'web-link',
            'flaticon-link' => 'link',
            'flaticon-hyperlink' => 'hyperlink',
            'flaticon-share' => 'share',
            'flaticon-arrow-down-sign-to-navigate' => 'arrow-down-sign-to-navigate',
            'flaticon-arrow-point-to-right' => 'arrow-point-to-right',
            'flaticon-navigate-up-arrow' => 'navigate-up-arrow',
            'flaticon-arrowhead-thin-outline-to-the-left' => 'arrowhead-thin-outline-to-the-left',
            'flaticon-link-interface-symbol' => 'link-interface-symbol',
            'flaticon-placeholder-filled-point' => 'placeholder-filled-point',
            'flaticon-music-player-play' => 'music-player-play',
            'flaticon-share-1' => 'share-1',
            'flaticon-search' => 'search',
            'flaticon-clock' => 'clock',
            'flaticon-ear' => 'ear',
            'flaticon-stomach' => 'stomach',
            'flaticon-right-arrow' => 'right-arrow',
            'flaticon-visibility' => 'visibility',
            'flaticon-check' => 'check',
            'flaticon-teddy-bear' => 'teddy-bear',
            'flaticon-call-1' => 'call-1',
            'flaticon-shopping-cart' => 'shopping-cart',
            'flaticon-pills-1' => 'pills-1',
            'flaticon-health' => 'health',
            'flaticon-liver' => 'liver',
            'flaticon-hospital-sign' => 'hospital-sign',
            'flaticon-microscope' => 'microscope',
            'flaticon-test-tubes' => 'test-tubes',
            'flaticon-dna' => 'dna',
            'flaticon-medicine' => 'medicine',
            'flaticon-mortar' => 'mortar',
            'flaticon-prescription' => 'prescription',
            'flaticon-heartbeat' => 'heartbeat',
            'flaticon-stethoscope' => 'stethoscope',
            'flaticon-microscope-1' => 'microscope-1',
            'flaticon-pharmacy-1' => 'pharmacy-1',
            'flaticon-pharmacy-2' => 'pharmacy-2',
            'flaticon-brain' => 'brain',
            'flaticon-baby-boy' => 'baby-boy',
            'flaticon-uterus' => 'uterus',
            'flaticon-customer-service' => 'customer-service',
            'flaticon-molecule' => 'molecule',
            'flaticon-aids' => 'aids',
            'flaticon-cardio' => 'cardio',
            'flaticon-doctor-bag' => 'doctor-bag',
            'flaticon-medicine-1' => 'medicine-1',
            'flaticon-nurse' => 'nurse',
            'flaticon-electrocardiogram' => 'electrocardiogram',
            'flaticon-stethoscope-1' => 'stethoscope-1',
            'flaticon-placeholder' => 'placeholder',
            'flaticon-stethoscope-2' => 'stethoscope-2',
            'flaticon-add' => 'add',
            'flaticon-heart' => 'heart',
            'flaticon-view' => 'view',
            'flaticon-quote' => 'quote',
            'flaticon-like' => 'like',
            'flaticon-close' => 'close',
            'flaticon-left-arrow' => 'left-arrow',
            'flaticon-left-arrow-1' => 'left-arrow-1',
            'flaticon-next' => 'next',
            'flaticon-add-1' => 'add-1',
            'flaticon-right-arrow-1' => 'right-arrow-1',
            'flaticon-add-2' => 'add-2',
            'flaticon-e-commerce-like-heart' => 'e-commerce-like-heart',
            'flaticon-left-quote' => 'left-quote',
            'flaticon-quote-1' => 'quote-1',
            'flaticon-cancel-music' => 'cancel-music',
            'flaticon-arrow-pointing-to-right' => 'arrow-pointing-to-right',
            'flaticon-close-cross' => 'close-cross',
            'flaticon-delete' => 'delete',
            'flaticon-eye-open' => 'eye-open',
            'flaticon-heart-outline' => 'heart-outline',
            'flaticon-close-button' => 'close-button',
            'flaticon-keyboard-right-arrow-button' => 'keyboard-right-arrow-button',
            'flaticon-left-quote-mark' => 'left-quote-mark',
        );
    }

    /**
     * Get radio image control default settings.
     *
     *
     * @since 1.0.0
     * @access protected
     *
     * @return array Control default settings.
     */
    protected function get_default_settings() {
        return [
            'label_block' => true,
            'options' => self::get_flaticons(),
            'include' => '',
            'exclude' => '',
            'select2options' => [],
        ];
    }

    /**
     * Render radio image control output in the editor.
     *
     * Used to generate the control HTML in the editor using Underscore JS
     * template. The variables for the class are available using `data` JS
     * object.
     *
     * @since 1.0.0
     * @access public
     */
    public function content_template() {

        $control_uid = $this->get_control_uid();
        ?>
        <div class="elementor-control-field">
            <# if ( data.label ) {#>
                <label for="<?php echo $control_uid; ?>" class="elementor-control-title">{{{ data.label }}}</label>
            <# } #>
            <div class="elementor-control-input-wrapper">
                <select id="<?php echo $control_uid; ?>" class="elementor-control-icon elementor-select2" type="select2"  data-setting="{{ data.name }}" data-placeholder="<?php echo __( 'Select Icon', 'medify-core' ); ?>">
                    <# _.each( data.options, function( option_title, option_value ) {
                        var value = data.controlValue;
                        if ( typeof value == 'string' ) {
                            var selected = ( option_value === value ) ? 'selected' : '';
                        } else if ( null !== value ) {
                            var value = _.values( value );
                            var selected = ( -1 !== value.indexOf( option_value ) ) ? 'selected' : '';
                        }
                        #>
                    <option {{ selected }} value="{{ option_value }}">{{{ option_title }}}</option>
                    <# } ); #>
                </select>
            </div>
        </div>
        <# if ( data.description ) { #>
            <div class="elementor-control-field-description">{{{ data.description }}}</div>
        <# } #>
        <?php
    }
}

?>