<?php

App::uses('AppController', 'Controller');

/**
 * ClientDomains Controller
 *
 * @property ClientDomain $ClientDomain
 */
class ClientDomainsController extends AppController
{

    /**
     * cron method
     *
     * @return void
     */
    public function cron()
    {
        $this->loadModel('ClientProjectDomain');
        $this->loadModel('ProjectFile');
        $this->loadModel('Section');
        // SEO/SEM
        $this->Section->id = 16;
        $user_id = $this->Section->field('supervisor');
        $params['recursive'] = -1;
        $params['joins'][] = array('table' => 'client_projects',
            'alias' => 'ClientProject',
            'type' => 'INNER',
            'conditions' => array(
                'ClientProject.id = ClientProjectDomain.project_id',
            )
        );
        $params['conditions']['ClientProject.close_realization'] = 0;
        //$params['fields'] = array('ClientProject.*');
        $projects = $this->ClientProjectDomain->find('all', $params);
        $this->ProjectFile->recursive = -1;
        foreach ($projects as $client)
        {
            //szukamy jakie ma site_id po id oraz czy jeszcze jest aktywny w bazie
            $site_id = $this->ClientDomain->client2site($client['ClientProjectDomain']['client_domain_id']);
            if (empty($site_id))
            {
                continue;
            }
            //prosimy o raport
            $date = date('Ym', strtotime('-1 month'));
            $file_name = $this->ClientDomain->api_pdf($site_id, $date);
            //zapisujemy i wersjonujemy
            $return[] = $this->ClientDomain->parseFile(
                    $user_id
                    , $file_name
                    , $client['ClientProjectDomain']['project_id']
                    , $client['ClientProjectDomain']['client_domain_id']
            );
        }
        die(debug($return));
    }

    /**
     * report method
     *
     * @return void
     */
    public function raport($domain_id = null, $project_id)
    {
        $this->loadModel('ProjectFile');
        $this->ClientDomain->id = $domain_id;
        if (!$this->ClientDomain->exists())
        {
            throw new NotFoundException(__('Invalid domain'));
        }
        $session = $this->Session->read();
        //szukamy jakie ma site_id po id oraz czy jeszcze jest aktywny w bazie
        $site_id = $this->ClientDomain->client2site($domain_id);
        if (empty($site_id))
        {
            $this->Session->setFlash(__('Nie można wygenerowąc raportu. Brak domeny w bazie'), 'flash/error');
        }
        $user_id = $session['Auth']['User']['id'];
        //prosimy o raport
        $date = date('Ym', strtotime('-1 month'));
        $file_name = $this->ClientDomain->api_pdf($site_id, $date);
        //zapisujemy i wersjonujemy
        $projectFile = $this->ClientDomain->parseFile(
                $user_id
                , $file_name
                , $project_id
                , $domain_id
        );
        if ($projectFile)
        {

            $this->Session->setFlash(__('Raport został wygenerowany'), 'flash/success');
        } else
        {
            $this->Session->setFlash(__('Nie można wygenerowąc raportu. Brak raportu.'), 'flash/error');
        }
        $this->redirect($this->referer());
    }

    /**
     * index method
     *
     * @return void
     */
    public function index($project_id = null)
    {
        $this->loadModel('ClientProject');
        $title = $subtitle = 'Domeny';
        if (!$this->ClientProject->exists($project_id))
        {
            throw new NotFoundException(__('Invalid client'));
        }
        //pobieranie listy domen powiązantych z danym projektem
        $this->ClientDomain->bindFile();
        $clientDomains = $this->ClientDomain->listDomainsByProject($project_id);
        $this->set(compact('clientDomains', 'title', 'subtitle', 'project_id'));
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
        $title = $subtitle = 'Domeny';
        $this->ClientDomain->id = $id;
        if (!$this->ClientDomain->exists())
        {
            throw new NotFoundException(__('Invalid client domain'));
        }
        $clientDomain = $this->ClientDomain->read(null, $id);
        $this->set(compact('clientDomain', 'title', 'subtitle'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add($project_id = null)
    {
        $this->loadModel('ClientProject');
        if (!$this->ClientProject->exists($project_id))
        {
            throw new NotFoundException(__('Invalid project'));
        }
        $title = $subtitle = 'Domeny';
        if ($this->request->is('post'))
        {
            $this->ClientDomain->create();
            if ($this->ClientDomain->save($this->request->data))
            {
                $this->Session->setFlash(__('The client domain has been saved'), 'flash/success');
                $this->redirect(array('action' => 'index', $project_id));
            } else
            {
                $this->Session->setFlash(__('The client domain could not be saved. Please, try again.'), 'flash/error');
            }
        }
        $this->set(compact('title', 'subtitle', 'project_id'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null, $project_id = null)
    {
        $this->loadModel('ClientProject');
        if (!$this->ClientProject->exists($project_id))
        {
            throw new NotFoundException(__('Invalid project'));
        }
        $title = $subtitle = 'Domeny';
        $this->ClientDomain->id = $id;
        $client_id = $this->ClientDomain->field('client_id');
        if (!$this->ClientDomain->exists())
        {
            throw new NotFoundException(__('Invalid client domain'));
        }
        if ($this->request->is('post') || $this->request->is('put'))
        {
            if ($this->ClientDomain->save($this->request->data))
            {
                $this->Session->setFlash(__('The client domain has been saved'), 'flash/success');
                $this->redirect(array('action' => 'index', $project_id));
            } else
            {
                $this->Session->setFlash(__('The client domain could not be saved. Please, try again.'), 'flash/error');
            }
        } else
        {
            $this->request->data = $this->ClientDomain->read(null, $id);
        }
        $this->set(compact('title', 'subtitle','project_id'));
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
        $this->ClientDomain->id = $id;
        $client_id = $this->ClientDomain->field('client_id');
        if (!$this->ClientDomain->exists())
        {
            throw new NotFoundException(__('Invalid client domain'));
        }
        if ($this->ClientDomain->delete())
        {
            $this->Session->setFlash(__('Client domain deleted'), 'flash/success');
            $this->redirect(array('action' => 'index', $client_id));
        }
        $this->Session->setFlash(__('Client domain was not deleted'), 'flash/error');
        $this->redirect(array('action' => 'index', $client_id));
    }

}
