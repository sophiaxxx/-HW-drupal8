<?php

namespace Drupal\migrate\Event;

<<<<<<< HEAD
use Drupal\migrate\Plugin\MigrationInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Wraps a pre- or post-import event for event listeners.
 */
class MigrateImportEvent extends Event {

  /**
   * Migration entity.
   *
   * @var \Drupal\migrate\Plugin\MigrationInterface
   */
  protected $migration;

  /**
   * Constructs an import event object.
   *
   * @param \Drupal\migrate\Plugin\MigrationInterface $migration
   *   Migration entity.
   */
  public function __construct(MigrationInterface $migration) {
    $this->migration = $migration;
  }

  /**
   * Gets the migration entity.
   *
   * @return \Drupal\migrate\Plugin\MigrationInterface
   *   The migration entity involved.
   */
  public function getMigration() {
    return $this->migration;
  }

}
=======
/**
 * Wraps a pre- or post-import event for event listeners.
 */
class MigrateImportEvent extends EventBase {}
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
