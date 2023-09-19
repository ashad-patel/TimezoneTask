<?php

namespace Drupal\time_zone_task\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\time_zone_task\TimeZoneTaskService;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'TimeZoneTask' block.
 *
 * @Block(
 *   id = "time_zone_task_block",
 *   admin_label = @Translation("Time Zone Task Block"),
 *   category = @Translation("TimeZoneTask Form block")
 * )
 */
class TimeZoneTask extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Constructs a Drupalist object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\time_zone_task\TimeZoneTaskService $timeZoneTask
   *   The current_user.
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    protected TimeZoneTaskService $timeZoneTask,
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('time_zone_task.time_zone_task'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {

    $data = $this->timeZoneTask->getData();
    $renderable = [
      '#theme' => 'time_zone_task',
      '#data' => $data,
    ];
    return $renderable;
  }

  /**
   * Cache disabled.
   */
  public function getCacheMaxAge() {
    return 0;
  }

}
