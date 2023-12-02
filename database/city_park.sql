-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 03 2023 г., 07:05
-- Версия сервера: 10.4.27-MariaDB
-- Версия PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `city_park`
--

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `menu_items`
--

CREATE TABLE `menu_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `isOnlineSaleAvailable` tinyint(1) NOT NULL,
  `name` varchar(255) NOT NULL,
  `src` varchar(255) NOT NULL,
  `description` varchar(2048) NOT NULL,
  `price` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `menu_items`
--

INSERT INTO `menu_items` (`id`, `isOnlineSaleAvailable`, `name`, `src`, `description`, `price`, `weight`, `category`, `created_at`, `updated_at`) VALUES
(3, 0, 'Стейк Рибай (мраморное мясо)', 'uploads/menu/jU0IkGMY9je7cUod7yqsiQEpAp13oFG4BFokDxCQ.jpg', 'Мраморная говядина Название \"рибай\" на профессиональном языке означает \"край на ребре\" и фактически обозначает самый мясистый отруб из передней части говяжьей туши с 5-го по 12-е ребро', 1000, 100, 'Стейк меню', '2023-12-01 07:20:11', '2023-12-01 07:20:11'),
(4, 0, 'Стейк Нью йорк (мраморное мясо)', 'uploads/menu/zLnW7BDpvj7lCvVjgwC4hUhSOGp4kKqskIosqj1p.jpg', 'Готовится из поясничной части бычка, из того отруба, который называется \"тонкий край\" (мраморное мясо)', 700, 100, 'Стейк меню', '2023-12-01 07:28:32', '2023-12-01 07:28:32'),
(6, 1, 'Сет классический', 'uploads/menu/fsv9YquVXTYA0Y0CV0srOFt4CJWjNttwr4fM4f8C.jpg', 'Калифорния с угрем 1/2 п; Калифорния с лососем 1/2 п; Филадельфия 1/2п; Канада 1/2 п.', 900, 400, 'Роллы', '2023-12-01 10:39:53', '2023-12-01 10:39:53'),
(7, 1, 'Сет Гуру', 'uploads/menu/ZYbRrHsOq7yqCd4aZvXEmJErPpzKz2pTC6dnDI0A.jpg', 'Темпура, Аляска, Киото, 1/2п , Эби сяки 1/2п, Унаги 1/2п, Яки 1/2п', 1500, 900, 'Роллы', '2023-12-01 10:43:08', '2023-12-01 10:43:08'),
(8, 1, 'Сет Изуми', 'uploads/menu/t5K0P2l10dlFhXNI9U8DIXTe7wMyzVaWxsmWG25r.jpg', 'Вегетарианский, Вулкан, Бонито, Калифорния с лососем', 1400, 850, 'Роллы', '2023-12-01 10:44:17', '2023-12-01 10:44:17'),
(9, 1, 'Сет Касуми', 'uploads/menu/kBc5J0ZGRpSEqs8RXooo1rh6KztXV6Gm4xcEWPqE.jpg', 'Ролл Дубай; Ролл Курица с беконом; Ролл Трио; Ролл Сифудо; Ролл Филадельфия', 2000, 1040, 'Роллы', '2023-12-01 10:45:45', '2023-12-01 10:45:45'),
(10, 1, 'Ролл Кани Сяки Темпура', 'uploads/menu/UjWWaArQM5Igx7gCmUo0tPpl1OwY8pnrfuwSYyWo.jpg', 'Рис, нори, лосось копченый, снежный краб ( имитация), сливочный сыр', 360, 200, 'Роллы', '2023-12-01 10:47:30', '2023-12-01 10:47:30'),
(11, 1, 'Ролл Эби Сяки (запеченный)', 'uploads/menu/JwFWvgUBIVtvywxVZIL0PnN20XW8TozgC47UTwap.jpg', 'Семга, креветка тигровая, соус хот.', 500, 220, 'Роллы', '2023-12-01 10:49:19', '2023-12-01 10:49:19'),
(12, 1, 'Теплый салат с фасолью', 'uploads/menu/kigGyY2bGbeGT1MBShEnF8jwn1GmGmZZNuKQdj8t.jpg', 'Фасоль стручковая, фасоль консервированная, шампиньоны, чеснок, зелень.', 450, 400, 'Постное меню', '2023-12-01 10:51:32', '2023-12-01 10:51:32'),
(13, 1, 'Салат овощной', 'uploads/menu/rW8ExiK8Z5cDuQXOpRigu7nTwOIfola9jQKLYXKR.jpg', 'Огурцы свежие, томаты свежие, болгарский перец, зелень, заправка в ассортименте.', 300, 360, 'Постное меню', '2023-12-01 10:52:13', '2023-12-01 10:52:13'),
(14, 1, 'Борщ с фасолью', 'uploads/menu/FkqAMjBQhpHra2DhuJ102cEXXNVJqOsi9WiTVPSd.jpg', 'Фасоль, картофель, капуста, томат, свекла, морковь, зелень.', 200, 250, 'Постное меню', '2023-12-01 10:53:13', '2023-12-01 10:53:13'),
(15, 0, 'Стейк Миньон', 'uploads/menu/o3CKU3iHdn8WOuU2aKShtNk2NTO6u8VvWs2Eobj9.jpg', 'Готовится из вырезки, получаемой из уникальной мышцы, которая практически не участвует в двигательных активностях', 500, 100, 'Стейк меню', '2023-12-01 10:55:09', '2023-12-01 10:55:09'),
(16, 0, 'Стейк T-Bone (мраморное мясо)', 'uploads/menu/hIAjkREKE5RZIwFX8czHuyud85y4lgez21fgpdO2.jpg', 'Мраморная говядина', 600, 110, 'Стейк меню', '2023-12-01 10:56:08', '2023-12-01 10:56:08'),
(17, 1, 'Крем суп со шпинатом', 'uploads/menu/tX9hMg0XqsFWwngfJTrL7gvDkeV5ssWqagjGal9p.jpg', 'Лук, морковь, шпинат, картофель, кедровый орех, гренки', 250, 250, 'Постное меню', '2023-12-01 10:57:26', '2023-12-01 10:57:26'),
(18, 1, 'Соте', 'uploads/menu/EBhHJbW0tjtXEYt6nXlSo2y2XatYJuj6PXvyPmF9.jpg', 'Баклажан, помидор, болгарский перец, лук, зелень, чеснок.', 400, 300, 'Постное меню', '2023-12-01 10:58:17', '2023-12-01 10:58:17'),
(19, 1, 'Рис в тайском стиле с овощами', 'uploads/menu/lTQlMc7tLLZqKpNJt6uwo7YigsfdKbUBYKrdVeV0.jpg', 'Рис, соевый соус, болгарский перец, помидоры, чеснок', 250, 200, 'Постное меню', '2023-12-01 10:59:48', '2023-12-01 10:59:48');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_11_12_162822_create_sessions_table', 1),
(7, '2023_11_28_184246_news', 1),
(8, '2023_11_30_135949_drop_user_table', 2),
(9, '2023_11_30_140222_drop_user_table', 3),
(10, '2023_11_30_140603_create_user', 4),
(11, '2023_12_01_065356_create_menu_items_table', 5),
(16, '2023_12_01_160245_create_orders_table', 6);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(2048) NOT NULL,
  `datetime` datetime NOT NULL,
  `photo_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `datetime`, `photo_path`) VALUES
