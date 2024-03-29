<?php

/**
 * @file
 * Functions that need to be loaded on every Drupal request.
 */

use Drupal\Component\Utility\Crypt;
use Drupal\Component\Utility\Html;
use Drupal\Component\Utility\SafeMarkup;
use Drupal\Component\Utility\Unicode;
use Drupal\Core\Config\BootstrapConfigStorageFactory;
use Drupal\Core\Logger\RfcLogLevel;
use Drupal\Core\Render\Markup;
use Drupal\Component\Render\MarkupInterface;
use Drupal\Core\Test\TestDatabase;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Site\Settings;
use Drupal\Core\Utility\Error;
use Drupal\Core\StringTranslation\TranslatableMarkup;

/**
 * Minimum supported version of PHP.
 */
const DRUPAL_MINIMUM_PHP = '5.5.9';

/**
 * Minimum recommended value of PHP memory_limit.
 *
 * 64M was chosen as a minimum requirement in order to allow for additional
 * contributed modules to be installed prior to hitting the limit. However,
 * 40M is the target for the Standard installation profile.
 */
const DRUPAL_MINIMUM_PHP_MEMORY_LIMIT = '64M';

/**
 * Error reporting level: display no errors.
 */
const ERROR_REPORTING_HIDE = 'hide';

/**
 * Error reporting level: display errors and warnings.
 */
const ERROR_REPORTING_DISPLAY_SOME = 'some';

/**
 * Error reporting level: display all messages.
 */
const ERROR_REPORTING_DISPLAY_ALL = 'all';

/**
 * Error reporting level: display all messages, plus backtrace information.
 */
const ERROR_REPORTING_DISPLAY_VERBOSE = 'verbose';

/**
 * Role ID for anonymous users; should match what's in the "role" table.
 *
 * @deprecated in Drupal 8.0.0, will be removed before Drupal 9.0.0.
 *   Use Drupal\Core\Session\AccountInterface::ANONYMOUS_ROLE or
 *   \Drupal\user\RoleInterface::ANONYMOUS_ID instead.
 */
const DRUPAL_ANONYMOUS_RID = AccountInterface::ANONYMOUS_ROLE;

/**
 * Role ID for authenticated users; should match what's in the "role" table.
 *
 * @deprecated in Drupal 8.0.0, will be removed before Drupal 9.0.0.
 *   Use Drupal\Core\Session\AccountInterface::AUTHENTICATED_ROLE or
 *   \Drupal\user\RoleInterface::AUTHENTICATED_ID instead.
 */
const DRUPAL_AUTHENTICATED_RID = AccountInterface::AUTHENTICATED_ROLE;

/**
 * The maximum number of characters in a module or theme name.
 */
const DRUPAL_EXTENSION_NAME_MAX_LENGTH = 50;

/**
 * Time of the current request in seconds elapsed since the Unix Epoch.
 *
 * This differs from $_SERVER['REQUEST_TIME'], which is stored as a float
 * since PHP 5.4.0. Float timestamps confuse most PHP functions
 * (including date_create()).
 *
 * @see http://php.net/manual/reserved.variables.server.php
 * @see http://php.net/manual/function.time.php
 *
 * @deprecated in Drupal 8.3.0, will be removed before Drupal 9.0.0.
 *   Use \Drupal::time()->getRequestTime();
 */
define('REQUEST_TIME', (int) $_SERVER['REQUEST_TIME']);

/**
 * Regular expression to match PHP function names.
 *
 * @see http://php.net/manual/language.functions.php
 */
const DRUPAL_PHP_FUNCTION_PATTERN = '[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*';

/**
 * $config_directories key for active directory.
 *
 * @see config_get_config_directory()
 *
 * @deprecated in Drupal 8.0.x and will be removed before 9.0.0. Drupal core no
 *   longer creates an active directory.
 */
const CONFIG_ACTIVE_DIRECTORY = 'active';

/**
 * $config_directories key for sync directory.
 *
 * @see config_get_config_directory()
 */
const CONFIG_SYNC_DIRECTORY = 'sync';

/**
 * $config_directories key for staging directory.
 *
 * @see config_get_config_directory()
 * @see CONFIG_SYNC_DIRECTORY
 *
 * @deprecated in Drupal 8.0.x and will be removed before 9.0.0. The staging
 *   directory was renamed to sync.
 */
const CONFIG_STAGING_DIRECTORY = 'staging';

/**
 * Defines the root directory of the Drupal installation.
 *
 * This strips two levels of directories off the current directory.
 */
define('DRUPAL_ROOT', dirname(dirname(__DIR__)));

