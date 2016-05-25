<?php

namespace backend\controllers;
use Yii;
use backend\models\User;
use backend\models\Room;
use yii\data\Pagination;
use  yii\web\Request;
class MainController extends \yii\web\Controller{
    public function actionIndex(){
        //调用模型层
        $query = User::find();
        //调用分页类
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize'=>2,
        ]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->asArray()
            ->all();

       return $this->renderPartial('tables', [
            'user' => $models,
            'pages' => $pages,
        ]);
        //return $this->renderPartial('tables',['user'=>$posts]);
    }
	/**
     * 锁定用户
     */
    public function actionBlock(){
        $request = Yii::$app->request;
        $u_id=$request->get('u_id');
        $status=$request->get('status');
        $connection = \Yii::$app->db;
        $connection->createCommand()->update('user', ['status' => $status], 'u_id='.$u_id)->execute();
        return $this->redirect(array('main/index'));
    }
    /**
     * 房源列表信息
     */
    public function actionTables(){
        //调用模型层
        $query = Room::find();
        //调用分页类
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize'=>10,
        ]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->asArray()
            ->all();
        //向视图层传参
        return $this->renderPartial('room', [
            'room' => $models,
            'pages' => $pages,
        ]);
    }

    /**
     * 房源审核
     */
    public function actionUpdate(){
        //调用传值方式
        $request = Yii::$app->request;
        $r_id=$request->get('r_id');
        $state=$request->get('state');
		$connection = \Yii::$app->db;
        $connection->createCommand()->update('room', ['state' => $state], 'u_id='.$u_id)->execute();
        return $this->redirect(array('main/tables'));
        //echo "<script>alert('已审核');location.href='index.php?r=main/tables'</script>";
    }
    /**
     * 房源批量删除
     */
    public function actionBatch(){
        $request = Yii::$app->request;
        $r_id=$request->get('r_id');
        $connection = \Yii::$app->db;
        $connection->createCommand("delete FROM room where r_id in($r_id)")->execute();
        return $this-redirect(array('main/tables'));
    }

	/**
     * 查看房源介绍
     */
    public function actionLook(){
        $request = Yii::$app->request;
        $r_id=$request->get('r_id');
        $connection = \Yii::$app->db;
        $command = $connection->createCommand("SELECT * FROM room where r_id='$r_id'");
        $post = $command->queryOne();
        return $this->renderPartial('look.html',['room'=>$post]);
    }
    /**
     * 查看详情
     */
    public function actionCheck(){
        $request = Yii::$app->request;
        $r_id=$request->get('r_id');
        //echo $r_id;die;
        $connection = \Yii::$app->db;
        $command = $connection->createCommand("SELECT * FROM room join type on room.r_type=type.ty_id where r_id='$r_id'");
        $post = $command->queryOne();
        $img = explode('|',$post['r_img']);
        foreach($img as $key => $val){
            if($key==0){
             $photos = $val;
            }
        }
        //print_r($photos);die;
        return $this->renderPartial('check',['room'=>$post,'image'=>$photos]);
    }
    /**
     * 相册
     */
    public function actionGallery(){
        $connection = \Yii::$app->db;
        $command = $connection->createCommand('SELECT * FROM users');
        $posts = $command->queryAll();
        foreach($posts as $key => $val){
            $img = explode(',',$val['image']);
            $val['image'] = $img;
            $photos[] = $val;
        }
        return $this->renderPartial('gallery.html',['users'=>$photos]);
    }
    /**
     * 相册删除
     */
    public function actionDelete(){
        echo 4554;
    }
    /**
     * 日历
     */
    public function actionCalendar(){
        return $this->renderPartial('calendar.html');
    }
}
