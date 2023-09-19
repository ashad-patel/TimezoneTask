<?php

namespace Drupal\time_zone_task\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure example settings for this site.
 */
class AdminConfigForm extends ConfigFormBase {

  /**
   * Config settings.
   *
   * @var string
   */
  const SETTINGS = 'time_zone_task.settings';

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'time_zone_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      static::SETTINGS,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config(static::SETTINGS);

    $form['time_zone_country'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Country'),
      '#default_value' => $config->get('time_zone_country'),
    ];

    $form['time_zone_city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('City'),
      '#default_value' => $config->get('time_zone_city'),
    ];

    $elements = [
      'America/Chicago' => 'America/Chicago',
      'America/New_York' => 'America/New_York',
      'Asia/Tokyo' => 'Asia/Tokyo',
      'Asia/Dubai' => 'Asia/Dubai',
      'Asia/Kolkata' => 'Asia/Kolkata',
      'Europe/Amsterdam' => 'Europe/Amsterdam',
      'Europe/Oslo' => 'Europe/Oslo',
      'Europe/London' => 'Europe/London',
    ];

    $form['time_zone_timezone'] = [
      '#type' => 'select',
      '#title' => $this->t('Select Timezone'),
      '#default_value' => $config->get('time_zone_timezone'),
      '#options' => $elements,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Retrieve the configuration.
    $this->configFactory->getEditable(static::SETTINGS)
      ->set('time_zone_country', $form_state->getValue('time_zone_country'))
      ->set('time_zone_city', $form_state->getValue('time_zone_city'))
      ->set('time_zone_timezone', $form_state->getValue('time_zone_timezone'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