/**
 * Returns the path of a configuration directory.
 *
 * Configuration directories are configured using $config_directories in
 * settings.php.
 *
 * @param string $type
 *   The type of config directory to return. Drupal core provides the
 *   CONFIG_SYNC_DIRECTORY constant to access the sync directory.
 *
 * @return string
 *   The configuration directory path.
 *
 * @throws \Exception
 */
function config_get_config_directory($type) {
  global $config_directories;

  // @todo Remove fallback in Drupal 9. https://www.drupal.org/node/2574943
  if ($type == CONFIG_SYNC_DIRECTORY && !isset($config_directories[CONFIG_SYNC_DIRECTORY]) && isset($config_directories[CONFIG_STAGING_DIRECTORY])) {
    $type = CONFIG_STAGING_DIRECTORY;
  }

  if (!empty($config_directories[$type])) {
    return $config_directories[$type];
  }
  // @todo https://www.drupal.org/node/2696103 Throw a more specific exception.
  throw new \Exception("The configuration directory type '$type' does not exist");
}

/**
 * Returns and optionally sets the filename for a system resource.
 *
 * The filename, whether provided, cached, or retrieved from the database, is
 * only returned if the file exists.
 *
 * This function plays a key role in allowing Drupal's resources (modules
 * and themes) to be located in different places depending on a site's
 * configuration. For example, a module 'foo' may legally be located
 * in any of these three places:
 *
 * core/modules/foo/foo.info.yml
 * modules/foo/foo.info.yml
 * sites/example.com/modules/foo/foo.info.yml
 *
 * Calling drupal_get_filename('module', 'foo') will give you one of
 * the above, depending on where the module is located.
 *
 * @param $type
 *   The type of the item; one of 'core', 'profile', 'module', 'theme', or
 *   'theme_engine'.
 * @param $name
 *   The name of the item for which the filename is requested. Ignored for
 *   $type 'core'.
 * @param $filename
 *   The filename of the item if it is to be set explicitly rather
 *   than by consulting the database.
 *
 * @return
 *   The filename of the requested item or NULL if the item is not found.
 */
function drupal_get_filename($type, $name, $filename = NULL) {
  // The location of files will not change during the request, so do not use
  // drupal_static().
  static $files = [];

  // Type 'core' only exists to simplify application-level logic; it always maps
  // to the /core directory, whereas $name is ignored. It is only requested via
  // drupal_get_path(). /core/core.info.yml does not exist, but is required
  // since drupal_get_path() returns the dirname() of the returned pathname.
  if ($type === 'core') {
    return 'core/core.info.yml';
  }

  // Profiles are converted into modules in system_rebuild_module_data().
  // @todo Remove false-exposure of profiles as modules.
  if ($type == 'profile') {
    $type = 'module';
  }
  if (!isset($files[$type])) {
    $files[$type] = [];
  }

  if (isset($filename)) {
    $files[$type][$name] = $filename;
  }
  elseif (!isset($files[$type][$name])) {
    // If the pathname of the requested extension is not known, try to retrieve
    // the list of extension pathnames from various providers, checking faster
    // providers first.
    // Retrieve the current module list (derived from the service container).
    if ($type == 'module' && \Drupal::hasService('module_handler')) {
      foreach (\Drupal::moduleHandler()->getModuleList() as $module_name => $module) {
        $files[$type][$module_name] = $module->getPathname();
      }
    }
    // If still unknown, retrieve the file list prepared in state by
    // system_rebuild_module_data() and
    // \Drupal\Core\Extension\ThemeHandlerInterface::rebuildThemeData().
    if (!isset($files[$type][$name]) && \Drupal::hasService('state')) {
      $files[$type] += \Drupal::state()->get('system.' . $type . '.files', []);
    }
    // If still unknown, create a user-level error message.
    if (!isset($files[$type][$name])) {
      trigger_error(SafeMarkup::format('The following @type is missing from the file system: @name', ['@type' => $type, '@name' => $name]), E_USER_WARNING);
    }
  }

  if (isset($files[$type][$name])) {
    return $files[$type][$name];
  }
}

/**
 * Returns the path to a system item (module, theme, etc.).
 *
 * @param $type
 *   The type of the item; one of 'core', 'profile', 'module', 'theme', or
 *   'theme_engine'.
 * @param $name
 *   The name of the item for which the path is requested. Ignored for
 *   $type 'core'.
 *
 * @return
 *   The path to the requested item or an empty string if the item is not found.
 */
function drupal_get_path($type, $name) {
  return dirname(drupal_get_filename($type, $name));
}