(25, 'Обновленное меню', 'Мы обновили основное меню «CityPark». Встречайте новинки меню, которые вас точно не оставят равнодушными.  Ознакомиться с новым меню можно на нашем сайте в разделе (доставка еды)', '2023-12-02 07:16:00', 'uploads/EiNVcxWtzYCJvjnZcXGsdb1r3WbVj2dRqK076UNL.jpg'),
(26, 'Спецпредложение июня', 'Закажите на сайте или по телефону +79183119791', '2023-12-02 07:28:00', 'uploads/9nNF0VNvxeUzEd8bkFwDdQWtv4HjINbzwjSImk2j.jpg'),
(27, 'Спецпредложение в октябре', 'Закажите на сайте или по телефону +79183119791', '2023-12-02 07:34:00', 'uploads/38Uj19oTJrV1Fi1LbFM9I1GfSdyM15b1Jyy9JHot.jpg'),
(28, 'Спецпредложение апреля', 'Новые блюда Вы можете заказать во вкладке \"спецпредложение\"\r\n\r\nЗаказ блюд по телефону +79183119791', '2023-12-03 07:34:00', 'uploads/vGgcev1msl46UkNQvj107N0HhtXfBXnsSe4a7Oee.jpg'),
(29, 'Новое постное меню', 'На нашем сайте есть полное меню, где вы можете заказать постные блюда.\r\n\r\nСупы, салаты, закуси, горячее и десерты.\r\n\r\nПопробуйте в CityPark или закажите доставку.', '2023-12-02 07:35:00', 'uploads/yCiNWRVSVbdeKdFsMowGVVChllFmWshMiGrD4knA.jpg'),
(30, 'Спецпредложение декабря', 'Новые блюда Вы можете заказать во вкладке \"спецпредложение\"\r\n\r\nЗаказ блюд по телефону +79183119791', '2023-12-22 07:50:00', 'uploads/eVqaOkf1h7cYLZoLeFFXsLDove7MlFAe7QUQZRxM.png');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `selectedDate` datetime DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `wishes` varchar(1024) DEFAULT NULL,
  `isCompleted` tinyint(1) DEFAULT 0,
  `cart` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`cart`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `selectedDate`, `address`, `name`, `phone`, `email`, `wishes`, `isCompleted`, `cart`, `created_at`, `updated_at`) VALUES
