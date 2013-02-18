<?php
    namespace app;
    use flyingpiranhas\common\database\adapters\MysqlAdapter;
    use flyingpiranhas\common\utils\Debug;

    /**
     * This class is a model for database access.
     * It contains an installTable method which installs the "site_settings" table
     * It is primarily a demo for how models are made (and registered in the extended bootstrapper)
     * but can also be used in production for saving site wide variables such as the default title,
     * meta data, main URL, site admin email or whatever else you desire.
     *
     * @category       database
     * @package        flyingpiranhas.demo
     * @license        Apache-2.0
     * @version        0.01
     * @since          2013-02-11
     * @author         Bruno Škvorc <bruno@skvorc.me>
     */
    class Settings extends MysqlAdapter
    {

        /** @var string */
        protected $sTableName = 'site_settings';

        /** @var array */
        protected $aSettings;

        /**
         *
         * @param bool $bDropIfExists
         *
         * @return bool
         */
        public function installTable($bDropIfExists = true)
        {
            $sQuery = ($bDropIfExists) ? 'DROP TABLE IF EXISTS `' . $this->sTableName . '`;' : ';';
            $sQuery .= 'CREATE TABLE IF NOT EXISTS `' . $this->sTableName . '` (
              `key` varchar(30) NOT NULL,
              `value` text,
              PRIMARY KEY (`key`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;';
            $oStatement = $this->prepare($sQuery);
            return $oStatement->execute();
        }

        /**
         * Sets the table name for the settings table. Defaults to site_settings.
         * Name is automatically escaped, no need to include backticks.
         *
         * @param string $sTableName
         *
         * @return Settings
         */
        public function setTableName($sTableName = 'site_settings')
        {
            $sTableName = trim($sTableName);
            if (!empty($sTableName)) {
                $this->sTableName = trim($sTableName, '`');
            }
            return $this;
        }

        /**
         * Returns the defined table name for settings
         *
         * @return string
         */
        public function getTableName()
        {
            return $this->sTableName;
        }

        /**
         * Returns the site settings in their entirety
         * Loads them if not already loaded
         *
         * @return array
         */
        public function getSettings()
        {
            if (!$this->aSettings) {
                $this->loadSettings();
            }
            $aUnserialized = array();
            foreach ($this->aSettings as $key => $value) {
                $aUnserialized[$key] = unserialize($value);
            }
            return $aUnserialized;
        }

        /**
         * Loads settings from database and saves them into a property for getter retrieval
         * You can also use this method to reload the settings, if you feel like something might be
         * out of sync
         *
         * @return Settings
         */
        public function loadSettings()
        {
            $sQuery    = 'SELECT * FROM `' . $this->sTableName . '`';
            $aSettings = $this->fetchAssoc($sQuery);
            foreach ($aSettings as $key => &$aValue) {
                $aSettings[$key] = $aValue['value'];
            }
            $this->aSettings = $aSettings;
            return $this;
        }

        /**
         * Inserts serialized settings.
         * While technically possible to save entire objects (because it all gets serialized) it is
         * not recommended you do this. Settings are supposed to be super-lightweight and they seldom
         * change, so they can easily be cached.
         *
         * @return bool
         */
        public function saveSettings()
        {
            if (!empty($this->aSettings)) {
                $sQuery = 'INSERT INTO `' . $this->sTableName . '` (`key`, `value`) VALUES ';
                $i      = 1;
                $aBind  = array();
                foreach ($this->aSettings as $key => $value) {
                    $sKeyTokenName   = ':key' . $i;
                    $sValueTokenName = ':value' . $i;
                    $sQuery .= '(' . $sKeyTokenName . ', ' . $sValueTokenName . '),';
                    $aBind[$sKeyTokenName]   = $key;
                    $aBind[$sValueTokenName] = $value;
                }
                $sQuery = trim($sQuery, ',');
                $sQuery .= ' ON DUPLICATE KEY UPDATE `value` = VALUES(`value`)';
                $oStatement = $this->prepare($sQuery);
                return $oStatement->execute($aBind);
            }
            return false;
        }

        /**
         * Sets a specific setting
         * On save, all values are serialized
         *
         * @param string $sKey
         * @param mixed  $mValue
         */
        public function __set($sKey, $mValue)
        {
            $this->aSettings[$sKey] = serialize($mValue);
        }

        /**
         * Gets a specific setting
         * Setting is automatically unserialized on retrieval
         * If setting does not exist, null is returned
         *
         * @param string $sKey
         *
         * @return null
         */
        public function __get($sKey)
        {
            if (isset($this->aSettings[$sKey])) {

                return unserialize($this->aSettings[$sKey]);
            }
            return null;
        }

        /**
         * Deletes a specific setting
         *
         * @param string $sKey
         */
        public function __unset($sKey)
        {
            if (isset($this->aSettings[$sKey])) {
                unset($this->aSettings[$sKey]);
                $sQuery     = 'DELETE FROM `' . $this->sTableName . '` WHERE `key` = :key';
                $oStatement = $this->prepare($sQuery);
                $oStatement->execute(array('key' => $sKey));
            }
        }

        /**
         * Alias for __unset
         *
         * @param string $sKey
         *
         * @return int|void
         */
        public function remove($sKey)
        {
            $this->__unset($sKey);
        }


    }