/**
 * Translates a string to the current language or to a given language.
 *
 * In order for strings to be localized, make them available in one of the ways
 * supported by the @link i18n Localization API. @endlink When possible, use
 * the \Drupal\Core\StringTranslation\StringTranslationTrait $this->t().
 * Otherwise create a new \Drupal\Core\StringTranslation\TranslatableMarkup
 * object directly.
 *
 * See \Drupal\Core\StringTranslation\TranslatableMarkup::__construct() for
 * important security information and usage guidelines.
 *
 * @param string $string
 *   A string containing the English text to translate.
 * @param array $args
 *   (optional) An associative array of replacements to make after translation.
 *   Based on the first character of the key, the value is escaped and/or
 *   themed. See
 *   \Drupal\Component\Render\FormattableMarkup::placeholderFormat() for
 *   details.
 * @param array $options
 *   (optional) An associative array of additional options, with the following
 *   elements:
 *   - 'langcode' (defaults to the current language): A language code, to
 *     translate to a language other than what is used to display the page.
 *   - 'context' (defaults to the empty context): The context the source string
 *     belongs to. See the @link i18n Internationalization topic @endlink for
 *     more information about string contexts.
 *
 * @return \Drupal\Core\StringTranslation\TranslatableMarkup
 *   An object that, when cast to a string, returns the translated string.
 *
 * @see \Drupal\Component\Render\FormattableMarkup::placeholderFormat()
 * @see \Drupal\Core\StringTranslation\StringTranslationTrait::t()
 * @see \Drupal\Core\StringTranslation\TranslatableMarkup::__construct()
 *
 * @ingroup sanitization
 */
function t($string, array $args = [], array $options = []) {
  return new TranslatableMarkup($string, $args, $options);
}

/**
 * Formats a string for HTML display by replacing variable placeholders.
 *
 * @see \Drupal\Component\Render\FormattableMarkup::placeholderFormat()
 * @see \Drupal\Component\Render\FormattableMarkup
 * @see t()
 * @ingroup sanitization
 *
 * @deprecated in Drupal 8.0.0, will be removed before Drupal 9.0.0.
 *   Use \Drupal\Component\Render\FormattableMarkup.
 */
function format_string($string, array $args) {
  return SafeMarkup::format($string, $args);
}

/**
 * Checks whether a string is valid UTF-8.
 *
 * All functions designed to filter input should use drupal_validate_utf8
 * to ensure they operate on valid UTF-8 strings to prevent bypass of the
 * filter.
 *
 * When text containing an invalid UTF-8 lead byte (0xC0 - 0xFF) is presented
 * as UTF-8 to Internet Explorer 6, the program may misinterpret subsequent
 * bytes. When these subsequent bytes are HTML control characters such as
 * quotes or angle brackets, parts of the text that were deemed safe by filters
 * end up in locations that are potentially unsafe; An onerror attribute that
 * is outside of a tag, and thus deemed safe by a filter, can be interpreted
 * by the browser as if it were inside the tag.
 *
 * The function does not return FALSE for strings containing character codes
 * above U+10FFFF, even though these are prohibited by RFC 3629.
 *
 * @param $text
 *   The text to check.
 *
 * @return bool
 *   TRUE if the text is valid UTF-8, FALSE if not.
 *
 * @see \Drupal\Component\Utility\Unicode::validateUtf8()
 *
 * @deprecated in Drupal 8.0.0, will be removed before Drupal 9.0.0.
 *   Use \Drupal\Component\Utility\Unicode::validateUtf8().
 */
function drupal_validate_utf8($text) {
  return Unicode::validateUtf8($text);
}

/**
 * Logs an exception.
 *
 * This is a wrapper logging function which automatically decodes an exception.
 *
 * @param $type
 *   The category to which this message belongs.
 * @param $exception
 *   The exception that is going to be logged.
 * @param $message
 *   The message to store in the log. If empty, a text that contains all useful
 *   information about the passed-in exception is used.
 * @param $variables
 *   Array of variables to replace in the message on display or
 *   NULL if message is already translated or not possible to
 *   translate.
 * @param $severity
 *   The severity of the message, as per RFC 3164.
 * @param $link
 *   A link to associate with the message.
 *
 * @see \Drupal\Core\Utility\Error::decodeException()
 */
function watchdog_exception($type, Exception $exception, $message = NULL, $variables = [], $severity = RfcLogLevel::ERROR, $link = NULL) {

  // Use a default value if $message is not set.
  if (empty($message)) {
    $message = '%type: @message in %function (line %line of %file).';
  }

  if ($link) {
    $variables['link'] = $link;
  }

  $variables += Error::decodeException($exception);

  \Drupal::logger($type)->log($severity, $message, $variables);
}

