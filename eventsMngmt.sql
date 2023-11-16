/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE `bookings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tickets_purchased` int(11) NOT NULL,
  `total_amount` double NOT NULL,
  `check_in_status` tinyint(1) DEFAULT NULL,
  `cancellation` tinyint(1) DEFAULT NULL,
  `booking_status` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `event_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `fk_user_id` (`user_id`),
  KEY `fk_event_id` (`event_id`),
  CONSTRAINT `fk_event_id` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `pricing` double NOT NULL,
  `available_tickets` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `natid` int(11) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `events` (`id`, `name`, `description`, `start_time`, `end_time`, `location`, `date`, `image`, `pricing`, `available_tickets`, `created_at`) VALUES
(1, 'Annual Charity Gala', 'Join us for an unforgettable evening at our Annual Charity Gala, where we come together to make a difference. This glamorous event will feature live entertainment, a gourmet dinner, and inspiring guest speakers. All proceeds will go towards supporting [Ch', '0700', '11000', 'Grand Ballroom, XYZ Hotel', '2023-03-06', NULL, 25000, 0, '2023-11-15 13:22:41');
INSERT INTO `events` (`id`, `name`, `description`, `start_time`, `end_time`, `location`, `date`, `image`, `pricing`, `available_tickets`, `created_at`) VALUES
(2, 'Tech Summit 2023', 'Tech Summit 2023 is a gathering of industry leaders, innovators, and tech enthusiasts. Join us for a full day of insightful discussions, hands-on workshops, and networking opportunities. Explore the latest trends in technology, engage with cutting-edge de', '0900', '1700', 'Innovation Center, [City]', '2023-03-06', NULL, 3000, 50, '2023-11-15 18:48:47');
INSERT INTO `events` (`id`, `name`, `description`, `start_time`, `end_time`, `location`, `date`, `image`, `pricing`, `available_tickets`, `created_at`) VALUES
(3, 'Yoga and Wellness Retreat', 'Escape the hustle and bustle and embark on a rejuvenating journey at our Yoga and Wellness Retreat. Nestled in the serene surroundings of Serenity Spa Retreat, this weekend getaway offers a perfect blend of yoga sessions, mindfulness workshops, and holist', '0900', '1700', 'Serenity Spa Retreat, [Location]', '2023-03-06', NULL, 5400, 0, '2023-11-15 13:22:41');
INSERT INTO `events` (`id`, `name`, `description`, `start_time`, `end_time`, `location`, `date`, `image`, `pricing`, `available_tickets`, `created_at`) VALUES
(4, 'Art Exhibition: \"Expressions of Color\"', 'Immerse yourself in a world of vibrant colors and artistic expression at our upcoming art exhibition, \"Expressions of Color.\" Featuring the works of local and emerging artists, this showcase celebrates the diverse ways artists use color to convey emotions', '0800', '1900', 'City Art Gallery, [City]', '2023-03-06', NULL, 1000, 0, '2023-11-15 13:22:41'),
(5, 'Startup Pitch Night', 'Get ready for an evening of innovation and entrepreneurial spirit at Startup Pitch Night. Join us as aspiring startups present their groundbreaking ideas to a panel of seasoned investors and industry experts. Whether you\'re a potential investor, mentor, o', '0700', '2000', 'Innovation Hub, [City]', '2023-03-06', NULL, 0, 0, '2023-11-15 13:22:41'),
(6, 'Science and Technology Conference 2023', 'Welcome to the Science and Technology Conference 2023, a gathering of leading researchers, scientists, and industry professionals. Explore the latest advancements in various scientific disciplines, engage in collaborative discussions, and broaden your kno', '1000', '1400', 'Convention Center, [City]', '2023-03-06', NULL, 2500, 0, '2023-11-15 13:22:41'),
(7, 'Cultural Food Festival', 'Indulge your taste buds at the Cultural Food Festival, a celebration of culinary diversity from around the world. Join us for a day of delicious food, live music, cultural performances, and family-friendly activities. Sample a wide array of international ', '1100', '2000', 'City Park, [City]', '2023-03-06', NULL, 1000, 0, '2023-11-15 13:22:41');

INSERT INTO `users` (`id`, `name`, `email`, `address`, `phone`, `gender`, `dob`, `natid`, `role`, `password`) VALUES
(1, 'susan', 'susanmuraya89@gmail.com', '1128-00515', '0741996366', 'Female', '1998-12-29', 35693297, '0', '$2y$10$dtKKBjXc0qoZQEeCFDsd8OnJz5h0ioNp3HEl8KiwbjsxR/DW5CdOm');
INSERT INTO `users` (`id`, `name`, `email`, `address`, `phone`, `gender`, `dob`, `natid`, `role`, `password`) VALUES
(2, 'susan', 'susanmuraya89@gmail.com', '', '', '', '0000-00-00', 0, '', '$2y$10$mi61smVl3ckmIlZ5aNgQve6WZzVTDC2ywNnnN44.k7/91jYmDOJ4K');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;