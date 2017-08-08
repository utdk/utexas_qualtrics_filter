<?php

namespace Drupal\utexas_qualtrics_filter\Plugin\CKEditorPlugin;

use Drupal\editor\Entity\Editor;
use Drupal\ckeditor\CKEditorPluginBase;

/**
 * Defines the "qualtricsbutton" plugin.
 *
 * @CKEditorPlugin(
 *   id = "qualtricsbutton",
 *   label = @Translation("Qualtrics button"),
 *   module = "utexas_qualtrics_filter"
 * )
 */
class qualtricsbutton extends CKEditorPluginBase {

  /**
   * Implements \Drupal\ckeditor\Plugin\CKEditorPluginInterface::getFile().
   */
  public function getFile() {
    $path = drupal_get_path('module', 'utexas_qualtrics_filter');
    return $path . '/qualtricsbutton/plugin.js';
  }

  /**
   * {@inheritdoc}
   */
  public function getLibraries(Editor $editor) {
    return array();
  }

  /**
   * {@inheritdoc}
   */
  public function isInternal() {
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function getButtons() {
    return array(
      'qualtricsbutton' => array(
        'label' => t('Qualtrics Button'),
        'image' => drupal_get_path('module', 'utexas_qualtrics_filter') . '/qualtricsbutton/icons/qualtricsbutton.png',
      ),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getConfig(Editor $editor) {
    return array();
  }

}