/**
 * Sets a message to display to the user.
 *
 * Messages are stored in a session variable and displayed in the page template
 * via the $messages theme variable.
 *
 * Example usage:
 * @code
 * drupal_set_message(t('An error occurred and processing did not complete.'), 'error');
 * @endcode
 *
 * @param string|\Drupal\Component\Render\MarkupInterface $message
 *   (optional) The translated message to be displayed to the user. For
 *   consistency with other messages, it should begin with a capital letter and
 *   end with a period.
 * @param string $type
 *   (optional) The message's type. Defaults to 'status'. These values are
 *   supported:
 *   - 'status'
 *   - 'warning'
 *   - 'error'
 * @param bool $repeat
 *   (optional) If this is FALSE and the message is already set, then the
 *   message won't be repeated. Defaults to FALSE.
 *
 * @return array|null
 *   A multidimensional array with keys corresponding to the set message types.
 *   The indexed array values of each contain the set messages for that type,
 *   and each message is an associative array with the following format:
 *   - safe: Boolean indicating whether the message string has been marked as
 *     safe. Non-safe strings will be escaped automatically.
 *   - message: The message string.
 *   So, the following is an example of the full return array structure:
 *   @code
 *     array(
 *       'status' => array(
 *         array(
 *           'safe' => TRUE,
 *           'message' => 'A <em>safe</em> markup string.',
 *         ),
 *         array(
 *           'safe' => FALSE,
 *           'message' => "$arbitrary_user_input to escape.",
 *         ),
 *       ),
 *     );
 *   @endcode
 *   If there are no messages set, the function returns NULL.
 *
 * @see drupal_get_messages()
 * @see status-messages.html.twig
 */
function drupal_set_message($message = NULL, $type = 'status', $repeat = FALSE) {
  if (isset($message)) {
    if (!isset($_SESSION['messages'][$type])) {
      $_SESSION['messages'][$type] = [];
    }

    // Convert strings which are safe to the simplest Markup objects.
    if (!($message instanceof Markup) && $message instanceof MarkupInterface) {
      $message = Markup::create((string) $message);
    }

    // Do not use strict type checking so that equivalent string and
    // MarkupInterface objects are detected.
    if ($repeat || !in_array($message, $_SESSION['messages'][$type])) {
      $_SESSION['messages'][$type][] = $message;
    }

    // Mark this page as being uncacheable.
    \Drupal::service('page_cache_kill_switch')->trigger();
  }

  // Messages not set when DB connection fails.
  return isset($_SESSION['messages']) ? $_SESSION['messages'] : NULL;
}

/**
 * Returns all messages that have been set with drupal_set_message().
 *
 * @param string $type
 *   (optional) Limit the messages returned by type. Defaults to NULL, meaning
 *   all types. These values are supported:
 *   - NULL
 *   - 'status'
 *   - 'warning'
 *   - 'error'
 * @param bool $clear_queue
 *   (optional) If this is TRUE, the queue will be cleared of messages of the
 *   type specified in the $type parameter. Otherwise the queue will be left
 *   intact. Defaults to TRUE.
 *
 * @return array
 *   An associative, nested array of messages grouped by message type, with
 *   the top-level keys as the message type. The messages returned are
 *   limited to the type specified in the $type parameter, if any. If there
 *   are no messages of the specified type, an empty array is returned. See
 *   drupal_set_message() for the array structure of individual messages.
 *
 * @see drupal_set_message()
 * @see status-messages.html.twig
 */
function drupal_get_messages($type = NULL, $clear_queue = TRUE) {
  if ($messages = drupal_set_message()) {
    if ($type) {
      if ($clear_queue) {
        unset($_SESSION['messages'][$type]);
      }
      if (isset($messages[$type])) {
        return [$type => $messages[$type]];
      }
    }
    else {
      if ($clear_queue) {
        unset($_SESSION['messages']);
      }
      return $messages;
    }
  }
  return [];
}

/**
 * Returns the time zone of the current user.
 */
function drupal_get_user_timezone() {
  $user = \Drupal::currentUser();
  $config = \Drupal::config('system.date');

  if ($user && $config->get('timezone.user.configurable') && $user->isAuthenticated() && $user->getTimezone()) {
    return $user->getTimezone();
  }
  else {
    // Ignore PHP strict notice if time zone has not yet been set in the php.ini
    // configuration.
    $config_data_default_timezone = $config->get('timezone.default');
    return !empty($config_data_default_timezone) ? $config_data_default_timezone : @date_default_timezone_get();
  }
}

