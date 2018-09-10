-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `project_mockups`
--

CREATE TABLE IF NOT EXISTS `project_mockups` (
  `id` int(10) unsigned NOT NULL,
  `client_project_id` int(10) unsigned NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Path to index.html',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `project_mockup_comments`
--

CREATE TABLE IF NOT EXISTS `project_mockup_comments` (
  `id` int(10) unsigned NOT NULL,
  `project_mockup_id` int(10) unsigned NOT NULL,
  `user_id` char(36) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `position` text COLLATE utf8_unicode_ci COMMENT 'JSON comment position',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `project_mockups`
--
ALTER TABLE `project_mockups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_mockup_comments`
--
ALTER TABLE `project_mockup_comments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `project_mockups`
--
ALTER TABLE `project_mockups`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `project_mockup_comments`
--
ALTER TABLE `project_mockup_comments`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
