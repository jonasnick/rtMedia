<?php

/**
 * Description of RTMediaUploadEndpoint
 *
 * @author Joshua Abenazer <joshua.abenazer@rtcamp.com>
 */
class RTMediaUploadEndpoint {

	public $upload;

	/**
	 *
	 */
    public function __construct() {
        add_action('rt_media_upload_redirect', array($this, 'template_redirect'));
    }

	/**
	 *
	 */
    function template_redirect() {

        if (!count($_POST)) {
            include get_404_template();
        } else {
            $nonce = $_REQUEST['rt_media_upload_nonce'];
            $mode = $_REQUEST['mode'];
            if (wp_verify_nonce($nonce, 'rt_media_upload_nonce')) {
                $model = new RTMediaUploadModel();
                $this->upload = $model->set_post_object();
				var_dump($this->upload);
                $upload = new RTMediaUpload($this->upload);
            }
            if(isset($_POST["redirect"]) && $_POST["redirect"]=="no" ){
                // Ha ha ha
                die();
            }else{
                //wp_safe_redirect(wp_get_referer());
            }
        }

        die();
    }

}

?>