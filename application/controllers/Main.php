<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {
	public function __construct() {
        parent::__construct();
  }
  public function index($lang='') {
    $this->_defineLanguage($lang); 
    $data = ['css'                => ['Main.css'],
		         'js'                 => ['TweenMax.min.js', 'placeholder.js', 'Main.js'],
             'text'               => $this->lang->{'language'},
             'url'                => $this->_defineURL(__FUNCTION__),
             'lang'               => $lang,
             'role'               => $this->_defineRole(),
             'content'            => $this->_defineRoleView(__FUNCTION__, true),
             'username'           => $this->data['username'],
             'tag_title'          => 'Главная страница'];
	 $this->load->view($this->template, $data);
	}
  public function aboutMesid($lang='') {
    $this->_defineLanguage($lang); 
    $data = ['css'                => ['Main.css'],
             'js'                 => ['Main.js'],
             'text'               => $this->lang->{'language'},
             'url'                => $this->_defineURL(__FUNCTION__),
             'lang'               => $lang,
             'role'               => $this->_defineRole(),
             'content'            => $this->_defineRoleView(__FUNCTION__, true),
             'username'           => $this->data['username'],
             'tag_title'          => 'МЭСИД'];
    $this->load->view($this->template, $data);
  }
  public function aboutMesidWork($lang='') {
    $this->_defineLanguage($lang); 
    $data = ['css'                => ['Main.css'],
             'js'                 => ['Main.js'],
             'text'               => $this->lang->{'language'},
             'url'                => $this->_defineURL(__FUNCTION__),
             'lang'               => $lang,
             'role'               => $this->_defineRole(),
             'content'            => $this->_defineRoleView(__FUNCTION__, true),
             'username'           => $this->data['username'],
             'tag_title'          => 'Как работает МЭСИД'];
    $this->load->view($this->template, $data);
  }
  public function aboutMesidExamples($lang='') {
    $this->_defineLanguage($lang); 
    $data = ['css'                => ['Main.css'],
             'js'                 => ['Main.js'],
             'text'               => $this->lang->{'language'},
             'url'                => $this->_defineURL(__FUNCTION__),
             'lang'               => $lang,
             'role'               => $this->_defineRole(),
             'content'            => $this->_defineRoleView(__FUNCTION__, true),
             'username'           => $this->data['username'],
             'tag_title'          => 'Примеры МЭСИД'];
    $this->load->view($this->template, $data);
  }
    public function aboutUs($lang='') {
    $this->_defineLanguage($lang); 
    $data = ['css'                => ['Main.css'],
             'js'                 => ['Main.js'],
             'text'               => $this->lang->{'language'},
             'url'                => $this->_defineURL(__FUNCTION__),
             'lang'               => $lang,
             'role'               => $this->_defineRole(),
             'content'            => $this->_defineRoleView(__FUNCTION__, true),
             'username'           => $this->data['username'],
             'tag_title'          => 'О нас'];
    $this->load->view($this->template, $data);
    }
    public function contacts($lang='') {
    $this->_defineLanguage($lang); 
    $data = ['css'                => ['Main.css'],
             'js'                 => ['Main.js'],
             'text'               => $this->lang->{'language'},
             'url'                => $this->_defineURL(__FUNCTION__),
             'lang'               => $lang,
             'role'               => $this->_defineRole(),
             'content'            => $this->_defineRoleView(__FUNCTION__, true),
             'username'           => $this->data['username'],
             'tag_title'          => 'Контактные данные'];
    $this->load->view($this->template, $data);
    }
    public function examples($lang='') {
    $this->_defineLanguage($lang); 
    $data = ['css'                => ['Main.css'],
             'js'                 => ['Main.js'],
             'text'               => $this->lang->{'language'},
             'url'                => $this->_defineURL(__FUNCTION__),
             'lang'               => $lang,
             'role'               => $this->_defineRole(),
             'content'            => $this->_defineRoleView(__FUNCTION__, true),
             'username'           => $this->data['username'],
             'tag_title'          => 'Примеры работ'];
    $this->load->view($this->template, $data);
    }
    public function software($lang='') {
    $this->_defineLanguage($lang); 
    $data = ['css'                => ['Main.css'],
             'js'                 => ['Main.js'],
             'text'               => $this->lang->{'language'},
             'url'                => $this->_defineURL(__FUNCTION__),
             'lang'               => $lang,
             'role'               => $this->_defineRole(),
             'content'            => $this->_defineRoleView(__FUNCTION__, true),
             'username'           => $this->data['username'],
             'tag_title'          => 'Программные продукты'];
    $this->load->view($this->template, $data);
    }
    public function media($lang='') {
    $this->_defineLanguage($lang); 
    $data = ['css'                => ['Main.css'],
             'js'                 => ['Main.js'],
             'text'               => $this->lang->{'language'},
             'url'                => $this->_defineURL(__FUNCTION__),
             'lang'               => $lang,
             'role'               => $this->_defineRole(),
             'content'            => $this->_defineRoleView(__FUNCTION__, true),
             'username'           => $this->data['username'],
             'tag_title'          => 'Медиаосвещение'];
    $this->load->view($this->template, $data);
    }
    public function history($lang='') {
    $this->_defineLanguage($lang); 
    $data = ['css'                => ['Main.css'],
             'js'                 => ['Main.js'],
             'text'               => $this->lang->{'language'},
             'url'                => $this->_defineURL(__FUNCTION__),
             'lang'               => $lang,
             'role'               => $this->_defineRole(),
             'content'            => $this->_defineRoleView(__FUNCTION__, true),
             'username'           => $this->data['username'],
             'tag_title'          => 'История развития'];
    $this->load->view($this->template, $data);
    }
    public function coop($lang='') {
    $this->_defineLanguage($lang); 
    $data = ['css'                => ['Main.css'],
             'js'                 => ['Main.js'],
             'text'               => $this->lang->{'language'},
             'url'                => $this->_defineURL(__FUNCTION__),
             'lang'               => $lang,
             'role'               => $this->_defineRole(),
             'content'            => $this->_defineRoleView(__FUNCTION__, true),
             'username'           => $this->data['username'],
             'tag_title'          => 'Сотрудничество'];
    $this->load->view($this->template, $data);
    }
    public function services($lang='') {
    $this->_defineLanguage($lang); 
    $data = ['css'                => ['Main.css'],
             'js'                 => ['Main.js'],
             'text'               => $this->lang->{'language'},
             'url'                => $this->_defineURL(__FUNCTION__),
             'lang'               => $lang,
             'role'               => $this->_defineRole(),
             'content'            => $this->_defineRoleView(__FUNCTION__, true),
             'username'           => $this->data['username'],
             'tag_title'          => 'Услуги'];
    $this->load->view($this->template, $data);
    }
    public function science($lang='') {
    $this->_defineLanguage($lang); 
    $data = ['css'                => ['Main.css'],
             'js'                 => ['Main.js'],
             'text'               => $this->lang->{'language'},
             'url'                => $this->_defineURL(__FUNCTION__),
             'lang'               => $lang,
             'role'               => $this->_defineRole(),
             'content'            => $this->_defineRoleView(__FUNCTION__, true),
             'username'           => $this->data['username'],
             'tag_title'          => 'Наука'];
    $this->load->view($this->template, $data);
    }
    public function vacancies($lang='') {
    $this->_defineLanguage($lang); 
    $data = ['css'                => ['Main.css'],
             'js'                 => ['Main.js'],
             'text'               => $this->lang->{'language'},
             'url'                => $this->_defineURL(__FUNCTION__),
             'lang'               => $lang,
             'role'               => $this->_defineRole(),
             'content'            => $this->_defineRoleView(__FUNCTION__, true),
             'username'           => $this->data['username'],
             'tag_title'          => 'Вакансии'];
    $this->load->view($this->template, $data);
    }
}
