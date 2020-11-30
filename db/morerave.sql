-- MySQL dump 10.13  Distrib 8.0.20, for macos10.15 (x86_64)
--
-- Host: localhost    Database: morerave
-- ------------------------------------------------------
-- Server version	8.0.20

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin','Femi Ibiwoye','YMU5GUIPsyCfI9QC7WiaSAM2qPw_o7e9','$2y$13$wum/jd6fHDfgIkinB3yID.yOCovABZ9WphpoTTMCvdnYB/kynM3QG','','admin@yahoo.com',10,'My job position','admin.png','super',1436003139,1596384095);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `banks`
--

LOCK TABLES `banks` WRITE;
/*!40000 ALTER TABLE `banks` DISABLE KEYS */;
/*!40000 ALTER TABLE `banks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `checkouts`
--

LOCK TABLES `checkouts` WRITE;
/*!40000 ALTER TABLE `checkouts` DISABLE KEYS */;
/*!40000 ALTER TABLE `checkouts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `linkedin_accounts`
--

LOCK TABLES `linkedin_accounts` WRITE;
/*!40000 ALTER TABLE `linkedin_accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `linkedin_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `oauth_access_tokens`
--

LOCK TABLES `oauth_access_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `oauth_auth_codes`
--

LOCK TABLES `oauth_auth_codes` WRITE;
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `oauth_clients`
--

LOCK TABLES `oauth_clients` WRITE;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `oauth_personal_access_clients`
--

LOCK TABLES `oauth_personal_access_clients` WRITE;
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `oauth_refresh_tokens`
--

LOCK TABLES `oauth_refresh_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `post_comments`
--

LOCK TABLES `post_comments` WRITE;
/*!40000 ALTER TABLE `post_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `post_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `post_likes`
--

LOCK TABLES `post_likes` WRITE;
/*!40000 ALTER TABLE `post_likes` DISABLE KEYS */;
/*!40000 ALTER TABLE `post_likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'2020-11-20 13:50:43','2020-11-20 13:59:14',1,'this','[\"1605880128.jpg\"]','[\"twitter\"]',1,0,0,0,257,'1329786380633968640','',1,'{\"created_at\":\"Fri Nov 20 13:59:14 +0000 2020\",\"id\":1329786380633968640,\"id_str\":\"1329786380633968640\",\"text\":\"this https:\\/\\/t.co\\/jtXJ6WAyZw\",\"truncated\":false,\"entities\":{\"hashtags\":[],\"symbols\":[],\"user_mentions\":[],\"urls\":[],\"media\":[{\"id\":1329786378163539969,\"id_str\":\"1329786378163539969\",\"indices\":[5,28],\"media_url\":\"http:\\/\\/pbs.twimg.com\\/media\\/EnRZqlmXUAEYTGN.jpg\",\"media_url_https\":\"https:\\/\\/pbs.twimg.com\\/media\\/EnRZqlmXUAEYTGN.jpg\",\"url\":\"https:\\/\\/t.co\\/jtXJ6WAyZw\",\"display_url\":\"pic.twitter.com\\/jtXJ6WAyZw\",\"expanded_url\":\"https:\\/\\/twitter.com\\/more_rave\\/status\\/1329786380633968640\\/photo\\/1\",\"type\":\"photo\",\"sizes\":{\"large\":{\"w\":720,\"h\":1500,\"resize\":\"fit\"},\"thumb\":{\"w\":150,\"h\":150,\"resize\":\"crop\"},\"medium\":{\"w\":576,\"h\":1200,\"resize\":\"fit\"},\"small\":{\"w\":326,\"h\":680,\"resize\":\"fit\"}}}]},\"extended_entities\":{\"media\":[{\"id\":1329786378163539969,\"id_str\":\"1329786378163539969\",\"indices\":[5,28],\"media_url\":\"http:\\/\\/pbs.twimg.com\\/media\\/EnRZqlmXUAEYTGN.jpg\",\"media_url_https\":\"https:\\/\\/pbs.twimg.com\\/media\\/EnRZqlmXUAEYTGN.jpg\",\"url\":\"https:\\/\\/t.co\\/jtXJ6WAyZw\",\"display_url\":\"pic.twitter.com\\/jtXJ6WAyZw\",\"expanded_url\":\"https:\\/\\/twitter.com\\/more_rave\\/status\\/1329786380633968640\\/photo\\/1\",\"type\":\"photo\",\"sizes\":{\"large\":{\"w\":720,\"h\":1500,\"resize\":\"fit\"},\"thumb\":{\"w\":150,\"h\":150,\"resize\":\"crop\"},\"medium\":{\"w\":576,\"h\":1200,\"resize\":\"fit\"},\"small\":{\"w\":326,\"h\":680,\"resize\":\"fit\"}}}]},\"source\":\"<a href=\\\"http:\\/\\/morerave.com\\\" rel=\\\"nofollow\\\">MoreRave<\\/a>\",\"in_reply_to_status_id\":null,\"in_reply_to_status_id_str\":null,\"in_reply_to_user_id\":null,\"in_reply_to_user_id_str\":null,\"in_reply_to_screen_name\":null,\"user\":{\"id\":1304101952062619652,\"id_str\":\"1304101952062619652\",\"name\":\"More Rave\",\"screen_name\":\"more_rave\",\"location\":\"\",\"description\":\"\",\"url\":null,\"entities\":{\"description\":{\"urls\":[]}},\"protected\":false,\"followers_count\":0,\"friends_count\":0,\"listed_count\":0,\"created_at\":\"Thu Sep 10 16:59:13 +0000 2020\",\"favourites_count\":0,\"utc_offset\":null,\"time_zone\":null,\"geo_enabled\":false,\"verified\":false,\"statuses_count\":14,\"lang\":null,\"contributors_enabled\":false,\"is_translator\":false,\"is_translation_enabled\":false,\"profile_background_color\":\"F5F8FA\",\"profile_background_image_url\":null,\"profile_background_image_url_https\":null,\"profile_background_tile\":false,\"profile_image_url\":\"http:\\/\\/abs.twimg.com\\/sticky\\/default_profile_images\\/default_profile_normal.png\",\"profile_image_url_https\":\"https:\\/\\/abs.twimg.com\\/sticky\\/default_profile_images\\/default_profile_normal.png\",\"profile_link_color\":\"1DA1F2\",\"profile_sidebar_border_color\":\"C0DEED\",\"profile_sidebar_fill_color\":\"DDEEF6\",\"profile_text_color\":\"333333\",\"profile_use_background_image\":true,\"has_extended_profile\":true,\"default_profile\":true,\"default_profile_image\":true,\"following\":false,\"follow_request_sent\":false,\"notifications\":false,\"translator_type\":\"none\"},\"geo\":null,\"coordinates\":null,\"place\":null,\"contributors\":null,\"is_quote_status\":false,\"retweet_count\":0,\"favorite_count\":0,\"favorited\":false,\"retweeted\":false,\"possibly_sensitive\":false,\"lang\":\"en\"}'),(2,'2020-11-20 16:19:40','2020-11-20 16:20:07',1,'hello lljjjvhyc fhgh dges','[\"1605889160.jpg\"]','[\"twitter\"]',1,0,0,0,300,'1329821835337347076','',1,'{\"created_at\":\"Fri Nov 20 16:20:07 +0000 2020\",\"id\":1329821835337347076,\"id_str\":\"1329821835337347076\",\"text\":\"hello lljjjvhyc fhgh dges https:\\/\\/t.co\\/gJSxBurlUB\",\"truncated\":false,\"entities\":{\"hashtags\":[],\"symbols\":[],\"user_mentions\":[],\"urls\":[],\"media\":[{\"id\":1329821829939294208,\"id_str\":\"1329821829939294208\",\"indices\":[26,49],\"media_url\":\"http:\\/\\/pbs.twimg.com\\/media\\/EnR56JwXcAACflH.jpg\",\"media_url_https\":\"https:\\/\\/pbs.twimg.com\\/media\\/EnR56JwXcAACflH.jpg\",\"url\":\"https:\\/\\/t.co\\/gJSxBurlUB\",\"display_url\":\"pic.twitter.com\\/gJSxBurlUB\",\"expanded_url\":\"https:\\/\\/twitter.com\\/more_rave\\/status\\/1329821835337347076\\/photo\\/1\",\"type\":\"photo\",\"sizes\":{\"large\":{\"w\":1536,\"h\":2048,\"resize\":\"fit\"},\"thumb\":{\"w\":150,\"h\":150,\"resize\":\"crop\"},\"medium\":{\"w\":900,\"h\":1200,\"resize\":\"fit\"},\"small\":{\"w\":510,\"h\":680,\"resize\":\"fit\"}}}]},\"extended_entities\":{\"media\":[{\"id\":1329821829939294208,\"id_str\":\"1329821829939294208\",\"indices\":[26,49],\"media_url\":\"http:\\/\\/pbs.twimg.com\\/media\\/EnR56JwXcAACflH.jpg\",\"media_url_https\":\"https:\\/\\/pbs.twimg.com\\/media\\/EnR56JwXcAACflH.jpg\",\"url\":\"https:\\/\\/t.co\\/gJSxBurlUB\",\"display_url\":\"pic.twitter.com\\/gJSxBurlUB\",\"expanded_url\":\"https:\\/\\/twitter.com\\/more_rave\\/status\\/1329821835337347076\\/photo\\/1\",\"type\":\"photo\",\"sizes\":{\"large\":{\"w\":1536,\"h\":2048,\"resize\":\"fit\"},\"thumb\":{\"w\":150,\"h\":150,\"resize\":\"crop\"},\"medium\":{\"w\":900,\"h\":1200,\"resize\":\"fit\"},\"small\":{\"w\":510,\"h\":680,\"resize\":\"fit\"}}}]},\"source\":\"<a href=\\\"http:\\/\\/morerave.com\\\" rel=\\\"nofollow\\\">MoreRave<\\/a>\",\"in_reply_to_status_id\":null,\"in_reply_to_status_id_str\":null,\"in_reply_to_user_id\":null,\"in_reply_to_user_id_str\":null,\"in_reply_to_screen_name\":null,\"user\":{\"id\":1304101952062619652,\"id_str\":\"1304101952062619652\",\"name\":\"More Rave\",\"screen_name\":\"more_rave\",\"location\":\"\",\"description\":\"\",\"url\":null,\"entities\":{\"description\":{\"urls\":[]}},\"protected\":false,\"followers_count\":0,\"friends_count\":0,\"listed_count\":0,\"created_at\":\"Thu Sep 10 16:59:13 +0000 2020\",\"favourites_count\":0,\"utc_offset\":null,\"time_zone\":null,\"geo_enabled\":false,\"verified\":false,\"statuses_count\":15,\"lang\":null,\"contributors_enabled\":false,\"is_translator\":false,\"is_translation_enabled\":false,\"profile_background_color\":\"F5F8FA\",\"profile_background_image_url\":null,\"profile_background_image_url_https\":null,\"profile_background_tile\":false,\"profile_image_url\":\"http:\\/\\/abs.twimg.com\\/sticky\\/default_profile_images\\/default_profile_normal.png\",\"profile_image_url_https\":\"https:\\/\\/abs.twimg.com\\/sticky\\/default_profile_images\\/default_profile_normal.png\",\"profile_link_color\":\"1DA1F2\",\"profile_sidebar_border_color\":\"C0DEED\",\"profile_sidebar_fill_color\":\"DDEEF6\",\"profile_text_color\":\"333333\",\"profile_use_background_image\":true,\"has_extended_profile\":true,\"default_profile\":true,\"default_profile_image\":true,\"following\":false,\"follow_request_sent\":false,\"notifications\":false,\"translator_type\":\"none\"},\"geo\":null,\"coordinates\":null,\"place\":null,\"contributors\":null,\"is_quote_status\":false,\"retweet_count\":0,\"favorite_count\":0,\"favorited\":false,\"retweeted\":false,\"possibly_sensitive\":false,\"lang\":\"en\"}');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `twitter_accounts`
--

LOCK TABLES `twitter_accounts` WRITE;
/*!40000 ALTER TABLE `twitter_accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `twitter_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,NULL,NULL,NULL,0,0,0,'Femi Ibiwoye','femibiwoye@gmail.com',NULL,'07069064169','$2y$13$2uQQV4lWyMaF9X4oPeHLb.R6FsbLaK0A9SbuxVp9kt/V9iBg471NG',NULL,'femi','https://morerave.s3.eu-west-2.amazonaws.com/users/tuop5kosuzLhGK9CCIHfe0mzcoxby_Uuyh0TSvTsqamVEMN2tR.png','sDaSvOkXGwFKYAJ_i9dla_eBnAk2JmBx','07069064167',9,'jksdngflsjdgopskdfoijewofijew9r4jofiewkfljsdopfje09fjwelv0pwjf9jmklmpoko;lk');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `verifications`
--

LOCK TABLES `verifications` WRITE;
/*!40000 ALTER TABLE `verifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `verifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `wallet_histories`
--

LOCK TABLES `wallet_histories` WRITE;
/*!40000 ALTER TABLE `wallet_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `wallet_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `withdrawal_requests`
--

LOCK TABLES `withdrawal_requests` WRITE;
/*!40000 ALTER TABLE `withdrawal_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `withdrawal_requests` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-11-30 11:08:10
