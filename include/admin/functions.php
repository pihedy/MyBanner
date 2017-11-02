<?php

// no direct access
defined( 'ABSPATH' ) or die;

class gMyBannerAdmin
{
    public function __construct()
    {
        $this->setHooks();
    }

    public function setHooks()
    {
        add_action('admin_enqueue_scripts', array($this, 'myBannerScripts'));
        add_action('admin_menu', array($this, 'myBannerAdminMenu'));
    }

    public function myBannerScripts()
    {
        wp_enqueue_media();
        wp_enqueue_script('myBannerScript', G_MY_BANNER_ASSETS . 'js/wpGallery.js', array('jquery'));
    }

    public function myBannerGetImage()
    {
        if(isset($_GET['id']) ){
            $image = wp_get_attachment_image( filter_input( INPUT_GET, 'id', FILTER_VALIDATE_INT ), 'medium', false, array( 'id' => 'myprefix-preview-image' ) );
            $data = array(
                'image'    => $image,
            );
            wp_send_json_success( $data );
        } else {
            wp_send_json_error();
        }
    }

    public function myBannerAdminMenu()
    {
        $pageTitle = 'MyBanner';
        $menuTitle = 'MyBanner';
        $capability = 'edit_theme_options';
        $menuSlug  = 'mybanner';
        $function   = array(
            $this,
            'myBannerAdmin',
        );

        add_theme_page (
            $pageTitle,
            $menuTitle, 
            $capability, 
            $menuSlug, 
            $function
        );
    }

    public function myBannerAdmin()
    {
        global $wpdb;

        $myBannerDbName = $wpdb->prefix . 'mybanner';
        $myBannerDb = $wpdb->get_results("SELECT * FROM $myBannerDbName");
        
        $bannerTitle = @$_POST['bannerTitle'];
        $pageLnk = @$_POST['pageLink'];
        $bannerUrl = @$_POST['bannerUrl'];

        if (!empty($bannerTitle) && !empty($bannerUrl)) {
            $wpdb->insert($myBannerDbName, array(
                'imgLink' => $bannerUrl,
                'title' => $bannerTitle,
                'pageLink' => $pageLnk,
                'clickCount' => 0,
            ));
        }

        $pluginData = get_plugin_data(G_MY_BANNER_ROOT);

        require G_MY_BANNER_INC_ADMIN . '/menu.php';
    }
}