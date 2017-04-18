<?php

namespace Drupal\migrate\Plugin\migrate\destination;

/**
 * Provides entity field storage configuration plugin.
 *
 * @MigrateDestination(
 *   id = "entity:field_storage_config"
 * )
 */
class EntityFieldStorageConfig extends EntityConfigBase {

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    $ids['entity_type']['type'] = 'string';
    $ids['field_name']['type'] = 'string';
    return $ids;
  }

  /**
   * {@inheritdoc}
   */
  public function rollback(array $destination_identifier) {
    $destination_identifier = implode('.', $destination_identifier);
<<<<<<< HEAD
    parent::rollback(array($destination_identifier));
=======
    parent::rollback([$destination_identifier]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

}
