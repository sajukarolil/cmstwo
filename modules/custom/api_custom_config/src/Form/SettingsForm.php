<?php

/**
 * @file
 * Contains Drupal\api_custom_config\Form\SettingsForm.
 */

namespace Drupal\api_custom_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;


/**
 * Class SettingsForm.
 *
 * @package Drupal\api_custom_config\Form
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'api_custom_config.adminsettings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'xai_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

	$config = $this->config('api_custom_config.adminsettings');

	$form['api_name'] = array(
		'#type' => 'textfield',
		'#title' => t('API Name: '),
		'#default_value' => $config->get('api_name'),
	);
	
	$form['api_url'] = array(
		'#type' => 'textfield',
		'#title' => t('API URL: '),
		'#default_value' => $config->get('api_url'),
	);	
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('api_custom_config.adminsettings')
		->set('api_name', $form_state->getValue('api_name'))
		->set('api_url', $form_state->getValue('api_url'))
		->save();
  }
}
