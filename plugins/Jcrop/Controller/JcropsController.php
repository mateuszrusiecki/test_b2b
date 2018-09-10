<?php

class JcropsController extends AppController {

    var $uses = null;

    function update($model = null, $id = null) {

        $this->loadModel($model);
        if ($model == 'Photo') {
            $this->loadModel('Crop');
            $model = 'Crop';
            debug($this->data);
            $crop = $this->Crop->find('first', array('conditions' => array('Crop.crop_type_id' => $this->data['active'], 'Crop.photo_id' => $id), 'recursive' => -1));
            $id = $crop['Crop']['id'];
        }

        $this->$model->id = $id;
        $this->$model->saveField('x', $this->data['x']);
        $this->$model->saveField('y', $this->data['y']);
        $this->$model->saveField('h', $this->data['h']);
        $this->$model->saveField('w', $this->data['w']);

        $this->render(false);
    }

    function edit() {
        $childModel = $this->request->data['childModel'];
        $field = $this->request->data['field'];
        $id = $this->request->data['id'];
        $parentModel = $this->request->data['parentModel'];
        $this->loadModel($childModel);
        list($plugin, $childModel) = pluginSplit($childModel);
        if ($childModel == 'Photo') {
            $this->loadModel('Crop');
            $crops = $this->Crop->CropType->find('all', array('conditions' => array('model' => $parentModel)));
            foreach ($crops as &$crop) {
                $temp = $this->Crop->find('first', array('conditions' => array('Crop.crop_type_id' => $crop['CropType']['id'], 'Crop.photo_id' => $id)));
                if (empty($temp)) {
                    $temp['Crop']['crop_type_id'] = $crop['CropType']['id'];
                    $temp['Crop']['photo_id'] = $id;
                    $this->Crop->create();
                    if (!$this->Crop->save($temp)) {
                        throw new Exception('Błąd przy tworzeniu cropa');
                    }
                    $lastId = $this->Crop->getLastInsertID();
                    $temp = $this->Crop->find('first', array('conditions' => array('Crop.id' => $lastId), 'recursive' => -1));
                    $crop['Crop'] = $temp['Crop'];
                } else {
                    $crop['Crop'] = $temp['Crop'];
                }

                $crop['Crop']['x'] = empty($crop['Crop']['x']) ? 0 : $crop['Crop']['x'];
                $crop['Crop']['y'] = empty($crop['Crop']['y']) ? 0 : $crop['Crop']['y'];
                $crop['Crop']['w'] = empty($crop['Crop']['w']) ? 0 : $crop['Crop']['w'];
                $crop['Crop']['h'] = empty($crop['Crop']['h']) ? 0 : $crop['Crop']['h'];
            }
            @$active = $crops[0]['CropType']['id'];
            $this->set(compact('model', 'id', 'crops', 'active'));
        } 
        $this->$childModel->id = $id;
        $data['x'] = $this->$childModel->field('x');
        $data['y'] = $this->$childModel->field('y');
        $data['w'] = $this->$childModel->field('w');
        $data['h'] = $this->$childModel->field('h');

        $data['name'] = $this->$childModel->field($field);
        $this->set(compact('childModel', 'data', 'id', 'parentModel'));
        
        $this->render('/Elements/jcrop');
    }

}