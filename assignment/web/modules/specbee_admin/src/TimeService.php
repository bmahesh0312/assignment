<?php

namespace Drupal\specbee_admin;

use Drupal\Core\Datetime;

/**
 * Class TimeService
 * @package Drupal\specbee_admin\Services
 */
class TimeService {

  /**
   * TimeService constructor.
   */
  public function __construct() {
  }


  /**
   * @return \Drupal\Component\Render\MarkupInterface|string
   */
  public function getTime() {
	  //admin configuration
	  $config = \Drupal::config('specbee_admin.settings');
	  //formatting datetime according to timezone and format
	  $time = \Drupal::service('date.formatter')->format(\Drupal::time()->getCurrentTime(),'specbee_date_format', $timezone = \Drupal::config('specbee_admin.settings')->get('timezone'), $langcode = NULL);
	  $suffixes =["th", "st", "nd", "rd", "th", "th", "th", "th", "th", "th", "th", "th", "th", "th", "th", "th", "th", "th", "th", "th", "th", "st", "nd", "rd", "th", "th", "th", "th", "th", "th", "th", "st"];
	  $date  = substr($time,0,strpos($time," "));
	  $date = $date . $suffixes[intval($date)];
	  $date = $date . " " . substr($time,strpos($time," ")+1,);
	  return ["timestamp"=>$date,"country"=>$config->get('country'),"city"=>$config->get('city')];
  }
}