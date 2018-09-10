<?php
/**
 * Maintenance Component blocks access to your site to all but allowed hosts, 
 * and show a default "site under maintenance" page 
 */
App::uses('Component', 'Controller'); 

class SlugComponent extends Component {
    
    private $controller = null;
    private $model = null;
    
    //called before Controller::beforeFilter()
    public function initialize(Controller $controller) {
        $this->controller = $controller;
    }
 
    //called after Controller::beforeFilter()
    public function startup(Controller $controller) {
        
    }

    /**
     * Wykonuje domyślną logikę dla Slugs
     * 
     * @param string $slug Slug string
     */
    public function basic($slug = null, Model $model = null){
        $id = $this->getRowId($slug, $model);
        if(!empty($this->model->Behaviors->Translate) AND $this->model->Behaviors->Translate instanceof ModelBehavior){
            $this->setLanguagesLinks();
        }
        return $id;
    }
    
    public function setLanguagesLinks($id = null, Model $model = null){
        if(!empty($model)){
            $this->model = $model;
        } else {
            $this->model = $this->controller->{$this->controller->modelClass};
        }
        if(!empty($id)){
            $this->model->{$this->model->primaryKey} = $id;
        }
        
        $slugs = $this->model->languagesLinks();
        
        $this->controller->set('Slug_LanguageLinks', $slugs);
        
        return $slugs;
    }
    
    
    public function getRowId($slug = null, Model $model = null){

        if(!empty($model)){
            $this->model = $model;
        } else {
            $this->model = $this->controller->{$this->controller->modelClass};
        }
        
        if(empty($slug) AND !empty($this->controller->request->params['slug'])){
			$slug = $this->controller->request->params['slug'];
		}
        if(empty($slug) AND !empty($this->controller->request->params['named']['slug'])){
			$slug = $this->controller->request->params['named']['slug'];
		}
        
        $slug = $this->model->isSlug($slug);
        
        if (!$slug) {
            throw new NotFoundException(__d('public', 'Strona nie istnieje'));
        }
        
        if (!empty($slug['error'])) {
            $params = array($slug['slug']);
            if(!empty($this->model->Behaviors->Translate) AND $this->model->Behaviors->Translate instanceof ModelBehavior){
                $params['lang'] = $slug['locale'];
            }
            $this->controller->redirect($params, $slug['error']);
        }
        
        $this->model->id = $slug['id'];
        if (!$this->model->exists()) {
            throw new NotFoundException(__d('public', 'Strona nie istnieje'));
        }        
        return $this->model->id;
    }

}
?>
