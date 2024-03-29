<?php

namespace Drupal\KernelTests\Core\Config;

use Drupal\config_entity_static_cache_test\ConfigOverrider;
use Drupal\KernelTests\KernelTestBase;

/**
 * Tests the entity static cache when used by config entities.
 *
 * @group config
 */
class ConfigEntityStaticCacheTest extends KernelTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('config_test', 'config_entity_static_cache_test');
=======
  public static $modules = ['config_test', 'config_entity_static_cache_test'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * The type ID of the entity under test.
   *
   * @var string
   */
  protected $entityTypeId;

  /**
   * The entity ID of the entity under test.
   *
   * @var string
   */
  protected $entityId;

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    $this->entityTypeId = 'config_test';
    $this->entityId = 'test_1';
    $this->container->get('entity_type.manager')
      ->getStorage($this->entityTypeId)
<<<<<<< HEAD
      ->create(array('id' => $this->entityId, 'label' => 'Original label'))
=======
      ->create(['id' => $this->entityId, 'label' => 'Original label'])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->save();
  }

  /**
   * Tests that the static cache is working.
   */
  public function testCacheHit() {
<<<<<<< HEAD
    $entity_1 = entity_load($this->entityTypeId, $this->entityId);
    $entity_2 = entity_load($this->entityTypeId, $this->entityId);
=======
    $storage = $this->container->get('entity_type.manager')
      ->getStorage($this->entityTypeId);
    $entity_1 = $storage->load($this->entityId);
    $entity_2 = $storage->load($this->entityId);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    // config_entity_static_cache_test_config_test_load() sets _loadStamp to a
    // random string. If they match, it means $entity_2 was retrieved from the
    // static cache rather than going through a separate load sequence.
    $this->assertIdentical($entity_1->_loadStamp, $entity_2->_loadStamp);
  }

  /**
   * Tests that the static cache is reset on entity save and delete.
   */
  public function testReset() {
<<<<<<< HEAD
    $entity = entity_load($this->entityTypeId, $this->entityId);
=======
    $storage = $this->container->get('entity_type.manager')
      ->getStorage($this->entityTypeId);
    $entity = $storage->load($this->entityId);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Ensure loading after a save retrieves the updated entity rather than an
    // obsolete cached one.
    $entity->label = 'New label';
    $entity->save();
<<<<<<< HEAD
    $entity = entity_load($this->entityTypeId, $this->entityId);
=======
    $entity = $storage->load($this->entityId);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdentical($entity->label, 'New label');

    // Ensure loading after a delete retrieves NULL rather than an obsolete
    // cached one.
    $entity->delete();
<<<<<<< HEAD
    $this->assertNull(entity_load($this->entityTypeId, $this->entityId));
=======
    $this->assertNull($storage->load($this->entityId));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Tests that the static cache is sensitive to config overrides.
   */
  public function testConfigOverride() {
    /** @var \Drupal\Core\Config\Entity\ConfigEntityStorage $storage */
    $storage = \Drupal::entityManager()->getStorage($this->entityTypeId);
    // Prime the cache prior to adding a config override.
    $storage->load($this->entityId);

    // Add the config override, and ensure that what is loaded is correct
    // despite the prior cache priming.
    \Drupal::configFactory()->addOverride(new ConfigOverrider());
    $entity_override = $storage->load($this->entityId);
    $this->assertIdentical($entity_override->label, 'Overridden label');

    // Load override free to ensure that loading the config entity again does
    // not return the overridden value.
    $entity_no_override = $storage->loadOverrideFree($this->entityId);
    $this->assertNotIdentical($entity_no_override->label, 'Overridden label');
    $this->assertNotIdentical($entity_override->_loadStamp, $entity_no_override->_loadStamp);

    // Reload the entity and ensure the cache is used.
    $this->assertIdentical($storage->loadOverrideFree($this->entityId)->_loadStamp, $entity_no_override->_loadStamp);

    // Enable overrides and reload the entity and ensure the cache is used.
    $this->assertIdentical($storage->load($this->entityId)->_loadStamp, $entity_override->_loadStamp);
  }

}
