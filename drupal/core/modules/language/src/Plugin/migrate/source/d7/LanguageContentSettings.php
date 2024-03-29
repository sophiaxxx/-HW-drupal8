<?php

namespace Drupal\language\Plugin\migrate\source\d7;

use Drupal\migrate\Row;
use Drupal\migrate_drupal\Plugin\migrate\source\DrupalSqlBase;

/**
 * Drupal multilingual node settings from database.
 *
 * @MigrateSource(
 *   id = "d7_language_content_settings",
 * )
 */
class LanguageContentSettings extends DrupalSqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    return $this->select('node_type', 't')
<<<<<<< HEAD
      ->fields('t', array(
        'type',
      ));
=======
      ->fields('t', [
        'type',
      ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
<<<<<<< HEAD
    $fields = array(
      'type' => $this->t('Type'),
      'language_content_type' => $this->t('Multilingual support.'),
      'i18n_lock_node' => $this->t('Lock language.'),
    );
=======
    $fields = [
      'type' => $this->t('Type'),
      'language_content_type' => $this->t('Multilingual support.'),
      'i18n_lock_node' => $this->t('Lock language.'),
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    $type = $row->getSourceProperty('type');
    $row->setSourceProperty('language_content_type', $this->variableGet('language_content_type_' . $type, NULL));
    $i18n_node_options = $this->variableGet('i18n_node_options_' . $type, NULL);
    if ($i18n_node_options && in_array('lock', $i18n_node_options)) {
      $row->setSourceProperty('i18n_lock_node', 1);
    }
    else {
      $row->setSourceProperty('i18n_lock_node', 0);
    }
    return parent::prepareRow($row);
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    $ids['type']['type'] = 'string';
    return $ids;
  }

}
