<?php
  /*
   * To change this license header, choose License Headers in Project Properties.
   * To change this template file, choose Tools | Templates
   * and open the template in the editor.
   */
   
  /**
   * @package Contact :  CodeIgniter Multi Language Loader
   *
   * @author TechArise Team
   *
   * @email  info@techarise.com
   *   
   * Description of Multi Language Loader Hook
   */
 
  class MultiLanguageLoader
  {
      function initialize() {
          $ci =& get_instance();
          // load language helper
          $ci->load->helper('language');

          $siteLang = $ci->session->userdata('site_lang');
          $siteLanguage = $ci->session->userdata('site_language');

          if ($siteLang) {
              // difine all language files
              $ci->lang->load($siteLang, $siteLanguage);
          } else {
              // default language files
              $ci->lang->load('en','english');
          }
      }
  }

  ?>