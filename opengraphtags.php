<?php
if (!defined('_PS_VERSION_'))
	exit;

include_once _PS_MODULE_DIR_ . 'opengraphtags/backend/classes/libs/phpthumb/ThumbLib.inc.php';

class Opengraphtags extends Module
{
	public function __construct()
	{
		$this->name		 = 'opengraphtags';
		$this->tab		 = 'front_office_features';
		$this->version = '1.0';
		$this->author	 = 'Pierrick CAEN';
		$this->need_instance = 0;

		parent::__construct();

		$this->displayName = $this->l('Open Graph tags');
		$this->description = $this->l('Manage your Open Graph tags');

		$this->_tplFile = _PS_MODULE_DIR_ . $this->name . '/backend/tpl/' . $this->name . '_backend_configure.tpl';
		$this->_imgPath = _PS_MODULE_DIR_ . $this->name . '/img/';

		$this->_abbreviation = 'OGT';
		$this->_debugView = false;
		$this->_configs = array(
			1 => array(
				'config_name'		=> $this->_abbreviation . '_TITLE',
				'name'					=> strtolower($this->name) . '_title',
				'title'					=> $this->l('Open Graph tag title'),
				'type'					=> 'text', // boolean, text, radio, select, checkbox, none
				'validate' 			=> 'isString',
				'default' 			=> '',
				'help' 					=> $this->l('The title of your object as it should appear within the graph, e.g., "The Rock".'),
				'tag' 					=> 'og:title'
			),
			2 => array(
				'config_name'		=> $this->_abbreviation . '_TYPE',
				'name'					=> strtolower($this->name) . '_type',
				'title'					=> $this->l('Open Graph tag type'),
				'type'					=> 'select', // boolean, text, radio, select, checkbox, none
				'validate'			=> 'isString',
				'default' 			=> '',
				'help' 					=> $this->l('The type of your object, e.g., "movie".'),
				'options' 			=> array(
					array('value' => 'activity',
					'name' => 'activity'),
					array('value' => 'sport',
					'name' => 'sport'),
					array('value' => 'bar',
					'name' => 'bar'),
					array('value' => 'company',
					'name' => 'company'),
					array('value' => 'cafe',
					'name' => 'cafe'),
					array('value' => 'hotel',
					'name' => 'hotel'),
					array('value' => 'restaurant',
					'name' => 'restaurant'),
					array('value' => 'cause',
					'name' => 'cause'),
					array('value' => 'sports_league',
					'name' => 'sports_league'),
					array('value' => 'sports_team',
					'name' => 'sports_team'),
					array('value' => 'band',
					'name' => 'band'),
					array('value' => 'government',
					'name' => 'government'),
					array('value' => 'non_profit',
					'name' => 'non_profit'),
					array('value' => 'school',
					'name' => 'school'),
					array('value' => 'university',
					'name' => 'university'),
					array('value' => 'actor',
					'name' => 'actor'),
					array('value' => 'athlete',
					'name' => 'athlete'),
					array('value' => 'author',
					'name' => 'author'),
					array('value' => 'director',
					'name' => 'director'),
					array('value' => 'musician',
					'name' => 'musician'),
					array('value' => 'politician',
					'name' => 'politician'),
					array('value' => 'public_figure',
					'name' => 'public_figure'),
					array('value' => 'city',
					'name' => 'city'),
					array('value' => 'country',
					'name' => 'country'),
					array('value' => 'landmark',
					'name' => 'landmark'),
					array('value' => 'state_province',
					'name' => 'state_province'),
					array('value' => 'album',
					'name' => 'album'),
					array('value' => 'book',
					'name' => 'book'),
					array('value' => 'drink',
					'name' => 'drink'),
					array('value' => 'food',
					'name' => 'food'),
					array('value' => 'game',
					'name' => 'game'),
					array('value' => 'product',
					'name' => 'product'),
					array('value' => 'song',
					'name' => 'song'),
					array('value' => 'movie',
					'name' => 'movie'),
					array('value' => 'tv_show',
					'name' => 'tv_show'),
					array('value' => 'blog',
					'name' => 'blog'),
					array('value' => 'website',
					'name' => 'website'),
					array('value' => 'article',
					'name' => 'article')
				),
				'tag' => 'og:type'
			),
			3 => array(
				'config_name' 	=> $this->_abbreviation . '_DESCRIPTION',
				'name'					=> strtolower($this->name) . '_description',
				'title' 				=> $this->l('Open Graph tag description'),
				'type'					=> 'textarea', // boolean, text, radio, select, checkbox, none
				'validate' 			=> 'isString',
				'default' 			=> '',
				'help'					=> $this->l('A one to two sentence description of your page.'),
				'tag'						=> 'og:description'
			),
			4 => array(
				'config_name'		=> $this->_abbreviation . '_DETERMINER',
				'name'					=> strtolower($this->name) . '_determiner',
				'title'					=> $this->l('Open Graph tag determiner'),
				'type'					=> 'text', // boolean, text, radio, select, checkbox, none
				'validate'			=> 'isString',
				'default'				=> '',
				'tag'						=> 'og:determiner'
			),
			5 => array(
				'config_name'		=> $this->_abbreviation . '_SITE_NAME',
				'name'					=> strtolower($this->name) . '_site_name',
				'title'					=> $this->l('Open Graph tag site name'),
				'type'					=> 'text', // boolean, text, radio, select, checkbox, none
				'validate'			=> 'isString',
				'default'				=> '',
				'help'					=> $this->l('A human-readable name for your site, e.g., "IMDb".'),
				'tag' 					=> 'og:site_name'
			),
			6 => array(
				'config_name'		=> $this->_abbreviation . '_LATITUDE',
				'name'					=> strtolower($this->name) . '_latitude',
				'title'					=> $this->l('Open Graph tag latitude'),
				'type'					=> 'text', // boolean, text, radio, select, checkbox, none
				'validate' 			=> 'isFloat',
				'default' 			=> '',
				'tag' 					=> 'og:latitude'
			),
			7 => array(
				'config_name'		=> $this->_abbreviation . '_LONGITUDE',
				'name'					=> strtolower($this->name) . '_longitude',
				'title'					=> $this->l('Open Graph tag longitude'),
				'type'					=> 'text', // boolean, text, radio, select, checkbox, none
				'validate' 			=> 'isFloat',
				'default' 			=> '',
				'tag' 					=> 'og:longitude'
			),
			8 => array(
				'config_name'		=> $this->_abbreviation . '_STREET_ADDRESS',
				'name'			=> strtolower($this->name) . '_street_address',
				'title'		=> $this->l('Open Graph tag street address'),
				'type'		=> 'text', // boolean, text, radio, select, checkbox, none
				'validate' => 'isString',
				'default' => '',
				'tag' => 'og:street_address'
			),
			9 => array(
				'config_name'		=> $this->_abbreviation . '_REGION',
				'name'			=> strtolower($this->name) . '_region',
				'title'		=> $this->l('Open Graph tag region'),
				'type'		=> 'text', // boolean, text, radio, select, checkbox, none
				'validate' => 'isString',
				'default' => '',
				'tag' => 'og:region'
			),
			10 => array(
				'config_name'		=> $this->_abbreviation . '_LOCALITY',
				'name'			=> strtolower($this->name) . '_locality',
				'title'		=> $this->l('Open Graph tag locality'),
				'type'		=> 'text', // boolean, text, radio, select, checkbox, none
				'validate' => 'isString',
				'default' => '',
				'tag' => 'og:locality'
			),
			11 => array(
				'config_name'			=> $this->_abbreviation . '_LOCALE',
				'name'				=> strtolower($this->name) . '_locale',
				'title'			=> $this->l('Facebook locales'),
				'type'			=> 'select', // boolean, text, radio, select, checkbox, none
				'validate'	=> 'isString',
				'default'		=> 'en_US',
				'options'		=> array(
					0 => array(
						'value'		=> 'none',
						'name'		=> $this->l('Choose your locale')
					)
				),
				'tag' => 'og:locale'
			),
			12 => array(
				'config_name'			=> $this->_abbreviation . '_LOCALE_ALTERNATE',
				'name'				=> strtolower($this->name) . '_locale_alternate',
				'title'			=> $this->l('Facebook locales alternate'),
				'type'			=> 'select', // boolean, text, radio, select, checkbox, none
				'validate'	=> 'isString',
				'default'		=> 'fr_FR',
				'options'		=> array(
					0 => array(
						'value'		=> 'none',
						'name'		=> $this->l('Choose your locale')
					)
				),
				'tag' => 'og:locale:alternate'
			),
			13 => array(
				'config_name'		=> $this->_abbreviation . '_POSTAL_CODE',
				'name'			=> strtolower($this->name) . '_postal_code',
				'title'		=> $this->l('Open Graph tag postal code'),
				'type'		=> 'text', // boolean, text, radio, select, checkbox, none
				'validate' => 'isPostCode',
				'default' => '',
				'tag' => 'og:postal-code'
			),
			14 => array(
				'config_name'		=> $this->_abbreviation . '_COUNTRY_NAME',
				'name'			=> strtolower($this->name) . '_country_name',
				'title'		=> $this->l('Open Graph tag country name'),
				'type'		=> 'text', // boolean, text, radio, select, checkbox, none
				'validate' => 'isString',
				'default' => '',
				'tag' => 'og:country-name'
			),
			15 => array(
				'config_name'		=> $this->_abbreviation . '_EMAIL',
				'name'			=> strtolower($this->name) . '_email',
				'title'		=> $this->l('Open Graph tag email'),
				'type'		=> 'text', // boolean, text, radio, select, checkbox, none
				'validate' => 'isEmail',
				'default' => '',
				'tag' => 'og:email'
			),
			16 => array(
				'config_name'		=> $this->_abbreviation . '_PHONE_NUMBER',
				'name'			=> strtolower($this->name) . '_phone_number',
				'title'		=> $this->l('Open Graph tag phone number'),
				'type'		=> 'text', // boolean, text, radio, select, checkbox, none
				'validate' => 'isPhoneNumber',
				'default' => '',
				'tag' => 'og:phone_number'
			),
			17 => array(
				'config_name'		=> $this->_abbreviation . '_FAX_NUMBER',
				'name'			=> strtolower($this->name) . '_fax_number',
				'title'		=> $this->l('Open Graph tag fax number'),
				'type'		=> 'text', // boolean, text, radio, select, checkbox, none
				'validate' => 'isPhoneNumber',
				'default' => '',
				'tag' => 'og:fax_number'
			),
			18 => array(
				'config_name'		=> $this->_abbreviation . '_IMAGE',
				'name'			=> strtolower($this->name) . '_image',
				'title'		=> $this->l('Open Graph tag image'),
				'type'		=> 'image', // boolean, text, radio, select, checkbox, none
				'validate' => false,
				'default' => '',
				'help' => $this->l('An image which should represent your object within the graph. The image must be at least 50px by 50px and have a maximum aspect ratio of 3:1. We support PNG, JPEG and GIF formats.'),
				'tag' => 'og:image'
			),
			19 => array(
				'config_name'		=> $this->_abbreviation . '_FB_ADMINS',
				'name'			=> strtolower($this->name) . '_fb_admins',
				'title'		=> $this->l('Open Graph fb admins'),
				'type'		=> 'text', // boolean, text, radio, select, checkbox, none
				'validate' => 'isInt',
				'default' => '',
				'help'		=> $this->l('A comma-separated list of either the Facebook IDs of page administrators'),
				'tag' => 'fb:admins'
			),
			20 => array(
				'config_name'		=> $this->_abbreviation . '_FB_APP_ID',
				'name'			=> strtolower($this->name) . '_fb_app_id',
				'title'		=> $this->l('Open Graph fb app id'),
				'type'		=> 'text', // boolean, text, radio, select, checkbox, none
				'validate' => 'isInt',
				'default' => '',
				'help'		=> $this->l('A comma-separated list of either Facebook Platform application ID'),
				'tag' => 'fb:app_id'
			)
		);

		// FACEBOOK LOCALES
		$fb_locales = $this->_getFacebookLocalesXML();
		if($fb_locales)
		{
			foreach($fb_locales AS $locale)
			{
				$this->_configs[11]['options'][] = array(
					'value' => $locale->codes->code->standard->representation,
					'name'	=> $locale->englishName
				);

				$this->_configs[12]['options'][] = array(
					'value' => $locale->codes->code->standard->representation,
					'name'	=> $locale->englishName
				);
			}
		}

		// GET META PAGES
		$meta_pages = Meta::getMetas();
		foreach($meta_pages as $meta_page)
		{
			$this->_configs[] = array(
				'config_name'	=> $this->_abbreviation . '_DEFAULT_ON_' . strtoupper($meta_page['page']),
				'name'				=> strtolower($this->name) . '_default_on_' . strtolower($meta_page['page']),
				'title'				=> $this->l('Use defaults open graph tags on page: ') . strtolower($meta_page['page']) . '.php' . $this->l('?'),
				'type'				=> 'boolean',
				'validate'		=> 'isBool',
				'default'			=> 0,
				'tag'
			);
		}

		$this->_hooks = array(
			1 => array(
				'name'		=> 'header',
				'insert'	=> false
			)
		);
	}

