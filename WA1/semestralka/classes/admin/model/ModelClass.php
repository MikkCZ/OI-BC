<?php

namespace admin\model;

/**
 * ModelClass is an abstract class, which has been implemented by all model classes.
 * 
 * @property string $RELATIVE_REQUEST_URL
 * @property string $title
 * @property string $headline
 * @property string $copyright
 *
 * @author Michal Stanke <michal.stanke@mikk.cz>
 */
abstract class ModelClass {

    protected $RELATIVE_REQUEST_URL;
    protected $title;
    protected $headline;
    protected $copyright;

    /**
     * Load necessary general and model dependent information.
     * 
     * @param string $relative_request_url request URL relative to the application root
     */
    public function setUrlAndLoad($relative_request_url) {
        $this->RELATIVE_REQUEST_URL = $relative_request_url;
        $this->loadGeneric();
        $this->load();
    }

    /**
     * Load necessary general information.
     */
    protected function loadGeneric() {
        $this->title = \SettingsTable::getInstance()->getSettingValue('title') . ' - admin';
        $this->headline = $this->title;
        $this->copyright = \SettingsTable::getInstance()->getSettingValue('copyright');
    }

    /**
     * Load necessary model dependent information.
     */
    protected abstract function load();

    /**
     * Check if the users is currently logged in (according to the session).
     * 
     * @return \Users logged if user (if logged in)
     */
    public function loggedIn() {
        return \controller\model\LoginController::getInstance()->loggedIn();
    }

    /**
     * Returns page title.
     * 
     * @return string title
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Returns page main headline.
     * 
     * @return string headline
     */
    public function getHeadline() {
        return $this->headline;
    }

    /**
     * Returns copyright of the application logo.
     * 
     * @return string copyright
     */
    public function getCopyright() {
        return $this->copyright;
    }

}
