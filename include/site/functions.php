<?php

// no direct access
defined( 'ABSPATH' ) or die;

class gMyBannerSite
{
    private $myBannerDb;

    public function __construct()
    {
        $this->setHooks();
    }

    public function setHooks()
    {
        add_action('wp_ajax_myBannerAjax', array($this, 'myBannerAjaxCall'));
        add_action('wp_ajax_nopriv_myBannerAjax', array($this, 'myBannerAjaxCall'));
        add_action('wp_enqueue_scripts', array($this, 'myBannerScripts'));
        add_action('wp', array($this, 'myBannerQuery'));
        add_shortcode('myBanner', array($this, 'myBannerShortcode'));
    }

    public function myBannerAjaxCall()
    {
        global $wpdb;

        $bannerId = $_POST['bannerid'];

        $myBannerDbName = $wpdb->prefix . 'mybanner';
        $myBannerDatabase = $wpdb->get_results("SELECT * FROM $myBannerDbName");

        $myBannerArray = json_decode(json_encode($myBannerDatabase), true);

        foreach ($myBannerArray as $value) {
            
            if ($bannerId == $value['id']) {
                $banner = $value;
            }

        }

        ++$banner['clickCount'];

        $newClick = $banner['clickCount'];

        $wpdb->query($wpdb->prepare("UPDATE $myBannerDbName SET `clickCount` = $newClick WHERE `id` = $bannerId"));

        wp_die();
    }

    public function myBannerScripts()
    {
        wp_enqueue_script('myBanner-js', G_MY_BANNER_ASSETS . 'js/myBanner.js', array('jquery'));
        wp_localize_script('myBanner-js', 'ajaxObject', array('ajaxUrl' => admin_url('admin-ajax.php'))); 
    }

    public function myBannerQuery()
    {
        global $wpdb;
        
        $myBannerDbName = $wpdb->prefix . 'mybanner';
        $this->myBannerDb = $wpdb->get_results("SELECT * FROM $myBannerDbName");

        return $this->myBannerDb;
    }

    public function myBannerShortcode($atts, $myBannerDb)
    {
        $myBannerArray = json_decode(json_encode($this->myBannerDb), true);
        
        foreach ($myBannerArray as $value) {
            
            if ($atts['id'] == $value['id']) {
                $banner = $value;
            }

        }

        echo '<a href="' . $banner['pageLink'] . '" class="myBanner" target="_blank">
            <img src="' . $banner['imgLink'] . '" mybannerid="' . $banner['id'] . '" />
            </a>';
    }
}
