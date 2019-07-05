CREATE TABLE IF NOT EXISTS `avj3_chronoforms_data_connector` (
  `aid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `trigger` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;



INSERT INTO `avj3_chronoforms_data_connector` (`aid`, `user_id`, `created`, `modified`, `name`, `description`, `trigger`, `action`) VALUES
(1, 000, '2019-04-24 18:15:40', NULL, 'DateTime', 'data e ora', '1', ''),
(2, 000, '2019-04-24 18:18:35', NULL, 'living room lamp', 'lampada del salotto', '', '1'),
(3, 000, '2019-04-24 18:26:57', NULL, 'badroom lamp', 'lampada della camera da letto', '', '1'),
(4, 000, '2019-05-01 09:27:54', NULL, 'Weather Underground', 'meteo', '1', ''),
(5, 000, '2019-05-01 10:36:05', NULL, 'Telegram', 'Telegram', '', '1'),
(6, 000, '2019-06-01 08:00:34', NULL, 'location', 'location', '1', '');



CREATE TABLE IF NOT EXISTS `avj3_chronoforms_data_triggerchannel` (
  `aid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime DEFAULT NULL,
  `connectorID` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;



INSERT INTO `avj3_chronoforms_data_triggerchannel` (`aid`, `user_id`, `created`, `modified`, `connectorID`, `name`, `description`) VALUES
(2, 000, '2019-04-25 08:10:58', NULL, '1', 'every day at 15:00', 'ogni giorno alle 15:00'),
(4, 000, '2019-05-01 09:30:36', NULL, '4', 'reports weather every day at 09:00 AM', 'meteo ogni giorno alle 15:00'),
(6, 000, '2019-06-01 07:23:22', NULL, '4', 'rain', 'se piove'),
(7, 000, '2019-06-01 08:01:16', NULL, '6', 'get out of the house', 'esco da casa');



CREATE TABLE IF NOT EXISTS `avj3_chronoforms_data_actionchannel` (
  `aid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime DEFAULT NULL,
  `connectorID` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;




INSERT INTO `avj3_chronoforms_data_actionchannel` (`aid`, `user_id`, `created`, `modified`, `connectorID`, `name`, `description`) VALUES
(1, 000, '2019-04-25 08:20:48', NULL, '2', 'living room lamp turn on', 'accendi lampada del salotto'),
(2, 000, '2019-05-01 10:37:40', NULL, '5', 'send me a Telegram message', 'inviami un messaggio Telegram'),
(3, 000, '2019-06-01 06:50:04', NULL, '2', 'living room lamp turn off', 'spegni lampada del salotto');



CREATE TABLE IF NOT EXISTS `avj3_chronoforms_data_behavior` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime DEFAULT NULL,
  `triggerchannel` varchar(255) NOT NULL,
  `actionchannel` varchar(255) NOT NULL,
  `activate` varchar(255) NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

