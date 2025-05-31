<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\web\Cookie;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\TasksData;
use app\models\SignupForm;
use app\models\TaskForm;

use app\models\Signup;
use app\models\EditModel;

///
use app\models\DeleteBtnForm;
///

use yii\data\ActiveDataProvider;
use yii\data\Pagination;

use yii\base\ErrorException;
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
		$isLoggedIn=false;
		if(!Yii::$app->user->isGuest)
			$isLoggedIn=true;
		

        /**Find in databasase by userid  */
        //$userId=Yii::$app->user->identity->id;

        $delBtnForm=new DeleteBtnForm();
        $editModel=new EditModel();


		$query=TasksData::find()->where([]);//['user_id'=>$userId]
		
		$queryCount=$query->count();
		$pages=new Pagination(['totalCount'=>$queryCount
		,'defaultPageSize'=>3]); 
		$data=$query->offset($pages->offset)->limit($pages->limit)->all(); 


		/**For main.php layout */
        $this->view->params['loginModel']=new LoginForm(); 
        $this->view->params['signupModel']=new SignupForm();
        $this->view->params['taskModel']=new TaskForm();
        /** */

		
		return $this->render('index',['delBtnFrm'=>$delBtnForm,'editModel'=>$editModel,'data'=>$data,'dataCount'=>$queryCount,'isLoggedIn'=>$isLoggedIn,'pages'=>$pages]);   
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if(!Yii::$app->user->isGuest) 
		{
            return $this->goHome();
        }
		
		
        $model = new LoginForm();
		
        if ($model->load(Yii::$app->request->post())) 
		{ 
			if(!$model->login())
				Yii::$app->session->setFlash('error','Incorrect login or password');
			else
				Yii::$app->session->setFlash('success','You logged in');
        }
			
		return $this->goHome();
		
    }


	public function actionSignup()
	{
		$signupForm=new SignupForm();
		if($signupForm->load(Yii::$app->request->post()))
		{	
			if($signupForm->validateUsername())
			{
				if($signupForm->validatePassword())
                {
                    if($signupForm->signup())
    				{
	    				Yii::$app->session->setFlash('success','Your account has been created');
                    	//$signupForm->addNewUserTable();
		    		}
					
			    	else
				    	Yii::$app->session->setFlash('error','You password is too weak.');
                }	
                else 
                    Yii::$app->session->setFlash('error','Signup failed');
                						
			}

			else
				Yii::$app->session->setFlash('error','This account already exists');
			
		}

		return $this->goHome();
	}
    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
  
	public function actionAdd()
	{
		if(Yii::$app->user->isGuest)
			$this->redirect('index');
		
		$addForm=new TaskForm();
		
		if($addForm->load(Yii::$app->request->post()))
		{
            try
            {
                $userId=Yii::$app->user->identity->id;
                $addForm->addData($userId);
                Yii::$app->session->setFlash('success','Task added successfully');
            }
            catch(ErrorException $err)
            {
                Yii::$app->session->setFlash('error',$err);
            }
		}
		else
			Yii::$app->session->setFlash('error','Data not loaded');

		return $this->goHome();
	}
	
    /** 
    * Remove task action 
     */

    public function actionRemove()
    {
        if(Yii::$app->user->isGuest)
			$this->redirect('index');

        $delBtnForm=new DeleteBtnForm();

        if($delBtnForm->load(Yii::$app->request->post()))
        {
            try
            {
                $delBtnForm->deleteData();
                Yii::$app->session->setFlash('success','Data removed sucessfully.'); 
            }
            catch(ErrorException)
            {
                  Yii::$app->session->setFlash('error','Error removing data');
            }
        }
        else
        {
            Yii::$app->session->setFlash('error','Error loading data');
        }

        return $this->goHome();
    }

    public function actionEdit()
    {
        if(Yii::$app->user->isGuest)
            $this->redirect('index');

        $editModel=new EditModel();
        if($editModel->load(Yii::$app->request->post()))
        {            
            if(!$editModel->validateData())
                Yii::$app->session->setFlash('error','Task not set');
            else
            {
                try
                {
                    $editModel->editData(); 
                    Yii::$app->session->setFlash('success','Data edited successfully');
                }
                catch(ErrorException $err)
                {
                    Yii::$app->session->setFlash('error',$err);
                }
            }
        }
        else
        {
            Yii::$app->session->setFlash('error','Error editing');
        }

        return $this->goHome();
    }

    ///
    public function actionUpdate()
	{
        //
        //file_put_contents('tmp.txt','tmp started');
        //
        if(Yii::$app->request->isAjax)
        {
            $taskId=Yii::$app->request->post('task_id'); //$_POST['data'];
            $taskStatus=Yii::$app->request->post('task_status'); //$_POST['data'];

            if(!isset($taskId)||!isset($taskStatus))
                Yii::$app->session->setFlash('error','Task id does not exist '.$data);    
            else
            {
                $taskData=TasksData::findOne($taskId);
                $taskData->taskStatus=$taskStatus;
                $taskData->save();
                
                Yii::$app->session->setFlash('success','Data successfull ');
            }
        }
		return  $this->goHome();
		
	}
    ///
}

