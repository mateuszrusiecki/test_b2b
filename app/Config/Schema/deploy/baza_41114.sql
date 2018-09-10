ALTER TABLE `projects` ADD `lead_id` INT( 10 ) NOT NULL AFTER `client_id` ,
ADD `project_id` INT( 10 ) NOT NULL AFTER `lead_id`;


INSERT INTO `brief_default_questions` (`id`, `content`, `category_name`, `group_name`, `created`, `modified`) VALUES
(5, 'Cel projektu', 'Projekt', 'WWW', '2015-06-12 09:41:38', '2015-06-12 09:41:38'),
(6, 'Czynniki sukcesu', 'Projekt', 'WWW', '2015-06-12 09:42:24', '2015-06-12 09:42:24'),
(7, 'Cel', 'Serwis internetowy', 'WWW', '2015-06-12 09:42:44', '2015-06-12 09:42:44'),
(8, 'Główna myśl, motto', 'Serwis internetowy', 'WWW', '2015-06-12 09:42:50', '2015-06-12 09:42:50'),
(9, 'Struktura i funkcjonalność', 'Serwis internetowy', 'WWW', '2015-06-12 09:43:00', '2015-06-12 09:43:00'),
(10, 'Technologia', 'Serwis internetowy', 'WWW', '2015-06-12 09:43:11', '2015-06-12 09:43:11'),
(11, 'Powód decyzji o realizacji projektu', 'Serwis internetowy', 'WWW', '2015-06-12 09:43:30', '2015-06-12 09:43:30'),
(12, 'Wizualizacja i kolorystyka', 'Serwis internetowy', 'WWW', '2015-06-12 09:44:27', '2015-06-12 09:44:27'),
(13, 'Sposoby promocji', 'Serwis internetowy', 'WWW', '2015-06-12 09:44:40', '2015-06-12 09:44:40'),
(14, 'Warunki brzegowe, terminy i wymagania', 'Serwis internetowy', 'WWW', '2015-06-12 09:44:49', '2015-06-12 09:44:49'),
(15, 'Przykłady i inspiracje WWW', 'Serwis internetowy', 'WWW', '2015-06-12 09:45:00', '2015-06-12 09:45:00'),
(16, 'Informacje o projekcie / marce', 'Marka / Produkt', 'WWW', '2015-06-12 09:46:53', '2015-06-12 09:46:53'),
(17, 'Grupa docelowa', 'Marka / Produkt', 'WWW', '2015-06-12 09:47:04', '2015-06-12 09:47:04'),
(18, 'Adres strony powiązanej z przedmiotem promocji', 'Informacje zasadnicze', 'Facebook', '2015-06-12 09:47:17', '2015-06-12 09:47:17'),
(19, 'Planowany czas trwania kampanii\r\n', 'Informacje zasadnicze', 'Facebook', '2015-06-12 09:47:28', '2015-06-12 09:47:28'),
(20, 'Adres strony powiązanej z przedmiotem promocji\r\n', 'Informacje zasadnicze', 'Buzz', '2015-06-12 09:47:48', '2015-06-12 09:47:48'),
(21, 'Oczekiwania w związku z planowanymi działaniami\r\npromocyjnymi\r\n', 'Informacje zasadnicze', 'Buzz', '2015-06-12 09:47:58', '2015-06-12 09:47:58'),
(22, 'Adres strony powiązanej z przedmiotem promocji', 'Informacje zasadnicze', 'Zintegrowany', '2015-06-12 09:48:24', '2015-06-12 09:48:24'),
(23, 'Oczekiwania w związku z planowanymi działaniami\r\npromocyjnymi', 'Informacje zasadnicze', 'Zintegrowany', '2015-06-12 09:48:35', '2015-06-12 09:48:35'),
(25, 'Grupa docelowa (płeć, wiek, zainteresowania)', 'Informacje zasadnicze', 'Zintegrowany', '2015-06-12 09:57:32', '2015-06-12 09:57:32'),
(26, 'Dotychczasowe działania w Internecie', 'Mara / Produkt', 'WWW', '2015-06-19 10:21:16', '2015-06-19 10:21:16'),
(27, 'Konkurencja', 'Mara / Produkt', 'WWW', '2015-06-19 10:21:34', '2015-06-19 10:21:34'),
(28, 'Działania konkurencji', 'Mara / Produkt', 'WWW', '2015-06-19 10:22:01', '2015-06-19 10:22:01'),
(29, 'Grupa docelowa (Płeć, wiek, zainteresowania itp.)', 'Informacje zasadnicze', 'Facebook', '2015-06-19 10:24:05', '2015-06-19 10:24:05'),
(30, 'Skala prowadzonych działań (ogólnopolskie, lokalne)', 'Informacje zasadnicze', 'Facebook', '2015-06-19 10:24:19', '2015-06-19 10:24:19'),
(31, 'Cele kampanii krótkofalowe', 'Informacje zasadnicze', 'Facebook', '2015-06-19 10:24:35', '2015-06-19 10:24:35'),
(32, 'Cele kampanii długofalowe', 'Informacje zasadnicze', 'Facebook', '2015-06-19 10:24:46', '2015-06-19 10:24:46'),
(33, 'Najważniejsze cechy marki - mocne strony', 'Informacje zasadnicze', 'Facebook', '2015-06-19 10:25:11', '2015-06-19 10:25:11'),
(34, 'Najważniejsze cechy marki - słabe strony', 'Informacje zasadnicze', 'Facebook', '2015-06-19 10:25:17', '2015-06-19 10:25:17'),
(35, 'Budżet na reklamę na Facebook (reklama kontekstowa)', 'Informacje zasadnicze', 'Facebook', '2015-06-19 10:25:34', '2015-06-19 10:25:34'),
(36, 'Dodatkowe oczekiwania związane z prowadzeniem strony na Facebook', 'Informacje zasadnicze', 'Facebook', '2015-06-19 10:25:52', '2015-06-19 10:25:52'),
(37, 'Planowane aplikacje na stronie', 'Informacje zasadnicze', 'Facebook', '2015-06-19 10:26:04', '2015-06-19 10:26:04'),
(38, 'Inne Państwa uwagi, sugestie, propozycje', 'Informacje zasadnicze', 'Facebook', '2015-06-19 10:26:14', '2015-06-19 10:26:14'),
(39, 'Grupa docelowa (Płeć, wiek, zainteresowania itp.)', 'Informacje zasadnicze', 'Buzz', '2015-06-19 10:24:05', '2015-06-19 10:24:05'),
(40, 'Reakcje jakie mają wzbudzać działania buzz marketingowe u Państwa potencjalnych klientów', 'Informacje zasadnicze', 'Buzz', '2015-06-19 10:27:30', '2015-06-19 10:27:30'),
(41, 'Cele kampanii krótkofalowe', 'Informacje zasadnicze', 'Buzz', '2015-06-19 10:24:35', '2015-06-19 10:24:35'),
(42, 'Cele kampanii długofalowe', 'Informacje zasadnicze', 'Buzz', '2015-06-19 10:24:46', '2015-06-19 10:24:46'),
(43, 'Najważniejsze cechy marki - mocne strony', 'Informacje zasadnicze', 'Buzz', '2015-06-19 10:25:11', '2015-06-19 10:25:11'),
(44, 'Najważniejsze cechy marki - słabe strony', 'Informacje zasadnicze', 'Buzz', '2015-06-19 10:25:17', '2015-06-19 10:25:17'),
(45, 'Najpoważniejsi konkurenci firmy i ich przewagi', 'Informacje zasadnicze', 'Buzz', '2015-06-19 10:29:19', '2015-06-19 10:29:19'),
(46, 'Cechy dające Państwu przewagę nad konkurencją', 'Informacje zasadnicze', 'Buzz', '2015-06-19 10:29:30', '2015-06-19 10:29:30'),
(47, 'Produkty/usługi których dotyczy kampania', 'Informacje zasadnicze', 'Buzz', '2015-06-19 10:29:47', '2015-06-19 10:29:47'),
(48, '5 słów, które mają kojarzyć się z Państwa firmą', 'Informacje zasadnicze', 'Buzz', '2015-06-19 10:29:58', '2015-06-19 10:29:58'),
(49, 'Miejsca w Internecie, w których przebywają Państwa klienci', 'Informacje zasadnicze', 'Buzz', '2015-06-19 10:30:15', '2015-06-19 10:30:15'),
(50, 'Inne Państwa uwagi, sugestie, propozycje', 'Informacje zasadnicze', 'Buzz', '2015-06-19 10:30:27', '2015-06-19 10:30:27'),
(51, 'Miejsca w Internecie, w których przebywają Państwa klienci', 'Informacje zasadnicze', 'Zintegrowany', '2015-06-19 10:50:26', '2015-06-19 10:50:26'),
(52, 'Skala prowadzonych działań (ogólnopolskie, lokalne)', 'Informacje zasadnicze', 'Zintegrowany', '2015-06-19 10:50:40', '2015-06-19 10:50:40'),
(53, 'Cele kampanii krótkofalowe', 'Informacje zasadnicze', 'Zintegrowany', '2015-06-19 10:24:35', '2015-06-19 10:24:35'),
(54, 'Cele kampanii długofalowe', 'Informacje zasadnicze', 'Zintegrowany', '2015-06-19 10:24:46', '2015-06-19 10:24:46'),
(55, 'Najważniejsze cechy marki - mocne strony', 'Informacje zasadnicze', 'Zintegrowany', '2015-06-19 10:25:11', '2015-06-19 10:25:11'),
(56, 'Najważniejsze cechy marki - słabe strony', 'Informacje zasadnicze', 'Zintegrowany', '2015-06-19 10:25:17', '2015-06-19 10:25:17'),
(57, 'Najpoważniejsi konkurenci firmy i ich przewagi', 'Informacje zasadnicze', 'Zintegrowany', '2015-06-19 10:52:43', '2015-06-19 10:52:43'),
(58, 'Cechy dające Państwu przewagę nad konkurencją', 'Informacje zasadnicze', 'Zintegrowany', '2015-06-19 10:52:53', '2015-06-19 10:52:53'),
(59, 'Oczekiwane działania (konkurs, akcja, działania niestandardowe)', 'Informacje zasadnicze', 'Zintegrowany', '2015-06-19 10:53:08', '2015-06-19 10:53:08'),
(60, 'Przewidywany czas trwania kampanii', 'Informacje zasadnicze', 'Zintegrowany', '2015-06-19 10:53:21', '2015-06-19 10:53:21'),
(61, 'Budżet przeznaczony na działania promocyjne', 'Informacje zasadnicze', 'Zintegrowany', '2015-06-19 10:53:32', '2015-06-19 10:53:32'),
(62, 'Spis i efekty podejmowanych wcześniej działań promocyjnych', 'Informacje zasadnicze', 'Zintegrowany', '2015-06-19 10:53:44', '2015-06-19 10:53:44'),
(63, 'Inne Państwa uwagi, sugestie, propozycje', 'Informacje zasadnicze', 'Zintegrowany', '2015-06-19 10:53:59', '2015-06-19 10:53:59');
