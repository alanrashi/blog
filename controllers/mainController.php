<?php


class MainController extends controller {

    public function actionDo() {

        $model = $this->getModel('index');
        $this->render('main');
        return true;
    }

}