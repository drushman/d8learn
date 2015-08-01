<?php

/**
 * @file
 * Contains Drupal\d8_form\Form\SimpleForm.
 */

namespace Drupal\d8_form\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class SimpleForm.
 *
 * @package Drupal\d8_form\Form
 */
class SimpleForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'd8_form.simple_config'
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'simple_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('d8_form.simple_config');
    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#description' => $this->t('Give your name'),
      '#maxlength' => 60,
      '#default_value' => $config->get('name'),
    );
    $form['mail'] = array(
      '#type' => 'email',
      '#title' => $this->t('Mail'),
      '#description' => $this->t('Give your mail'),
      '#default_value' => $config->get('mail'),
    );
    $form['bank_account'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Bank account'),
      '#description' => $this->t('Give your bank account'),
      '#default_value' => $config->get('bank_account'),
    );
    $form['phone'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Phone'),
      '#description' => $this->t('Give your phone'),
      '#default_value' => $config->get('phone'),
    );
    $form['birthday'] = array(
      '#type' => 'date',
      '#title' => $this->t('Birthday'),
      '#description' => $this->t('Give your birthday'),
      '#default_value' => $config->get('birthday'),
    );
    $form['give_your_gender'] = array(
      '#type' => 'radios',
      '#title' => $this->t('Give your gender'),
      '#description' => $this->t('Give your gender'),
      '#options' => array($this->t('male') => $this->t('male'), $this->t('female') => $this->t('female'), $this->t('other') => $this->t('other')),
      '#default_value' => $config->get('give_your_gender'),
    );
    $form['give_your_age'] = array(
      '#type' => 'number',
      '#title' => $this->t('Give your age'),
      '#description' => $this->t('Give your age 18+'),
      '#default_value' => $config->get('give_your_age'),
    );
    $form['color'] = array(
      '#type' => 'color',
      '#title' => $this->t('Color'),
      '#description' => $this->t('What\'s color do your like?'),
      '#default_value' => $config->get('color'),
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $age = $form_state->getValue('give_your_age');
    if ($age < 18) {
      $form_state->setErrorByName('give_your_age', $this->t("The must be more than 18."));
    }
    
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('d8_form.simple_config')
      ->set('name', $form_state->getValue('name'))
      ->set('mail', $form_state->getValue('mail'))
      ->set('bank_account', $form_state->getValue('bank_account'))
      ->set('phone', $form_state->getValue('phone'))
      ->set('birthday', $form_state->getValue('birthday'))
      ->set('give_your_gender', $form_state->getValue('give_your_gender'))
      ->set('give_your_age', $form_state->getValue('give_your_age'))
      ->set('color', $form_state->getValue('color'))
      ->save();
  }

}
