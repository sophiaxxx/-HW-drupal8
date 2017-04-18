<?php

/**
 * @file
 * Test fixture.
 */

<<<<<<< HEAD
use Drupal\Component\Serialization\Yaml;
use Drupal\Core\Database\Database;
=======
use Drupal\Core\Database\Database;
use Drupal\Core\Serialization\Yaml;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

$connection = Database::getConnection();

$connection->insert('config')
  ->fields([
    'collection' => '',
    'name' => 'views.view.test_duplicate_field_handlers',
    'data' => serialize(Yaml::decode(file_get_contents('core/modules/views/tests/modules/views_test_config/test_views/views.view.test_duplicate_field_handlers.yml'))),
<<<<<<< HEAD
  ))
=======
  ])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  ->execute();
