<?php

namespace Drupal\Tests\system\Kernel\Token;

use Drupal\KernelTests\Core\Entity\EntityKernelTestBase;

/**
 * Base class for token replacement tests.
 */
abstract class TokenReplaceKernelTestBase extends EntityKernelTestBase {

  /**
   * The interface language.
   *
   * @var \Drupal\Core\Language\LanguageInterface
   */
  protected $interfaceLanguage;

  /**
   * Token service.
   *
   * @var \Drupal\Core\Utility\Token
   */
  protected $tokenService;

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('system');
=======
  public static $modules = ['system'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  protected function setUp() {
    parent::setUp();
    // Install default system configuration.
<<<<<<< HEAD
    $this->installConfig(array('system'));
=======
    $this->installConfig(['system']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    \Drupal::service('router.builder')->rebuild();

    $this->interfaceLanguage = \Drupal::languageManager()->getCurrentLanguage();
    $this->tokenService = \Drupal::token();
  }

}
