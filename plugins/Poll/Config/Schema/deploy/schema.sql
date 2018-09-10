-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `polls`
--

CREATE TABLE IF NOT EXISTS `polls` (
  `id` int(10) unsigned NOT NULL,
  `client_project_id` int(10) unsigned NOT NULL,
  `filled` tinyint(1) NOT NULL DEFAULT '0',
  `fill_date` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `poll_answers`
--

CREATE TABLE IF NOT EXISTS `poll_answers` (
  `id` int(10) unsigned NOT NULL,
  `user_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `poll_question_id` int(10) unsigned NOT NULL,
  `answer` text COLLATE utf8_unicode_ci NOT NULL,
  `modified` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `poll_notification_logs`
--

CREATE TABLE IF NOT EXISTS `poll_notification_logs` (
  `id` int(10) unsigned NOT NULL,
  `poll_id` int(10) unsigned NOT NULL,
  `user_id` char(36) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `action_date` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = client, 1 = merchant'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `poll_questions`
--

CREATE TABLE IF NOT EXISTS `poll_questions` (
  `id` int(10) unsigned NOT NULL,
  `poll_id` int(10) unsigned NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1',
  `question` text COLLATE utf8_unicode_ci NOT NULL,
  `modified` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poll_answers`
--
ALTER TABLE `poll_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poll_notification_logs`
--
ALTER TABLE `poll_notification_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poll_questions`
--
ALTER TABLE `poll_questions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `polls`
--
ALTER TABLE `polls`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `poll_answers`
--
ALTER TABLE `poll_answers`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `poll_notification_logs`
--
ALTER TABLE `poll_notification_logs`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `poll_questions`
--
ALTER TABLE `poll_questions`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
