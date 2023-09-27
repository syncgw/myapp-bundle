-- 
--  Tables definitions and sample data
--
--	@package	sync*gw
--	@subpackage	myApp handler
--	@copyright	(c) 2008 - 2023 Florian Daeumling, Germany. All right reserved
-- 	@license 	LGPL-3.0-or-later
--
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- --------------------------------------------------------
-- User table
-- --------------------------------------------------------

DROP TABLE IF EXISTS `myapp_user`;
CREATE TABLE IF NOT EXISTS `myapp_user` (
  `id` 				INT 		NOT null AUTO_INCREMENT,
  `username` 		VARCHAR(64) NOT null COLLATE utf8_general_ci,
  `password` 		VARCHAR(64) NOT null COLLATE utf8_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8 AUTO_INCREMENT=1 ;

INSERT INTO `myapp_user` ( `id`, `username`, `password` ) VALUES
(11, 't1', 'mamma'),
(12, 'debug', 'mamma');

-- --------------------------------------------------------
-- Notes table
-- --------------------------------------------------------

DROP TABLE IF EXISTS `myapp_notes`;
CREATE TABLE IF NOT EXISTS `myapp_notes` (
  `id` 				INT 		 NOT null AUTO_INCREMENT,
  `user`	 		INT 		 NOT null COLLATE utf8_general_ci,  
  `cats`	 		VARCHAR(64)  null COLLATE utf8_general_ci,  
  `title`	 		VARCHAR(64)  null COLLATE utf8_general_ci,  
  `text`	 		VARCHAR(256) NOT null COLLATE utf8_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=UTF8 AUTO_INCREMENT=1 ;

INSERT INTO `myapp_notese` ( `id`, `user`, `cats`, `title`, `text` ) VALUES
(11, 11, 'Cat1, Cat2', 'Notes title', 'This is a short text.');
