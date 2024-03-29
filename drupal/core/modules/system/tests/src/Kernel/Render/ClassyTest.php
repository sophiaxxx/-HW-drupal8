<?php

namespace Drupal\Tests\system\Kernel\Render;

use Drupal\KernelTests\KernelTestBase;

/**
 * Tests the Classy theme.
 *
 * @group Theme
 */
class ClassyTest extends KernelTestBase {

  /**
   * {@inheritdoc}
   */
<<<<<<< HEAD
  public static $modules = array('system', 'twig_theme_test');
=======
  public static $modules = ['system', 'twig_theme_test'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();

    // Use the classy theme.
    $this->container->get('theme_installer')->install(['classy']);
    $this->container->get('config.factory')
      ->getEditable('system.theme')
      ->set('default', 'classy')
      ->save();
    // Clear the theme registry.
    $this->container->set('theme.registry', NULL);

  }

  /**
   * Test the classy theme.
   */
<<<<<<< HEAD
  function testClassyTheme() {
    drupal_set_message('An error occurred', 'error');
    drupal_set_message('But then something nice happened');
    $messages = array(
      '#type' => 'status_messages',
    );
=======
  public function testClassyTheme() {
    drupal_set_message('An error occurred', 'error');
    drupal_set_message('But then something nice happened');
    $messages = [
      '#type' => 'status_messages',
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->render($messages);
    $this->assertNoText('custom-test-messages-class', 'The custom class attribute value added in the status messages preprocess function is not displayed as page content.');
  }

}
