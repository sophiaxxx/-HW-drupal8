<?php

namespace Drupal\migrate\Event;

use Drupal\migrate\Plugin\MigrationInterface;
<<<<<<< HEAD
=======
use Drupal\migrate\MigrateMessageInterface;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
use Drupal\migrate\Row;

/**
 * Wraps a pre-save event for event listeners.
 */
class MigratePreRowSaveEvent extends EventBase {

  /**
   * Row object.
   *
   * @var \Drupal\migrate\Row
   */
  protected $row;

  /**
<<<<<<< HEAD
   * Migration entity.
   *
   * @var \Drupal\migrate\Plugin\MigrationInterface
   */
  protected $migration;

  /**
=======
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
   * Constructs a pre-save event object.
   *
   * @param \Drupal\migrate\Plugin\MigrationInterface $migration
   *   Migration entity.
   * @param \Drupal\migrate\MigrateMessageInterface $message
   *   The current migrate message service.
   * @param \Drupal\migrate\Row $row
   */
  public function __construct(MigrationInterface $migration, MigrateMessageInterface $message, Row $row) {
    parent::__construct($migration, $message);
    $this->row = $row;
  }

  /**
<<<<<<< HEAD
   * Gets the migration entity.
   *
   * @return \Drupal\migrate\Plugin\MigrationInterface
   *   The migration entity being imported.
   */
  public function getMigration() {
    return $this->migration;
  }

  /**
=======
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
   * Gets the row object.
   *
   * @return \Drupal\migrate\Row
   *   The row object about to be imported.
   */
  public function getRow() {
    return $this->row;
  }

}
