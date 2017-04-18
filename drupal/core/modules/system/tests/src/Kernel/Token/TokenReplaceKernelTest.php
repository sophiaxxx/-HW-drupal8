<?php

namespace Drupal\Tests\system\Kernel\Token;

use Drupal\Component\Render\FormattableMarkup;
use Drupal\Component\Utility\Html;
use Drupal\Component\Utility\Xss;
use Drupal\Core\Render\BubbleableMetadata;

/**
 * Generates text using placeholders for dummy content to check token
 * replacement.
 *
 * @group system
 */
class TokenReplaceKernelTest extends TokenReplaceKernelTestBase {

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    // Set the site name to something other than an empty string.
    $this->config('system.site')->set('name', 'Drupal')->save();
  }

  /**
   * Test whether token-replacement works in various contexts.
   */
  public function testSystemTokenRecognition() {
    // Generate prefixes and suffixes for the token context.
<<<<<<< HEAD
    $tests = array(
      array('prefix' => 'this is the ', 'suffix' => ' site'),
      array('prefix' => 'this is the', 'suffix' => 'site'),
      array('prefix' => '[', 'suffix' => ']'),
      array('prefix' => '', 'suffix' => ']]]'),
      array('prefix' => '[[[', 'suffix' => ''),
      array('prefix' => ':[:', 'suffix' => '--]'),
      array('prefix' => '-[-', 'suffix' => ':]:'),
      array('prefix' => '[:', 'suffix' => ']'),
      array('prefix' => '[site:', 'suffix' => ':name]'),
      array('prefix' => '[site:', 'suffix' => ']'),
    );
=======
    $tests = [
      ['prefix' => 'this is the ', 'suffix' => ' site'],
      ['prefix' => 'this is the', 'suffix' => 'site'],
      ['prefix' => '[', 'suffix' => ']'],
      ['prefix' => '', 'suffix' => ']]]'],
      ['prefix' => '[[[', 'suffix' => ''],
      ['prefix' => ':[:', 'suffix' => '--]'],
      ['prefix' => '-[-', 'suffix' => ':]:'],
      ['prefix' => '[:', 'suffix' => ']'],
      ['prefix' => '[site:', 'suffix' => ':name]'],
      ['prefix' => '[site:', 'suffix' => ']'],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Check if the token is recognized in each of the contexts.
    foreach ($tests as $test) {
      $input = $test['prefix'] . '[site:name]' . $test['suffix'];
      $expected = $test['prefix'] . 'Drupal' . $test['suffix'];
<<<<<<< HEAD
      $output = $this->tokenService->replace($input, array(), array('langcode' => $this->interfaceLanguage->getId()));
      $this->assertTrue($output == $expected, format_string('Token recognized in string %string', array('%string' => $input)));
=======
      $output = $this->tokenService->replace($input, [], ['langcode' => $this->interfaceLanguage->getId()]);
      $this->assertTrue($output == $expected, format_string('Token recognized in string %string', ['%string' => $input]));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    }

    // Test token replacement when the string contains no tokens.
    $this->assertEqual($this->tokenService->replace('No tokens here.'), 'No tokens here.');
  }

  /**
   * Tests the clear parameter.
   */
  public function testClear() {
    // Valid token.
    $source = '[site:name]';
    // No user passed in, should be untouched.
    $source .= '[user:name]';
    // Non-existing token.
    $source .= '[bogus:token]';

    // Replace with the clear parameter, only the valid token should remain.
    $target = Html::escape($this->config('system.site')->get('name'));
<<<<<<< HEAD
    $result = $this->tokenService->replace($source, array(), array('langcode' => $this->interfaceLanguage->getId(), 'clear' => TRUE));
=======
    $result = $this->tokenService->replace($source, [], ['langcode' => $this->interfaceLanguage->getId(), 'clear' => TRUE]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertEqual($target, $result, 'Valid tokens replaced while invalid tokens ignored.');

    $target .= '[user:name]';
    $target .= '[bogus:token]';
<<<<<<< HEAD
    $result = $this->tokenService->replace($source, array(), array('langcode' => $this->interfaceLanguage->getId()));
=======
    $result = $this->tokenService->replace($source, [], ['langcode' => $this->interfaceLanguage->getId()]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertEqual($target, $result, 'Valid tokens replaced while invalid tokens ignored.');
  }

  /**
   * Tests the generation of all system site information tokens.
   */
  public function testSystemSiteTokenReplacement() {
<<<<<<< HEAD
    $url_options = array(
      'absolute' => TRUE,
      'language' => $this->interfaceLanguage,
    );
=======
    $url_options = [
      'absolute' => TRUE,
      'language' => $this->interfaceLanguage,
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $slogan = '<blink>Slogan</blink>';
    $safe_slogan = Xss::filterAdmin($slogan);

    // Set a few site variables.
    $config = $this->config('system.site');
    $config
      ->set('name', '<strong>Drupal<strong>')
      ->set('slogan', $slogan)
      ->set('mail', 'simpletest@example.com')
      ->save();


    // Generate and test tokens.
<<<<<<< HEAD
    $tests = array();
=======
    $tests = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $tests['[site:name]'] = Html::escape($config->get('name'));
    $tests['[site:slogan]'] = $safe_slogan;
    $tests['[site:mail]'] = $config->get('mail');
    $tests['[site:url]'] = \Drupal::url('<front>', [], $url_options);
<<<<<<< HEAD
    $tests['[site:url-brief]'] = preg_replace(array('!^https?://!', '!/$!'), '', \Drupal::url('<front>', [], $url_options));
=======
    $tests['[site:url-brief]'] = preg_replace(['!^https?://!', '!/$!'], '', \Drupal::url('<front>', [], $url_options));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $tests['[site:login-url]'] = \Drupal::url('user.page', [], $url_options);

    $base_bubbleable_metadata = new BubbleableMetadata();

    $metadata_tests = [];
    $metadata_tests['[site:name]'] = BubbleableMetadata::createFromObject(\Drupal::config('system.site'));
    $metadata_tests['[site:slogan]'] = BubbleableMetadata::createFromObject(\Drupal::config('system.site'));
    $metadata_tests['[site:mail]'] = BubbleableMetadata::createFromObject(\Drupal::config('system.site'));
    $bubbleable_metadata = clone $base_bubbleable_metadata;
    $metadata_tests['[site:url]'] = $bubbleable_metadata->addCacheContexts(['url.site']);
    $metadata_tests['[site:url-brief]'] = $bubbleable_metadata;
    $metadata_tests['[site:login-url]'] = $bubbleable_metadata;

    // Test to make sure that we generated something for each token.
    $this->assertFalse(in_array(0, array_map('strlen', $tests)), 'No empty tokens generated.');

    foreach ($tests as $input => $expected) {
      $bubbleable_metadata = new BubbleableMetadata();
<<<<<<< HEAD
      $output = $this->tokenService->replace($input, array(), array('langcode' => $this->interfaceLanguage->getId()), $bubbleable_metadata);
=======
      $output = $this->tokenService->replace($input, [], ['langcode' => $this->interfaceLanguage->getId()], $bubbleable_metadata);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      $this->assertEqual($output, $expected, new FormattableMarkup('System site information token %token replaced.', ['%token' => $input]));
      $this->assertEqual($bubbleable_metadata, $metadata_tests[$input]);
    }
  }

  /**
   * Tests the generation of all system date tokens.
   */
  public function testSystemDateTokenReplacement() {
    // Set time to one hour before request.
    $date = REQUEST_TIME - 3600;

    // Generate and test tokens.
<<<<<<< HEAD
    $tests = array();
=======
    $tests = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $date_formatter = \Drupal::service('date.formatter');
    $tests['[date:short]'] = $date_formatter->format($date, 'short', '', NULL, $this->interfaceLanguage->getId());
    $tests['[date:medium]'] = $date_formatter->format($date, 'medium', '', NULL, $this->interfaceLanguage->getId());
    $tests['[date:long]'] = $date_formatter->format($date, 'long', '', NULL, $this->interfaceLanguage->getId());
    $tests['[date:custom:m/j/Y]'] = $date_formatter->format($date, 'custom', 'm/j/Y', NULL, $this->interfaceLanguage->getId());
<<<<<<< HEAD
    $tests['[date:since]'] = $date_formatter->formatTimeDiffSince($date, array('langcode' => $this->interfaceLanguage->getId()));
=======
    $tests['[date:since]'] = $date_formatter->formatTimeDiffSince($date, ['langcode' => $this->interfaceLanguage->getId()]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $tests['[date:raw]'] = Xss::filter($date);

    // Test to make sure that we generated something for each token.
    $this->assertFalse(in_array(0, array_map('strlen', $tests)), 'No empty tokens generated.');

    foreach ($tests as $input => $expected) {
<<<<<<< HEAD
      $output = $this->tokenService->replace($input, array('date' => $date), array('langcode' => $this->interfaceLanguage->getId()));
      $this->assertEqual($output, $expected, format_string('Date token %token replaced.', array('%token' => $input)));
=======
      $output = $this->tokenService->replace($input, ['date' => $date], ['langcode' => $this->interfaceLanguage->getId()]);
      $this->assertEqual($output, $expected, format_string('Date token %token replaced.', ['%token' => $input]));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    }
  }

}