	public function getContent()
	{
		$output	 = '';
		$output .= $this->_postProcess();

		return $output.$this->displayForm();
	}

	public function displayForm()
	{
		global $smarty;

		foreach($this->_configs as $key => &$config)
		{
			if(!$config['type'])
				unset($this->_configs[$key]);
			else
				$config['value'] = Configuration::get($config['config_name']);
		}

		$smarty->assign('simpleXML_loaded', extension_loaded('SimpleXML'));
		$smarty->assign('simpleXML_needed', $this->l('This module need the SimpleXML extension'));
		$smarty->assign('settings', $this->l('Settings'));
		$smarty->assign('enabled', $this->l('Enabled'));
		$smarty->assign('disabled', $this->l('Disabled'));
		$smarty->assign('save', $this->l('Save'));
		$smarty->assign('action', Tools::safeOutput($_SERVER['REQUEST_URI']));
		$smarty->assign('display_name', $this->displayName);
		$smarty->assign('module_name', strtolower($this->name));
		$smarty->assign('module_dir', $this->_path);
		$smarty->assign('configs', $this->_configs);

		$cache_id = $compile_id = ($this->_debugView ? Tools::passwdGen(16) : null);
		return $smarty->fetch($this->_tplFile, $cache_id, $compile_id);
	}

