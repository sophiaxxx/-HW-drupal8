<?php

namespace Drupal\migrate\Plugin\migrate\destination;

/**
 * Provides entity view mode destination plugin.
 *
 * @MigrateDestination(
 *   id = "entity:entity_view_mode"
 * )
 */
class EntityViewMode extends EntityConfigBase {

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    $ids['targetEntityType']['type'] = 'string';
    $ids['mode']['type'] = 'string';
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