/**
 * Provides custom PHP error handling.
 *
 * @param $error_level
 *   The level of the error raised.
 * @param $message
 *   The error message.
 * @param $filename
 *   The filename that the error was raised in.
 * @param $line
 *   The line number the error was raised at.
 * @param $context
 *   An array that points to the active symbol table at the point the error
 *   occurred.
 */
function _drupal_error_handler($error_level, $message, $filename, $line, $context) {
  require_once __DIR__ . '/errors.inc';
  _drupal_error_handler_real($error_level, $message, $filename, $line, $context);
}

/**
 * Provides custom PHP exception handling.
 *
 * Uncaught exceptions are those not enclosed in a try/catch block. They are
 * always fatal: the execution of the script will stop as soon as the exception
 * handler exits.
 *
 * @param \Exception|\Throwable $exception
 *   The exception object that was thrown.
 */
function _drupal_exception_handler($exception) {
  require_once __DIR__ . '/errors.inc';

  try {
    // Log the message to the watchdog and return an error page to the user.
    _drupal_log_error(Error::decodeException($exception), TRUE);
  }
  // PHP 7 introduces Throwable, which covers both Error and
  // Exception throwables.
  catch (\Throwable $error) {
    _drupal_exception_handler_additional($exception, $error);
  }
  // In order to be compatible with PHP 5 we also catch regular Exceptions.
  catch (\Exception $exception2) {
    _drupal_exception_handler_additional($exception, $exception2);
  }
}

/**
 * Displays any additional errors caught while handling an exception.
 *
 * @param \Exception|\Throwable $exception
 *   The first exception object that was thrown.
 * @param \Exception|\Throwable $exception2
 *   The second exception object that was thrown.
 */
function _drupal_exception_handler_additional($exception, $exception2) {
  // Another uncaught exception was thrown while handling the first one.
  // If we are displaying errors, then do so with no possibility of a further
  // uncaught exception being thrown.
  if (error_displayable()) {
    print '<h1>Additional uncaught exception thrown while handling exception.</h1>';
    print '<h2>Original</h2><p>' . Error::renderExceptionSafe($exception) . '</p>';
    print '<h2>Additional</h2><p>' . Error::renderExceptionSafe($exception2) . '</p><hr />';
  }
}

/**
 * Returns the test prefix if this is an internal request from SimpleTest.
 *
 * @param string $new_prefix
 *   Internal use only. A new prefix to be stored.
 *
 * @return string|false
 *   Either the simpletest prefix (the string "simpletest" followed by any
 *   number of digits) or FALSE if the user agent does not contain a valid
 *   HMAC and timestamp.
 */