	private function _postProcess()
	{
		$output = '';

		if(Tools::isSubmit('submit_' . strtolower($this->name)))
		{
			foreach($this->_configs as $config)
			{
				if($config['type'])
				{
					if($config['type'] == 'image')
					{
						// Upload image
						if (isset($_FILES[$config['name']]) AND isset($_FILES[$config['name']]['tmp_name']) AND !empty($_FILES[$config['name']]['tmp_name']))
						{
							if ($error = checkImage($_FILES[$config['name']], Tools::convertBytes(ini_get('upload_max_filesize'))))
								$errors .= $error;
							else
							{
								if($name = $this->_createPicture($_FILES[$config['name']], $this->_imgPath))
								{
									if(!Configuration::updateValue($config['config_name'], $name))
										return false;
								}
							}
						}
					}
					else
					{
						if(!Configuration::updateValue($config['config_name'], Tools::getValue($config['name'])))
							return false;
					}
				}
			}
			$output .= '<div class="conf confirm"><img src="../img/admin/ok.gif" alt="'.$this->l('Confirmation').'" />'.$this->l('Settings updated').'</div>';
		}

		return $output;
	}

	private function _getFacebookLocalesXML()
	{
		return @simplexml_load_file('https://www.facebook.com/translations/FacebookLocales.xml');
	}

