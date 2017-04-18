<?php

namespace Drupal\Tests\language\Kernel\Views;

use Drupal\language\Entity\ConfigurableLanguage;
use Drupal\Tests\views\Kernel\ViewsKernelTestBase;

/**
 * Defines the base class for all Language handler tests.
 */
abstract class LanguageTestBase extends ViewsKernelTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('system', 'language');

  protected function setUp($import_test_views = TRUE) {
    parent::setUp();
    $this->installConfig(array('language'));

    // Create another language beside English.
    ConfigurableLanguage::create(array('id' => 'xx-lolspeak', 'label' => 'Lolspeak'))->save();
=======
  public static $modules = ['system', 'language'];

  protected function setUp($import_test_views = TRUE) {
    parent::setUp();
    $this->installConfig(['language']);

    // Create another language beside English.
    ConfigurableLanguage::create(['id' => 'xx-lolspeak', 'label' => 'Lolspeak'])->save();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * {@inheritdoc}
   */
  protected function schemaDefinition() {
    $schema = parent::schemaDefinition();
<<<<<<< HEAD
    $schema['views_test_data']['fields']['langcode'] = array(
=======
    $schema['views_test_data']['fields']['langcode'] = [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'description' => 'The {language}.langcode of this beatle.',
      'type' => 'varchar',
      'length' => 12,
      'default' => '',
<<<<<<< HEAD
    );
=======
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    return $schema;
  }

  /**
   * {@inheritdoc}
   */
  protected function viewsData() {
    $data = parent::viewsData();
<<<<<<< HEAD
    $data['views_test_data']['langcode'] = array(
      'title' => t('Langcode'),
      'help' => t('Langcode'),
      'field' => array(
        'id' => 'language',
      ),
      'argument' => array(
        'id' => 'language',
      ),
      'filter' => array(
        'id' => 'language',
      ),
    );
=======
    $data['views_test_data']['langcode'] = [
      'title' => t('Langcode'),
      'help' => t('Langcode'),
      'field' => [
        'id' => 'language',
      ],
      'argument' => [
        'id' => 'language',
      ],
      'filter' => [
        'id' => 'language',
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    return $data;
  }

  /**
   * {@inheritdoc}
   */
  protected function dataSet() {
    $data = parent::dataSet();
    $data[0]['langcode'] = 'en';
    $data[1]['langcode'] = 'xx-lolspeak';
    $data[2]['langcode'] = '';
    $data[3]['langcode'] = '';
    $data[4]['langcode'] = '';

    return $data;
  }

}
