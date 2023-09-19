<?php

namespace Drupal\time_zone_task;

use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a service for retrieving time zone information.
 *
 * @package Drupal\time_zone_task\Services
 */
class TimeZoneTaskService {

  /**
   * TimeZoneTaskService constructor.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $configFactory
   *   The config factory service.
   */
  public function __construct(ConfigFactoryInterface $configFactory) {
    $this->configFactory = $configFactory;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory')
    );
  }

  /**
   * Get the config form data.
   */
  public function getData() {
    $config = $this->configFactory->get('time_zone_task.settings');
    $time_zone_country = $config->get('time_zone_country');
    $time_zone_city = $config->get('time_zone_city');
    $time_zone_timezone = $config->get('time_zone_timezone');

    $time_zone_mappings = [
      'America/Chicago' => 'Time in Chicago, IL, USA',
      'America/New_York' => 'Time in New York, NY, USA',
      'Asia/Tokyo' => 'Time in Tokyo, Japan',
      'Asia/Dubai' => 'Time in Dubai, UAE',
      'Asia/Kolkata' => 'Time in Kolkata, India',
      'Europe/Amsterdam' => 'Time in Amsterdam, Netherlands',
      'Europe/Oslo' => 'Time in Oslo, Norway',
      'Europe/London' => 'Time in London, UK',
    ];

    $timezone = new \DateTimeZone($time_zone_timezone);
    $current_time = new \DateTime('now', $timezone);
    $time = $current_time->format('h:i A');
    $date = $current_time->format('l, j F Y');
    $request_time = $current_time->format('jS M Y - h:i A');

    return [
      'time' => $time,
      'date' => $date,
      'time_zone_country' => $time_zone_country,
      'time_zone_city' => $time_zone_city,
      'time_zone_timezone' => $time_zone_mappings[$time_zone_timezone],
      'time_zone_time' => $request_time,
    ];
  }

}