	// ---------------------------
	// --------- HOOKS -----------
	// ---------------------------
	public function hookHeader($params)
	{
		global $smarty, $cookie, $link;

		$base_dir 	= $smarty->tpl_vars['base_dir']->value;
		$page_name	= $smarty->tpl_vars['page_name']->value;

		$metas = $confs = array();
		foreach($this->_configs AS $key => $config)
		{
			if(isset($config['tag']) && $config['tag'])
			{
				$metas[$key] = array();
				$metas[$key]['property'] = $config['tag'];

				if($config['tag'] == 'og:image')
				{
					if($page_name == 'product')
					{
						$product = new Product(Tools::getValue('id_product'));
						$cover = Product::getCover($product->id);
						$id_image = $cover['id_image'];
						$metas[$key]['content'] = $link->getImageLink($product->link_rewrite, $id_image);
					}
					elseif($page_name == 'category')
					{
						$category = new Category(Tools::getValue('id_category'));
						if($category->id_image)
							$metas[$key]['content'] = $link->getImageLink($category->link_rewrite, $category->id_image);
						else
						{
							$products = $category->getProducts($cookie->id_lang, 1, 5);
							if(count($products) == 1)
							{
								$product = new Product($products[0]['id_product']);
								$cover = Product::getCover($product->id);
								$id_image = $cover['id_image'];
								$metas[$key]['content'] = $link->getImageLink($product->link_rewrite, $id_image);
							}
							else
							{
								foreach($products as $product)
								{
									$product = new Product($product['id_product']);
									$cover = Product::getCover($product->id);
									$id_image = $cover['id_image'];
									$metas[] = array(
										'property' => 'og:image',
										'content'  => $link->getImageLink($product->link_rewrite, $id_image)
									);
								}
							}
						}
					}
					else
						$metas[$key]['content']	 = $base_dir . Configuration::get($config['config_name']);
				}
				elseif($config['tag'] == 'og:title')
				{
					if($page_name != 'index' && (!Configuration::get($this->_abbreviation . '_DEFAULT_ON_' . strtoupper($page_name))))
						$metas[$key]['content'] = $smarty->tpl_vars['meta_title']->value;
					else
						$metas[$key]['content'] = Configuration::get($config['config_name']);
				}
				elseif($config['tag'] == 'og:description')
				{
					if($page_name != 'index' && (!Configuration::get($this->_abbreviation . '_DEFAULT_ON_' . strtoupper($page_name))))
						$metas[$key]['content'] = $smarty->tpl_vars['meta_description']->value;
					else
						$metas[$key]['content']	 = Configuration::get($config['config_name']);
				}
				else
				{
					if(Configuration::get($config['config_name']) != '')
						$metas[$key]['content']	 = Configuration::get($config['config_name']);
					else
						unset($metas[$key]);
				}
			}
		}

		if(is_string($link))
		{
			$metas['og:url'] = array(
				'property' => 'og:url',
				'content' => $link
			);
		}

		$vars = array(
			'metas' 						=> $metas,
			'module_name' 			=> strtoupper($this->name),
			'use_dublin_core' 	=> Configuration::get($this->_abbreviation . '_USE_DUBLIN_CORE')
		);

		$smarty->assign('module_'. strtolower($this->name) . '_header' , $vars);

		return $this->display(__FILE__, $this->name . '.tpl');
	}

