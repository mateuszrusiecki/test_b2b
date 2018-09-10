<?php

class UsersLogsController extends AppController
{

    var $name = 'UsersLogs';

    function admin_index($id = null)
    {

        $this->UsersLog->recursive = 0;
        if ($id)
            $this->paginate['conditions']['user_id'] = $id;

        $this->paginate['order'] = 'UsersLog.id DESC';
        $this->set('usersLogs', $this->paginate());
    }

    function admin_view($id = null)
    {

        if (!$id)
        {
            $this->Session->setFlash(__('Invalid UsersLog.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('usersLog', $this->UsersLog->read(null, $id));
    }

    function last_login()
    {
        return $this->UsersLog->last_login($this->Session->read('Auth.User.id'));
    }

    function admin_add()
    {

        if (!empty($this->request->data))
        {
            $this->UsersLog->create();
            if ($this->UsersLog->save($this->request->data))
            {
                $this->Session->setFlash(__('The UsersLog has been saved'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__('The UsersLog could not be saved. Please, try again.'));
            }
        }
        $users = $this->UsersLog->User->find('list');
        $this->set(compact('users'));
    }

    function admin_edit($id = null)
    {

        if (!$id && empty($this->request->data))
        {
            $this->Session->setFlash(__('Invalid UsersLog'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data))
        {
            if ($this->UsersLog->save($this->request->data))
            {
                $this->Session->setFlash(__('The UsersLog has been saved'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__('The UsersLog could not be saved. Please, try again.'));
            }
        }
        if (empty($this->request->data))
        {
            $this->request->data = $this->UsersLog->read(null, $id);
        }
        $users = $this->UsersLog->User->find('list');
        $this->set(compact('users'));
    }

    function admin_delete($id = null)
    {

        if (!$id)
        {
            $this->Session->setFlash(__('Invalid id for UsersLog'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->UsersLog->del($id))
        {
            $this->Session->setFlash(__('UsersLog deleted'));
            $this->redirect(array('action' => 'index'));
        }
    }

    public function activity_monitor()
    {

        $title = 'Monitorowanie aktywności użytkowników';
        $subtitle = 'Monitorowanie aktywności użytkowników';


        $this->set(compact('subtitle', 'title'));

//dane do jsona

        if ($this->params['ext'] == 'json')
        {
            $this->loadModel('ClientProjectLog');
            $this->loadModel('LeadLog');
            $params['recursive'] = -1;
            $params = array(
                'conditions' => array(
                    'NOT' => array('UsersLog.action' => 'Wylogowano poprawnie'),
                )
            );
            //wyciagam userlogs
            $all_user_logs = $this->UsersLog->find('all', $params);
            //debug($all_user_logs);die;
            //wyciagam project user logs
            $paramsProject['recursive'] = -1;
            $paramsProject['joins'] = array(
                array(
                    'table' => 'profiles',
                    'alias' => 'Profile',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'ClientProjectLog.user_id = Profile.user_id',
                    )
                ),
            );

            $paramsProject['fields'] = array('ClientProjectLog.*', 'Profile.firstname', 'Profile.surname');
            $all_project_logs = $this->ClientProjectLog->find('all', $paramsProject);

            //wyciagam leadlog
            $paramsLead['recursive'] = -1;
            $paramsLead['joins'] = array(
                array(
                    'table' => 'profiles',
                    'alias' => 'Profile',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'LeadLog.user_id = Profile.user_id',
                    )
                ),
            );
            $paramsLead['fields'] = array('LeadLog.*', 'Profile.firstname', 'Profile.surname');
            $all_lead_logs = $this->LeadLog->find('all', $paramsLead);
            $lead_log_types = $this->LeadLog->log_type;
            $project_log_types = $this->ClientProjectLog->log_type;


            //parsowanie tablicy do angulara
            $allLogs = $this->UsersLog->parse2List($all_project_logs, 'ClientProjectLog', $project_log_types);
            $allLogs = am($allLogs, $this->UsersLog->parse2List($all_user_logs, 'UsersLog'));
            $allLogs = am($allLogs, $this->UsersLog->parse2List($all_lead_logs, 'LeadLog', $lead_log_types));
            $allLogs = Set::sort($allLogs, '{n}.date', 'desc');
            $this->set(compact('allLogs'));
            $this->set('_serialize', 'allLogs');
        }
    }

}

?>