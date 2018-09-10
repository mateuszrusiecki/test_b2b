<?php
App::uses('AppController', 'Controller');
/**
 * Grindstones Controller
 *
 */
class GraphicProjectsController extends AppController {
    
    public function index(){
        
        $title = "Projekty graficzne";
        $subtitle = "Projekty graficzne";
        
        $this->set(compact('title', 'subtitle'));
    }
    
    public function edit($graphic_project_id = null){
        
        $this->GraphicProject->id = $graphic_project_id;
        if (!$this->GraphicProject->exists())
        {
            throw new NotFoundException(__d('cms', 'Strona nie istnieje.'));
        }
        
        //$graphic_project = $this->GraphicProject->findById($graphic_project_id);
        
        $title = "Edycja projektu graficznego";
        $subtitle = "Edycja projektu";
     
        $this->set(compact('title', 'subtitle'));
    }
    
    /*
     * returns: lista projektów z danymi dla managera (project-list)
     */
    public function projectsreview(){
        
        $graphic_projects = $this->GraphicProject->find('all', array(
            'recursive' => 1,
            'Category' => array(
                'order' => array(
                    'Category.ordernum' => 'ASC',
                ),
                'pView' => array(
                    'order' => array(
                       'pView.ordernum' => 'ASC',
                    ),
                    'Version' => array(
                        'order' => array(
                            'number' => 'DESC'
                        )
                    )
                )
            )
        ));
        
        $this->response->body(json_encode($graphic_projects));
    }
}
