<?php

namespace Drupal\KernelTests\Core\Config;

use Drupal\KernelTests\KernelTestBase;

/**
 * Unit tests for configuration entity base methods.
 *
 * @group config
 */
class ConfigEntityUnitTest extends KernelTestBase {

  /**
   * Exempt from strict schema checking.
   *
<<<<<<< HEAD
   * @see \Drupal\Core\Config\Testing\ConfigSchemaChecker
=======
   * @see \Drupal\Core\Config\Development\ConfigSchemaChecker
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
   *
   * @var bool
   */
  protected $strictConfigSchema = FALSE;

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('config_test');
=======
  public static $modules = ['config_test'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * The config_test entity storage.
   *
   * @var \Drupal\Core\Config\Entity\ConfigEntityStorageInterface
   */
  protected $storage;

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    $this->storage = $this->container->get('entity.manager')->getStorage('config_test');
  }

  /**
   * Tests storage methods.
   */
  public function testStorageMethods() {
    $entity_type = \Drupal::entityManager()->getDefinition('config_test');

    // Test the static extractID() method.
    $expected_id = 'test_id';
    $config_name = $entity_type->getConfigPrefix() . '.' . $expected_id;
    $storage = $this->storage;
    $this->assertIdentical($storage::getIDFromConfigName($config_name, $entity_type->getConfigPrefix()), $expected_id);

    // Create three entities, two with the same style.
    $style = $this->randomMachineName(8);
    for ($i = 0; $i < 2; $i++) {
<<<<<<< HEAD
      $entity = $this->storage->create(array(
        'id' => $this->randomMachineName(),
        'label' => $this->randomString(),
        'style' => $style,
      ));
      $entity->save();
    }
    $entity = $this->storage->create(array(
=======
      $entity = $this->storage->create([
        'id' => $this->randomMachineName(),
        'label' => $this->randomString(),
        'style' => $style,
      ]);
      $entity->save();
    }
    $entity = $this->storage->create([
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'id' => $this->randomMachineName(),
      'label' => $this->randomString(),
      // Use a different length for the entity to ensure uniqueness.
      'style' => $this->randomMachineName(9),
<<<<<<< HEAD
    ));
=======
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $entity->save();

    // Ensure that the configuration entity can be loaded by UUID.
    $entity_loaded_by_uuid = \Drupal::entityManager()->loadEntityByUuid($entity_type->id(), $entity->uuid());
    if (!$entity_loaded_by_uuid) {
      $this->fail(sprintf("Failed to load '%s' entity ID '%s' by UUID '%s'.", $entity_type->id(), $entity->id(), $entity->uuid()));
    }
    // Compare UUIDs as the objects are not identical since
    // $entity->enforceIsNew is FALSE and $entity_loaded_by_uuid->enforceIsNew
    // is NULL.
    $this->assertIdentical($entity->uuid(), $entity_loaded_by_uuid->uuid());

    $entities = $this->storage->loadByProperties();
    $this->assertEqual(count($entities), 3, 'Three entities are loaded when no properties are specified.');

<<<<<<< HEAD
    $entities = $this->storage->loadByProperties(array('style' => $style));
=======
    $entities = $this->storage->loadByProperties(['style' => $style]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertEqual(count($entities), 2, 'Two entities are loaded when the style property is specified.');

    // Assert that both returned entities have a matching style property.
    foreach ($entities as $entity) {
      $this->assertIdentical($entity->get('style'), $style, 'The loaded entity has the correct style value specified.');
    }

    // Test that schema type enforcement can be overridden by trusting the data.
<<<<<<< HEAD
    $entity = $this->storage->create(array(
      'id' => $this->randomMachineName(),
      'label' => $this->randomString(),
      'style' => 999
    ));
=======
    $entity = $this->storage->create([
      'id' => $this->randomMachineName(),
      'label' => $this->randomString(),
      'style' => 999
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $entity->save();
    $this->assertIdentical('999', $entity->style);
    $entity->style = 999;
    $entity->trustData()->save();
    $this->assertIdentical(999, $entity->style);
    $entity->save();
    $this->assertIdentical('999', $entity->style);
  }

}
