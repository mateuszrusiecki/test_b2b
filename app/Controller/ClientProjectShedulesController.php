<?php

App::uses('AppController', 'Controller');

/**
 * ClientProjectShedules Controller
 *
 * @property ClientProjectShedule $ClientProjectShedule
 */
class ClientProjectShedulesController extends AppController
{

    public $uses = array('ClientProjectShedule', 'ClientProjectLog');

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array('cron_agreement'));
    }

    /**
     * Akcja dodajaca nowa umowę
     * 
     * @return void
     */
    public function cron_agreement()
    {
        $params['recursive'] = -1;
        $params['conditions']['ClientProject.auto_project'] = 1;
        $params['conditions']['ClientProject.interval_project >='] = 1;
        $params['fields'] = array('auto_project', 'interval_project', 'id');
        $clientProjects = $this->ClientProjectShedule->ClientProject->find('all', $params);

        $m = date('m'); //miesiąc
        $d = date('d'); //dzien
        $Y = date('Y'); //rok
        foreach ($clientProjects as &$clientProject)
        {
            $project_id = $clientProject['ClientProject']['id'];
            $lastAgreement = $this->ClientProjectShedule->lastAgreement($project_id);
            $time = strtotime($lastAgreement['date_to']);
            $am = date('m', $time); //miesiąc
            $ad = date('d', $time); //dzień
            $aY = date('Y', $time); //rok

            if ($m == $am && $d == $ad && $Y == $aY)
            {
                $save['client_project_id'] = $project_id;
                $save['type'] = 'agreement';
                $save['desc'] = __d('public', 'Umowa przedłużona automatycznie');
                $save['name'] = __d('public', 'Umowa');
                $nextday = strtotime('+1 day', $time);
                $save['date'] = date('Y-m-d', $nextday);
                $save['date_to'] = date('Y-m-d', strtotime('+' . $clientProject['ClientProject']['interval_project'] . 'month', $time));
                $this->ClientProjectShedule->save($save, false);
            }
        }
        $this->layout = false;
        $this->render(false);
    }

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $this->ClientProjectShedule->recursive = 0;
        $this->set('clientProjectShedules', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {
        $this->ClientProjectShedule->id = $id;
        if (!$this->ClientProjectShedule->exists())
        {
            throw new NotFoundException(__('Invalid client project shedule'));
        }
        $this->set('clientProjectShedule', $this->ClientProjectShedule->read(null, $id));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post'))
        {
            $this->ClientProjectShedule->create();
            if ($this->ClientProjectShedule->save($this->request->data))
            {
                $this->Session->setFlash(__('The client project shedule has been saved'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__('The client project shedule could not be saved. Please, try again.'));
            }
        }
        $clientProjects = $this->ClientProjectShedule->ClientProject->find('list');
        $this->set(compact('clientProjects'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null)
    {
        $this->ClientProjectShedule->id = $id;
        if (!$this->ClientProjectShedule->exists())
        {
            throw new NotFoundException(__('Invalid client project shedule'));
        }
        if ($this->request->is('post') || $this->request->is('put'))
        {
            if ($this->ClientProjectShedule->save($this->request->data))
            {
                $this->Session->setFlash(__('The client project shedule has been saved'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__('The client project shedule could not be saved. Please, try again.'));
            }
        } else
        {
            $this->request->data = $this->ClientProjectShedule->read(null, $id);
        }
        $clientProjects = $this->ClientProjectShedule->ClientProject->find('list');
        $this->set(compact('clientProjects'));
    }

    /**
     * delete method
     *
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null)
    {
        if (!$this->request->is('post'))
        {
            throw new MethodNotAllowedException();
        }
        $this->ClientProjectShedule->id = $id;
        if (!$this->ClientProjectShedule->exists())
        {
            throw new NotFoundException(__('Invalid client project shedule'));
        }
        if ($this->ClientProjectShedule->delete())
        {
            $this->Session->setFlash(__('Client project shedule deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Client project shedule was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index()
    {
        $this->ClientProjectShedule->recursive = 0;
        $this->set('clientProjectShedules', $this->paginate());
    }

    /**
     * admin_view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_view($id = null)
    {
        $this->ClientProjectShedule->id = $id;
        if (!$this->ClientProjectShedule->exists())
        {
            throw new NotFoundException(__('Invalid client project shedule'));
        }
        $this->set('clientProjectShedule', $this->ClientProjectShedule->read(null, $id));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add()
    {
        if ($this->request->is('post'))
        {
            $this->ClientProjectShedule->create();
            if ($this->ClientProjectShedule->save($this->request->data))
            {
                $this->Session->setFlash(__('The client project shedule has been saved'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__('The client project shedule could not be saved. Please, try again.'));
            }
        }
        $clientProjects = $this->ClientProjectShedule->ClientProject->find('list');
        $this->set(compact('clientProjects'));
    }

    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null)
    {
        $this->ClientProjectShedule->id = $id;
        if (!$this->ClientProjectShedule->exists())
        {
            throw new NotFoundException(__('Invalid client project shedule'));
        }
        if ($this->request->is('post') || $this->request->is('put'))
        {
            if ($this->ClientProjectShedule->save($this->request->data))
            {
                $this->Session->setFlash(__('The client project shedule has been saved'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__('The client project shedule could not be saved. Please, try again.'));
            }
        } else
        {
            $this->request->data = $this->ClientProjectShedule->read(null, $id);
        }
        $clientProjects = $this->ClientProjectShedule->ClientProject->find('list');
        $this->set(compact('clientProjects'));
    }

    /**
     * admin_delete method
     *
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null)
    {
        if (!$this->request->is('post'))
        {
            throw new MethodNotAllowedException();
        }
        $this->ClientProjectShedule->id = $id;
        if (!$this->ClientProjectShedule->exists())
        {
            throw new NotFoundException(__('Invalid client project shedule'));
        }
        if ($this->ClientProjectShedule->delete())
        {
            $this->Session->setFlash(__('Client project shedule deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Client project shedule was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function done()
    {
        $this->layout = 'ajax';
        $this->render(false);

        $this->loadModel('ClientProjectShedule');
        $this->loadModel('ClientProject');
        $this->loadModel('ClientProjectLog');

        if (!$this->request->is('post'))
        {
            throw new MethodNotAllowedException();
        }
        if (empty($this->data['id']))
        {
            throw new NotFoundException(__('Invalid id project shedule'));
        }
        $this->ClientProjectShedule->id = $this->data['id'];
        if (!$this->ClientProjectShedule->exists())
        {
            throw new NotFoundException(__('Invalid client project shedule'));
        }
        $session = $this->Session->read();
        $this->ClientProject->id = $this->ClientProjectShedule->field('client_project_id');
        $return = false;
        /*
         * Na chwilę obecną nie ograniczamy dostępu do możliwości oznaczenia kamienia milowego - każdy kto ma dostęp do widoku projektu może to zrobić(kierownicy, zarząd, handlowiec odpowiedzialny)
         */

        $return = $this->ClientProjectShedule->saveField('done', $this->data['done']);

        $data['ClientProjectLog']['user_id'] = $this->Session->read('Auth.User.id');
        $data['ClientProjectLog']['client_project_id'] = $this->ClientProjectShedule->field('client_project_id');
        $data['ClientProjectLog']['name'] = $this->ClientProjectShedule->field('name');
        if ($this->data['done'])
        {
            $this->ClientProjectLog->saveLog(14, $data); //realizacja kamienia milowego
        } else
        {
            $this->ClientProjectLog->saveLog(17, $data); // odznaczenie realizacji kamienia milowego
        }

        $this->set('data', $return);
        $this->set('_serialize', array('data'));
    }

    /*
     * metoda tworząca fakturę do wystawienia
     * sekretariat musi wprowadzić fakturę do comarch optima, zaimportować ją do systemu i powiązać z tą fakturą 
     * to spowoduje usunięcie faktury do wystawienia z systemu i zastąpienie jej przez właściwą z comarch 
     */

    public function done_payment()
    {
        $this->layout = 'ajax';
        $this->render(false);

        $this->loadModel('Payment');
        $this->loadModel('ClientProject');
        $this->loadModel('ClientProjectLog');

        if (!$this->request->is('post'))
        {
            throw new MethodNotAllowedException();
        }
        if (empty($this->data['id']))
        {
            throw new NotFoundException(__('Invalid payment id'));
        }
        $this->Payment->id = $this->data['id'];

        //$this->Payment->id = 2;
        if (!$this->Payment->exists())
        {
            throw new NotFoundException(__('Invalid payment'));
        }

        $this->Payment->saveField('payment_type', 1); //faktura do wystawienia

        /*
         * stworzenie 'faktury do wystawienia'
         */
        $client_project = $this->ClientProject->findById($this->Payment->field('client_project_id'));
        $invoice['user_id'] = $client_project['User']['id'];
        $invoice['client_id'] = $client_project['Client']['id'];
        $invoice['client_project_id'] = $this->Payment->field('client_project_id');
        $invoice['payment_id'] = $this->Payment->field('id');
        $invoice['type'] = 3; //faktura do wystawienia
        $invoice['payment_date'] = $this->Payment->field('date');
//        $invoice['gross_price'] = $this->Payment->field('price');
//        $invoice['vat_rate'] = 23;
//        $invoice['net_price'] = round($this->Payment->field('price') / 1.23, 2);
//        $invoice['vat_price'] = $invoice['gross_price'] - $invoice['net_price'];
        $invoice['net_price'] = $this->Payment->field('price');
        $invoice['vat_rate'] = 23;
        $invoice['gross_price'] = round($this->Payment->field('price') * 1.23, 2);
        $invoice['vat_amount'] = $invoice['gross_price'] - $invoice['net_price'];

        $this->loadModel('Invoice');
        $this->Invoice->create();
        $return = $this->Invoice->save($invoice);
        if (!empty($return))
        {
            $invoice_position['invoice_id'] = $return['Invoice']['id'];
            $invoice_position['name'] = $this->Payment->field('name');
            $invoice_position['quantity'] = 1;
            $invoice_position['net_value'] = $invoice['net_price'];
            $invoice_position['unit_price'] = $invoice['net_price'] / $invoice_position['quantity'];
            $invoice_position['tax'] = $invoice['vat_rate'];
            $invoice_position['tax_value'] = $invoice['vat_amount'];
            $invoice_position['gross_value'] = $invoice['gross_price'];

            $this->loadModel('InvoicePosition');
            $this->InvoicePosition->create();
            $return2 = $this->InvoicePosition->save($invoice_position);

            /*
             * koniec tworzenia
             */

            $this->ClientProject->id = $client_project_id = $this->Payment->field('client_project_id');
            $data['ClientProjectLog']['client_project_id'] = $client_project_id;
            $data['ClientProjectLog']['name'] = $this->Payment->field('name');
            $data['ClientProjectLog']['user_id'] = $this->Session->read('Auth.User.id');
            $this->ClientProjectLog->saveLog(25, $data); //faktura do wystawienia
        }

        $this->set('data', $return);
        $this->set('_serialize', array('data'));
    }

}
