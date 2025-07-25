<?php
#CMS - CMS Made Simple
#(c)2004 by Ted Kulp (ted@cmsmadesimple.org)
#Visit our homepage at: http://www.cmsmadesimple.org
#
#This program is free software; you can redistribute it and/or modify
#it under the terms of the GNU General Public License as published by
#the Free Software Foundation; either version 2 of the License, or
#(at your option) any later version.
#
#This program is distributed in the hope that it will be useful,
#but WITHOUT ANY WARRANTY; without even the implied warranty of
#MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#GNU General Public License for more details.
#You should have received a copy of the GNU General Public License
#along with this program; if not, write to the Free Software
#Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
#

class microtiny_utils
{
  
  protected static $_initialized = FALSE;

  /**
   * Constructor
   *
   * @since 1.0
   */
  private function __construct() { }

  /**
   * Module API wrapper function
   *
   * @internal
   */
  public static function WYSIWYGGenerateHeader($selector=null, $css_name='')
  {
      static $first_time = true;

      // Check if we are in object instance
      $config = cms_utils::get_config();
      $mod = cms_utils::get_module('MicroTinyV7');
      if(!is_object($mod)) throw new CmsLogicException('Could not find the microtiny module...');

      $frontend = CmsApp::get_instance()->is_frontend_request();
      $languageid = self::GetLanguageId($frontend);
      $mtime = time() - 300; // by defaul cache for 5 minutes ??

      // get the cssname that we're going to use (either passed in, or from profile)
      try {
          $profile = null;
          if( $frontend ) {
              $profile = microtiny_profile::load(MicroTinyV7::PROFILE_FRONTEND);
          }
          else {
              $profile = microtiny_profile::load(MicroTinyV7::PROFILE_ADMIN);
          }

          if( !$profile['allowcssoverride'] ) {
              // not allowwing override
              $css_name = null;
              $css_id = (int) $profile['dfltstylesheet'];
              if( $css_id > 0 ) $css_name = $css_id;
          }
      }
      catch( \Exception $e ) {
          // do nothing.
      }

      // if we have a stylesheet name, use it's modification time as our mtime
      if( $css_name ) {
          try {
              $css = CmsLayoutStylesheet::load($css_name);
              $css_name = $css->get_name();
              $mtime = $css->get_modified();
          }
          catch( Exception $e ) {
              // couldn't load the stylesheet for some reason.
              $css_name = null;
          }
      }

      // if this is an action for MicroTiny disable caching.
      $smarty = CmsApp::get_instance()->GetSmarty();
      $module = $smarty->get_template_vars('actionmodule');
      if( $module == $mod->GetName() ) $mtime = time() + 60; // do not cache when we're using this from within the MT module.

      // also disable caching if told to by the config.php
      if( isset($config['mt_disable_cache']) && cms_to_bool($config['mt_disable_cache']) ) $mtime = time() + 60;
    
      $output = '';
      if( $first_time ) {
          // only once per request.
          $first_time = FALSE;
          $output .= '<script type="text/javascript" src="'.$config->smart_root_url().'/modules/MicroTinyV7/lib/js/tinymce/tinymce.min.js"></script>';
      }

      $hash_salt = __DIR__.session_id().$frontend.$selector.$css_name.get_userid(FALSE).$languageid;
      if( get_userid(false) && !$frontend ) $hash_salt .= $_SESSION[CMS_USER_KEY];
      $fn = cms_join_path(PUBLIC_CACHE_LOCATION,'mt_'.md5($hash_salt).'.js');
      if( !file_exists($fn) || filemtime($fn) < $mtime ) {
          // we have to generate an mt config js file.
          self::_save_static_config($fn,$frontend,$selector,$css_name,$languageid);
      }

      $configurl = $config['public_cache_url'].'/'.basename($fn);
      $output.='<script type="text/javascript" src="'.$configurl.'" defer="defer"></script>';

      return $output;
  }

  private static function _save_static_config($fn, $frontend=false, $selector = NULL, $css_name = '', $languageid='')
  {
    if( !$fn ) return;
    $configcontent = self::_generate_config($frontend, $selector, $css_name, $languageid);
    $res = file_put_contents($fn,$configcontent);
    if( !$res ) throw new CmsFileSystemException('Problem writing data to '.$fn);
  }
  
