<?php

namespace Drupal\block_content\Plugin\migrate\source\d6;

use Drupal\migrate_drupal\Plugin\migrate\source\DrupalSqlBase;

/**
 * Drupal 6 block source from database.
 *
 * @MigrateSource(
 *   id = "d6_box"
 * )
 */
class Box extends DrupalSqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('boxes', 'b')
<<<<<<< HEAD
      ->fields('b', array('bid', 'body', 'info', 'format'));
=======
      ->fields('b', ['bid', 'body', 'info', 'format']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $query->orderBy('b.bid');

    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    return [
      'bid' => $this->t('The numeric identifier of the block/box'),
      'body' => $this->t('The block/box content'),
      'info' => $this->t('Admin title of the block/box.'),
      'format' => $this->t('Input format of the custom block/box content.'),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    $ids['bid']['type'] = 'integer';
    return $ids;
  }

}