function drupal_valid_test_ua($new_prefix = NULL) {
  static $test_prefix;

  if (isset($new_prefix)) {
    $test_prefix = $new_prefix;
  }
  if (isset($test_prefix)) {
    return $test_prefix;
  }
  // Unless the below User-Agent and HMAC validation succeeds, we are not in
  // a test environment.
  $test_prefix = FALSE;

  // A valid Simpletest request will contain a hashed and salted authentication
  // code. Check if this code is present in a cookie or custom user agent
  // string.
  $http_user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : NULL;
  $user_agent = isset($_COOKIE['SIMPLETEST_USER_AGENT']) ? $_COOKIE['SIMPLETEST_USER_AGENT'] : $http_user_agent;
<<<<<<< HEAD
  if (isset($user_agent) && preg_match("/^(simpletest\d+):(.+):(.+):(.+)$/", $user_agent, $matches)) {
=======
  if (isset($user_agent) && preg_match("/^simple(\w+\d+):(.+):(.+):(.+)$/", $user_agent, $matches)) {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    list(, $prefix, $time, $salt, $hmac) = $matches;
    $check_string = $prefix . ':' . $time . ':' . $salt;
    // Read the hash salt prepared by drupal_generate_test_ua().
    // This function is called before settings.php is read and Drupal's error
    // handlers are set up. While Drupal's error handling may be properly
    // configured on production sites, the server's PHP error_reporting may not.
    // Ensure that no information leaks on production sites.
    $test_db = new TestDatabase($prefix);
    $key_file = DRUPAL_ROOT . '/' . $test_db->getTestSitePath() . '/.htkey';
    if (!is_readable($key_file)) {
      header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');
      exit;
    }
    $private_key = file_get_contents($key_file);
    // The file properties add more entropy not easily accessible to others.
    $key = $private_key . filectime(__FILE__) . fileinode(__FILE__);
    $time_diff = REQUEST_TIME - $time;
    $test_hmac = Crypt::hmacBase64($check_string, $key);
    // Since we are making a local request a 600 second time window is allowed,
    // and the HMAC must match.
    if ($time_diff >= 0 && $time_diff <= 600 && $hmac === $test_hmac) {
      $test_prefix = $prefix;
    }
    else {
      header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden (SIMPLETEST_USER_AGENT invalid)');
      exit;
    }
  }
  return $test_prefix;
}

/**
 * Generates a user agent string with a HMAC and timestamp for simpletest.
 */
function drupal_generate_test_ua($prefix) {
  static $key, $last_prefix;

  if (!isset($key) || $last_prefix != $prefix) {
    $last_prefix = $prefix;
    $test_db = new TestDatabase($prefix);
    $key_file = DRUPAL_ROOT . '/' . $test_db->getTestSitePath() . '/.htkey';
    // When issuing an outbound HTTP client request from within an inbound test
    // request, then the outbound request has to use the same User-Agent header
    // as the inbound request. A newly generated private key for the same test
    // prefix would invalidate all subsequent inbound requests.
    // @see \Drupal\Core\Http\Plugin\SimpletestHttpRequestSubscriber
    if (DRUPAL_TEST_IN_CHILD_SITE && $parent_prefix = drupal_valid_test_ua()) {
      if ($parent_prefix != $prefix) {
        throw new \RuntimeException("Malformed User-Agent: Expected '$parent_prefix' but got '$prefix'.");
      }
      // If the file is not readable, a PHP warning is expected in this case.
      $private_key = file_get_contents($key_file);
    }
    else {
      // Generate and save a new hash salt for a test run.
      // Consumed by drupal_valid_test_ua() before settings.php is loaded.
      $private_key = Crypt::randomBytesBase64(55);
      file_put_contents($key_file, $private_key);
    }
    // The file properties add more entropy not easily accessible to others.
    $key = $private_key . filectime(__FILE__) . fileinode(__FILE__);
  }
  // Generate a moderately secure HMAC based on the database credentials.
  $salt = uniqid('', TRUE);
  $check_string = $prefix . ':' . time() . ':' . $salt;
<<<<<<< HEAD
  return $check_string . ':' . Crypt::hmacBase64($check_string, $key);
=======
  return 'simple' . $check_string . ':' . Crypt::hmacBase64($check_string, $key);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
}

/**
 * Enables use of the theme system without requiring database access.
 *
 * Loads and initializes the theme system for site installs, updates and when
 * the site is in maintenance mode. This also applies when the database fails.
 *
 * @see _drupal_maintenance_theme()
 */
function drupal_maintenance_theme() {
  require_once __DIR__ . '/theme.maintenance.inc';
  _drupal_maintenance_theme();
}

/**
 * Returns TRUE if a Drupal installation is currently being attempted.
 */
function drupal_installation_attempted() {
  // This cannot rely on the MAINTENANCE_MODE constant, since that would prevent
  // tests from using the non-interactive installer, in which case Drupal
  // only happens to be installed within the same request, but subsequently
  // executed code does not involve the installer at all.
  // @see install_drupal()
  return isset($GLOBALS['install_state']) && empty($GLOBALS['install_state']['installation_finished']);
}

/**
 * Gets the name of the currently active installation profile.
 *
 * When this function is called during Drupal's initial installation process,
 * the name of the profile that's about to be installed is stored in the global
 * installation state. At all other times, the "install_profile" setting will be
 * available in container as a parameter.
 *
 * @return string|null
 *   The name of the installation profile or NULL if no installation profile is
 *   currently active. This is the case for example during the first steps of
 *   the installer or during unit tests.
 *
 * @deprecated in Drupal 8.3.0, will be removed before Drupal 9.0.0.
 *   Use the install_profile container parameter or \Drupal::installProfile()
 *   instead. If you are accessing the value before it is written to
 *   configuration during the installer use the $install_state global. If you
 *   need to access the value before container is available you can use
 *   BootstrapConfigStorageFactory to load the value directly from
 *   configuration.
 */
function drupal_get_profile() {
  global $install_state;

  if (drupal_installation_attempted()) {
    // If the profile has been selected return it.
    if (isset($install_state['parameters']['profile'])) {
      $profile = $install_state['parameters']['profile'];
    }
    else {
      $profile = NULL;
    }
  }
  else {
    if (\Drupal::hasContainer()) {
      $profile = \Drupal::installProfile();
    }
    else {
      $profile = BootstrapConfigStorageFactory::getDatabaseStorage()->read('core.extension')['profile'];
    }

    // A BC layer just in in case this only exists in Settings. Introduced in
    // Drupal 8.3.x and will be removed before Drupal 9.0.0.
    if (empty($profile)) {
      $profile = Settings::get('install_profile');
    }
  }

  return $profile;
}

/**
 * Registers an additional namespace.
 *
 * @param string $name
 *   The namespace component to register; e.g., 'node'.
 * @param string $path
 *   The relative path to the Drupal component in the filesystem.
 */
function drupal_classloader_register($name, $path) {
  $loader = \Drupal::service('class_loader');
  $loader->addPsr4('Drupal\\' . $name . '\\', \Drupal::root() . '/' . $path . '/src');
}

/**
 * Provides central static variable storage.
 *
 * All functions requiring a static variable to persist or cache data within
 * a single page request are encouraged to use this function unless it is
 * absolutely certain that the static variable will not need to be reset during
 * the page request. By centralizing static variable storage through this
 * function, other functions can rely on a consistent API for resetting any
 * other function's static variables.
 *
 * Example:
 * @code
 * function example_list($field = 'default') {
 *   $examples = &drupal_static(__FUNCTION__);
 *   if (!isset($examples)) {
 *     // If this function is being called for the first time after a reset,
 *     // query the database and execute any other code needed to retrieve
 *     // information.
 *     ...
 *   }
 *   if (!isset($examples[$field])) {
 *     // If this function is being called for the first time for a particular
 *     // index field, then execute code needed to index the information already
 *     // available in $examples by the desired field.
 *     ...
 *   }
 *   // Subsequent invocations of this function for a particular index field
 *   // skip the above two code blocks and quickly return the already indexed
 *   // information.
 *   return $examples[$field];
 * }
 * function examples_admin_overview() {
 *   // When building the content for the overview page, make sure to get
 *   // completely fresh information.
 *   drupal_static_reset('example_list');
 *   ...
 * }
 * @endcode
 *
 * In a few cases, a function can have certainty that there is no legitimate
 * use-case for resetting that function's static variable. This is rare,
 * because when writing a function, it's hard to forecast all the situations in
 * which it will be used. A guideline is that if a function's static variable
 * does not depend on any information outside of the function that might change
 * during a single page request, then it's ok to use the "static" keyword
 * instead of the drupal_static() function.
 *
 * Example:
 * @code
 * function mymodule_log_stream_handle($new_handle = NULL) {
 *   static $handle;
 *   if (isset($new_handle)) {
 *     $handle = $new_handle;
 *   }
 *   return $handle;
 * }
 * @endcode
 *
 * In a few cases, a function needs a resettable static variable, but the
 * function is called many times (100+) during a single page request, so
 * every microsecond of execution time that can be removed from the function
 * counts. These functions can use a more cumbersome, but faster variant of
 * calling drupal_static(). It works by storing the reference returned by
 * drupal_static() in the calling function's own static variable, thereby
 * removing the need to call drupal_static() for each iteration of the function.
 * Conceptually, it replaces:
 * @code
 * $foo = &drupal_static(__FUNCTION__);
 * @endcode
 * with:
 * @code
 * // Unfortunately, this does not work.
 * static $foo = &drupal_static(__FUNCTION__);
 * @endcode
 * However, the above line of code does not work, because PHP only allows static
 * variables to be initialized by literal values, and does not allow static
 * variables to be assigned to references.
 * - http://php.net/manual/language.variables.scope.php#language.variables.scope.static
 * - http://php.net/manual/language.variables.scope.php#language.variables.scope.references
 * The example below shows the syntax needed to work around both limitations.
 * For benchmarks and more information, see https://www.drupal.org/node/619666.
 *
 * Example:
 * @code
 * function example_default_format_type() {
 *   // Use the advanced drupal_static() pattern, since this is called very often.
 *   static $drupal_static_fast;
 *   if (!isset($drupal_static_fast)) {
 *     $drupal_static_fast['format_type'] = &drupal_static(__FUNCTION__);
 *   }
 *   $format_type = &$drupal_static_fast['format_type'];
 *   ...
 * }
 * @endcode
 *
 * @param $name
 *   Globally unique name for the variable. For a function with only one static,
 *   variable, the function name (e.g. via the PHP magic __FUNCTION__ constant)
 *   is recommended. For a function with multiple static variables add a
 *   distinguishing suffix to the function name for each one.
 * @param $default_value
 *   Optional default value.
 * @param $reset
 *   TRUE to reset one or all variables(s). This parameter is only used
 *   internally and should not be passed in; use drupal_static_reset() instead.
 *   (This function's return value should not be used when TRUE is passed in.)
 *
 * @return
 *   Returns a variable by reference.
 *
 * @see drupal_static_reset()
 */
function &drupal_static($name, $default_value = NULL, $reset = FALSE) {
  static $data = [], $default = [];
  // First check if dealing with a previously defined static variable.
  if (isset($data[$name]) || array_key_exists($name, $data)) {
    // Non-NULL $name and both $data[$name] and $default[$name] statics exist.
    if ($reset) {
      // Reset pre-existing static variable to its default value.
      $data[$name] = $default[$name];
    }
    return $data[$name];
  }
  // Neither $data[$name] nor $default[$name] static variables exist.
  if (isset($name)) {
    if ($reset) {
      // Reset was called before a default is set and yet a variable must be
      // returned.
      return $data;
    }
    // First call with new non-NULL $name. Initialize a new static variable.
    $default[$name] = $data[$name] = $default_value;
    return $data[$name];
  }
  // Reset all: ($name == NULL). This needs to be done one at a time so that
  // references returned by earlier invocations of drupal_static() also get
  // reset.
  foreach ($default as $name => $value) {
    $data[$name] = $value;
  }
  // As the function returns a reference, the return should always be a
  // variable.
  return $data;
}

/**
 * Resets one or all centrally stored static variable(s).
 *
 * @param $name
 *   Name of the static variable to reset. Omit to reset all variables.
 *   Resetting all variables should only be used, for example, for running
 *   unit tests with a clean environment.
 */
function drupal_static_reset($name = NULL) {
  drupal_static($name, NULL, TRUE);
}

/**
 * Formats text for emphasized display in a placeholder inside a sentence.
 *
 * @deprecated in Drupal 8.0.0, will be removed before Drupal 9.0.0. Use
 *   \Drupal\Component\Utility\SafeMarkup::format() or Twig's "placeholder"
 *   filter instead. Note this method should not be used to simply emphasize a
 *   string and therefore has few valid use-cases. Note also, that this method
 *   does not mark the string as safe.
 *
 * @see \Drupal\Component\Utility\SafeMarkup::format()
 */
function drupal_placeholder($text) {
  return '<em class="placeholder">' . Html::escape($text) . '</em>';
}

/**
 * Registers a function for execution on shutdown.
 *
 * Wrapper for register_shutdown_function() that catches thrown exceptions to
 * avoid "Exception thrown without a stack frame in Unknown".
 *
 * @param $callback
 *   The shutdown function to register.
 * @param ...
 *   Additional arguments to pass to the shutdown function.
 *
 * @return
 *   Array of shutdown functions to be executed.
 *
 * @see register_shutdown_function()
 * @ingroup php_wrappers
 */
function &drupal_register_shutdown_function($callback = NULL) {
  // We cannot use drupal_static() here because the static cache is reset during
  // batch processing, which breaks batch handling.
  static $callbacks = [];

  if (isset($callback)) {
    // Only register the internal shutdown function once.
    if (empty($callbacks)) {
      register_shutdown_function('_drupal_shutdown_function');
    }
    $args = func_get_args();
    // Remove $callback from the arguments.
    unset($args[0]);
    // Save callback and arguments
    $callbacks[] = ['callback' => $callback, 'arguments' => $args];
  }
  return $callbacks;
}

/**
 * Executes registered shutdown functions.
 */
function _drupal_shutdown_function() {
  $callbacks = &drupal_register_shutdown_function();

  // Set the CWD to DRUPAL_ROOT as it is not guaranteed to be the same as it
  // was in the normal context of execution.
  chdir(DRUPAL_ROOT);

  try {
    while (list($key, $callback) = each($callbacks)) {
      call_user_func_array($callback['callback'], $callback['arguments']);
    }
  }
  // PHP 7 introduces Throwable, which covers both Error and
  // Exception throwables.
  catch (\Throwable $error) {
    _drupal_shutdown_function_handle_exception($error);
  }
  // In order to be compatible with PHP 5 we also catch regular Exceptions.
  catch (\Exception $exception) {
    _drupal_shutdown_function_handle_exception($exception);
  }
}

/**
 * Displays and logs any errors that may happen during shutdown.
 *
 * @param \Exception|\Throwable $exception
 *   The exception object that was thrown.
 *
 * @see _drupal_shutdown_function()
 */
function _drupal_shutdown_function_handle_exception($exception) {
  // If using PHP-FPM then fastcgi_finish_request() will have been fired
  // preventing further output to the browser.
  if (!function_exists('fastcgi_finish_request')) {
    // If we are displaying errors, then do so with no possibility of a
    // further uncaught exception being thrown.
    require_once __DIR__ . '/errors.inc';
    if (error_displayable()) {
      print '<h1>Uncaught exception thrown in shutdown function.</h1>';
      print '<p>' . Error::renderExceptionSafe($exception) . '</p><hr />';
    }
  }
  error_log($exception);
}
