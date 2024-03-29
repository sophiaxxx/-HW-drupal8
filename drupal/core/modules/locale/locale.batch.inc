<?php

/**
 * @file
 * Batch process to check the availability of remote or local po files.
 */

use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

/**
 * Load the common translation API.
 */
// @todo Combine functions differently in files to avoid unnecessary includes.
// Follow-up issue: https://www.drupal.org/node/1834298.
require_once __DIR__ . '/locale.translation.inc';

/**
 * Implements callback_batch_operation().
 *
 * Checks the presence and creation time po translation files in located at
 * remote server location and local file system.
 *
 * @param string $project
 *   Machine name of the project for which to check the translation status.
 * @param string $langcode
 *   Language code of the language for which to check the translation.
 * @param array $options
 *   An array with options that can have the following elements:
 *   - 'finish_feedback': Whether or not to give feedback to the user when the
 *     batch is finished. Optional, defaults to TRUE.
 *   - 'use_remote': Whether or not to check the remote translation file.
 *     Optional, defaults to TRUE.
<<<<<<< HEAD
 * @param array|\ArrayAccess $context.
=======
 * @param array|\ArrayAccess $context
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
 *   The batch context.
 */
function locale_translation_batch_status_check($project, $langcode, array $options, &$context) {
  $failure = $checked = FALSE;
  $options += [
    'finish_feedback' => TRUE,
    'use_remote' => TRUE,
  ];
  $source = locale_translation_get_status([$project], [$langcode]);
  $source = $source[$project][$langcode];

  // Check the status of local translation files.
  if (isset($source->files[LOCALE_TRANSLATION_LOCAL])) {
    if ($file = locale_translation_source_check_file($source)) {
      locale_translation_status_save($source->name, $source->langcode, LOCALE_TRANSLATION_LOCAL, $file);
    }
    $checked = TRUE;
  }

  // Check the status of remote translation files.
  if ($options['use_remote'] && isset($source->files[LOCALE_TRANSLATION_REMOTE])) {
    $remote_file = $source->files[LOCALE_TRANSLATION_REMOTE];
    if ($result = locale_translation_http_check($remote_file->uri)) {
      // Update the file object with the result data. In case of a redirect we
      // store the resulting uri.
      if (isset($result['last_modified'])) {
        $remote_file->uri = isset($result['location']) ? $result['location'] : $remote_file->uri;
        $remote_file->timestamp = $result['last_modified'];
        locale_translation_status_save($source->name, $source->langcode, LOCALE_TRANSLATION_REMOTE, $remote_file);
      }
      // @todo What to do with when the file is not found (404)? To prevent
      //   re-checking within the TTL (1day, 1week) we can set a last_checked
      //   timestamp or cache the result.
      $checked = TRUE;
    }
    else {
      $failure = TRUE;
    }
  }

  // Provide user feedback and record success or failure for reporting at the
  // end of the batch.
  if ($options['finish_feedback'] && $checked) {
    $context['results']['files'][] = $source->name;
  }
  if ($failure && !$checked) {
    $context['results']['failed_files'][] = $source->name;
  }
  $context['message'] = t('Checked translation for %project.', ['%project' => $source->project]);
}

/**
 * Implements callback_batch_finished().
 *
 * Set result message.
 *
 * @param bool $success
 *   TRUE if batch successfully completed.
 * @param array $results
 *   Batch results.
 */
function locale_translation_batch_status_finished($success, $results) {
  if ($success) {
    if (isset($results['failed_files'])) {
      if (\Drupal::moduleHandler()->moduleExists('dblog') && \Drupal::currentUser()->hasPermission('access site reports')) {
        $message = \Drupal::translation()->formatPlural(count($results['failed_files']), 'One translation file could not be checked. <a href=":url">See the log</a> for details.', '@count translation files could not be checked. <a href=":url">See the log</a> for details.', [':url' => \Drupal::url('dblog.overview')]);
      }
      else {
        $message = \Drupal::translation()->formatPlural(count($results['failed_files']), 'One translation files could not be checked. See the log for details.', '@count translation files could not be checked. See the log for details.');
      }
      drupal_set_message($message, 'error');
    }
    if (isset($results['files'])) {
      drupal_set_message(\Drupal::translation()->formatPlural(
        count($results['files']),
        'Checked available interface translation updates for one project.',
        'Checked available interface translation updates for @count projects.'
      ));
    }
    if (!isset($results['failed_files']) && !isset($results['files'])) {
      drupal_set_message(t('Nothing to check.'));
    }
    \Drupal::state()->set('locale.translation_last_checked', REQUEST_TIME);
  }
  else {
    drupal_set_message(t('An error occurred trying to check available interface translation updates.'), 'error');
  }
}

/**
 * Implements callback_batch_operation().
 *
 * Downloads a remote gettext file into the translations directory. When
 * successfully the translation status is updated.
 *
 * @param object $project
 *   Source object of the translatable project.
 * @param string $langcode
 *   Language code.
 * @param array $context
 *   The batch context.
 *
 * @see locale_translation_batch_fetch_import()
 */
function locale_translation_batch_fetch_download($project, $langcode, &$context) {
  $sources = locale_translation_get_status([$project], [$langcode]);
  if (isset($sources[$project][$langcode])) {
    $source = $sources[$project][$langcode];
    if (isset($source->type) && $source->type == LOCALE_TRANSLATION_REMOTE) {
      if ($file = locale_translation_download_source($source->files[LOCALE_TRANSLATION_REMOTE], 'translations://')) {
        $context['message'] = t('Downloaded translation for %project.', ['%project' => $source->project]);
        locale_translation_status_save($source->name, $source->langcode, LOCALE_TRANSLATION_LOCAL, $file);
      }
      else {
        $context['results']['failed_files'][] = $source->files[LOCALE_TRANSLATION_REMOTE];
      }
    }
  }
}

