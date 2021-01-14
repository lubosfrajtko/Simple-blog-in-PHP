# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.7.26)
# Database: myblog
# Generation Time: 2020-11-12 16:00:08 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `post_id` int(11) DEFAULT NULL,
  `text` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `text` text NOT NULL,
  `slug` varchar(100) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;

INSERT INTO `posts` (`id`, `user_id`, `title`, `text`, `slug`, `created_at`, `updated_at`)
VALUES
	(1,0,'HOW I GOT HERE: FOREST YOUNG','Forest Young’s career has spanned an impressive range of disciplines, including work in the realms of branding, user experience, interactive and traditional graphic design. He’s had pieces exhibited at multiple museums around the world, been recognised with a long list of industry awards, and has just been named Wolff Olins’ first Global Chief Creative Officer.\n\nHowever his trajectory hasn’t been straightforward, as he reveals. Forays into the worlds of medicine, acting, and even hotel management all preceded his creative career, which Young says has taken something of a circuitous path. Here he tells CR why failure has been such an important part of getting him to this point, and makes the case for “a weird career path of tumbling and tumbling”.\n\nThe family influence I started doing artistic expression – painting and drawing – at such a young age. I can’t even remember the first time I picked up a pencil, crayon or paintbrush. It has to be three or four. A lot of people in my family are artists and painters, and I admit that I took for granted – the amount of people that were comfortable expressing themselves in form. My aunt would create something out of wood, and put it on the wall, and I thought normal people did that. My uncle, who was a police officer, did criminal sketches when he wasn’t painting and was part of the San Diego design community. So I was drawing and painting, and probably took it for granted. A lot of the time when something comes naturally to you, you don’t understand that it’s significant.','how-i-got-here','2020-11-12 16:38:09','2020-11-12 16:38:09'),
	(2,0,'Pentagram gives banking a fresh face in Virgin Money rebrand','There has been a movement among traditional financial institutions to adopt a more human persona in recent years – largely thanks to younger, cooler challenger banks like Monzo and Starling snapping at their heels.\n\nRecent examples of this shift in tone include Natwest’s launch of millennial-friendly digital banking service Bó, and First Direct’s new brand positioning that focuses on financial wellness.\n\n\n\nIt is in this context that Virgin Money unveils its new brand identity, which comes off the back of its merger with CYBG plc, formed of Clydesdale Bank, Yorkshire Bank and B products and services.\n\nVirgin Money approached Pentagram’s Luke Powell, Jody Hudson-Powell and Domenic Lippa to create a fresh look to go with its new proposition, as a brand that shares Virgin’s core values but happens to be in banking, as opposed to a financial brand that happens to be part of Virgin.\n\n\n\nThe new identity looks to move the brand firmly away from the often faceless, corporate look favoured by many financial services companies, and reflect a customer-focused approach to banking.\n\nThe design team created a bespoke mono-linear wordmark, with the wider Virgin Money headline font family being built from this geometric logo.\n\n\n\nThe Virgin Money ʹMʹ and its distinctive loop is a key feature of the wordmark, and a stacked version of the logo is used for applications where users are already familiar with the brand, such as in stores, on bank cards or existing customer communications.\n\nA bespoke typeface was created by Luke Prowse and comprises two distinct cuts, Virgin Money Sans and Virgin Money Loop, to allow the brand to adjust its visual tone of voice.\n\n\n\n“The overall construction is a balance of geometric curves, nuanced humanist forms, and hard edges and angles, creating a visual form that references Virgin Money’s functional and pragmatic side while embodying its people-centred approach,” says Pentagram.\n\nADVERTISING\n\nThe instantly recognisable Virgin red is used as the brand’s primary colour, alongside a secondary colour palette of bright blue, purple and white.\n\n\n\nPentagram also created a distinct and and more sophisticated visual language for its business banking sub-brand, Virgin Money Business. It features a reduced usage of the looped typeface, a lighter version of the Virgin Money pattern and a more streamlined colour palette of charcoal and bright lime.\n\npentagram.com\n\nCreative Inspiration Branding Graphic Design\n','pentagran-gives-banking','2020-11-12 16:41:43','2020-11-12 16:41:43'),
	(3,0,'IRVINE WELSH ON CREATIVITY AND CANCEL CULTURE','Irvine Welsh is no stranger to a bit of controversy. The Scottish author has a long reputation for causing literary offence: his cult 1993 novel Trainspotting, which tells the story of a group of working class heroin addicts from Edinburgh, was pulled from the Booker Prize shortlist after two of the judges threatened to resign over it, while posters promoting the release of 1998’s Filth, which revolves around a racist and mysoginistic copper protagonist, were subsequently seized from an independent bookshop by the police.\n\nDespite the divisive nature of Welsh’s work, he’s also achieved huge success. Trainspotting has sold more than one million copies in the UK alone, and is said to be the most shoplifted novel in British publishing history, while Danny Boyle’s film adpation of the book topped a 2012 poll of the best British films of the past 60 years.\n\nFast forward to 2020, however, and the cultural and political landscape is markedly different from the one in which Welsh first curated his thought-provoking brand of controversy. Building on the age-old practice of public shaming, the act of ostracising – or cancelling – public figures and companies after they have done or said something deemed to be offensive has become increasingly commonplace in recent years, growing hand in hand with sociopolitical movements such as #MeToo.','irvine-welsh-on-creativity','2020-11-12 16:41:55','2020-11-12 16:41:55');

/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `post_create` BEFORE INSERT ON `posts` FOR EACH ROW SET NEW.created_at = NOW(),
	NEW.updated_at = NOW() */;;
/*!50003 SET SESSION SQL_MODE="ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `post_update` BEFORE UPDATE ON `posts` FOR EACH ROW SET NEW.updated_at = NOW(),
	NEW.created_at = OLD.created_at */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;


# Dump of table posts_tags
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts_tags`;

CREATE TABLE `posts_tags` (
  `post_id` int(11) unsigned NOT NULL DEFAULT '0',
  `tag_id` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`tag_id`,`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `posts_tags` WRITE;
/*!40000 ALTER TABLE `posts_tags` DISABLE KEYS */;

INSERT INTO `posts_tags` (`post_id`, `tag_id`)
VALUES
	(1,1),
	(2,1),
	(1,3),
	(3,3);

/*!40000 ALTER TABLE `posts_tags` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tags
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tags`;

CREATE TABLE `tags` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tag` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;

INSERT INTO `tags` (`id`, `tag`)
VALUES
	(1,'balls'),
	(2,'tits'),
	(3,'big');

/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
