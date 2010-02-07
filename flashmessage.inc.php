<?php

/**
 * This is a small library for maintaining flash messages in PHP.
 * It provides an easy way, for sending data back to the views, from the
 * controller, by adding a "flash(type,message)" function.
 *
 * The flash message will only remain there for one request!
 *
 * Internally, the flash message is removed, once you open a new URI.
 *
 * In order for the flash functionality for work properly, remember to 
 * initialize sessions on all pages AND call the unsetFlash() function on ALL
 * pages as well.
 */

/**
 * Sets a message in the given type, within 1 REQUEST.
 * After one request, the message is removed.
 * $type, the type to set. E.g. notice, error etc.
 * $message, the message to set
 */
function flash($type, $message) {
  // creates the flash holder, if not defined yet
  if(!isset($_SESSION['flash'])) {
    $_SESSION['flash'] = array();
    $_SESSION['flash']['uri'] = $_SERVER['REQUEST_URI'];
  }
  // sets the message
  $_SESSION['flash'][$type] = $message;
}

/**
 * Removes all due flash messages.
 */
function unsetFlash() {
  if(isset($_SESSION['flash'])) {
    if($_SERVER['REQUEST_URI'] != $_SESSION['flash']['uri']) {
      $_SESSION['flash'] = null;
    }
  }
}

/**
 * Gets a flash message, that has the given $type
 * $type, the type to get the flash message for.
 */
function getFlash($type) {
  if(isset($_SESSION['flash'])) {
    return $_SESSION['flash'][$type];
  }
  
  return null;
}

?>
