<?php

/**
 * @file
 * Contains Drupal\d8_form\Plugin\Block\SimpleFormBlock.
 */

namespace Drupal\d8_form\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'SimpleFormBlock' block.
 *
 * @Block(
 *  id = "simple_form_block",
 *  admin_label = @Translation("Simple form as a block"),
 * )
 */
class SimpleFormBlock extends BlockBase {


  /**
   * {@inheritdoc}
   */
  public function build() {
    return \Drupal::formBuilder()->getForm('\Drupal\d8_form\Form\SimpleForm');
  }

}
