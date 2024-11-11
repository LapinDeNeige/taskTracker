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

use yii\data\ActiveDataProvider;
use yii\data\Pagination;

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
		
		$loginForm=new LoginForm();
		$signupForm=new SignupForm();
		$taskForm=new TaskForm();
		
		$query=TasksData::find()->where('1');
		
		$queryCount=$query->count();
		
		$pages=new Pagination(['totalCount'=>$queryCount
		,'defaultPageSize'=>1]); 
		
		$data=$query->offset($pages->offset)->limit(3)->all(); 
		
		//'sort'=>false
		return $this->render('index',['loginModel'=>$loginForm,'signupModel'=>$signupForm,'newTaskModel'=>$taskForm,'data'=>$data,'isLoggedIn'=>$isLoggedIn,'pages'=>$pages]);   
		
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
			
		return $this->redirect('index');
		
    }
	public function actionSignup()
	{
		$signupForm=new SignupForm();
		if($signupForm->load(Yii::$app->request->post()))
		{	
			if($signupForm->validateUsername())
			{
				if(!$signupForm->validatePassword())
					Yii::$app->session->setFlash('error','Password is too weak. It must contain at least 7 characters');
					
				else if($signupForm->signup())
				{
					Yii::$app->session->setFlash('success','Your account has been created');
					$signupForm->addNewUserTable();
				}
					
				else
					Yii::$app->session->setFlash('error','Signup failed');
						
			}
			else
				Yii::$app->session->setFlash('error','This account already exists');
			
		}
		$this->redirect('index');
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
		
		$taskForm=new TaskForm();
		
		if($taskForm->load(Yii::$app->request->post()))
		{
			$tasksData=new TasksData();
			$tasksData->Task=$taskForm->task;
			
			$tasksData->Task_start_date=$taskForm->taskStart;
			$tasksData->Task_end_date=$taskForm->taskEnd;
			
			$tasksData->taskInfo=$taskForm->taskInformation;
			
			$tasksData->save();
			
			Yii::$app->session->setFlash('success','Data loaded');
		}
		else
			Yii::$app->session->setFlash('error','Data not loaded');
		return $this->goHome();
	}
	
	public function actionTmp()
	{
		$t=new TaskForm();
		$t->addNewUserTable();
		
		return  $this->goHome();
		
	}
}
