<?php

namespace Drupal\acro_orange_layouts\Plugin\Layout;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\PluginFormInterface;
use Drupal\Core\Layout\LayoutDefault;
use Drupal\Component\Utility\Html;

/**
 * Layout class for all Orange layouts.
 */
class OrangeLayoutsBase extends LayoutDefault implements PluginFormInterface {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return parent::defaultConfiguration() + [
      'classes' => '',
      'display_options' => [],
      'bg_color' => '#ffffff',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $configuration = $this->getConfiguration();
    $form['display_options'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('Display Options'),
      '#description' => $this->t('Various options that control the display of this section.'),
      '#options' => [
        'full_width' => $this->t('Full Width'),
        'no_padding' => $this->t('No Padding')
      ],
      '#default_value' => $configuration['display_options'],
      '#multiple' => TRUE,
    ];
    $form['bg_color'] = [
      '#type' => 'color',
      '#title' => $this->t('Background Color'),
      '#description' => $this->t('Changes the background color of this section.'),
      '#default_value' => $configuration['bg_color'],
    ];
    $form['classes'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Custom Classes'),
      '#description' => $this->t('Add additional HTML classes to the layout markup. Separate each class name by a space.<br>Eg: custom-section my-featured-section'),
      '#default_value' => $configuration['classes'],
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateConfigurationForm(array &$form, FormStateInterface $form_state) {
    // Any additional form validation that is required.
  }

  /**
   * {@inheritdoc}
   */
  public function build(array $regions) {
    $configuration = $this->getConfiguration();
    $build = parent::build($regions);

    if (!empty($configuration['classes'])) {
      $classes_value = is_array($configuration['classes']) ? implode(' ', $configuration['classes']) : $configuration['classes'];
      $build['#attributes']['class'][] = $classes_value;
    }
    if (!empty($configuration['bg_color'])) {
      $build['#attributes']['style'] = 'background-color: ' . $configuration['bg_color'];
    }
    if (!empty($configuration['display_options'])) {
      foreach ($configuration['display_options'] as &$option) {
        $option_class_name = 'layout-section--' . $option;
        $option_class = Html::cleanCssIdentifier($option_class_name);
        $build['#attributes']['class'][] = $option_class;
      }
    }

    return $build;
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    $this->configuration['classes'] = $form_state->getValue('classes');
    $this->configuration['display_options'] = array_filter($form_state->getValue('display_options'));
    $this->configuration['bg_color'] = $form_state->getValue('bg_color');
  }

}