	// ---------------------------
	// --- INSTALL / UNINSTALL ---
	// ---------------------------
	public function install()
	{
		parent::install();

		foreach($this->_hooks as $hook)
		{
			if(!$this->registerHook($hook['name']))
				return false;
		}

		foreach($this->_configs as $config)
		{
			if(!Configuration::updateValue($config['config_name'], $config['default']))
				return false;
		}

		return true;
	}

	public function uninstall()
	{
		parent::uninstall();

		foreach($this->_configs as $config)
		{
			if(!Configuration::deleteByName($config['config_name']))
				return false;
		}

		return true;
	}

	// ---------------------------
	// --------- TOOLS -----------
	// ---------------------------
	private function _createPicture($file, $path, $action = null, $name = null, $with = null, $height = null)
	{
		$img = PhpThumbFactory::create($file['tmp_name']);

		if(!$name)
			$name = $file['name'];
		else
		{
			$ext = $this->_getFileExtension($file);
			$name .= $ext; 
		}

		if($action)
		{
			switch($action)
			{
				case 'cropFromCenter':
					if(!$width || !$height)
						return false;

					$img->cropFromCenter($width, $height);
					break;
				case 'resize':
					if(!$width || !$height)
						return false;

					$img->resize($width, $height);
					break;
				case 'adaptiveResize':
					if(!$width || !$height)
						return false;

					$img->adaptiveResize($width, $height);
			}
		}
		$fileName = $path . $name;

		$img->save($fileName);

		return $name;
	}

	private function _getFileExtension($file)
	{
		return strrchr($file['name'], '.');
	}

	private function _deleteFile($fileName)
	{
		if(file_exists($fileName))
			return unlink($fileName);
		else
			return false;
	}
}
?>