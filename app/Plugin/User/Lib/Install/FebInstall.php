<?php

/**
 * FebInstall
 *
 * @autor Sławomir Jach
 * @property $FebShell FebShell
 */
App::uses('Install', 'Install');

class FebInstall extends Install {

    protected $FebShell = null;

    public function __construct(FebShell $FebShell) {
        $this->FebShell = $FebShell;
    }

    public function install() {
        if ('y' == $this->FebShell->in(__d('cake_console', 'Insetować domyślne dane użytkowników?'), array('y', 'n'), 'n')) {
            $this->_insert('User.User', $this->users);
            $this->_insert('User.Group', $this->groups);
            $this->_insert('User.PermissionGroup', $this->permission_groups);
            $this->_insert('User.PermissionCategory', $this->permission_categories);
            $this->_insert('User.Permission', $this->permissions);
            $this->_insert('User.GroupsUser', $this->groups_users);
            $this->_insert('User.RequestersPermission', $this->requesters_permissions);
        }
        
    }

    /**
     * Export to PHP Array plugin for PHPMyAdmin
     * @version 0.2b
     */
    public $groups = array(
        array('id' => '4d530799-91d0-4249-8c38-0ff477ecc6b3', 'order' => '0', 'name' => 'Redaktorzy', 'alias' => 'editors', 'permission_groups' => '{"PermissionGroup":{"0":19,"1":18,"3":13,"4":12,"5":6,"6":5}}', 'created' => '2011-02-09 22:31:05', 'modified' => '2012-03-12 14:18:12'),
        array('id' => '4e76b6f4-6cea-102d-9f80-579a023712b2', 'order' => '1', 'name' => 'Administratorzy', 'alias' => 'admins', 'permission_groups' => '{"PermissionGroup":["31"]}', 'created' => '2010-02-17 00:00:00', 'modified' => '2012-03-09 10:36:21'),
        array('id' => '4e7eaa5d-6cea-102d-9f80-579a023712b2', 'order' => '2', 'name' => 'Użytkownicy', 'alias' => 'users', 'permission_groups' => NULL, 'created' => '2010-02-17 00:00:00', 'modified' => '2010-02-27 16:42:40'),
        array('id' => '4f59c5fb-3d40-4c87-b94b-057077ecc6b3', 'order' => '0', 'name' => 'Moja grupa', 'alias' => 'asd', 'permission_groups' => '{"PermissionGroup":["33","32","30","28"]}', 'created' => '2012-03-09 09:57:31', 'modified' => '2012-03-09 09:57:31'),
        array('id' => '4f59cfd8-139c-4614-bcc7-057077ecc6b3', 'order' => '0', 'name' => 'Super Admin', 'alias' => 'superAdmins', 'permission_groups' => '{"PermissionGroup":["19","18"]}', 'created' => '2012-03-09 10:39:36', 'modified' => '2012-03-12 14:18:19')
    );
// `feb_cms2`.`groups_users`
    public $groups_users = array(
        array('id' => '4f59d7df-495c-462d-a2d7-057077ecc6b3', 'group_id' => '4e76b6f4-6cea-102d-9f80-579a023712b2', 'user_id' => '4e671a22-2db0-4f23-ac24-0fa877ecc6b3'),
        array('id' => '50239170-37dc-4d6e-adc5-026c77ecc6b3', 'group_id' => '4e76b6f4-6cea-102d-9f80-579a023712b2', 'user_id' => '4e782a14-b7d0-496c-89c1-01d877ecc6b3'),
        array('id' => '4f3b62e8-8bcc-46ca-94bd-0e0877ecc6b3', 'group_id' => '4e76b6f4-6cea-102d-9f80-579a023712b2', 'user_id' => '4f3b62e8-48e4-4cff-9836-0e0877ecc6b3'),
        array('id' => '4f143337-5fa0-4567-8ad1-109477ecc6b3', 'group_id' => '4e7eaa5d-6cea-102d-9f80-579a023712b2', 'user_id' => '4e676fd8-67c4-4aa0-b1c6-13d077ecc6b3'),
        array('id' => 'af394f22-7342-11e1-aba5-6cf049176608', 'group_id' => '4f59cfd8-139c-4614-bcc7-057077ecc6b3', 'user_id' => '3a38ee92-6934-102d-9f80-579a023712b2'),
        array('id' => '50239170-4c2c-4676-be53-026c77ecc6b3', 'group_id' => '4f59cfd8-139c-4614-bcc7-057077ecc6b3', 'user_id' => '4e782a14-b7d0-496c-89c1-01d877ecc6b3')
    );
// `feb_cms2`.`permissions`
    public $permissions = array(
        array('id' => '4f59d387-df7c-4344-b3af-057077ecc6b3', 'name' => 'User:admin:users:index', 'permission_group_id' => '1', 'created' => '2012-03-09 10:55:19', 'modified' => '2012-03-09 10:55:19'),
        array('id' => '4f59d38c-6d00-4a21-8b16-057077ecc6b3', 'name' => 'User:admin:users:view', 'permission_group_id' => '1', 'created' => '2012-03-09 10:55:24', 'modified' => '2012-03-09 10:55:24'),
        array('id' => '4f59d392-bff0-4511-8e28-057077ecc6b3', 'name' => 'User:admin:users:add', 'permission_group_id' => '9', 'created' => '2012-03-09 10:55:30', 'modified' => '2012-08-16 10:13:42'),
        array('id' => '4f59d398-8c90-4a64-a1c6-057077ecc6b3', 'name' => 'User:admin:users:edit', 'permission_group_id' => '1', 'created' => '2012-03-09 10:55:36', 'modified' => '2012-03-09 10:55:36'),
        array('id' => '4f59d3ac-0a4c-45f6-a349-057077ecc6b3', 'name' => 'User:admin:users:delete', 'permission_group_id' => '2', 'created' => '2012-03-09 10:55:56', 'modified' => '2012-03-09 10:55:56'),
        array('id' => '4f59d630-ce10-4d64-8e07-057077ecc6b3', 'name' => 'Page:admin:pages:edit', 'permission_group_id' => '6', 'created' => '2012-03-09 11:06:40', 'modified' => '2012-03-09 13:14:11'),
        array('id' => '4f59d637-5974-40fa-b213-057077ecc6b3', 'name' => 'Page:admin:pages:add', 'permission_group_id' => '5', 'created' => '2012-03-09 11:06:47', 'modified' => '2012-03-09 13:22:38'),
        array('id' => '4f59d63b-17e0-4385-9277-057077ecc6b3', 'name' => 'Page:admin:pages:delete', 'permission_group_id' => '7', 'created' => '2012-03-09 11:06:51', 'modified' => '2012-08-16 10:14:31'),
        array('id' => '4f59d694-6ab8-44aa-bc0c-057077ecc6b3', 'name' => 'Menu:admin:menus:index', 'permission_group_id' => '3', 'created' => '2012-03-09 11:08:20', 'modified' => '2012-03-09 11:08:20'),
        array('id' => '4f59d699-3c1c-4a5f-974a-057077ecc6b3', 'name' => 'Menu:admin:menus:relatedindex', 'permission_group_id' => '3', 'created' => '2012-03-09 11:08:25', 'modified' => '2012-03-09 11:08:25'),
        array('id' => '4f59d69b-0bd0-462f-8c35-057077ecc6b3', 'name' => 'Menu:admin:menus:reset', 'permission_group_id' => '3', 'created' => '2012-03-09 11:08:27', 'modified' => '2012-03-09 11:08:27'),
        array('id' => '4f59d69d-d954-46a9-b694-057077ecc6b3', 'name' => 'Menu:admin:menus:update', 'permission_group_id' => '3', 'created' => '2012-03-09 11:08:29', 'modified' => '2012-03-09 11:08:29'),
        array('id' => '4f59d6a3-1dc8-43b2-801a-057077ecc6b3', 'name' => 'Menu:admin:menus:add', 'permission_group_id' => '3', 'created' => '2012-03-09 11:08:35', 'modified' => '2012-03-09 11:08:35'),
        array('id' => '4f59d6a5-cf70-45ff-8f1b-057077ecc6b3', 'name' => 'Menu:admin:menus:edit', 'permission_group_id' => '3', 'created' => '2012-03-09 11:08:37', 'modified' => '2012-03-09 11:08:37'),
        array('id' => '4f59f1b6-cec0-4d5f-9cf9-057077ecc6b3', 'name' => 'Page:admin:pages:autocomplete', 'permission_group_id' => NULL, 'created' => '2012-03-09 13:04:06', 'modified' => '2012-03-09 13:22:38'),
        array('id' => '4f59f1be-18a4-4b14-b7fa-057077ecc6b3', 'name' => 'Page:admin:pages:autocomplete:own', 'permission_group_id' => NULL, 'created' => '2012-03-09 13:04:14', 'modified' => '2012-03-09 13:22:37'),
        array('id' => '4f59f20b-7b4c-4cb8-8575-057077ecc6b3', 'name' => 'Panel:admin:panel:simple', 'permission_group_id' => NULL, 'created' => '2012-03-09 13:05:31', 'modified' => '2012-03-09 13:22:39'),
        array('id' => '4f5df721-ba24-4c9d-8619-082477ecc6b3', 'name' => 'Maintenance::maintenance:index', 'permission_group_id' => '18', 'created' => '2012-03-12 14:16:17', 'modified' => '2012-03-12 14:16:17'),
        array('id' => '4f5df728-20a0-4db6-980b-082477ecc6b3', 'name' => 'Maintenance::maintenance:index:own', 'permission_group_id' => NULL, 'created' => '2012-03-12 14:16:24', 'modified' => '2012-03-12 14:16:34'),
        array('id' => '4f5df738-912c-4356-8828-082477ecc6b3', 'name' => 'Menu::menus:links:own', 'permission_group_id' => '18', 'created' => '2012-03-12 14:16:40', 'modified' => '2012-03-12 14:16:40'),
        array('id' => '4f5df759-23a4-40d9-b109-082477ecc6b3', 'name' => 'News::news:index:own', 'permission_group_id' => '18', 'created' => '2012-03-12 14:17:13', 'modified' => '2012-03-12 14:17:13'),
        array('id' => '4f5df75b-7bf4-4ddb-b74a-082477ecc6b3', 'name' => 'News::news:index', 'permission_group_id' => '18', 'created' => '2012-03-12 14:17:15', 'modified' => '2012-03-12 14:17:15'),
        array('id' => '4f6c607e-6724-43a1-b39f-0c5477ecc6b3', 'name' => 'DynamicElements:admin:dynamic_elements:delete', 'permission_group_id' => NULL, 'created' => '2012-03-23 12:37:34', 'modified' => '2012-08-16 10:14:26'),
        array('id' => '502ca972-3cbc-4f46-abed-127077ecc6b3', 'name' => 'Photo:admin:photos:delete', 'permission_group_id' => '12', 'created' => '2012-08-16 10:04:02', 'modified' => '2012-08-16 10:04:02'),
        array('id' => '502ca999-46e4-4213-b784-127077ecc6b3', 'name' => 'Photo:admin:photos:set_parent', 'permission_group_id' => '13', 'created' => '2012-08-16 10:04:41', 'modified' => '2012-08-16 10:04:41'),
        array('id' => '502ca99b-cb98-4ef7-a4a8-127077ecc6b3', 'name' => 'Photo:admin:photos:set_title', 'permission_group_id' => '13', 'created' => '2012-08-16 10:04:43', 'modified' => '2012-08-16 10:04:43'),
        array('id' => '502ca99c-1a48-4087-b75f-127077ecc6b3', 'name' => 'Photo:admin:photos:get_title', 'permission_group_id' => '13', 'created' => '2012-08-16 10:04:44', 'modified' => '2012-08-16 10:04:44'),
        array('id' => '502ca99d-7034-4bf9-9f20-127077ecc6b3', 'name' => 'Photo:admin:photos:sort', 'permission_group_id' => '13', 'created' => '2012-08-16 10:04:45', 'modified' => '2012-08-16 10:04:45'),
        array('id' => '502ca9a0-2cb0-4327-9877-127077ecc6b3', 'name' => 'Photo:admin:photos:index', 'permission_group_id' => '13', 'created' => '2012-08-16 10:04:48', 'modified' => '2012-08-16 10:04:48'),
        array('id' => '502ca9a1-6d18-4e2d-a8e3-127077ecc6b3', 'name' => 'Photo:admin:photos:view', 'permission_group_id' => '13', 'created' => '2012-08-16 10:04:49', 'modified' => '2012-08-16 10:04:49'),
        array('id' => '502ca9a2-4f84-46d1-8053-127077ecc6b3', 'name' => 'Photo:admin:photos:add', 'permission_group_id' => '13', 'created' => '2012-08-16 10:04:50', 'modified' => '2012-08-16 10:04:50'),
        array('id' => '502ca9a4-9f84-44ac-8c78-127077ecc6b3', 'name' => 'Photo:admin:photos:edit', 'permission_group_id' => '13', 'created' => '2012-08-16 10:04:52', 'modified' => '2012-08-16 10:04:52'),
        array('id' => '502ca9bc-aa1c-43a3-993d-127077ecc6b3', 'name' => 'Photo::photos:upload', 'permission_group_id' => '13', 'created' => '2012-08-16 10:05:16', 'modified' => '2012-08-16 10:05:16'),
        array('id' => '502caaff-dd9c-407b-a2c6-127077ecc6b3', 'name' => 'Setting:admin:settings:prefix', 'permission_group_id' => '15', 'created' => '2012-08-16 10:10:39', 'modified' => '2012-08-16 10:10:46'),
        array('id' => '502cab0f-3070-47df-afed-127077ecc6b3', 'name' => 'Setting:admin:settings:dashboard', 'permission_group_id' => NULL, 'created' => '2012-08-16 10:10:55', 'modified' => '2012-08-16 10:11:15'),
        array('id' => '502cab19-ef10-4007-b5fb-127077ecc6b3', 'name' => 'Setting:admin:settings:index', 'permission_group_id' => NULL, 'created' => '2012-08-16 10:11:05', 'modified' => '2012-08-16 10:11:17'),
        array('id' => '502cab1c-a24c-4543-9c6c-127077ecc6b3', 'name' => 'Setting:admin:settings:edit', 'permission_group_id' => NULL, 'created' => '2012-08-16 10:11:08', 'modified' => '2012-08-16 10:11:18'),
        array('id' => '502cade0-76f4-4074-9b95-127077ecc6b3', 'name' => 'Page:admin:pages:index', 'permission_group_id' => '20', 'created' => '2012-08-16 10:22:56', 'modified' => '2012-08-16 10:22:56')
    );
// `feb_cms2`.`permission_categories`
    public $permission_categories = array(
        array('id' => '8', 'name' => 'Zarządzanie stronami', 'modified' => '2012-03-09 10:50:40', 'created' => '2012-03-09 10:50:40'),
        array('id' => '9', 'name' => 'Zarządzanie menu', 'modified' => '2012-03-09 10:50:46', 'created' => '2012-03-09 10:50:46'),
        array('id' => '10', 'name' => 'Zarządzanie użytkownikami', 'modified' => '2012-03-09 10:50:53', 'created' => '2012-03-09 10:50:53'),
        array('id' => '12', 'name' => 'Ustawienia', 'modified' => '2012-03-09 15:42:50', 'created' => '2012-03-09 15:42:50'),
        array('id' => '13', 'name' => 'Galerie', 'modified' => '2012-03-09 15:43:47', 'created' => '2012-03-09 15:43:35')
    );
// `feb_cms2`.`permission_groups`
    public $permission_groups = array(
        array('id' => '1', 'name' => 'Administracja użytkownikiem', 'permission_category_id' => '10', 'modified' => '2012-03-09 10:52:05', 'created' => '2012-03-09 10:51:10'),
        array('id' => '2', 'name' => 'Usuwanie użytkowników', 'permission_category_id' => '10', 'modified' => '2012-03-09 10:51:20', 'created' => '2012-03-09 10:51:20'),
        array('id' => '3', 'name' => 'Administracja menu', 'permission_category_id' => '9', 'modified' => '2012-03-09 10:52:19', 'created' => '2012-03-09 10:52:19'),
        array('id' => '5', 'name' => 'Dodawanie podstron', 'permission_category_id' => '8', 'modified' => '2012-03-09 10:54:48', 'created' => '2012-03-09 10:52:47'),
        array('id' => '6', 'name' => 'Edycja podstron', 'permission_category_id' => '8', 'modified' => '2012-03-09 10:54:41', 'created' => '2012-03-09 10:52:53'),
        array('id' => '7', 'name' => 'Usuwanie podstron', 'permission_category_id' => '8', 'modified' => '2012-03-09 10:53:02', 'created' => '2012-03-09 10:53:02'),
        array('id' => '9', 'name' => 'Dodawanie użytkowników', 'permission_category_id' => '10', 'modified' => '2012-03-09 15:41:19', 'created' => '2012-03-09 15:41:19'),
        array('id' => '20', 'name' => 'Administracja podstronami', 'permission_category_id' => '8', 'modified' => '2012-08-16 10:22:48', 'created' => '2012-08-16 10:22:48'),
        array('id' => '15', 'name' => 'Edycja uprawnień', 'permission_category_id' => '12', 'modified' => '2012-03-09 15:51:02', 'created' => '2012-03-09 15:51:02'),
        array('id' => '12', 'name' => 'Usuwanie zdjęć z galerii', 'permission_category_id' => '13', 'modified' => '2012-03-09 15:44:28', 'created' => '2012-03-09 15:44:28'),
        array('id' => '13', 'name' => 'Zarządzanie galerią', 'permission_category_id' => '13', 'modified' => '2012-03-09 15:49:15', 'created' => '2012-03-09 15:45:43')
    );
// `feb_cms2`.`requesters_permissions`
    public $requesters_permissions = array(
        array('id' => '502cb9b4-0a20-4dc2-b580-127077ecc6b3', 'permission_id' => '502ca999-46e4-4213-b784-127077ecc6b3', 'model' => 'Group', 'row_id' => '4d530799-91d0-4249-8c38-0ff477ecc6b3', 'created' => '2012-08-16 11:13:24', 'modified' => '2012-08-16 11:13:24'),
        array('id' => '502cb9b4-0acc-487e-9e2a-127077ecc6b3', 'permission_id' => '4f5df721-ba24-4c9d-8619-082477ecc6b3', 'model' => 'Group', 'row_id' => '4d530799-91d0-4249-8c38-0ff477ecc6b3', 'created' => '2012-08-16 11:13:24', 'modified' => '2012-08-16 11:13:24'),
        array('id' => '502cb9b4-2c7c-43bd-bdef-127077ecc6b3', 'permission_id' => '502caaff-dd9c-407b-a2c6-127077ecc6b3', 'model' => 'User', 'row_id' => '3a38ee92-6934-102d-9f80-579a023712b2', 'created' => '2012-08-16 11:13:24', 'modified' => '2012-08-16 11:13:24'),
        array('id' => '502cb9b4-3c14-4976-9532-127077ecc6b3', 'permission_id' => '4f59d637-5974-40fa-b213-057077ecc6b3', 'model' => 'Group', 'row_id' => '4d530799-91d0-4249-8c38-0ff477ecc6b3', 'created' => '2012-08-16 11:13:24', 'modified' => '2012-08-16 11:13:24'),
        array('id' => '502cb9b4-4404-4b2c-9611-127077ecc6b3', 'permission_id' => '502ca99c-1a48-4087-b75f-127077ecc6b3', 'model' => 'Group', 'row_id' => '4d530799-91d0-4249-8c38-0ff477ecc6b3', 'created' => '2012-08-16 11:13:24', 'modified' => '2012-08-16 11:13:24'),
        array('id' => '502cb9b4-5c90-49fd-8b59-127077ecc6b3', 'permission_id' => '4f5df738-912c-4356-8828-082477ecc6b3', 'model' => 'Group', 'row_id' => '4f59cfd8-139c-4614-bcc7-057077ecc6b3', 'created' => '2012-08-16 11:13:24', 'modified' => '2012-08-16 11:13:24'),
        array('id' => '502cb9b4-5d7c-4028-9264-127077ecc6b3', 'permission_id' => '502ca9a0-2cb0-4327-9877-127077ecc6b3', 'model' => 'Group', 'row_id' => '4d530799-91d0-4249-8c38-0ff477ecc6b3', 'created' => '2012-08-16 11:13:24', 'modified' => '2012-08-16 11:13:24'),
        array('id' => '502cb9b4-6018-4f9c-a316-127077ecc6b3', 'permission_id' => '502ca972-3cbc-4f46-abed-127077ecc6b3', 'model' => 'Group', 'row_id' => '4d530799-91d0-4249-8c38-0ff477ecc6b3', 'created' => '2012-08-16 11:13:24', 'modified' => '2012-08-16 11:13:24'),
        array('id' => '502cb9b4-64b8-4ea1-bf1c-127077ecc6b3', 'permission_id' => '4f5df759-23a4-40d9-b109-082477ecc6b3', 'model' => 'Group', 'row_id' => '4d530799-91d0-4249-8c38-0ff477ecc6b3', 'created' => '2012-08-16 11:13:24', 'modified' => '2012-08-16 11:13:24'),
        array('id' => '502cb9b4-6df8-4910-88d1-127077ecc6b3', 'permission_id' => '502ca9a2-4f84-46d1-8053-127077ecc6b3', 'model' => 'Group', 'row_id' => '4d530799-91d0-4249-8c38-0ff477ecc6b3', 'created' => '2012-08-16 11:13:24', 'modified' => '2012-08-16 11:13:24'),
        array('id' => '502cb9b4-6f00-4c58-ade0-127077ecc6b3', 'permission_id' => '4f5df75b-7bf4-4ddb-b74a-082477ecc6b3', 'model' => 'Group', 'row_id' => '4f59cfd8-139c-4614-bcc7-057077ecc6b3', 'created' => '2012-08-16 11:13:24', 'modified' => '2012-08-16 11:13:24'),
        array('id' => '502cb9b4-8068-4b83-bd09-127077ecc6b3', 'permission_id' => '502ca9bc-aa1c-43a3-993d-127077ecc6b3', 'model' => 'Group', 'row_id' => '4d530799-91d0-4249-8c38-0ff477ecc6b3', 'created' => '2012-08-16 11:13:24', 'modified' => '2012-08-16 11:13:24'),
        array('id' => '502cb9b4-89b4-4949-a51e-127077ecc6b3', 'permission_id' => '4f59d63b-17e0-4385-9277-057077ecc6b3', 'model' => 'User', 'row_id' => '4e671a22-2db0-4f23-ac24-0fa877ecc6b3', 'created' => '2012-08-16 11:13:24', 'modified' => '2012-08-16 11:13:24'),
        array('id' => '502cb9b4-b298-41f1-a27a-127077ecc6b3', 'permission_id' => '502ca99b-cb98-4ef7-a4a8-127077ecc6b3', 'model' => 'Group', 'row_id' => '4d530799-91d0-4249-8c38-0ff477ecc6b3', 'created' => '2012-08-16 11:13:24', 'modified' => '2012-08-16 11:13:24'),
        array('id' => '502cb9b4-b600-4b8a-a7f1-127077ecc6b3', 'permission_id' => '4f5df738-912c-4356-8828-082477ecc6b3', 'model' => 'Group', 'row_id' => '4d530799-91d0-4249-8c38-0ff477ecc6b3', 'created' => '2012-08-16 11:13:24', 'modified' => '2012-08-16 11:13:24'),
        array('id' => '502cb9b4-d2b4-4a3e-8b63-127077ecc6b3', 'permission_id' => '502ca99d-7034-4bf9-9f20-127077ecc6b3', 'model' => 'Group', 'row_id' => '4d530799-91d0-4249-8c38-0ff477ecc6b3', 'created' => '2012-08-16 11:13:24', 'modified' => '2012-08-16 11:13:24'),
        array('id' => '502cb9b4-d424-42c4-b3ac-127077ecc6b3', 'permission_id' => '4f59d630-ce10-4d64-8e07-057077ecc6b3', 'model' => 'Group', 'row_id' => '4d530799-91d0-4249-8c38-0ff477ecc6b3', 'created' => '2012-08-16 11:13:24', 'modified' => '2012-08-16 11:13:24'),
        array('id' => '502cb9b4-d484-475e-8b86-127077ecc6b3', 'permission_id' => '4f5df721-ba24-4c9d-8619-082477ecc6b3', 'model' => 'Group', 'row_id' => '4f59cfd8-139c-4614-bcc7-057077ecc6b3', 'created' => '2012-08-16 11:13:24', 'modified' => '2012-08-16 11:13:24'),
        array('id' => '502cb9b4-e5ec-4417-a2d0-127077ecc6b3', 'permission_id' => '502ca9a1-6d18-4e2d-a8e3-127077ecc6b3', 'model' => 'Group', 'row_id' => '4d530799-91d0-4249-8c38-0ff477ecc6b3', 'created' => '2012-08-16 11:13:24', 'modified' => '2012-08-16 11:13:24'),
        array('id' => '502cb9b4-e6f4-4f55-a925-127077ecc6b3', 'permission_id' => '4f5df759-23a4-40d9-b109-082477ecc6b3', 'model' => 'Group', 'row_id' => '4f59cfd8-139c-4614-bcc7-057077ecc6b3', 'created' => '2012-08-16 11:13:24', 'modified' => '2012-08-16 11:13:24'),
        array('id' => '502cb9b4-f730-4232-9f5a-127077ecc6b3', 'permission_id' => '502ca9a4-9f84-44ac-8c78-127077ecc6b3', 'model' => 'Group', 'row_id' => '4d530799-91d0-4249-8c38-0ff477ecc6b3', 'created' => '2012-08-16 11:13:24', 'modified' => '2012-08-16 11:13:24'),
        array('id' => '502cb9b4-fb9c-47f3-947b-127077ecc6b3', 'permission_id' => '4f5df75b-7bf4-4ddb-b74a-082477ecc6b3', 'model' => 'Group', 'row_id' => '4d530799-91d0-4249-8c38-0ff477ecc6b3', 'created' => '2012-08-16 11:13:24', 'modified' => '2012-08-16 11:13:24')
    );
// `feb_cms2`.`users`
    public $users = array(
        array('id' => '3a38ee92-6934-102d-9f80-579a023712b2', 'facebook_id' => '0', 'active' => '1', 'email' => 'admin@feb.net.pl', 'login' => 'admin', 'pass' => '1a6747eef12c2f0b7fc6fa326a441801fff14b1e', 'name' => 'Admin', 'avatar' => '100_2003.jpg', 'x' => '160', 'y' => '0', 'remember' => '8bb9a0e5ca07eefd287d4f64dbff9dd9e247e1ad', 'menu' => '1', 'themed' => NULL, 'permission_groups' => '{"PermissionGroup":["15"]}', 'created' => '2009-10-30 14:09:30', 'modified' => '2012-05-21 08:33:25', 'failed_loginss' => '0', 'date_locked' => NULL),
        array('id' => '4e671a22-2db0-4f23-ac24-0fa877ecc6b3', 'facebook_id' => '100001414898604', 'active' => '1', 'email' => 's.jach@feb.net.pl', 'login' => NULL, 'pass' => '8cc111f2f058c989613eeae053dcc5286c594037', 'name' => 'Slawomir', 'avatar' => '1311063938_problem.png', 'x' => NULL, 'y' => NULL, 'remember' => '479751f4c0e24ac096ca67a1ff5405f0c8b11203', 'menu' => '1', 'themed' => NULL, 'permission_groups' => '{"PermissionGroup":["7"]}', 'created' => '2011-09-07 09:15:46', 'modified' => '2012-03-09 11:13:51', 'failed_loginss' => '0', 'date_locked' => NULL),
        array('id' => '4e676fd8-67c4-4aa0-b1c6-13d077ecc6b3', 'facebook_id' => NULL, 'active' => '1', 'email' => 'arek@dziki.eu', 'login' => NULL, 'pass' => '8a1450cd2fb9c9938842d02211e009f54a2693f9', 'name' => 'Arek', 'avatar' => NULL, 'x' => NULL, 'y' => NULL, 'remember' => NULL, 'menu' => '1', 'themed' => NULL, 'permission_groups' => NULL, 'created' => '2011-09-07 15:21:28', 'modified' => '2012-01-16 15:24:55', 'failed_loginss' => '0', 'date_locked' => NULL),
        array('id' => '4e782a14-b7d0-496c-89c1-01d877ecc6b3', 'facebook_id' => NULL, 'active' => '1', 'email' => 'd.czyz@feb.net.pl', 'login' => NULL, 'pass' => '28c6fe234e0a9f685787282d499cb8ecbc00eca9', 'name' => 'damian', 'avatar' => NULL, 'x' => NULL, 'y' => NULL, 'remember' => '43ab8e47d0739018dbe7f0ddb58b12e0ed2bdede', 'menu' => '1', 'themed' => NULL, 'permission_groups' => '{"PermissionGroup":""}', 'created' => '2011-09-20 07:52:20', 'modified' => '2012-08-09 12:31:12', 'failed_loginss' => '0', 'date_locked' => NULL),
        array('id' => '4f3b62e8-48e4-4cff-9836-0e0877ecc6b3', 'facebook_id' => NULL, 'active' => '1', 'email' => 'm.kuzniar@feb.net.pl', 'login' => NULL, 'pass' => 'e93dc2d4b01d3cc85556b093a0ce55f5b492f760', 'name' => 'Michal', 'avatar' => NULL, 'x' => NULL, 'y' => NULL, 'remember' => NULL, 'menu' => '1', 'themed' => NULL, 'permission_groups' => NULL, 'created' => '2012-02-15 08:46:48', 'modified' => '2012-03-12 11:13:02', 'failed_loginss' => '0', 'date_locked' => NULL)
    );

}