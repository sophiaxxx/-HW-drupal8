<?php

namespace Drupal\Tests\field\Kernel;

use Drupal\Core\Field\BaseFieldDefinition;

/**
 * Tests the field formatter plugin manager.
 *
 * @group field
 */
class FormatterPluginManagerTest extends FieldKernelTestBase {

  /**
   * Tests that getInstance falls back on default if current is not applicable.
   *
   * @see \Drupal\field\Tests\WidgetPluginManagerTest::testNotApplicableFallback()
   */
  public function testNotApplicableFallback() {
    /** @var \Drupal\Core\Field\FormatterPluginManager $formatter_plugin_manager */
    $formatter_plugin_manager = \Drupal::service('plugin.manager.field.formatter');

    $base_field_definition = BaseFieldDefinition::create('test_field')
      // Set a name that will make isApplicable() return TRUE.
      ->setName('field_test_field');

<<<<<<< HEAD
    $formatter_options = array(
      'field_definition' => $base_field_definition,
      'view_mode' => 'default',
      'configuration' => array(
        'type' => 'field_test_applicable',
      ),
    );
=======
    $formatter_options = [
      'field_definition' => $base_field_definition,
      'view_mode' => 'default',
      'configuration' => [
        'type' => 'field_test_applicable',
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $instance = $formatter_plugin_manager->getInstance($formatter_options);
    $this->assertEqual($instance->getPluginId(), 'field_test_applicable');

    // Now set name to something that makes isApplicable() return FALSE.
    $base_field_definition->setName('deny_applicable');
    $instance = $formatter_plugin_manager->getInstance($formatter_options);

    // Instance should be default widget.
    $this->assertNotEqual($instance->getPluginId(), 'field_test_applicable');
    $this->assertEqual($instance->getPluginId(), 'field_test_default');
  }

}
