Baza:


--
-- Struktura tabeli dla tabeli `partners`
--

CREATE TABLE IF NOT EXISTS `partners` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


---
Użycie:

<?php echo $this->Html->requestAction(array('plugin' => 'partner', 'controller' => 'partners', 'action' => 'partners_to_front')); ?>