/**
 * Implements callback_batch_operation().
 *
 * Imports a gettext file from the translation directory. When successfully the
 * translation status is updated.
 *
 * @param object $project
 *   Source object of the translatable project.
 * @param string $langcode
 *   Language code.
 * @param array $options
 *   Array of import options.
 * @param array $context
 *   The batch context.
 *
 * @see locale_translate_batch_import_files()
 * @see locale_translation_batch_fetch_download()
 */
function locale_translation_batch_fetch_import($project, $langcode, $options, &$context) {
  $sources = locale_translation_get_status([$project], [$langcode]);
  if (isset($sources[$project][$langcode])) {
    $source = $sources[$project][$langcode];
    if (isset($source->type)) {
      if ($source->type == LOCALE_TRANSLATION_REMOTE || $source->type == LOCALE_TRANSLATION_LOCAL) {
        $file = $source->files[LOCALE_TRANSLATION_LOCAL];
        module_load_include('bulk.inc', 'locale');
        $options += [
          'message' => t('Importing translation for %project.', ['%project' => $source->project]),
        ];
        // Import the translation file. For large files the batch operations is
        // progressive and will be called repeatedly until finished.
        locale_translate_batch_import($file, $options, $context);

        // The import is finished.
        if (isset($context['finished']) && $context['finished'] == 1) {
          // The import is successful.
          if (isset($context['results']['files'][$file->uri])) {
            $context['message'] = t('Imported translation for %project.', ['%project' => $source->project]);

            // Save the data of imported source into the {locale_file} table and
            // update the current translation status.
            locale_translation_status_save($project, $langcode, LOCALE_TRANSLATION_CURRENT, $source->files[LOCALE_TRANSLATION_LOCAL]);
          }
        }
      }
    }
  }
}

/**
 * Implements callback_batch_finished().
 *
 * Set result message.
 *
 * @param bool $success
 *   TRUE if batch successfully completed.
 * @param array $results
 *   Batch results.
 */
function locale_translation_batch_fetch_finished($success, $results) {
  module_load_include('bulk.inc', 'locale');
  if ($success) {
    \Drupal::state()->set('locale.translation_last_checked', REQUEST_TIME);
  }
  return locale_translate_batch_finished($success, $results);
}

/**
 * Check if remote file exists and when it was last updated.
 *
 * @param string $uri
 *   URI of remote file.
 *
 * @return array|bool
 *   Associative array of file data with the following elements:
 *   - last_modified: Last modified timestamp of the translation file.
 *   - (optional) location: The location of the translation file. Is only set
 *     when a redirect (301) has occurred.
 *   TRUE if the file is not found. FALSE if a fault occurred.
 */
function locale_translation_http_check($uri) {
  $logger = \Drupal::logger('locale');
  try {
    $actual_uri = NULL;
    $response = \Drupal::service('http_client_factory')->fromOptions(['allow_redirects' => [
      'on_redirect' => function(RequestInterface $request, ResponseInterface $response, UriInterface $request_uri) use (&$actual_uri) {
        $actual_uri = (string) $request_uri;
      }
    ]])->head($uri);
    $result = [];

    // Return the effective URL if it differs from the requested.
    if ($actual_uri && $actual_uri !== $uri) {
      $result['location'] = $actual_uri;
    }

    $result['last_modified'] = $response->hasHeader('Last-Modified') ? strtotime($response->getHeaderLine('Last-Modified')) : 0;
    return $result;
  }
  catch (RequestException $e) {
    // Handle 4xx and 5xx http responses.
    if ($response = $e->getResponse()) {
      if ($response->getStatusCode() == 404) {
        // File not found occurs when a translation file is not yet available
        // at the translation server. But also if a custom module or custom
        // theme does not define the location of a translation file. By default
        // the file is checked at the translation server, but it will not be
        // found there.
        $logger->notice('Translation file not found: @uri.', ['@uri' => $uri]);
        return TRUE;
      }
      $logger->notice('HTTP request to @url failed with error: @error.', ['@url' => $uri, '@error' => $response->getStatusCode() . ' ' . $response->getReasonPhrase()]);
    }
  }

  return FALSE;
}

/**
 * Downloads a translation file from a remote server.
 *
 * @param object $source_file
 *   Source file object with at least:
 *   - "uri": uri to download the file from.
 *   - "project": Project name.
 *   - "langcode": Translation language.
 *   - "version": Project version.
 *   - "filename": File name.
 * @param string $directory
 *   Directory where the downloaded file will be saved. Defaults to the
 *   temporary file path.
 *
 * @return object
 *   File object if download was successful. FALSE on failure.
 */
function locale_translation_download_source($source_file, $directory = 'temporary://') {
  if ($uri = system_retrieve_file($source_file->uri, $directory)) {
    $file = clone($source_file);
    $file->type = LOCALE_TRANSLATION_LOCAL;
    $file->uri = $uri;
    $file->directory = $directory;
    $file->timestamp = filemtime($uri);
    return $file;
  }
  \Drupal::logger('locale')->error('Unable to download translation file @uri.', ['@uri' => $source_file->uri]);
  return FALSE;
}
