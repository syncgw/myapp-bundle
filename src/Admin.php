<?php
declare(strict_types=1);

/*
 * 	Administration interface handler
 *
 *	@package	sync*gw
 *	@subpackage	myApp handler
 *	@copyright	(c) 2008 - 2023 Florian Daeumling, Germany. All right reserved
 * 	@license 	LGPL-3.0-or-later
 */

namespace syncgw\interface\myapp;

use syncgw\lib\Config;
use syncgw\lib\DataStore;
use syncgw\gui\guiHandler;
use syncgw\interface\DBAdmin;

class Admin extends \syncgw\interface\mysql\Admin implements DBAdmin {

    /**
     * 	Singleton instance of object
     * 	@var Admin
     */
    static private $_obj = null;

    /**
	 *  Get class instance handler
	 *
	 *  @return - Class object
	 */
	public static function getInstance(): Admin {

	   	if (!self::$_obj)
            self::$_obj = new self();

		return self::$_obj;
	}

    /**
	 * 	Show/get installation parameter
	 */
	public function getParms(): void {

		GuiHandler::getInstance()->putQBox('Please enter message which will be used during execution',
					  '<input name="MyParm" type="text" size="40" maxlength="250" value="'.
					   Config::getInstance()->getVar('Usr_Parm').'" />',
					  'MyApp dummy message.', false);

		parent::getParms();
	}

	/**
	 * 	Connect to handler
	 *
	 * 	@return - true=Ok; false=Error
	*/
	public function Connect(): bool {

		$gui = guiHandler::getInstance();
		$cnf = Config::getInstance();

		// connection already established?
		if ($cnf->getVar(Config::DATABASE))
			return true;

		if ($v = $gui->getVar('MyParm'))
			$cnf->updVar('Usr_Parm', $v);

		// create our own tables
		$cmds = parent::loadSQL('assets/myapp/tables.sql');
		parent::mkTable($cmds);

		return parent::Connect();
	}

	/**
	 * 	Disconnect from handler
	 *
	 * 	@return - true=Ok; false=Error
	 */
	public function DisConnect(): bool {

		// remove parameter
		$cnf = Config::getInstance();
		$cnf->updVar('Usr_Parm', '');

		// delete our own tables
		$cmds = parent::loadSQL('assets/myapp/tables.sql');
		parent::delTable($cmds);

		return parent::DisConnect();
	}

	/**
	 * 	Return list of supported data store handler
	 *
	 * 	@return - Bit map of supported data store handler
 	 */
	public function SupportedHandlers(): int {

		return DataStore::EXT|DataStore::NOTE;
	}

}