  /**
   * Generate a tinymce initialization file.
   *
   * @param boolean Frontend true/false
   * @param string Templateid
   * @param string A2 Languageid
   *
   * @return string
   * @throws \SmartyException
   * @since 1.0
   */
  private static function _generate_config($frontend=false, $selector = null, $css_name = null, $languageid="en")
  {
      $ajax_url = function($url) {
          return str_replace('&amp;','&',$url).'&showtemplate=false';
      };
      
      $mod = cms_utils::get_module('MicroTinyV7');
      $_gCms = CmsApp::get_instance();
      $config = $_gCms->GetConfig();
      $smarty = $_gCms->GetSmarty();
      $page_id = ($_gCms->is_frontend_request()) ? $smarty->getTemplateVars('content_id') : '';
      $tpl_ob = $smarty->CreateTemplate('module_file_tpl:MicroTinyV7;tinymce_config.js',null,null,$smarty); // child of the global smarty
      $tpl_ob->assign('MT',$mod);
      $tpl_ob->assign('MicroTinyV7',$mod);
      $tpl_ob->clear_assign('mt_profile');
      $tpl_ob->clear_assign('mt_selector');
      $tpl_ob->assign('mt_actionid','m1_');
      $tpl_ob->assign('isfrontend',$frontend);
      $tpl_ob->assign('languageid',$languageid);
      $tpl_ob->assign('root_url',$config->smart_root_url());
      $fp = \cms_utils::get_filepicker_module();
      if( $fp ) {
          $url = $fp->get_browser_url();
          $tpl_ob->assign('filepicker_url',$ajax_url($url));
      }
      
      // This robustly calculates the relative uploads path for the file picker.
      // Get the root URL and the uploads URL from the CMSMS config.
      $root_url = $config['root_url'];
      $uploads_url = $config['uploads_url'];
      
      // Ensure both URLs have a trailing slash for clean comparison.
      if (substr($root_url, -1) !== '/') $root_url .= '/';
      if (substr($uploads_url, -1) !== '/') $uploads_url .= '/';
      
      $uploads_path = '';
      // Check if uploads_url starts with root_url (the normal case).
      if (strpos($uploads_url, $root_url) === 0) {
          // If it does, subtract the root_url part to get the relative path.
          $uploads_path = substr($uploads_url, strlen($root_url));
      } else {
          // Fallback for complex configurations (like a CDN). Just take the path part of the URL.
          $parsed = parse_url($uploads_url);
          $uploads_path = isset($parsed['path']) ? ltrim($parsed['path'], '/') : '';
      }
      
      // Trim any slashes from the start and end to get a clean path like "uploads" or "my/uploads".
      $uploads_path = trim($uploads_path, '/');
      
      // Assign this correctly calculated path to Smarty for use in the JS config.
      $tpl_ob->assign('uploads_path', $uploads_path);      
      
      $url = $mod->create_url('m1_','linker',$page_id);
      $tpl_ob->assign('linker_url',$ajax_url($url));
      $url = $mod->create_url('m1_','ajax_getpages',$page_id);
      $tpl_ob->assign('getpages_url',$ajax_url($url));
      if( $selector ) $tpl_ob->assign('mt_selector',$selector);

      try {
          $profile = null;
          if( $frontend ) {
              $profile = microtiny_profile::load(MicroTinyV7::PROFILE_FRONTEND);
          }
          else {
              $profile = microtiny_profile::load(MicroTinyV7::PROFILE_ADMIN);
          }

          $tpl_ob->assign('mt_profile',$profile);
          if( $css_name ) $tpl_ob->assign('mt_cssname',$css_name);
      }
      catch( Exception $e ) {
          // oops, we got a problem.
          die($e->Getmessage());
      }
      
      return $tpl_ob->fetch();
  }
  
  /**
   * Hackish way to get rid of USER deprecated warnings
   * thrown by Smarty on a (IMO) particular bad decision
   *
   * @internal
   * @param $errno
   * @param $errstr
   * @param $errfile
   * @param $errline
   *
   * @return bool
   */
  public static function _error_handler($errno, $errstr, $errfile, $errline)
  {
    return $errno === E_USER_DEPRECATED;
  }

  /**
   * Convert users current language to something tinymce can prolly understand (hopefully).
   *
   * @since 1.0
   * @return string
   */
  private static function GetLanguageId() {
    $mylang = CmsNlsOperations::get_current_language();
    if ($mylang=="") return "en"; //Lang setting "No default selected"
    $shortlang = substr($mylang,0,2);

    $mod = cms_utils::get_module('MicroTinyV7');
    $dir = $mod->GetModulePath().'/lib/js/tinymce/langs';
    $langs = array();
    {
        $files = glob($dir.'/*.js');
        if( is_array($files) && count($files) ) {
            foreach( $files as $one ) {
                $one = basename($one);
                $one = substr($one,0,-3);
                $langs[] = $one;
            }
        }
    }

    if( in_array($mylang,$langs) ) return $mylang;
    if( in_array($shortlang,$langs) ) return $shortlang;
    return 'en';
  }

  /**
   * Get an img tag for a thumbnail file if one exists.
   *
   * @since 1.0
   * @param string $file
   * @param string $path
   * @param string $url
   * @return string
   */
  public static function GetThumbnailFile($file,$path,$url)
  {
    $image='';
    $imagepath = self::Slashes($path."/thumb_".$file);
    $imageurl = self::Slashes($url."/thumb_".$file);
    if (!file_exists($imagepath)) {
      $image='';
    } else {
      $image="<img src='".$imageurl."' alt='".$file."' title='".$file."' />";
    }
    return $image;
  }

  /**
   * Fix Slashes
   *
   * @since 1.0
   * @return string
   */
  private static function Slashes($url)
  {
    $result=str_replace("\\","/",$url);
    return $result;
  }
  
  public static function mt_jsbool($val)
{
  $val = cms_to_bool($val);
  if( $val ) return 'true';
  return 'false';
}

} // end of class

#
# EOF
#
?>
