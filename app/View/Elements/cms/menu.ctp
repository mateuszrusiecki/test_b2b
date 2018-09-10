<?php
MenuCMS::add(MenuCms::TOP, 'Strona główna', '/admin');

//MenuCMS::add(MenuCms::TOP, 'Zawartość/Strony', array('plugin' => 'page', 'admin' => 'admin', 'controller' => 'pages', 'action' => 'index'));
MenuCMS::add(MenuCms::TOP, 'Zawartość/Edycja menu', array('plugin' => 'menu', 'admin' => false, 'controller' => 'menus', 'action' => 'index'));
//MenuCMS::add(MenuCms::TOP, 'Zawartość/Elementy strony', array('plugin' => 'dynamic_elements', 'admin' => 'admin', 'controller' => 'dynamic_elements', 'action' => 'index'));
//MenuCMS::add(MenuCms::TOP, 'Zawartość/Kontakt (lokalizacje)', array('plugin' => 'multi_contact', 'admin' => 'admin', 'controller' => 'multi_contacts', 'action' => 'index'));

//MenuCMS::add(MenuCms::TOP, 'Zawartość/Komentarze', array('plugin' => 'page', 'admin' => 'admin', 'controller' => 'comments', 'action' => 'index'));

MenuCMS::add(MenuCms::TOP, 'Użytkownicy', array('plugin' => 'user', 'admin' => 'admin', 'controller' => 'users', 'action' => 'index'));

MenuCMS::add(MenuCms::TOP, 'Działy', array('plugin' => false, 'admin' => 'admin', 'controller' => 'sections', 'action' => 'index'));

//MenuCMS::add(MenuCms::TOP, 'Lasopedia/Strony', array('plugin' => 'wiki', 'admin' => 'admin', 'controller' => 'wiki_pages', 'action' => 'index'));
//MenuCMS::add(MenuCms::TOP, 'Lasopedia/Kategorie', array('plugin' => 'wiki', 'admin' => 'admin', 'controller' => 'wiki_categories', 'action' => 'index'));
//MenuCMS::add(MenuCms::TOP, 'Lasopedia/Tagi', array('plugin' => 'wiki', 'admin' => 'admin', 'controller' => 'wiki_tags', 'action' => 'index'));

//MenuCMS::add(MenuCms::TOP, 'Aktualności/Lista', array('plugin' => 'news', 'admin' => 'admin', 'controller' => 'news', 'action' => 'index'));
//MenuCMS::add(MenuCms::TOP, 'Aktualności/Dodaj nową', array('plugin' => 'news', 'admin' => 'admin', 'controller' => 'news', 'action' => 'add'));

//MenuCMS::add(MenuCms::TOP, 'Newsletter/Wiadomości', array('plugin' => 'newsletter', 'admin' => 'admin', 'controller' => 'newsletter_messages', 'action' => 'index'));
//MenuCMS::add(MenuCms::TOP, 'Newsletter/Odbiorcy', array('plugin' => 'newsletter', 'admin' => 'admin', 'controller' => 'newsletters', 'action' => 'index'));

//MenuCMS::add(MenuCms::TOP, 'Produkty/Produkty', array('plugin' => 'static_product', 'admin' => 'admin', 'controller' => 'products', 'action' => 'index'));
//MenuCMS::add(MenuCms::TOP, 'Produkty/Kategorie produktów', array('plugin' => 'static_product', 'admin' => 'admin', 'controller' => 'product_categories', 'action' => 'index'));

//MenuCMS::add(MenuCms::TOP, 'E-Commerce/Produkty', array('plugin' => 'static_product', 'admin' => 'admin', 'controller' => 'products', 'action' => 'index'));
//MenuCMS::add(MenuCms::TOP, 'E-Commerce/Kategorie produktów', array('plugin' => 'static_product', 'admin' => 'admin', 'controller' => 'product_categories', 'action' => 'index'));

//MenuCMS::add(MenuCms::TOP, 'Partnerzy/Lista partnerów', array('plugin' => 'partner', 'admin' => 'admin', 'controller' => 'partners', 'action' => 'index'));
//MenuCMS::add(MenuCms::TOP, 'Partnerzy/Lista kategorii partnerów', array('plugin' => 'partner', 'admin' => 'admin', 'controller' => 'partner_categories', 'action' => 'index'));
//MenuCMS::add(MenuCms::TOP, 'Partnerzy/Dodaj partnera', array('plugin' => 'partner', 'admin' => 'admin', 'controller' => 'partners', 'action' => 'add'));
MenuCMS::add(MenuCms::TOP, 'Administracja/Grupy użytkowników', array('plugin' => 'user', 'admin' => 'admin', 'controller' => 'groups', 'action' => 'index'));
MenuCMS::add(MenuCms::TOP, 'Administracja/Kategorie uprawnień', array('plugin' => 'user', 'admin' => 'admin', 'controller' => 'permission_categories', 'action' => 'index'));
MenuCMS::add(MenuCms::TOP, 'Administracja/Zarządzanie uprawnieniami', array('plugin' => 'user', 'admin' => 'admin', 'controller' => 'permission_groups', 'action' => 'summary'));
//MenuCMS::add(MenuCms::TOP, 'Administracja/Uprawnienia grup - lista', array('plugin' => 'user', 'admin' => 'admin', 'controller' => 'permissions', 'action' => 'groups'));
MenuCMS::add(MenuCms::TOP, 'Administracja/Logi operacji', array('plugin' => 'modification', 'admin' => 'admin', 'controller' => 'modifications', 'action' => 'view'));
MenuCMS::add(MenuCms::TOP, 'Administracja/Motywy graficzne', array('plugin' => 'theme', 'admin' => 'admin', 'controller' => 'theme', 'action' => 'index'));

MenuCMS::add(MenuCms::TOP, 'Ustawienia/Strona', array('plugin' => 'setting', 'admin' => 'admin', 'controller' => 'settings', 'action' => 'prefix', 'App'));
MenuCMS::add(MenuCms::TOP, 'Ustawienia/SEO', array('plugin' => 'setting', 'admin' => 'admin', 'controller' => 'settings', 'action' => 'prefix', 'Meta'));
//MenuCMS::add(MenuCms::TOP, 'Ustawienia/SEO', array('plugin' => 'setting', 'admin' => 'admin', 'controller' => 'settings', 'action' => 'prefix', 'SEO'));
MenuCMS::add(MenuCms::TOP, 'Ustawienia/Service', array('plugin' => 'setting', 'admin' => 'admin', 'controller' => 'settings', 'action' => 'prefix', 'Service'));
MenuCMS::add(MenuCms::TOP, 'Ustawienia/Maintenance', array('plugin' => 'setting', 'admin' => 'admin', 'controller' => 'settings', 'action' => 'prefix', 'Maintenance'));
MenuCMS::add(MenuCms::TOP, 'Ustawienia/Google Analytics', array('plugin' => 'setting', 'admin' => 'admin', 'controller' => 'settings', 'action' => 'prefix', 'Analytics'));
?>