(3, '2023-12-13 05:40:00', 'Сумгаитский государственный университет', 'Paul', '+7 (888) 888-88-8', 'test@mail.com', 'abc', 0, '[{\"id\":6,\"amount\":1},{\"id\":8,\"amount\":3},{\"id\":10,\"amount\":2}]', '2023-12-02 02:40:25', '2023-12-02 16:24:41'),
(4, '2023-12-14 06:31:00', 'Sds Snapper', 'Paul', '+7 (918) 145-80-40', 'pavlikmolchanov@yandex.ru', 'qwerty', 0, '[{\"id\":13,\"amount\":1},{\"id\":17,\"amount\":3},{\"id\":14,\"amount\":2}]', '2023-12-02 03:32:04', '2023-12-02 16:30:15'),
(5, '2023-12-13 14:51:00', 'Москва', 'Тимур', '+7 (888) 888-88-8', 'test@mail.com', 'Кот на клавиатуреКот на клавиатуреКот на клавиатуреКот на клавиатуреКот на клавиатуреКот на клавиатуреКот на клавиатуреКот на клавиатуреКот на клавиатуреКот на клавиатуреКот на клавиатуреКот на клавиатуреКот на клавиатуреКот на клавиатуреКот на клавиатуреКот на клавиатуреКот на клавиатуреКот на клавиатуреКот на клавиатуреКот на клавиатуреКот на клавиатуреКот на клавиатуреКот на клавиатуреКот на клавиатуреКот на клавиатуреКот на клавиатуреКот на клавиатуреКот на клавиатуреКот на клавиатуреКот на клавиатуреКот на клавиатуреКот на клавиатуреКот на клавиатуреКот на клавиатуреКот на клавиатуреКот на клавиатуре', 1, '[{\"id\":17,\"amount\":1},{\"id\":14,\"amount\":6},{\"id\":18,\"amount\":2},{\"id\":11,\"amount\":3},{\"id\":9,\"amount\":3},{\"id\":7,\"amount\":3}]', '2023-12-02 11:52:10', '2023-12-02 16:24:12'),
(6, '2023-12-13 18:51:00', 'Addis Ababa', 'Ahmed', '+1233232334434343', 'ahmed123@faaf.com', 'q', 0, '[{\"id\":12,\"amount\":1},{\"id\":14,\"amount\":2}]', '2023-12-02 15:52:50', '2023-12-02 16:25:22'),
(7, '2023-12-29 18:58:00', 'Belarus', 'Bogdan', '+5555555555555555', 'bogdan@mail.com', NULL, 0, '[{\"id\":11,\"amount\":1},{\"id\":9,\"amount\":1}]', '2023-12-02 15:58:59', '2023-12-02 16:30:20');

-- --------------------------------------------------------

--
-- Структура таблицы `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('muy2UWCiHEN7Go3DyBvMjalGBtZxWK2p0nYXdqEN', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.5993.2470 YaBrowser/23.11.0.2470 Yowser/2.5 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiUUEwOGxETjgwYTAyeG1UM2VKRVBmZG9uM3J6c21BVWllMzhUdlJjMiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiRVUDdHb1lQQk14TTg5bEQ1eFBRR291QTdsUDVNR3JtV25RTnByR0x1aGNCU2J4S0k4eHhZQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTIkVVA3R29ZUEJNeE04OWxENXhQUUdvdUE3bFA1TUdybVduUU5wckdMdWhjQlNieEtJOHh4WUMiO30=', 1701546246);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `role`, `email_verified_at`, `password`, `remember_token`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Paul', 'test@mail.com', '8 (888) 888-88-88', 'admin', NULL, '$2y$12$UP7GoYPBMxM89lD5xPQGouA7lP5MGrmWnQNprGLuhcBSbxKI8xxYC', NULL, NULL, '2023-11-30 11:08:11', '2023-11-30 14:18:06');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
