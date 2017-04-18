<?php

namespace Drupal\Tests\file\Kernel;


/**
 * Tests the file_validate() function.
 *
 * @group file
 */
class ValidateTest extends FileManagedUnitTestBase {
  /**
   * Test that the validators passed into are checked.
   */
<<<<<<< HEAD
  function testCallerValidation() {
    $file = $this->createFile();

    // Empty validators.
    $this->assertEqual(file_validate($file, array()), array(), 'Validating an empty array works successfully.');
    $this->assertFileHooksCalled(array('validate'));
=======
  public function testCallerValidation() {
    $file = $this->createFile();

    // Empty validators.
    $this->assertEqual(file_validate($file, []), [], 'Validating an empty array works successfully.');
    $this->assertFileHooksCalled(['validate']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Use the file_test.module's test validator to ensure that passing tests
    // return correctly.
    file_test_reset();
<<<<<<< HEAD
    file_test_set_return('validate', array());
    $passing = array('file_test_validator' => array(array()));
    $this->assertEqual(file_validate($file, $passing), array(), 'Validating passes.');
    $this->assertFileHooksCalled(array('validate'));

    // Now test for failures in validators passed in and by hook_validate.
    file_test_reset();
    file_test_set_return('validate', array('Epic fail'));
    $failing = array('file_test_validator' => array(array('Failed', 'Badly')));
    $this->assertEqual(file_validate($file, $failing), array('Failed', 'Badly', 'Epic fail'), 'Validating returns errors.');
    $this->assertFileHooksCalled(array('validate'));
=======
    file_test_set_return('validate', []);
    $passing = ['file_test_validator' => [[]]];
    $this->assertEqual(file_validate($file, $passing), [], 'Validating passes.');
    $this->assertFileHooksCalled(['validate']);

    // Now test for failures in validators passed in and by hook_validate.
    file_test_reset();
    file_test_set_return('validate', ['Epic fail']);
    $failing = ['file_test_validator' => [['Failed', 'Badly']]];
    $this->assertEqual(file_validate($file, $failing), ['Failed', 'Badly', 'Epic fail'], 'Validating returns errors.');
    $this->assertFileHooksCalled(['validate']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

}
