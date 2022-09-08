-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 29, 2022 at 03:15 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keyword` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=visible,1=hidden',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parent_id` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=parent,1=child1,2=child2',
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `meta_title`, `meta_keyword`, `meta_description`, `status`, `created_at`, `updated_at`, `parent_id`, `user_id`) VALUES
(8, 'Football', 'football', 'Football, also called association football or soccer, game in which two teams of 11 players, using any part of their bodies except their hands and arms, try to maneuver the ball into the opposing team’s goal. Only the goalkeeper is permitted to handle the ball and may do so only within the penalty area surrounding the goal. The team that scores more goals wins.\r\n\r\nFootball is the world’s most popular ball game in numbers of participants and spectators.', 'football', 'football', 'This is Football meta description', 0, '2022-08-16 20:18:28', '2022-08-24 21:20:41', 0, 3),
(10, 'Photograph', 'photograph', 'A photograph (also known as a photo, image, or picture) is an image created by light falling on a photosensitive surface, usually photographic film or an electronic image sensor, such as a CCD or a CMOS chip. Most photographs are now created using a smartphone/camera, which uses a lens to focus the scene\'s visible wavelengths of light into a reproduction of what the human eye would see. The process and practice of creating such images is called photography.', 'photograph', 'photograph', 'This is photograph meta description', 0, '2022-08-19 01:39:21', '2022-08-19 01:39:21', 0, 4),
(11, 'Flower', 'flower', 'A flower is the reproductive part of flowering plants. Flowers are also called the bloom or blossom of a plant. Flowers have petals. Inside the part of the flower that has petals are the parts which produce pollen and seeds.', 'flower', 'flower', 'This is flower meta description', 0, '2022-08-24 20:54:43', '2022-08-24 21:04:55', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_08_15_021041_add_details_to_users_table', 2),
(6, '2022_08_15_023648_create_categories_table', 3),
(7, '2022_08_15_024346_create_categories_table', 4),
(8, '2022_08_15_043702_add_details_to_categories_table', 5),
(9, '2022_08_16_020540_create_posts_table', 6),
(10, '2022_08_16_024801_add_details_to_posts_table', 7),
(11, '2022_08_16_085331_create_media_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ima` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(11) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=visible,1=hidden',
  `view_count` int(11) DEFAULT NULL,
  `like_count` int(11) DEFAULT NULL,
  `favorite_count` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `ima`, `content`, `user_id`, `status`, `view_count`, `like_count`, `favorite_count`, `created_at`, `updated_at`, `category_id`) VALUES
(5, 'Neymar Jr', 'neymar-1.jpg', '<p><strong>Neymar</strong>, in full <strong>Neymar da Silva Santos, Jr.</strong>, (born February 5, 1992, <a href=\"https://www.britannica.com/place/Mogi-das-Cruzes\">Mogi das Cruzes</a>, Brazil), Brazilian <a href=\"https://www.britannica.com/sports/football-soccer\">football</a> (soccer) player who was one of the most <a href=\"https://www.merriam-webster.com/dictionary/prolific\">prolific</a> scorers in his <a href=\"https://www.britannica.com/topic/nation-state\">country’s</a> storied football history.</p><p>Neymar began playing football as a boy in <a href=\"https://www.britannica.com/place/Sao-Vicente-Brazil\">São Vicente</a>, under the guidance of his father, a former professional footballer who remained a close adviser and mentor throughout his son’s career. Having played street and indoor five-a-side football, Neymar joined Portuguesa Santista’s youth team in São Vicente, and in 2003 he and his family moved to <a href=\"https://www.britannica.com/place/Santos\">Santos</a>. There Neymar, who was already an impressive player, joined the youth academy of Santos FC (the same club for which Brazilian football <a href=\"https://www.merriam-webster.com/dictionary/legend\">legend</a> <a href=\"https://www.britannica.com/biography/Pele-Brazilian-athlete\">Pelé</a> starred over the majority of his domestic career). At age 14 he had a successful trial with <a href=\"https://www.britannica.com/place/Spain\">Spain’s</a> <a href=\"https://www.britannica.com/topic/Real-Madrid\">Real Madrid</a>, and Santos had to increase its spending to retain him.</p><figure class=\"image\"><img src=\"http://127.0.0.1:8000/assets/storage/neymar.jpg\"></figure>', 4, 1, NULL, NULL, NULL, '2022-08-16 20:25:18', '2022-08-25 00:45:56', 8),
(7, 'Eliot Porter', 'eliot-furness-porter.jpg', '<p><a href=\"https://www.icp.org/browse/archive/constituents/eliot-porter?all/all/all/all/0\">Eliot Furness Porter</a> was an American photographer famous for his colourful nature photos.</p><p>He started to photograph birds and landscapes with a Kodak box camera as a child.</p><p>Porter got a Leica in 1930. In 1933, he was inspired by the photographs of Ansel Adams. Ansel Adams encouraged him to work with a large-format camera.</p><p>Porter did so after meeting Alfred Stieglitz, who exhibited his work at An American Place in 1939.</p><figure class=\"image\"><img src=\"http://127.0.0.1:8000/assets/storage/eliotporter.webp\"></figure>', 4, 1, NULL, NULL, NULL, '2022-08-19 01:42:56', '2022-08-22 02:11:21', 10),
(8, 'Paul Strand', 'paul-strand.jpeg', '<p><a href=\"https://www.artsy.net/artist/paul-strand\">Paul Strand</a>&nbsp;was an American photographer who helped to establish photography as an <a href=\"https://expertphotography.com/the-complete-guide-to-fine-art-photography-tips/\">art form</a> in the 20th century. His diverse work spanned for six decades.</p><p>He covered many genres and subjects throughout the Americas, Europe, and Africa. Alfred Steiglitz helped to influence his modernistic approach.</p><p>Paul even worked with renowned documentary photographer Lewis Hine.</p><p>He learned how to capture urban bustle, formal abstractions, and street portraits.</p><figure class=\"image\"><img src=\"http://127.0.0.1:8000/assets/storage/paulstrand.webp\"></figure>', 4, 1, NULL, NULL, NULL, '2022-08-19 01:45:41', '2022-08-22 02:24:08', 10),
(9, 'Lionel Messi', 'messi.jpg', '<p><strong>Lionel Messi</strong>, in full <strong>Lionel Andrés Messi</strong>, also called <strong>Leo Messi</strong>, (born June 24, 1987, <a href=\"https://www.britannica.com/place/Rosario-Argentina\">Rosario</a>, Argentina), Argentine-born <a href=\"https://www.britannica.com/sports/football-soccer\">football</a> (soccer) player who was named Fédération Internationale de <a href=\"https://www.britannica.com/topic/Football-Association\">Football Association</a> (FIFA) world player of the year six times (2009–12, 2015, and 2019).</p><p>Messi started playing football as a boy and in 1995 joined the <a href=\"https://www.britannica.com/dictionary/youth\">youth</a> team of Newell’s Old Boys (a Rosario-based top-division football club). Messi’s phenomenal skills garnered the attention of prestigious clubs on both sides of the Atlantic. At age 13 Messi and his family relocated to Barcelona, and he began playing for <a href=\"https://www.britannica.com/topic/FC-Barcelona\">FC Barcelona</a>’s under-14 team. He scored 21 goals in 14 games for the junior team, and he quickly graduated through the higher-level teams until at age 16 he was given his informal debut with FC Barcelona in a friendly match.</p><figure class=\"image\"><img src=\"http://127.0.0.1:8000/assets/storage/lionel-messi.jpg\"></figure><p>In the 2004–05 season Messi, then 17, became the youngest official player and goal scorer in the Spanish La Liga (the country’s highest division of football). Though only 5 feet 7 inches (1.7 metres) tall and weighing 148 pounds (67 kg), he was strong, well-balanced, and <a href=\"https://www.britannica.com/dictionary/versatile\">versatile</a> on the field. Naturally left-footed, quick, and precise in control of the ball, Messi was a keen pass distributor and could readily thread his way through packed defenses. In 2005 he was granted Spanish citizenship, an honour greeted with mixed feelings by the fiercely Catalan supporters of Barcelona. The next year Messi and Barcelona won the Champions League (the European club championship) title.</p>', 4, 1, NULL, NULL, NULL, '2022-08-19 01:47:37', '2022-08-22 02:22:19', 8),
(12, 'Cristiano Ronaldo', 'cr7.jpeg', '<p><strong>Cristiano Ronaldo</strong>, in full <strong>Cristiano Ronaldo dos Santos Aveiro</strong>, (born February 5, 1985, <a href=\"https://www.britannica.com/place/Funchal\">Funchal</a>, <a href=\"https://www.britannica.com/topic/Madeira-wine\">Madeira</a>, <a href=\"https://www.britannica.com/place/Portugal\">Portugal</a>), Portuguese <a href=\"https://www.britannica.com/sports/football-soccer\">football</a> (soccer) forward who was one of the greatest players of his generation.</p><p><a href=\"https://www.britannica.com/biography/Ronaldo\">Ronaldo’s</a> father, José Dinis Aveiro, was the equipment manager for the local club Andorinha. (The name Ronaldo was added to Cristiano’s name in honour of his father’s favourite movie actor, <a href=\"https://www.britannica.com/biography/Ronald-Reagan\">Ronald Reagan</a>, who was U.S. president at the time of Cristiano’s birth.) At age 15 Ronaldo was diagnosed with a heart condition that necessitated surgery, but he was sidelined only briefly and made a full recovery. He first played for Clube Desportivo Nacional of Madeira and then transferred to Sporting Clube de Portugal (known as Sporting Lisbon), where he played for that club’s various youth teams before making his debut on Sporting’s first team in 2002.</p><p>&nbsp;</p><figure class=\"image\"><img src=\"http://127.0.0.1:8000/assets/storage/ronaldo.jpeg\"></figure>', 11, 1, NULL, NULL, NULL, '2022-08-23 01:35:31', '2022-08-23 01:35:31', 8),
(14, 'Rose flower', 'rose2.jpg', '<p><strong>rose</strong>, (genus <i>Rosa</i>), <a href=\"https://www.britannica.com/science/genus-taxon\">genus</a> of some 100 species of <a href=\"https://www.britannica.com/science/perennial\">perennial</a> <a href=\"https://www.britannica.com/plant/shrub\">shrubs</a> in the rose family (<a href=\"https://www.britannica.com/plant/Rosaceae\">Rosaceae</a>). Roses are native primarily to the temperate regions of the Northern Hemisphere. Many roses are <a href=\"https://www.merriam-webster.com/dictionary/cultivated\">cultivated</a> for their beautiful flowers, which range in colour from white through various tones of yellow and <a href=\"https://www.britannica.com/plant/pink-plant\">pink</a> to dark crimson and maroon, and most have a delightful fragrance, which varies according to the variety and to climatic conditions.</p><figure class=\"image\"><img src=\"http://127.0.0.1:8000/assets/storage/rose1.jpg\"></figure><p>Most rose species are native to <a href=\"https://www.britannica.com/place/Asia\">Asia</a>, with smaller numbers being native to <a href=\"https://www.britannica.com/place/North-America\">North America</a> and a few to <a href=\"https://www.britannica.com/place/Europe\">Europe</a> and northwest Africa. Roses from different regions of the world hybridize readily, giving rise to types that overlap the parental forms, and making it difficult to determine basic species. Fewer than 10 species, mostly native to Asia, were involved in the crossbreeding that ultimately produced today’s many types of garden roses.</p>', 4, 1, NULL, NULL, NULL, '2022-08-25 00:06:48', '2022-08-25 00:17:31', 11);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=user,1=admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `type`) VALUES
(3, 'Admin', 'admin@gmail.com', NULL, '$2y$10$K0ZOzsAJzfLIBOU8NuD2BeIZ9h3aKVbdc7ZVcfg0XvOjwlRPwTZzG', NULL, '2022-08-16 20:17:14', '2022-08-16 20:17:14', 1),
(4, 'Tuấn Anh', 'tuananh10@gmail.com', NULL, '$2y$10$aYoeZR6cbnf44r7XZgaESOjHMxCdStnNe3k6xbAMFOiZcs7.Lq81y', NULL, '2022-08-17 00:24:37', '2022-08-17 00:24:37', 0),
(11, 'TuanAnh', 'tuananh109876@gmail.com', NULL, '$2y$10$/40mqv.GnA2qXxKof4F54e/zX.2jgRbUoBWqsT7MnJXeZbLckde72', NULL, '2022-08-17 21:25:37', '2022-08-17 21:25:37', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
