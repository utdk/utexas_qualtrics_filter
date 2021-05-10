<?php

namespace Drupal\utexas_qualtrics_filter\Plugin\Filter;

use Drupal\filter\FilterProcessResult;
use Drupal\filter\Plugin\FilterBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Render\PlainTextOutput;

/**
 * @Filter(
 *   id = "filter_qualtrics",
 *   title = @Translation("Qualtrics Filter"),
 *   description = @Translation("Help this text format filter qualtrics forms."),
 *   type = Drupal\filter\Plugin\FilterInterface::TYPE_MARKUP_LANGUAGE,
 * )
 */
class FilterQualtrics extends FilterBase {

  /**
   * {@inheritdoc}
   */
  public function process($text, $langcode) {
    // Do nothing if there is no oembed objects in the body field.
    if (strpos($text, "qualtrics.com")) {
      $result = $this->utexas_qualtrics_filter($text);
      $result = new FilterProcessResult($result);
      // Add CSS if checkbox variable checked.
      if ($this->settings['qualtrics_css']) {
        $result->setAttachments([
          'library' => ['utexas_qualtrics_filter/qualtrics-form'],
        ]);
      }
      return $result;
    }
    return new FilterProcessResult($text);
  }

  /**
   * Settings form.
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $form['qualtrics_css'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Add CSS?'),
      '#default_value' => $this->settings['qualtrics_css'] ?? NULL,
      '#description' => $this->t('Add styles to Qualtrics form rendered in nodes.'),
    ];
    return $form;
  }

  /**
   * Callback function that will update the $text variable.
   */
  public function utexas_qualtrics_filter($text) {
    // Lookup for all qualtrics urls in the WYSIWYG field.
    if (preg_match_all('/\[embed\]((.+qualtrics.com.+))?( .+)?\[\/embed\]/iU', $text, $matches_code)) {
      foreach ($matches_code[0] as $ci => $code) {
        $form = [
          'source' => $matches_code[2][$ci],
        ];

        // Override default attributes.
        if ($matches_code[3][$ci] && preg_match_all('/\|\s*([a-zA-Z_]+)\:(\s*)?([0-9a-zA-Z \/]+)(\s*)/i', $matches_code[3][$ci], $matches_attributes)) {
          foreach ($matches_attributes[0] as $ai => $value) {
            $form[$matches_attributes[1][$ai]] = $matches_attributes[3][$ai];
          }
        }

        $form['height'] = filter_var(isset($form['height']), FILTER_VALIDATE_INT) ? trim($form['height']) : 500;
        $form['title'] = PlainTextOutput::renderFromHtml(isset($form['title']) ? trim($form['title']) : 'Qualtrics Form');

        if (!$replacement = $this->_utexas_qualtrics_filter_iframe($form)) {
          // Invalid callback.
          $replacement = '<!-- QUALTRICS FILTER - INVALID CALLBACK IN: ' . $code . ' -->';
        }
        $text = str_replace($code, $replacement, $text);
      }
    }
    return trim($text);
  }

  /**
   * Wrapper that calls the theme function.
   */
  function _utexas_qualtrics_filter_iframe($form) {
    if (!filter_var($form['source'], FILTER_VALIDATE_URL) === FALSE) {
      $output = '<iframe src="' . $form['source'] . '" width="100%" scrolling="auto" name="Qualtrics"
      align="center" height="' . $form['height'] . '" frameborder="no" title="' . $form['title'] . '" class="qualtrics-form" ></iframe>';
      return $output;
    }
    else
      return FALSE;
  }

}
