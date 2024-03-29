<?php

namespace Drupal\Tests\contact\Kernel;

use Drupal\KernelTests\Core\Entity\EntityKernelTestBase;

/**
 * Tests the message entity class.
 *
 * @group contact
 * @see \Drupal\contact\Entity\Message
 */
class MessageEntityTest extends EntityKernelTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array(
=======
  public static $modules = [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    'system',
    'contact',
    'field',
    'user',
    'contact_test',
<<<<<<< HEAD
  );

  protected function setUp() {
    parent::setUp();
    $this->installConfig(array('contact', 'contact_test'));
=======
  ];

  protected function setUp() {
    parent::setUp();
    $this->installConfig(['contact', 'contact_test']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Test some of the methods.
   */
  public function testMessageMethods() {
    $message_storage = $this->container->get('entity.manager')->getStorage('contact_message');
<<<<<<< HEAD
    $message = $message_storage->create(array('contact_form' => 'feedback'));
=======
    $message = $message_storage->create(['contact_form' => 'feedback']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Check for empty values first.
    $this->assertEqual($message->getMessage(), '');
    $this->assertEqual($message->getSenderName(), '');
    $this->assertEqual($message->getSenderMail(), '');
    $this->assertFalse($message->copySender());

    // Check for default values.
    $this->assertEqual('feedback', $message->getContactForm()->id());
    $this->assertFalse($message->isPersonal());

    // Set some values and check for them afterwards.
    $message->setMessage('welcome_message');
    $message->setSenderName('sender_name');
    $message->setSenderMail('sender_mail');
    $message->setCopySender(TRUE);

    $this->assertEqual($message->getMessage(), 'welcome_message');
    $this->assertEqual($message->getSenderName(), 'sender_name');
    $this->assertEqual($message->getSenderMail(), 'sender_mail');
    $this->assertTrue($message->copySender());

    $no_access_user = $this->createUser(['uid' => 2]);
    $access_user = $this->createUser(['uid' => 3], ['access site-wide contact form']);
    $admin = $this->createUser(['uid' => 4], ['administer contact forms']);

    $this->assertFalse(\Drupal::entityManager()->getAccessControlHandler('contact_message')->createAccess(NULL, $no_access_user));
    $this->assertTrue(\Drupal::entityManager()->getAccessControlHandler('contact_message')->createAccess(NULL, $access_user));
    $this->assertTrue($message->access('edit', $admin));
    $this->assertFalse($message->access('edit', $access_user));
  }

}
