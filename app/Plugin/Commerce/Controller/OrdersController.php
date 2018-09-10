<?php

App::uses('CommerceAppController', 'Commerce.Controller');
App::uses('Commerce', 'Commerce.Vendor');

/**
 * Orders Controller
 *
 * @property Order $Order
 */
class OrdersController extends CommerceAppController {

    /**
     * Nazwa layoutu
     */
    public $layout = 'default';

    /**
     * Tablica helperów doładowywana do kontrolera
     */
    public $helpers = array('Filter', 'FebNumber', 'Number', 'FebTime', 'FebTinyMce4');


    //public $uses = array('Commerce.Order');

    /**
     * Tablica komponentów doładowywana do kontrolera
     */
    public $components = array('Filtering', 'Commerce.Commerce', 'Email');

    //public $useas = array('Commerce.Order', 'Commerce.OrderStatus');
    /**
     * Callback wykonywujący się przed wykonaniem akcji kontrollera
     * 
     * @access public 
     */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('get_user_address', 'cart', 'summary', 'completed', 'quantity', 'delete', 'set_realization_order', 'clear_garbage_order', 'add_payment', 'order_checkout', 'front_cart_info'));
    }

    public function admin_report() {
        $this->layout = 'admin';
    }

    /**
     * Ajaxowa akcja do pobierania danych dla wykresu graficznego 
     * przedstawiający statystyki zamówień
     */
    public function admin_orders_stats() {
        $this->layout = 'ajax';

        if ($_POST['typeChart'] == 'count') {
            $fieldName = 'COUNT(`id`) as `ile`';
            $config['vAxis'] = "Ilość";
            $config['title'] = "Ilość zrealizowanych zamówień";
        } else {
            $fieldName = 'SUM(`total`) as `ile`';
            $config['vAxis'] = "Wartość [PLN]";
            $config['title'] = "Wartość zrealizowanych zamówień";
        }
        $params['conditions']['order_status_id'] = 60;

        $format = 'Y-m-d';
        switch ($_POST['type']) {
            case "1":
                //Dni
                $format = 'Y-m-d';
                $params['fields'] = array($fieldName, 'DATE_FORMAT(`created`, \'%Y-%m-%d\') as `dzien`');
                $params['group'] = "DATE_FORMAT(`created`, '%Y-%m-%d')";
                break;
            case "2":
                //Miesiace
                $format = 'Y-m';
                $params['fields'] = array($fieldName, 'DATE_FORMAT(`created`, \'%Y-%m\') as `dzien`');
                $params['group'] = "DATE_FORMAT(`created`, '%Y-%m')";
                break;
            case "3":
                //Lata
                $format = 'Y';
                $params['fields'] = array($fieldName, 'DATE_FORMAT(`created`, \'%Y\') as `dzien`');
                $params['group'] = "DATE_FORMAT(`created`, '%Y')";
                break;
        }
        $preperyData = $this->createDateRangeKeyArray($_POST['datePickerFrom'], $_POST['dataPickerTo'], 0, $format);

        $params['conditions']['created >='] = $_POST['datePickerFrom'];
        $params['conditions']['created <='] = $_POST['dataPickerTo'];

        $params['order'] = 'created ASC';

        $this->Order->recursive = -1;
        $sqlData = $this->Order->find('all', $params);

        foreach ($sqlData as $k => $obj) {
            $preperyData[$obj[0]['dzien']] = $obj[0]['ile'];
        }

        //Format daty oraz wypełnienie przygotowanej
        $data = array();

        setlocale(LC_ALL, 'pl-PL.utf8', 'pl_PL.UTF8', 'pl_PL.utf8', 'pl_PL.UTF-8', 'pl_PL.utf-8', 'polish_POLISH.UTF8', 'polish_POLISH.utf8', 'pl.UTF8', 'polish.UTF8', 'polish-pl.UTF8', 'PL.UTF8', 'polish.utf8', 'polish-pl.utf8', 'PL.utf8', 'polish');


        foreach ($preperyData as $dateFormated => $obj) {
            switch ($_POST['type']) {
                case "1":
                    //Dni
                    $dayFormat = strftime('%d %b', strtotime($dateFormated));
                    $data[$dayFormat] = $obj;
                    break;
                case "2":
                    //Miesiace
                    $monthFormat = strftime('%b', strtotime($dateFormated));
                    $data[$monthFormat] = $obj;
                    break;
                case "3":
                    //Lata
                    $yearFormat = date('Y', strtotime($dateFormated));
                    $data[$yearFormat] = $obj;
                    break;
            }
        }

        $preperyToDisplay = array();
        foreach ($data as $k => $v) {
            $preperyToDisplay[] = array((string) $k, (int) $v);
        }

        echo json_encode(array('dane' => $preperyToDisplay, 'config' => $config));
        $this->render(false);
    }

    /**
     * Metoda wypelnia tablice kluczami dat w zadanym okresie, wykorzystywana glownie do wykresow
     * 
     * @param type $strDateFrom
     * @param type $strDateTo
     * @param type $fillAt
     * @return null 
     */
    private function createDateRangeKeyArray($strDateFrom, $strDateTo, $fillAt = null, $format = 'Y-m-d') {
        $aryRange = array();

        $iDateFrom = mktime(1, 0, 0, substr($strDateFrom, 5, 2), substr($strDateFrom, 8, 2), substr($strDateFrom, 0, 4));
        $iDateTo = mktime(1, 0, 0, substr($strDateTo, 5, 2), substr($strDateTo, 8, 2), substr($strDateTo, 0, 4));

        if ($iDateTo >= $iDateFrom) {
            $aryRange[date($format, $iDateFrom)] = $fillAt;

            while ($iDateFrom < $iDateTo) {
                $iDateFrom+=86400; // add 24 hours
                $aryRange[date($format, $iDateFrom)] = $fillAt;
            }
        }
        return $aryRange;
    }

    function cart() {
        //$this->helpers[] = 'Fancybox.Fancybox';
        $order_id = $this->Commerce->getOrder();
        $this->Order->recursive = 1;


        $params['contain'] = array('OrderStatus', 'Customer', 'ShipmentMethod', 'Invoice', 'OrderItem', 'Payment');
        $this->Order->Behaviors->attach('Containable');
        $this->Order->cacheQueries = true;
        $params['conditions']['Order.id'] = $order_id;


        $order = $this->Order->find('first', $params);
//        debug($order);

        if (empty($order['OrderItem'])) {
            $this->Session->setFlash(__('Twój Koszyk jest pusty', true));
            $this->redirect('/');
        }


        if (!empty($this->request->data)) {
            $this->Order->id = $order_id;
            $this->Order->save($this->request->data);
            $this->Order->recalculateShipmentPrice();
            $custommer = $this->Commerce->customer;
            $this->redirect(array('plugin' => 'commerce', 'controller' => 'orders', 'action' => 'order_checkout'));
            //$this->redirect(array('plugin' => 'commerce', 'controller' => 'customers', 'action' => 'edit', $custommer['Customer']['id']));
        }

        $this->request->data['Order'] = $order['Order'];
        //Domyślne Wartości
        if (empty($this->request->data['Order']['shipment_method_id'])) {
            $this->request->data['Order']['shipment_method_id'] = 1;
        }

        if (empty($this->request->data['Order']['payment_type'])) {
            $this->request->data['Order']['payment_type'] = 0;
        }

        $paymentTypes = $this->Order->paymentTypes;
        $shipmentMethods = $this->Order->getShipmentMethod($order);

        $tmp = Commerce::getTotalPricesForOrder($order);
        $total = $tmp['final_price_gross'];


        $this->set(compact('order', 'shipmentMethods', 'total', 'paymentTypes'));

        if ($this->RequestHandler->isAjax()) {
            $this->render('ajax_cart');
        }

        $this->set('hidenCart', true);
        return $order;
    }

    function mini_cart() {
        $order_id = $this->Commerce->getOrder();
        $this->Order->recursive = 1;
        $order = $this->Order->read(null, $order_id);
        return $order;
    }

    function front_cart_info() {
        $order_id = $this->Commerce->getOrder();
        $this->Order->recursive = 1;
        $params['conditions']['Order.id'] = $order_id;
        $order = $this->Order->find('first', $params);
        $price = 0;
        $count = 0;
        if (empty($order['OrderItem'])) {
            $info = 'Koszyk pusty';
        } else {
            foreach ($order['OrderItem'] as $item) {
                $price += $item['price'] * $item['quantity'];
                $count += $item['quantity'];
            }
            $info = $count . ' szt. / <b>' . number_format($price, 2, ',', '') . ' zł</b>';
        }
        $this->set('info', $info);
        $this->render('front_cart_info');
    }

    function order_checkout() {

        if (!empty($this->request->data)) {
            $this->loadModel('Commerce.Customer');
            $this->loadModel('Note');
            $order['Order']['id'] = $this->request->data['Order']['id'];
            $order['Order']['customer_id'] = $this->request->data['Order']['customer_id'];
            $order['Order']['shipment_method_id'] = $this->request->data['Order']['shipment_method_id'];
            $order['Order']['shipment_price'] = $this->request->data['Order']['shipment_price'];
            $order['Order']['payment_type'] = $this->request->data['Order']['payment_type'];
            $order['Order']['order_status_id'] = 10;
            $this->Order->save($order);
            $this->Order->id = $order['Order']['id'];
            $this->Order->recalculateShipmentPrice();
            $this->Order->deleteAll(array('Order.order_status_id' => 0, 'Order.customer_id' => $order['Order']['customer_id']));
            $order_id = $order['Order']['id'];
            $order = '';
            $order = $this->Order->findById($order_id);
            if (!empty($this->request->data['Order']['note'])) {
                $note['Note']['user_id'] = $order_id;
                $note['Note']['model'] = 'Order';
                $note['Note']['content'] = $this->request->data['Order']['note'];
                $this->Note->create();
                $this->Note->save($note);
            }
            unset($this->request->data['Order']);

            //$this->request->data['Order'] = $order['Order'];
            //Jezeli dane do wysylki inne niz do faktury
            if (empty($this->request->data['Order']['dane_do_wysylki_inne_niz_do_faktury'])) {
                $this->request->data['AddressDefault'] = $this->request->data['InvoiceIdentityDefault'];
            }

            //$customer = $this->Customer->findById($id);   

            $this->request->data['AddressDefault']['id'] = $order['Customer']['address_id'];
            $this->request->data['AddressDefault']['customer_id'] = $order['Customer']['id'];
            $this->request->data['InvoiceIdentityDefault']['id'] = $order['Customer']['invoice_identity_id'];
            $this->request->data['InvoiceIdentityDefault']['customer_id'] = $order['Customer']['id'];
            $this->request->data['Customer']['id'] = $order['Customer']['id'];
            //debug($order);
            //unset($this->request->data['Order']);
            //debug($this->request->data);
            //if ($this->Customer->save($this->request->data) AND $this->Customer->InvoiceIdentityDefault->save($this->request->data) AND $this->Customer->AddressDefault->save($this->request->data) AND $this->request->data['Customer']['user_id'] != -2) {
            if ($this->Customer->saveAll($this->request->data, array('validate' => 'first'))) {

                $customer = $this->Customer->find('first', array('recursive' => -1, 'conditions' => array('Customer.id' => $order['Customer']['id'])));

                $this->Customer->AddressDefault->recursive = -1;
                $this->Customer->InvoiceIdentityDefault->recursive = -1;

                $toSave['Order'] = array(
                    'id' => $order_id,
                    'address' => json_encode($this->Customer->AddressDefault->findById($customer['Customer']['address_id'])),
                    'invoice_identity' => json_encode($this->Customer->InvoiceIdentityDefault->findById($customer['Customer']['invoice_identity_id']))
                );

                //debug($toSave);
                $this->Order->save($toSave);
                $this->Session->setFlash(__d('public', 'Twoje zamówienie zostało zapisane.', true));
                $this->redirect(array('plugin' => false, 'controller' => 'fronts', 'action' => 'front'));
            } else {
                $this->Order->Customer->InvoiceIdentityDefault->saveAll($this->request->data, array('validate' => 'only'));
                $this->Order->Customer->AddressDefault->saveAll($this->request->data, array('validate' => 'only'));
                $this->Session->setFlash(__d('public', 'Twoje zamówienie nie zostało zapisane. Sprawdź formularz i popraw odpowiednie dane.', true), 'flash/error');
            }
        } else {
            $user = $this->Auth->user();
            $customer = !empty($user) ? $this->Order->Customer->find('first', array('conditions' => array('Customer.user_id' => $user['id']), 'recursive' => 0)) : '';
//            if (!empty($user)) {
//                $customer = $this->Order->Customer->find('first', array('conditions' => array('Customer.user_id' => $user['id']), 'recursive' => 0));
//            }
            $order_id = $this->Commerce->getOrder();
            $this->Order->recursive = 1;
            $params['contain'] = array('OrderStatus', 'Customer', 'ShipmentMethod', 'Invoice', 'OrderItem', 'Payment');
            $this->Order->Behaviors->attach('Containable');
            $this->Order->cacheQueries = true;
            $params['conditions']['Order.id'] = $order_id;
            $order = $this->Order->find('first', $params);
            if (empty($order['OrderItem'])) {
                $this->Session->setFlash(__('Twój Koszyk jest pusty', true));
                $this->redirect('/');
            }
            $this->request->data['Order'] = $order['Order'];
            if (empty($this->request->data['Order']['shipment_method_id'])) {
                $this->request->data['Order']['shipment_method_id'] = 1;
            }

            if (empty($this->request->data['Order']['payment_type'])) {
                $this->request->data['Order']['payment_type'] = 0;
            }

            if ($customer != null) {
                $this->request->data['Customer'] = $customer['Customer'];
                $this->request->data['InvoiceIdentityDefault'] = $customer['InvoiceIdentityDefault'];
                $this->request->data['AddressDefault'] = $customer['AddressDefault'];

                if (!empty($customer['User'])) {
                    $this->request->data['Customer']['email'] = $customer['User']['email'];
                }
            } else {
                $this->request->data['InvoiceIdentityDefault']['iscompany'] = '1';
            }
            if (empty($this->request->data['InvoiceIdentityDefault']['iscompany'])) {
                $this->request->data['InvoiceIdentityDefault']['iscompany'] = '0';
            }

            $this->request->data['Customer']['dane_do_wysylki_inne_niz_do_faktury'] = 0;
            if (empty($this->request->data['InvoiceIdentityDefault']['country_id'])) {
                $this->request->data['InvoiceIdentityDefault']['country_id'] = 'PL';
                $this->request->data['InvoiceIdentityDefault']['region_id'] = 9;
            }
            if (empty($this->request->data['AddressDefault']['country_id'])) {
                $this->request->data['AddressDefault']['country_id'] = 'PL';
                $this->request->data['AddressDefault']['region_id'] = 9;
            }

            foreach ($this->request->data['AddressDefault'] AS $key => $value) {
                if (!in_array($key, array('id', 'created', 'modified', 'phone'))) {
                    if ($this->request->data['AddressDefault'][$key] != $this->request->data['InvoiceIdentityDefault'][$key]) {
                        $this->request->data['Customer']['dane_do_wysylki_inne_niz_do_faktury'] = 1;
                        break;
                    }
                }
            }
            $this->request->data['InvoiceIdentityDefault']['iscompany'] = 0;


            $this->set(compact('user', 'customer'));
        }
        $paymentTypes = $this->Order->paymentTypes;
        $shipmentMethods = $this->Order->getShipmentMethod($order);
        $tmp = Commerce::getTotalPricesForOrder($order);
        $total = $tmp['final_price_gross'];
        $regions = $this->Customer->Address->Region->find('list');
        $countries = $this->Customer->Address->Country->find('list');
        $this->set(compact('order', 'shipmentMethods', 'total', 'paymentTypes', 'regions', 'countries'));
        $this->set('step', 1);
    }

    function get_user_address() {
        if (!empty($this->request->data)) {
            $customer = $this->Order->Customer->find('first', array('conditions' => array('Customer.id' => $this->request->data['id']), 'recursive' => 0));
            $this->set(compact('customer'));
            $this->set('_serialize', array('customer'));
        }
        $this->render(false);
    }

    function save_order() {
        if (!empty($this->request->data)) {
            $order_id = $this->Commerce->getOrder();
            $this->request->data['Order']['id'] = $order_id;
            debug($this->request->data);
        }
    }

    function summary($id = null) {
        $id = $this->Commerce->getOrder();

        $this->Order->recursive = 1;
        $this->Order->Customer->unbindModel(array('hasMany' => array('Order', 'Address', 'InvoiceIdentity')));
        $this->Order->ShipmentMethod->unbindModel(array('hasMany' => array('Order')));
        $this->Order->OrderItem->unbindModel(array('belongsTo' => array('Order')));
        $order = $this->Order->read(null, $id);
        $paymentTypes = $this->Order->paymentTypes;

        if (empty($order)) {
            $this->Session->setFlash(__('Niepoprawny numer zamówienia', true), 'flash/error');
            $this->redirect(array('action' => 'cart'));
        }

        if (!empty($this->request->data)) {
//            $file_error = false;
//            if (empty($order['Customer']['User'])) {
//                foreach ($order['OrderItem'] AS $orderItem) {
//                    if (empty($orderItem['OrderItemFile'])) {
//                        $file_error = true;
//                        break;
//                    }
//                }
//            }
            if ($order['Order']['payment_type'] == 0) {
                //platnosc przy odbiorze - ustaw status na "Do weryfikacji"
                $this->request->data['Order']['order_status_id'] = 20;
            } else {
                //platnosc elektroniczna - ustaw status na "Czeka na zapłatę"
                $this->request->data['Order']['order_status_id'] = 10;
            }

            $this->request->data['Order']['id'] = $id;

            //Aktualizacja hasha zamówienia
            $year = date('Y');
            if (empty($data['Order']['customer_id'])) {
                $this->request->data['Order']['hash'] = "{$id}/{$order['Order']['customer_id']}/{$year}";
            }

            try {
                $this->Cookie->write('Status.hash', $id);
                $this->Cookie->delete('Order.hash');
                //$this->Email->delivery = 'debug';
                $order = $this->Order->read(null, $id);
                $this->Email->to = Configure::read('Email.default');
                $this->Email->from = Configure::read('Email.defaultname') . ' <' . Configure::read('Email.default') . '>';
                $this->Email->subject = '[www] Nowe zamówienie';
                $this->Email->template = 'order.adminemail';
                $this->Email->sendAs = 'both';
                $this->Email->model = 'Order';
                $this->Email->row_id = $id;

                $this->set(array('id' => $id));
                $shipmentMethods = $this->Order->ShipmentMethod->find('list');
                $this->set(compact('order', 'shipmentMethods'));
                $this->Email->send();
                //debug($this->Session->read('Message.email.message'));
                $this->Email->to = $order['Customer']['email'];
                $this->Email->from = Configure::read('Email.defaultname') . ' <' . Configure::read('Email.default') . '>';
                $this->Email->subject = '[www] Zarejestrowano zamówienie w systemie';
                $this->Email->template = 'order.email.first';
                $this->Email->sendAs = 'html';
                $this->Email->send();
            } catch (Exception $e) {
                
            }


            if ($this->Order->save($this->request->data)) {

                //debug($this->Session->read('Message.email.message')); exit;

                if ($order['Order']['payment_type'] == 1) {
                    $this->loadModel('Payments.Payment');
                    if (!empty($order['Order']['customer_id'])) {
                        $this->Payment->create();
                        $payment_saved = $this->Payment->save(array(
                            'Payment' => array(
                                'user_plugin' => 'Commerce',
                                'user_model' => 'Customer',
                                'user_row_id' => $order['Order']['customer_id'],
                                'related_plugin' => 'Commerce',
                                'related_model' => 'Order',
                                'related_row_id' => $order['Order']['id'],
                                'payment_gate' => 'platnosci.pl',
                                'amount' => $order['Order']['total'],
                                'title' => sprintf(__d('public', 'Zamówienie nr %s - hedom.pl', true), $order['Order']['hash']),
                            )
                        ));
                        $payment_id = $this->Payment->getInsertID();

                        $this->redirect(array(
                            'plugin' => 'payments',
                            'controller' => 'payments',
                            'action' => 'start',
                            'platnosci.pl',
                            $payment_id
                        ));
                    }
                }

                $this->redirect(array('action' => 'completed', $order['Order']['payment_type'], $order['Order']['id']));
            } else {
                debug($this->request->data);
                $this->Session->setFlash(__('Zapisywanie zamówienia nie powiodło się. Jeśli problem będzie się powtarzał skontaktuj się z biurem obsługi klienta.', true));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $order;
        }

        $shipmentMethods = $this->Order->ShipmentMethod->find('list');
        $hidenCart = true;
        $this->set(compact('shipmentMethods', 'order', 'hidenCart', 'paymentTypes'));
    }

    /**
     * Dokończyć
     */
    function add_payment($order_id = null) {
        $this->loadModel('Payments.Payment');
        $this->Order->id = $order_id;
        $hash = $this->Order->field('hash');

        $this->Payment->create();
        $payment_saved = $this->Payment->save(array(
            'Payment' => array(
                'user_plugin' => 'Commerce',
                'user_model' => 'Customer',
                'user_row_id' => $this->Order->field('customer_id'),
                'related_plugin' => 'Commerce',
                'related_model' => 'Order',
                'related_row_id' => $order_id,
                'payment_gate' => 'platnosci.pl',
                'amount' => $this->Order->field('total'),
                'title' => sprintf(__d('public', 'Zamówienie nr %s - hedom.pl', true), $hash),
            )
        ));
        $payment_id = $this->Payment->getInsertID();
        $this->redirect(array(
            'plugin' => 'payments',
            'controller' => 'payments',
            'action' => 'start',
            'platnosci.pl',
            $payment_id
        ));
    }

    function completed($id = null, $order_id = null) {
        $orderId = $this->Cookie->read('Status.hash');

        if ($order_id != $orderId) {
            $this->Session->setFlash(__('Sesja wygasła', true), 'flash/error');
            $this->redirect('/');
        }
        $this->Order->recursive = 1;
        $this->Order->Customer->unbindModel(array('hasMany' => array('Order', 'Address', 'InvoiceIdentity')));
        $this->Order->ShipmentMethod->unbindModel(array('hasMany' => array('Order')));
        $this->Order->OrderItem->unbindModel(array('belongsTo' => array('Order')));
        $order = $this->Order->find('first', array('recursive' => 1, 'conditions' => array('Order.id' => $orderId)));
        $content_for_view_2 = '';

        switch ($id) {
            case 1: // Płatność elektroniczna
                $title_for_layout = "Zamówienie zostało zapisane";
                $content_for_view = "<p>Zamówienie zostało zapisane w systemie i oczekuje na realizację.</p>
                                        <p>O każdej zmianie statusu zamówienia będziemy informować poprzez email.</p>";
                break;
            case 2: // Przelew dane do przelewu
                $title_for_layout = "Zamówienie zostało zapisane - dokonaj wpłaty.";
                $content_for_view = '<p>Twoje zamówienie zostało zapisane w naszym systemie. Aby zostało zrealizowane należy dokonać płatności.</p>';

                $content_for_view_2 .= '<br /><h2>Wpłatę prosimy dokonać na poniższe konto:</h2>';
                $content_for_view_2 .= '<p><strong>';
                $content_for_view_2 .= Configure::read('Commerce.company_name');
                $content_for_view_2 .= '</strong>';
                $content_for_view_2 .= '<br />';
                $content_for_view_2 .= Configure::read('Commerce.company_address');
                $content_for_view_2 .= '<br />';
                $content_for_view_2 .= Configure::read('Commerce.company_post_code');
                $content_for_view_2 .= ' ';
                $content_for_view_2 .= Configure::read('Commerce.company_city');
                $content_for_view_2 .= '<br />NIP: ';
                $content_for_view_2 .= Configure::read('Commerce.company_nip');
                $content_for_view_2 .= '<br /><strong>Numer konta: ';
                $content_for_view_2 .= '' . Configure::read('Commerce.company_bank_account') . '</strong>';
                $content_for_view_2 .= '<br /><br />';
                $content_for_view_2 .= 'Po otrzymaniu wpłaty Twoje zamówienie zostanie przekazane do realizacji. Jeżeli w ciągu 14 dni nie otrzymamy wpłaty, zamówienie zostanie anulowane.';
                break;

            default:
                $title_for_layout = "Zamówienie zostało zapisane";
                $content_for_view = "<p>O każdej zmianie statusu zamówienia będziemy informować poprzez email.</p>";
                break;
        }

        $this->set('title_for_layout', __d('public', $title_for_layout, true));
        $this->set(compact('content_for_view', 'order', 'content_for_view_2'));
    }

    function quantity($id = null, $action = null) {

        $this->Order->OrderItem->recursive = -1;

        $this->Order->OrderItem->id = $id;

        $quantity = $this->Order->OrderItem->field('quantity');

        if ($action == 'up') {
            $this->Order->OrderItem->saveField('quantity', ++$quantity);
        }

        if ($action == 'down' and $quantity > 1) {
            $this->Order->OrderItem->saveField('quantity', --$quantity);
        }

        if (!empty($this->request->data) and $this->request->data['Order']['quantity'] >= 1) {
            $this->Order->OrderItem->saveField('quantity', $this->request->data['Order']['quantity']);
        }

        $orderItem = $this->Order->OrderItem->read();
        $orderItem = $orderItem['OrderItem'];

        $orderItems = $this->Order->find('first', array('conditions' => array('Order.id' => $orderItem['order_id'])));
        $tmp = Commerce::getTotalPricesForOrder($orderItems);
        $total = $tmp['final_price_gross'];

        $this->set(compact('orderItem', 'total'));
        $this->render('/Elements/Orders/order_product');
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Wyszukiwane zamówienie nie istnieje.', true), 'flash/error');
            $this->redirect(array('action' => 'index'));
        }
        if ($this->Order->OrderItem->delete($id)) {
            $this->Order->OrderItem->recursive = -1;
            $orderItem = $this->Order->OrderItem->read('order_id', $id);
            $this->Order->recursive = 1;
            $order = $this->Order->read(null, $orderItem['id']);

            if (empty($order['OrderItem'])) {
                $this->Session->setFlash(__('Usunięto wszystkie produkty z koszyka.', true));
                $this->Order->delete($order['Order']['id']);
                $this->Cookie->delete('Order.hash');
                $this->redirect('/');
            } else {
                $this->Session->setFlash(__('Usunięto produkt z koszyka.', true));
                $this->redirect(array('action' => 'cart'));
            }
        }
    }

    function admin_index($status = 1) {
        $this->layout = 'admin';

//        Debugger::dump($this);
//        Debugger::dump($this->Order);

        $orderStatuses = $this->Order->OrderStatus->find('list');

        $orderStatusFull = $orderStatuses;

        $this->filters = array(
            'Order.hash' => array('param_name' => 'numer', 'default' => '', 'form' => array('label' => __('Nr zamówienia', true))),
            'Customer.name' => array('param_name' => 'klient', 'default' => '', 'form' => array('label' => __('Nazwa klienta', true)))
        );

        $this->set('filtersSettings', $this->filters);
        $f_params = $this->Filtering->getParams();

        $params = $this->Order->filterParams($this->request->data);

        if ($status == 1) {
            //W Trakcje realizacji
            $params['conditions']['Order.order_status_id <>'] = 0;
            $params['conditions']['Order.order_status_id <'] = 60;
        } else {
            //Zrealizowane
            $params['conditions']['Order.order_status_id >='] = 60;
            $params['conditions']['Order.order_status_id <'] = 70;
        }


        $params['contain'] = array('OrderStatus', 'ShipmentMethod', 'Customer');
        $params['contain']['OrderItem'] = array('OrderItemFile');

        $this->Order->Behaviors->attach('Containable');
        $this->Order->cacheQueries = true;

        $params['order'] = 'Order.created DESC';
        $params['limit'] = 25;

        $this->paginate = $params;

        $paymentTypes = $this->Order->paymentTypes;

        $orders = $this->paginate();
        foreach ($orders as &$order) {
            $order['Order']['paymentTotal'] = $this->Order->Payment->total($order['Order']['id'], 'Order', 'Commerce');
            $order['Order']['files_is_not_exist'] = 0;
            $order['Order']['not_accepted'] = 0;
            $order['Order']['fullstatus'] = 1;

            foreach ($order['OrderItem'] as $orderItem) {
                if (empty($orderItem['OrderItemFile'])) {
                    //Puste, brak plików projektu
                    $order['Order']['files_is_not_exist'] = 1;
                    $order['Order']['fullstatus'] = 0;
                    break;
                }
            }
        }
        foreach ($orders as &$order) {
            if ($order['Order']['files_is_not_exist'] == 0) {
                foreach ($order['OrderItem'] as $orderItem) {
                    if (!empty($orderItem['OrderItemFile'])) {
                        foreach ($orderItem['OrderItemFile'] as $orderItem) {
                            if ($orderItem['accepted'] == 0 || $orderItem['accepted'] == 2) {
                                //Jest nie zaakceptowany plik projektu
                                $order['Order']['not_accepted'] = 1;
                                $order['Order']['fullstatus'] = 0;
                                break;
                            }
                        }
                    }
                }
            }
        }

        $this->set(compact('orders', 'orderStatuses', 'orderStatusFull', 'paymentTypes', 'status'));
        $this->set('filtersParams', $f_params);
    }

    /**
     * Akcja ustawia status zamówień na anulowany ( po 16 dniach i gdy przedmiot znajduje się dalej w koszyku i nie dodano mu żadnej płatności ) 
     */
    function clear_garbage_order() {
        $this->layout = 'ajax';
        $params['conditions']['Order.order_status_id <'] = 20;
        $params['conditions'][] = "Order.created < DATE_SUB(NOW(), INTERVAL {$this->Order->cookieLifeTime} DAY)";

        $this->Order->recursive = -1;
        $orders = $this->Order->find('all', $params);
        foreach ($orders as &$order) {
            $order['Order']['paymentTotal'] = $this->Order->Payment->total($order['Order']['id'], 'Order', 'Commerce');
            if ($order['Order']['paymentTotal'] == 0) {
                $toCancelList[] = ($order['Order']['id']);
            }
        }

        if (!empty($toCancelList)) {
            $this->Order->updateAll(array('Order.order_status_id' => 70), array('Order.id' => $toCancelList));
        }

        $this->log('Zapisuje coś do loga z crona');

        $this->render(false);
    }

    /**
     * Akcja ustawia status zamówień na zrealizowany ( po 5 dniach od zmiany statusu na wysłane )
     */
    function set_realization_order() {
        $this->layout = 'ajax';
        $params['conditions']['Order.order_status_id'] = 50; // Status wysłane
        $params['conditions'][] = "Order.modified < DATE_SUB(NOW(), INTERVAL 5 DAY)";
        $updateList = array();
        $this->Order->recursive = -1;
        $orders = $this->Order->find('all', $params);
        foreach ($orders as $order) {
            $updateList[] = $order['Order']['id'];
        }

        if (!empty($updateList)) {
            $this->Order->updateAll(array('Order.order_status_id' => 60), array('Order.id' => $updateList));
        }
        $this->render(false);
    }

    function admin_index_chart($co = false) {
        $this->layout = 'admin';

        $orderStatuses = $this->Order->OrderStatus->find('list');

        $params['order'] = "Order.created DESC";
        $params['conditions']['OrderStatus.id'] = "0";

        $this->paginate = $params;

        $this->set('orders', $this->paginate());

        $coockieTimeLife = $this->Order->cookieLifeTime;
        $params['conditions'] = "Order.modified < DATE_SUB(NOW(), INTERVAL {$coockieTimeLife} DAY)";
        $this->Order->recursive = -1;
        $oldOrders = $this->Order->find('count', $params);
        $this->set(compact('orderStatuses', 'oldOrders', 'coockieTimeLife'));

        if ($co == 'delete') {
            $conditions = $params['conditions'];
            $this->Order->deleteAll($conditions);
            $this->Session->setFlash(__('Poprawnie usunięto koszyki starsze niż ' . $coockieTimeLife . ' dni.', true));
            $this->redirect(array('action' => 'index_chart'));
        }
    }

    function admin_index_cancel() {
        $this->layout = 'admin';

        $orderStatuses = $this->Order->OrderStatus->find('list');

        $params['order'] = "Order.created DESC";
        $params['conditions']['OrderStatus.id'] = "70";

        $this->paginate = $params;

        $this->set('orders', $this->paginate());
        $this->set(compact('orderStatuses', 'oldOrders'));
    }

    function admin_specification($id = null) {
        $this->admin_view($id);
    }

    function admin_view($id = null) {
        $this->layout = 'admin';
        if (!$id) {
            $this->Session->setFlash(__('Wyszukiwana oferta nie istnieje.', true), 'flash/error');
            $this->redirect(array('action' => 'index'));
        }
        $this->set('order', $this->Order->read(null, $id));
        $this->set('orderStatuses', $this->Order->OrderStatus->find('list'));
        $this->set('statuses', $this->Order->Payment->statuses);
    }

    function admin_edit($id = null) {
        $this->Order->Behaviors->attach('Modification');
        $this->Order->OrderItem->Behaviors->attach('Modification');

        $this->layout = 'admin';
        $this->Order->recursive = 2;

        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Nie istnieje takie zamówienie.', true), 'flash/error');
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {

            $this->request->data['Note']['user_id'] = $this->Auth->user('id');
            $content = trim(strip_tags($this->request->data['Note']['content']));
            if (empty($content)) {
                unset($this->request->data['Note']);
            } else {
                $this->request->data['Note'] = array($this->request->data['Note']);
            }
            if (isset($this->request->data['Customer'])) {
                unset($this->request->data['Customer']);
            }
            if ($this->Order->saveAll($this->request->data)) {
                $this->Session->setFlash(__('Zamówienie zostało pomyślnie zmienione.', true));
                if (!isset($this->request->data['save_end_not_send'])) {
                    $this->redirect(array('action' => 'send_order_email', $id));
                }
            } else {
                $this->Session->setFlash(__('Zamówienie nie mogło zostać zapisane, spróbuj ponownie.', true), 'flash/error');
            }
        }

        $orderStatuses = $this->Order->OrderStatus->find('list');
        $orderStatusFull = $orderStatuses;
        unset($orderStatuses[0]);

        $params['conditions']['Order.id'] = $id;

        $params['contain'] = array('OrderStatus', 'ShipmentMethod', 'Customer', 'Payment', 'Note');
        $params['contain']['OrderItem'] = array('OrderItemFile');

        $this->Order->Behaviors->attach('Containable');
        $this->Order->cacheQueries = true;

        $order = $this->Order->find('first', $params);

        $order['Order']['files_is_not_exist'] = 0;
        $order['Order']['not_accepted'] = 0;

        foreach ($order['OrderItem'] as $orderItem) {
            if (empty($orderItem['OrderItemFile'])) {
                //Puste, brak plików projektu
                $order['Order']['files_is_not_exist'] = 1;
                unset($orderStatuses[3]);
                unset($orderStatuses[4]);
                unset($orderStatuses[5]);
                unset($orderStatuses[6]);
                unset($orderStatuses[7]);
                break;
            }
        }


        if ($order['Order']['files_is_not_exist'] == 0) {
            foreach ($order['OrderItem'] as $orderItem) {
                if (!empty($orderItem['OrderItemFile'])) {
                    foreach ($orderItem['OrderItemFile'] as $orderItem) {
                        if ($orderItem['accepted'] == 0 || $orderItem['accepted'] == 2) {
                            //Jest nie zaakceptowany plik projektu
                            $order['Order']['not_accepted'] = 1;
                            unset($orderStatuses[3]);
                            unset($orderStatuses[4]);
                            unset($orderStatuses[5]);
                            unset($orderStatuses[6]);
                            unset($orderStatuses[7]);
                            break;
                        }
                    }
                }
            }
        }
        $this->request->data = $order;


        $paymentTotal = $this->Order->Payment->total($this->request->data['Order']['id'], 'Order', 'Commerce');

        $statuses = $this->Order->Payment->statuses;

        $customers = $this->Order->Customer->find('list');
        $countries = $this->Order->Customer->Address->Country->find('list');
        $regions = $this->Order->Customer->Address->Region->find('list');
        $shipmentMethods = $this->Order->ShipmentMethod->find('list');

        $paymentTypes = $this->Order->paymentTypes;
        $users = $this->Order->Customer->User->find('list');
        $fileStatuses = $this->Order->OrderItem->OrderItemFile->fileStatuses;


        $diffs = $this->Order->getModyfications($id);
        $this->set(compact('users', 'order', 'orderStatuses', 'orderStatusFull', 'customers', 'addresses', 'invoiceIdentities', 'shipmentMethods', 'countries', 'regions', 'diffs', 'paymentTypes', 'statuses', 'paymentTotal', 'fileStatuses'));
    }

    /**
     * Akcja usuwająca obiekt
     *
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Order->id = $id;
        if (!$this->Order->exists()) {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        if ($this->Order->delete()) {
            $this->Session->setFlash(__d('cms', 'Poprawnie usunięto.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__d('cms', 'Nie można usunąć.'), 'flash/error');
        $this->redirect(array('action' => 'index'));
    }

    function admin_send_order_email($orderId = null) {
        if (!$orderId)
            $orderId = $this->request->data['Order']['id'];

        $this->Order->recursive = 2;
        $order = $this->Order->read(null, $orderId);

        $this->layout = 'admin';
        $this->SavedMail->Behaviors->attach('Modification');

        if (!$orderId && empty($this->request->data)) {
            $this->Session->setFlash(__('Nie istnieje zamówienie do którego można wysłać powiadomienie.', true), 'flash/error');
            $this->redirect(array('action' => 'index'));
        }

        if (!empty($this->request->data)) {
            //wysłanie mejla do właściciela problemu            
//            $this->FebEmail->layout = 'commerce';
            App::uses('FebEmail', 'Lib');
            $email = new FebEmail('public');

            $email->viewVars(array('entry' => $this->request->data['Order']['content']));

            $email->template('Commerce.order_email')
                    ->emailFormat('both')
                    ->to(array($order['Customer']['email']))
                    ->from(array(Configure::read('App.WebSenderEmail') => Configure::read('App.WebSenderName')))
                    ->subject('[www] ' . $this->request->data['Order']['subject']);
            $email_sent = $email->send();

            $email->reset();

            if ($email_sent) {
                $this->Session->setFlash(__('Wysłano powiadomienie.', true));
                $this->redirect(array('action' => 'edit', $orderId));
            } else {
                $this->Session->setFlash(__('Powiadomienie nie mógło zostać wysłane', true), 'flash/error');
                //$this->redirect(array('action' => 'edit', $orderId));
            }
        }

        $paymentTotal = $this->Order->Payment->total($orderId, 'Order', 'Commerce');
        $statuses = $this->Order->Payment->statuses;
        $shipmentMethods = $this->Order->ShipmentMethod->find('list');

        $this->set(compact('order', 'paymentTotal', 'shipmentMethods', 'statuses'));

        $this->request->data['Order']['Od'] = Configure::read('Commerce.Sender.Email');
        $this->request->data['Order']['Do'] = $order['Customer']['email'];
    }

    function admin_ajax_change_order_status() {
        $this->layout = 'none';
        $this->Order->Behaviors->attach('Modification');
        $this->Order->save($this->request->data);
        exit();
    }

    function admin_ajax_change_order_item_file() {
        $this->layout = false;

        if ($this->Order->OrderItem->OrderItemFile->save($this->request->data)) {
            echo "OK";
        } else {
            echo 'Error';
        }
    }

    function admin_ajaxedit() {

        $this->Order->Behaviors->attach('Modification');

        if (isset($this->request->data['OrderItem'])) {
            $this->Order->OrderItem->Behaviors->attach('Modification');
            $this->request->data['OrderItem'] = array($this->request->data['OrderItem']);
            $this->Order->saveAll($this->request->data);
        } elseif (isset($this->request->data['Order']['discount'])) {
            $this->Order->OrderItem->updateAll(array('OrderItem.discount' => $this->request->data['Order']['discount']), array('OrderItem.order_id' => $this->request->data['Order']['id']));

            //Zmieniam tez discount dla sposobu wysylki ( 3 linijki kodu )
            $this->request->data['Order']['shipment_discount'] = $this->request->data['Order']['discount'];
            unset($this->request->data['Order']['discount']);
            $this->Order->save($this->request->data);
            $this->Order->recalculateTotal($this->request->data['Order']['id']);
        } else {
            $this->Order->save($this->request->data);
            $this->Order->recalculateTotal($this->request->data['Order']['id']);
        }

        if (isset($this->request->data['Order']['shipment_method_id']) || isset($this->request->data['Order']['payment_type'])) {
            $this->Order->recalculateShipmentPrice();
        }

        $this->Order->recursive = 2;
        $this->request->data = $this->Order->read(null, $this->request->data['Order']['id']);

        $order = $this->request->data['Order'];
        $paymentTypes = $this->Order->paymentTypes;
        $paymentTotal = $this->Order->Payment->total($this->request->data['Order']['id'], 'Order', 'Commerce');
        $statuses = $this->Order->Payment->statuses;
        $orderStatuses = $this->Order->OrderStatus->find('list');
        $countries = $this->Order->Customer->Address->Country->find('list');
        $regions = $this->Order->Customer->Address->Region->find('list');
        $customers = $this->Order->Customer->find('list');
        $shipmentMethods = $this->Order->ShipmentMethod->find('list');

        $fileStatuses = $this->Order->OrderItem->OrderItemFile->fileStatuses;

        $diffs = $this->Order->getModyfications($this->request->data['Order']['id']);

        $this->set(compact('diffs', 'orderItems', 'orderStatuses', 'customers', 'invoiceIdentities', 'shipmentMethods', 'countries', 'regions', 'paymentTypes', 'statuses', 'paymentTotal', 'order', 'fileStatuses'));
    }

    function admin_create_invoice($id = null) {
        $this->layout = 'admin';
        $this->Order->recursive = 1;
        $order = $this->Order->findById($id);

        if (empty($order) OR empty($order['Order']['invoice_identity'])) {
            $this->Session->setFlash(__('Nie można utworzyć FV dla zamówienia o podanym id.', true), 'flash/error');
            $this->redirect(array('action' => 'index'));
        }

        if (!empty($order['Invoice']['id'])) {
            $this->Session->setFlash(__('Nie można utworzyć FV dla zamówienia o podanym id. Faktura już istnieje', true), 'flash/error');
            $this->redirect(array('admin' => 'admin', 'plugin' => 'commerce', 'controller' => 'orders', 'action' => 'edit', $id));
        }


        $payments = array();
        $last_payment_date = '';
        foreach ($order['Payment'] AS $payment) {
            if ($payment['payment_date'] AND $payment['status'] == $this->Order->Payment->completed_status_id) {
                $payments[] = $payment;
                $last_payment_date = max($last_payment_date, $payment['payment_date']);
            }
        }

        if (empty($this->request->data['Invoice'])) {
            if ($last_payment_date) {
                $this->request->data['Invoice']['invoice_date'] = date('Y-m-d', strtotime($last_payment_date));
            }
            return;
        }

        $this->Order->Customer->Address->Country->id = $order['Order']['invoice_identity']['country_id'];
        $order['Order']['invoice_identity']['country'] = $this->Order->Customer->Address->Country->field('name');
        $this->Order->Customer->Address->Region->id = $order['Order']['invoice_identity']['region_id'];
        $order['Order']['invoice_identity']['region'] = $this->Order->Customer->Address->Region->field('name');

        $items = array();
        foreach ($order['OrderItem'] as $orderItem) {
            $price = Commerce::calculateByPriceType($orderItem['price'], $orderItem['tax_rate']);
            $amount = Commerce::calculateByPriceType($orderItem['price'], $orderItem['tax_rate'], $orderItem['quantity'], $orderItem['discount']);
            $items[] = array(
                'name' => $orderItem['name'],
                'description' => '', //$orderItem['description'],
                'code' => '', //pkwiu
                'tax_rate' => $orderItem['tax_rate'],
                'price_net' => $price['price_net'],
                'price_tax_value' => $price['tax_value'],
                'price_gross' => $price['price_gross'],
                'unit' => 'szt',
                'quantity' => $orderItem['quantity'],
                'discount' => $orderItem['discount'],
                //
                'final_amount_net' => $amount['final_price_net'],
                'final_amount_tax_value' => $amount['final_tax_value'],
                'final_amount_gross' => $amount['final_price_gross'],
            );
        }

        if ($order['Order']['shipment_price'] > 0) {
            $price = Commerce::calculateByPriceType($order['Order']['shipment_price'], $order['Order']['shipment_tax_rate'], 1, $order['Order']['shipment_discount']);
            $items[] = array(
                'name' => __d('commerce', 'Koszty wysyłki', true),
                'description' => '', //$orderItem['description'],
                'code' => '', //pkwiu
                'tax_rate' => $order['Order']['shipment_tax_rate'],
                'price_net' => $price['price_net'],
                'price_tax_value' => $price['tax_value'],
                'price_gross' => $price['price_gross'],
                'unit' => 'szt',
                'quantity' => 1,
                'discount' => $order['Order']['shipment_discount'],
                'final_amount_net' => $price['final_price_net'],
                'final_amount_tax_value' => $price['final_tax_value'],
                'final_amount_gross' => $price['final_price_gross'],
            );
        }

        $toSave = array(
            'Invoice' => array(
                'related_plugin' => 'Commerce',
                'related_model' => 'Order',
                'related_row_id' => $order['Order']['id'],
                'invoice_date' => $this->request->data['Invoice']['invoice_date'],
                'seller' => array(
                    'name' => Configure::read('Commerce.company_name'),
                    'nip' => Configure::read('Commerce.company_nip'),
                    'address' => Configure::read('Commerce.company_address'),
                    'city' => Configure::read('Commerce.company_city'),
                    'post_code' => Configure::read('Commerce.company_post_code'),
                    'region' => Configure::read('Commerce.company_region'),
                    'country' => Configure::read('Commerce.company_country'),
                    'phone' => Configure::read('Commerce.company_phone'),
                    'creator_person' => $this->Auth->User('name'),
                ),
                'buyer_is_company' => $order['Order']['invoice_identity']['iscompany'],
                'buyer' => array(
                    'name' => $order['Order']['invoice_identity']['name'],
                    'nip' => $order['Order']['invoice_identity']['nip'],
                    'address' => $order['Order']['invoice_identity']['address'],
                    'city' => $order['Order']['invoice_identity']['city'],
                    'post_code' => $order['Order']['invoice_identity']['post_code'],
                    'region' => $order['Order']['invoice_identity']['region_id'],
                    'country' => $order['Order']['invoice_identity']['country'],
                    'creator_person' => $this->Auth->User('name'),
                ),
                'items' => $items,
                'payments' => $payments,
                'total_paid' => $this->Order->Payment->total($order['Order']['id'], 'Order', 'Commerce')
            )
        );
        $result = $this->Order->Invoice->create($toSave);

        if ($result) {
            $this->Session->setFlash(__('FV została utworzona', true));
        } else {
            $this->Session->setFlash(__('Tworzenie FV nie powiodło się', true), 'flash/error');
        }
        $this->redirect(array('admin' => 'admin', 'plugin' => 'commerce', 'controller' => 'orders', 'action' => 'edit', $id));
    }

    /**
     * Akcja do podpowiadaina danych z formularza
     * 
     * @param type $term
     * @throws MethodNotAllowedException 
     */
    function admin_autocomplete($term = null) {
        $this->layout = 'ajax';
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $params = array();
        $params['fields'] = array('hash');

        //Dodatkowe dane przekazywane z FebFormHelper-a
        //if (!empty($this->request->data['fields']['field_name'])) {
        //    $params['conditions']['Order.field_name'] = $_POST['fields']['field_name'];
        //}

        $this->request->data['fraz'] = preg_replace('/[ >]+/', '%', $this->request->data['fraz']);
        $this->Order->recursive = -1;
        $params['conditions']["Order.hash LIKE"] = "%{$this->request->data['fraz']}%";
        $res = $this->Order->find('all', $params);
        echo json_encode($res);
        $this->render(false);
    }

}
