<?php

namespace Drupal\Tests\text\Kernel;

use Drupal\field\Entity\FieldConfig;
use Drupal\filter\Entity\FilterFormat;
use Drupal\KernelTests\Core\Entity\EntityKernelTestBase;
use Drupal\field\Entity\FieldStorageConfig;

/**
 * Tests the text formatters functionality.
 *
 * @group text
 */
class TextFormatterTest extends EntityKernelTestBase {

  /**
   * The entity type used in this test.
   *
   * @var string
   */
  protected $entityType = 'entity_test';

  /**
   * The bundle used in this test.
   *
   * @var string
   */
  protected $bundle = 'entity_test';

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('text');
=======
  public static $modules = ['text'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

<<<<<<< HEAD
    FilterFormat::create(array(
      'format' => 'my_text_format',
      'name' => 'My text format',
      'filters' => array(
        'filter_autop' => array(
          'module' => 'filter',
          'status' => TRUE,
        ),
      ),
    ))->save();

    FieldStorageConfig::create(array(
      'field_name' => 'formatted_text',
      'entity_type' => $this->entityType,
      'type' => 'text',
      'settings' => array(),
    ))->save();
=======
    FilterFormat::create([
      'format' => 'my_text_format',
      'name' => 'My text format',
      'filters' => [
        'filter_autop' => [
          'module' => 'filter',
          'status' => TRUE,
        ],
      ],
    ])->save();

    FieldStorageConfig::create([
      'field_name' => 'formatted_text',
      'entity_type' => $this->entityType,
      'type' => 'text',
      'settings' => [],
    ])->save();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    FieldConfig::create([
      'entity_type' => $this->entityType,
      'bundle' => $this->bundle,
      'field_name' => 'formatted_text',
      'label' => 'Filtered text',
    ])->save();
  }

  /**
   * Tests all text field formatters.
   */
  public function testFormatters() {
<<<<<<< HEAD
    $formatters = array(
      'text_default',
      'text_trimmed',
      'text_summary_or_trimmed',
    );
=======
    $formatters = [
      'text_default',
      'text_trimmed',
      'text_summary_or_trimmed',
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Create the entity to be referenced.
    $entity = $this->container->get('entity_type.manager')
      ->getStorage($this->entityType)
<<<<<<< HEAD
      ->create(array('name' => $this->randomMachineName()));
    $entity->formatted_text = array(
      'value' => 'Hello, world!',
      'format' => 'my_text_format',
    );
=======
      ->create(['name' => $this->randomMachineName()]);
    $entity->formatted_text = [
      'value' => 'Hello, world!',
      'format' => 'my_text_format',
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $entity->save();

    foreach ($formatters as $formatter) {
      // Verify the text field formatter's render array.
<<<<<<< HEAD
      $build = $entity->get('formatted_text')->view(array('type' => $formatter));
      \Drupal::service('renderer')->renderRoot($build[0]);
      $this->assertEqual($build[0]['#markup'], "<p>Hello, world!</p>\n");
      $this->assertEqual($build[0]['#cache']['tags'], FilterFormat::load('my_text_format')->getCacheTags(), format_string('The @formatter formatter has the expected cache tags when formatting a formatted text field.', array('@formatter' => $formatter)));
=======
      $build = $entity->get('formatted_text')->view(['type' => $formatter]);
      \Drupal::service('renderer')->renderRoot($build[0]);
      $this->assertEqual($build[0]['#markup'], "<p>Hello, world!</p>\n");
      $this->assertEqual($build[0]['#cache']['tags'], FilterFormat::load('my_text_format')->getCacheTags(), format_string('The @formatter formatter has the expected cache tags when formatting a formatted text field.', ['@formatter' => $formatter]));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    }
  }

}
