<?php

namespace Drupal\field\Tests\Number;

use Drupal\Component\Utility\Unicode;
use Drupal\field\Entity\FieldConfig;
use Drupal\node\Entity\Node;
use Drupal\simpletest\WebTestBase;
use Drupal\field\Entity\FieldStorageConfig;

/**
 * Tests the creation of numeric fields.
 *
 * @group field
 */
class NumberFieldTest extends WebTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
  public static $modules = ['node', 'entity_test', 'field_ui'];

  protected function setUp() {
    parent::setUp();
    $this->drupalLogin($this->drupalCreateUser([
      'view test entity',
      'administer entity_test content',
      'administer content types',
      'administer node fields',
      'administer node display',
      'bypass node access',
      'administer entity_test fields',
    ]));
  }

  /**
   * Test decimal field.
   */
  public function testNumberDecimalField() {
    // Create a field with settings to validate.
    $field_name = Unicode::strtolower($this->randomMachineName());
    FieldStorageConfig::create([
      'field_name' => $field_name,
      'entity_type' => 'entity_test',
      'type' => 'decimal',
      'settings' => [
        'precision' => 8, 'scale' => 4,
      ]
    ])->save();
    FieldConfig::create([
      'field_name' => $field_name,
      'entity_type' => 'entity_test',
      'bundle' => 'entity_test',
    ])->save();

    entity_get_form_display('entity_test', 'entity_test', 'default')
      ->setComponent($field_name, [
        'type' => 'number',
        'settings' => [
          'placeholder' => '0.00'
        ],
      ])
      ->save();
    entity_get_display('entity_test', 'entity_test', 'default')
      ->setComponent($field_name, [
        'type' => 'number_decimal',
      ])
      ->save();

    // Display creation form.
    $this->drupalGet('entity_test/add');
    $this->assertFieldByName("{$field_name}[0][value]", '', 'Widget is displayed');
    $this->assertRaw('placeholder="0.00"');

    // Submit a signed decimal value within the allowed precision and scale.
    $value = '-1234.5678';
    $edit = [
      "{$field_name}[0][value]" => $value,
    ];
    $this->drupalPostForm(NULL, $edit, t('Save'));
    preg_match('|entity_test/manage/(\d+)|', $this->url, $match);
    $id = $match[1];
    $this->assertText(t('entity_test @id has been created.', ['@id' => $id]), 'Entity was created');
    $this->assertRaw($value, 'Value is displayed.');

    // Try to create entries with more than one decimal separator; assert fail.
    $wrong_entries = [
      '3.14.159',
      '0..45469',
      '..4589',
      '6.459.52',
      '6.3..25',
    ];

    foreach ($wrong_entries as $wrong_entry) {
      $this->drupalGet('entity_test/add');
      $edit = [
        "{$field_name}[0][value]" => $wrong_entry,
      ];
      $this->drupalPostForm(NULL, $edit, t('Save'));
      $this->assertRaw(t('%name must be a number.', ['%name' => $field_name]), 'Correctly failed to save decimal value with more than one decimal point.');
    }

    // Try to create entries with minus sign not in the first position.
    $wrong_entries = [
      '3-3',
      '4-',
      '1.3-',
      '1.2-4',
      '-10-10',
    ];

    foreach ($wrong_entries as $wrong_entry) {
      $this->drupalGet('entity_test/add');
      $edit = [
        "{$field_name}[0][value]" => $wrong_entry,
      ];
      $this->drupalPostForm(NULL, $edit, t('Save'));
      $this->assertRaw(t('%name must be a number.', ['%name' => $field_name]), 'Correctly failed to save decimal value with minus sign in the wrong position.');
    }
  }

  /**
   * Test integer field.
   */
  public function testNumberIntegerField() {
    $minimum = rand(-4000, -2000);
    $maximum = rand(2000, 4000);

    // Create a field with settings to validate.
    $field_name = Unicode::strtolower($this->randomMachineName());
    $storage = FieldStorageConfig::create([
      'field_name' => $field_name,
      'entity_type' => 'entity_test',
      'type' => 'integer',
    ]);
    $storage->save();

    FieldConfig::create([
      'field_name' => $field_name,
      'entity_type' => 'entity_test',
      'bundle' => 'entity_test',
      'settings' => [
        'min' => $minimum, 'max' => $maximum, 'prefix' => 'ThePrefix',
      ]
    ])->save();

    entity_get_form_display('entity_test', 'entity_test', 'default')
      ->setComponent($field_name, [
        'type' => 'number',
        'settings' => [
          'placeholder' => '4'
        ],
      ])
      ->save();
    entity_get_display('entity_test', 'entity_test', 'default')
      ->setComponent($field_name, [
        'type' => 'number_integer',
        'settings' => [
          'prefix_suffix' => FALSE,
        ],
      ])
      ->save();

    // Check the storage schema.
    $expected = [
      'columns' => [
        'value' => [
          'type' => 'int',
          'unsigned' => '',
          'size' => 'normal'
        ],
      ],
      'unique keys' => [],
      'indexes' => [],
      'foreign keys' => []
    ];
    $this->assertEqual($storage->getSchema(), $expected);

    // Display creation form.
    $this->drupalGet('entity_test/add');
    $this->assertFieldByName("{$field_name}[0][value]", '', 'Widget is displayed');
    $this->assertRaw('placeholder="4"');

    // Submit a valid integer
    $value = rand($minimum, $maximum);
    $edit = [
      "{$field_name}[0][value]" => $value,
    ];
    $this->drupalPostForm(NULL, $edit, t('Save'));
    preg_match('|entity_test/manage/(\d+)|', $this->url, $match);
    $id = $match[1];
    $this->assertText(t('entity_test @id has been created.', ['@id' => $id]), 'Entity was created');

    // Try to set a value below the minimum value
    $this->drupalGet('entity_test/add');
    $edit = [
      "{$field_name}[0][value]" => $minimum - 1,
    ];
    $this->drupalPostForm(NULL, $edit, t('Save'));
    $this->assertRaw(t('%name must be higher than or equal to %minimum.', ['%name' => $field_name, '%minimum' => $minimum]), 'Correctly failed to save integer value less than minimum allowed value.');

    // Try to set a decimal value
    $this->drupalGet('entity_test/add');
    $edit = [
      "{$field_name}[0][value]" => 1.5,
    ];
    $this->drupalPostForm(NULL, $edit, t('Save'));
    $this->assertRaw(t('%name is not a valid number.', ['%name' => $field_name]), 'Correctly failed to save decimal value to integer field.');

    // Try to set a value above the maximum value
    $this->drupalGet('entity_test/add');
    $edit = [
      "{$field_name}[0][value]" => $maximum + 1,
    ];
    $this->drupalPostForm(NULL, $edit, t('Save'));
    $this->assertRaw(t('%name must be lower than or equal to %maximum.', ['%name' => $field_name, '%maximum' => $maximum]), 'Correctly failed to save integer value greater than maximum allowed value.');

    // Try to set a wrong integer value.
    $this->drupalGet('entity_test/add');
    $edit = [
      "{$field_name}[0][value]" => '20-40',
    ];
    $this->drupalPostForm(NULL, $edit, t('Save'));
    $this->assertRaw(t('%name must be a number.', ['%name' => $field_name]), 'Correctly failed to save wrong integer value.');

    // Test with valid entries.
    $valid_entries = [
      '-1234',
      '0',
      '1234',
    ];

    foreach ($valid_entries as $valid_entry) {
      $this->drupalGet('entity_test/add');
      $edit = [
        "{$field_name}[0][value]" => $valid_entry,
      ];
      $this->drupalPostForm(NULL, $edit, t('Save'));
      preg_match('|entity_test/manage/(\d+)|', $this->url, $match);
      $id = $match[1];
      $this->assertText(t('entity_test @id has been created.', ['@id' => $id]), 'Entity was created');
      $this->assertRaw($valid_entry, 'Value is displayed.');
      $this->assertNoFieldByXpath('//div[@content="' . $valid_entry . '"]', NULL, 'The "content" attribute is not present since the Prefix is not being displayed');
    }

    // Test for the content attribute when a Prefix is displayed. Presumably this also tests for the attribute when a Suffix is displayed.
    entity_get_display('entity_test', 'entity_test', 'default')
      ->setComponent($field_name, [
        'type' => 'number_integer',
        'settings' => [
          'prefix_suffix' => TRUE,
        ],
      ])
      ->save();
    $integer_value = '123';
    $this->drupalGet('entity_test/add');
    $edit = [
      "{$field_name}[0][value]" => $integer_value,
    ];
    $this->drupalPostForm(NULL, $edit, t('Save'));
    preg_match('|entity_test/manage/(\d+)|', $this->url, $match);
    $id = $match[1];
    $this->assertText(t('entity_test @id has been created.', ['@id' => $id]), 'Entity was created');
    $this->drupalGet('entity_test/' . $id);
    $this->assertFieldByXPath('//div[@content="' . $integer_value . '"]', 'ThePrefix' . $integer_value, 'The "content" attribute has been set to the value of the field, and the prefix is being displayed.');
  }

  /**
  * Test float field.
  */
  public function testNumberFloatField() {
    // Create a field with settings to validate.
    $field_name = Unicode::strtolower($this->randomMachineName());
    FieldStorageConfig::create([
      'field_name' => $field_name,
      'entity_type' => 'entity_test',
      'type' => 'float',
    ])->save();

    FieldConfig::create([
      'field_name' => $field_name,
      'entity_type' => 'entity_test',
      'bundle' => 'entity_test',
    ])->save();

    entity_get_form_display('entity_test', 'entity_test', 'default')
      ->setComponent($field_name, [
        'type' => 'number',
        'settings' => [
          'placeholder' => '0.00'
        ],
      ])
      ->save();

    entity_get_display('entity_test', 'entity_test', 'default')
      ->setComponent($field_name, [
        'type' => 'number_decimal',
      ])
      ->save();

    // Display creation form.
    $this->drupalGet('entity_test/add');
    $this->assertFieldByName("{$field_name}[0][value]", '', 'Widget is displayed');
    $this->assertRaw('placeholder="0.00"');

    // Submit a signed decimal value within the allowed precision and scale.
    $value = '-1234.5678';
    $edit = [
      "{$field_name}[0][value]" => $value,
    ];
    $this->drupalPostForm(NULL, $edit, t('Save'));
    preg_match('|entity_test/manage/(\d+)|', $this->url, $match);
    $id = $match[1];
    $this->assertText(t('entity_test @id has been created.', ['@id' => $id]), 'Entity was created');

    // Ensure that the 'number_decimal' formatter displays the number with the
    // expected rounding.
    $this->drupalGet('entity_test/' . $id);
    $this->assertRaw(round($value, 2));

    // Try to create entries with more than one decimal separator; assert fail.
    $wrong_entries = [
      '3.14.159',
      '0..45469',
      '..4589',
      '6.459.52',
      '6.3..25',
    ];

    foreach ($wrong_entries as $wrong_entry) {
      $this->drupalGet('entity_test/add');
      $edit = [
        "{$field_name}[0][value]" => $wrong_entry,
      ];
      $this->drupalPostForm(NULL, $edit, t('Save'));
      $this->assertRaw(t('%name must be a number.', ['%name' => $field_name]), 'Correctly failed to save float value with more than one decimal point.');
    }

    // Try to create entries with minus sign not in the first position.
    $wrong_entries = [
      '3-3',
      '4-',
      '1.3-',
      '1.2-4',
      '-10-10',
    ];

    foreach ($wrong_entries as $wrong_entry) {
      $this->drupalGet('entity_test/add');
      $edit = [
        "{$field_name}[0][value]" => $wrong_entry,
      ];
      $this->drupalPostForm(NULL, $edit, t('Save'));
      $this->assertRaw(t('%name must be a number.', ['%name' => $field_name]), 'Correctly failed to save float value with minus sign in the wrong position.');
    }
  }

  /**
   * Test default formatter behavior
   */
  public function testNumberFormatter() {
    $type = Unicode::strtolower($this->randomMachineName());
    $float_field = Unicode::strtolower($this->randomMachineName());
    $integer_field = Unicode::strtolower($this->randomMachineName());
    $thousand_separators = ['', '.', ',', ' ', chr(8201), "'"];
    $decimal_separators = ['.', ','];
    $prefix = $this->randomMachineName();
    $suffix = $this->randomMachineName();
    $random_float = rand(0, pow(10, 6));
    $random_integer = rand(0, pow(10, 6));

    // Create a content type containing float and integer fields.
    $this->drupalCreateContentType(['type' => $type]);

    FieldStorageConfig::create([
      'field_name' => $float_field,
      'entity_type' => 'node',
      'type' => 'float',
    ])->save();

    FieldStorageConfig::create([
      'field_name' => $integer_field,
      'entity_type' => 'node',
      'type' => 'integer',
    ])->save();

    FieldConfig::create([
      'field_name' => $float_field,
      'entity_type' => 'node',
      'bundle' => $type,
      'settings' => [
        'prefix' => $prefix,
        'suffix' => $suffix
      ],
    ])->save();

    FieldConfig::create([
      'field_name' => $integer_field,
      'entity_type' => 'node',
      'bundle' => $type,
      'settings' => [
        'prefix' => $prefix,
        'suffix' => $suffix
      ],
    ])->save();

    entity_get_form_display('node', $type, 'default')
      ->setComponent($float_field, [
        'type' => 'number',
        'settings' => [
          'placeholder' => '0.00'
        ],
      ])
      ->setComponent($integer_field, [
        'type' => 'number',
        'settings' => [
          'placeholder' => '0.00'
        ],
      ])
      ->save();

    entity_get_display('node', $type, 'default')
      ->setComponent($float_field, [
        'type' => 'number_decimal',
      ])
      ->setComponent($integer_field, [
        'type' => 'number_unformatted',
      ])
      ->save();

    // Create a node to test formatters.
    $node = Node::create([
      'type' => $type,
      'title' => $this->randomMachineName(),
      $float_field => ['value' => $random_float],
      $integer_field => ['value' => $random_integer],
    ]);
    $node->save();

    // Go to manage display page.
    $this->drupalGet("admin/structure/types/manage/$type/display");

    // Configure number_decimal formatter for the 'float' field type.
    $thousand_separator = $thousand_separators[array_rand($thousand_separators)];
    $decimal_separator = $decimal_separators[array_rand($decimal_separators)];
    $scale = rand(0, 10);

    $this->drupalPostAjaxForm(NULL, [], "${float_field}_settings_edit");
    $edit = [
      "fields[${float_field}][settings_edit_form][settings][prefix_suffix]" => TRUE,
      "fields[${float_field}][settings_edit_form][settings][scale]" => $scale,
      "fields[${float_field}][settings_edit_form][settings][decimal_separator]" => $decimal_separator,
      "fields[${float_field}][settings_edit_form][settings][thousand_separator]" => $thousand_separator,
    ];
    $this->drupalPostAjaxForm(NULL, $edit, "${float_field}_plugin_settings_update");
    $this->drupalPostForm(NULL, [], t('Save'));

    // Check number_decimal and number_unformatted formatters behavior.
    $this->drupalGet('node/' . $node->id());
    $float_formatted = number_format($random_float, $scale, $decimal_separator, $thousand_separator);
    $this->assertRaw("$prefix$float_formatted$suffix", 'Prefix and suffix added');
    $this->assertRaw((string) $random_integer);

    // Configure the number_decimal formatter.
    entity_get_display('node', $type, 'default')
      ->setComponent($integer_field, [
        'type' => 'number_integer',
      ])
      ->save();
    $this->drupalGet("admin/structure/types/manage/$type/display");

    $thousand_separator = $thousand_separators[array_rand($thousand_separators)];

    $this->drupalPostAjaxForm(NULL, [], "${integer_field}_settings_edit");
    $edit = [
      "fields[${integer_field}][settings_edit_form][settings][prefix_suffix]" => FALSE,
      "fields[${integer_field}][settings_edit_form][settings][thousand_separator]" => $thousand_separator,
    ];
    $this->drupalPostAjaxForm(NULL, $edit, "${integer_field}_plugin_settings_update");
    $this->drupalPostForm(NULL, [], t('Save'));

    // Check number_integer formatter behavior.
    $this->drupalGet('node/' . $node->id());

    $integer_formatted = number_format($random_integer, 0, '', $thousand_separator);
    $this->assertRaw($integer_formatted, 'Random integer formatted');
  }

  /**
   * Tests setting the minimum value of a float field through the interface.
   */
  public function testCreateNumberFloatField() {
    // Create a float field.
    $field_name = Unicode::strtolower($this->randomMachineName());
    FieldStorageConfig::create([
      'field_name' => $field_name,
      'entity_type' => 'entity_test',
      'type' => 'float',
    ])->save();

    $field = FieldConfig::create([
      'field_name' => $field_name,
      'entity_type' => 'entity_test',
      'bundle' => 'entity_test',
    ]);
    $field->save();

    // Set the minimum value to a float value.
    $this->assertSetMinimumValue($field, 0.0001);
    // Set the minimum value to an integer value.
    $this->assertSetMinimumValue($field, 1);
  }

  /**
   * Tests setting the minimum value of a decimal field through the interface.
   */
  public function testCreateNumberDecimalField() {
    // Create a decimal field.
    $field_name = Unicode::strtolower($this->randomMachineName());
    FieldStorageConfig::create([
      'field_name' => $field_name,
      'entity_type' => 'entity_test',
      'type' => 'decimal',
    ])->save();

    $field = FieldConfig::create([
      'field_name' => $field_name,
      'entity_type' => 'entity_test',
      'bundle' => 'entity_test',
    ]);
    $field->save();

    // Set the minimum value to a decimal value.
    $this->assertSetMinimumValue($field, 0.1);
    // Set the minimum value to an integer value.
    $this->assertSetMinimumValue($field, 1);
  }

  /**
   * Helper function to set the minimum value of a field.
   */
  public function assertSetMinimumValue($field, $minimum_value) {
    $field_configuration_url = 'entity_test/structure/entity_test/fields/entity_test.entity_test.' . $field->getName();

    // Set the minimum value.
    $edit = [
      'settings[min]' => $minimum_value,
    ];
    $this->drupalPostForm($field_configuration_url, $edit, t('Save settings'));
    // Check if an error message is shown.
<<<<<<< HEAD
    $this->assertNoRaw(t('%name is not a valid number.', array('%name' => t('Minimum'))), 'Saved ' . gettype($minimum_value) . '  value as minimal value on a ' . $field->getType() . ' field');
=======
    $this->assertNoRaw(t('%name is not a valid number.', ['%name' => t('Minimum')]), 'Saved ' . gettype($minimum_value) . '  value as minimal value on a ' . $field->getType() . ' field');
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    // Check if a success message is shown.
    $this->assertRaw(t('Saved %label configuration.', ['%label' => $field->getLabel()]));
    // Check if the minimum value was actually set.
    $this->drupalGet($field_configuration_url);
    $this->assertFieldById('edit-settings-min', $minimum_value, 'Minimal ' . gettype($minimum_value) . '  value was set on a ' . $field->getType() . ' field.');
  }

}
