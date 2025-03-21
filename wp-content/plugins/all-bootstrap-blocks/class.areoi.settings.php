<?php
use ABB\ScssPhp\ScssPhp\Compiler;

class AREOI_Settings
{
	private static $initiated = false;
	public static $page;
	
	public static function init() {
		if ( ! self::$initiated ) {
			self::init_hooks();
		}
	}

	private static function init_hooks() 
	{
		self::$initiated = true;

		if ( is_admin() ) {

			add_action( 'admin_init', array( 'AREOI_Settings', 'register_settings' ) );
			add_action( 'admin_menu', array( 'AREOI_Settings', 'add_menu_items' ) );

			if ( 
				sanitize_text_field( !empty( $_GET['page'] ) ) && 
				strpos( sanitize_text_field( $_GET['page'] ), 'areoi-') !== false && 
				sanitize_text_field( !empty( $_GET['settings-updated'] ) ) && 
				sanitize_text_field( $_GET['settings-updated'] ) == true
			) {
				$save_type = !empty( $_GET['save_type'] ) ? sanitize_text_field( $_GET['save_type'] ) : 2;
				
				if ( $save_type != 1 ) self::compile_scss();
			}
		}
	}

	public static function register_settings()
	{
		$page 		= self::get_settings();

		register_setting( 'areoi', 'areoi-bootstrap-version' );

		foreach ( $page['children'] as $child_key => $child ) {
			if ( empty( $child['sections'] ) ) {
				continue;	
			}
			foreach ( $child['sections'] as $section_key => $section ) {
				
				if ( empty( $section['options'] ) ) {
					continue;	
				}

				foreach ( $section['options'] as $option_key => $option ) {
					if ( in_array( $option['input'], array( 'header', 'divider' ) ) ) {
						continue;
					}
					$args = array(
			            'type' 				=> 'string', 
			            'sanitize_callback' => 'sanitize_text_field',
			        );

					if ( !empty( $_POST ) && isset( $_POST['section'] ) && $_POST['section'] == $section['slug'] ) {
						register_setting( $child['slug'], $option['name'], $args );
					}
				}
			}
		}
	}

	public static function add_menu_items()
	{
		$page 		= self::get_settings();

		add_menu_page( 
			__( $page['name'], AREOI__TEXT_DOMAIN ), 
			$page['name'], 
			'manage_options', 
			$page['slug'], 
			array( 'AREOI_Settings', 'add_pages' ), 
			$page['icon'], 
			60
		);

		foreach ( $page['children'] as $child_key => $child ) {
			add_submenu_page( 
				$page['slug'], 
				$child['name'], 
				$child['name'], 
				'manage_options', 
				$child['slug'], 
				array( 'AREOI_Settings', 'add_pages' )
			);
		}

		add_submenu_page( 
			$page['slug'], 
			'Import / Export', 
			'Import / Export', 
			'manage_options', 
			'areoi-import-export', 
			array( 'AREOI_Settings', 'add_import_export' )
		);

		add_submenu_page( 
			$page['slug'], 
			'Reset Settings', 
			'Reset Settings', 
			'manage_options', 
			'areoi-reset_settings', 
			array( 'AREOI_Settings', 'add_reset_settings' )
		);

		add_submenu_page( 
			$page['slug'], 
			'Credits', 
			'Credits', 
			'manage_options', 
			'areoi-credits', 
			array( 'AREOI_Settings', 'add_credits' )
		);

		if ( areoi_is_lightspeed() ) {
			add_menu_page( 
				__( 'Lightspeed', AREOI__TEXT_DOMAIN ), 
				'Lightspeed', 
				'manage_options', 
				AREOI__PREPEND . '-lightspeed', 
				array( 'AREOI_Settings', 'add_pages' ), 
				'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAyNS40LjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiDQoJIHZpZXdCb3g9IjAgMCAxMDAgMTAwIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCAxMDAgMTAwOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQo8c3R5bGUgdHlwZT0idGV4dC9jc3MiPg0KCS5zdDB7ZmlsbDojQTdBQUFEO30NCjwvc3R5bGU+DQo8Zz4NCgk8cGF0aCBjbGFzcz0ic3QwIiBkPSJNNDUuOCwwLjlMMi42LDk5LjFsMCwwYzEzLjksMCwyNi41LTguNCwzMi4xLTIwLjlMNjguOCwwLjlINDUuOHoiLz4NCgk8cGF0aCBjbGFzcz0ic3QwIiBkPSJNNzMuNyw3Ni44YzkuMSwwLDE3LjQsMy41LDIzLjcsOS44TDczLjcsMzIuOUw1MCw4Ni42QzU2LjMsODEsNjQuNiw3Ni44LDczLjcsNzYuOHoiLz4NCjwvZz4NCjwvc3ZnPg0K', 
				60
			);
		}
	}

	public static function add_pages()
	{
		$page 		= self::get_settings();
		$active_page= $page['children']['areoi-dashboard'];
		if ( sanitize_text_field( !empty( $_GET['page'] ) ) && !empty( $page['children'][sanitize_text_field( $_GET['page'] )] ) ) {
			$active_page = $page['children'][sanitize_text_field( $_GET['page'] )];
		}
		$has_theme_json = areoi_get_theme_json();
        ?>

        <div class="areoi-container">
			<div class="areoi-container__content">

				<?php include( AREOI__PLUGIN_DIR . 'views/partials/sidebar.php' ); ?>

				<div style="max-width: 1550px; height: 100%;">
					<div class="areoi-container__body">
						
						<div class="areoi-header">
							<h2><?php echo esc_attr( $active_page['name'] ) ?></h2>
						</div><!-- .areoi-header -->

						<form method="post" action="options.php" enctype="multipart/form-data" class="areoi-form"> 
							<div class="areoi-body">

								<?php settings_fields( esc_attr( $active_page['slug'] ) ); ?>
								
								<?php include( AREOI__PLUGIN_DIR . 'views/partials/settings-section.php' ); ?>

							</div><!-- .areoi-body -->

						</form>

						<?php include( AREOI__PLUGIN_DIR . 'views/partials/areoi.php' ); ?>

						<div style="clear: both; display: block;"></div>

					</div><!-- .areoi-container__body -->

					<div class="areoi-form-button">
						<div class="areoi-form-button__body">

							<div class="areoi-form-button__group">
								<button class="button" data-type="1">Save Settings</button>
								<?php if ( areoi2_get_option( 'areoi-dashboard-global-bootstrap-css', true ) ) : ?>
									<button class="button button-primary" data-type="2">Save & Recompile CSS</button>
								<?php endif; ?>
							</div>

							<span class="spinner" style="float: none;"></span>

							<p class="areoi-form-button__alert">
								The CSS failed to compile. This is usually because of an invalid variable. Check your variable values and try again. 
							</p>
						</div><!-- .areoi-body -->
					</div><!-- .areoi-form-button -->
				</div>

			</div><!-- .areoi-container__content -->

		</div><!-- .areoi-container -->

        <?php
	}

	public static function add_import_export()
	{
		?>

		<div class="wrap">
			<h1 style="margin: 0 0 20px 0;">Import / Export</h1>
			<div style="width: 400px; margin: 0 20px 0 0;">
				<div id="areoi-admin-export" class="postbox">
					<div class="postbox-header">
						<h2 style="padding: 8px 12px;">Export Bootstrap Settings</h2>
					</div>
					<div class="inside">
						<p>Use the download button to export to a .json file which you can then import to another All Bootstrap Blocks installation.</p>
						
						<form method="post">
							<input type="hidden" name="areoi-export" value="1">
							<button class="button button-primary">Download</button>
						</form>
					</div>
				</div>
			</div>

			<div style="width: 400px; margin: 0 20px 0 0;">
				<div id="areoi-admin-export" class="postbox">
					<div class="postbox-header">
						<h2 style="padding: 8px 12px;">Import Bootstrap Settings</h2>
					</div>
					<div class="inside">
						<p>Export your Bootstrap settings from another instance of All Bootstrap Blocks then select the file and click import.</p>

						<form method="post" enctype="multipart/form-data">
							<input type="hidden" name="areoi-import" value="1">
							<p><input type="file" name="areoi-import-file"></p>
							<button class="button button-primary">Import</button>
						</form>
					</div>
				</div>
			</div>
		</div>

		<?php
	}

	public static function add_reset_settings()
	{
		?>

		<div class="wrap">
			<h1 style="margin: 0 0 20px 0;">Reset Settings</h1>
			<div style="width: 400px; margin: 0 20px 0 0;">
				<div id="areoi-admin-export" class="postbox">
					<div class="postbox-header">
						<h2 style="padding: 8px 12px;">Are you sure?</h2>
					</div>
					<div class="inside">
						<p>Clicking the button below will revert all of the settings to the Bootstrap defaults. This action cannot be undone so please be sure before you continue.</p>
						
						<form method="post">
							 <?php wp_nonce_field( 'areoi-reset', 'areoi-reset-nonce' ); ?>
							<input type="hidden" name="areoi-reset" value="1">
							<button class="button button-primary">Reset</button>
						</form>
					</div>
				</div>
			</div>
		</div>

		<?php
	}

	public static function add_credits()
	{
		$credits = array(
			'Mikhail Nilov' => 'https://www.pexels.com/@mikhail-nilov/',
			'Kateryna Babaieva' => 'https://www.pexels.com/@kateryna-babaieva-1423213/',
			'Tima Miroshnichenko' => 'https://www.pexels.com/@tima-miroshnichenko/',
			'Mike Sangma' => 'https://www.pexels.com/@mike-sangma-1611592/',
			'Prakash Chavda' => 'https://www.pexels.com/@praksh/',
			'Vraj Shah' => 'https://www.pexels.com/@vraj-shah-115200/',
			'Daryl Johnson' => 'https://www.pexels.com/@daryl-johnson-165513825/',
			'Dante Juhasz' => 'https://www.pexels.com/@dante-juhasz-62201650/',
			'Johannes Treier' => 'https://www.pexels.com/@johannes-treier-1312189/',
			'Ricardo Esquivel' => 'https://www.pexels.com/@rickyrecap/',
			'Ruvim Miksanskiy' => 'https://www.pexels.com/@digitech/',
			'Albin Berlin' => 'https://www.pexels.com/@albinberlin/',
			'Tom Fisk' => 'https://www.pexels.com/@tomfisk/',
			'Craig Adderley' => 'https://www.pexels.com/@thatguycraig000/',
			'Kelly' => 'https://www.pexels.com/@kelly-1179532/',
			'Ella Olsson' => 'https://www.pexels.com/@ella-olsson-572949/',
			'Javier Disabato' => 'https://www.pexels.com/@javier-disabato-2612346/',
			'Ray Piedra' => 'https://www.pexels.com/@craytive/',
			'Luna Lovegood' => 'https://www.pexels.com/@luna-lovegood/',
			'Polina Tankilevitch' => 'https://www.pexels.com/@polina-tankilevitch/',
			'Max Fischer' => 'https://www.pexels.com/@max-fischer/',
			'Yan Krukov' => 'https://www.pexels.com/@yankrukov/',
			'Pavel Danilyuk' => 'https://www.pexels.com/@pavel-danilyuk/',
			'Christina Morillo' => 'https://www.pexels.com/@divinetechygirl/',
			'Craig Dennis' => 'https://www.pexels.com/@craigmdennis/',
			'Andrea Piacquadio' => 'https://www.pexels.com/@olly/',
			'Pixabay' => 'https://www.pexels.com/@pixabay/',
			'Dima Krivoy' => 'https://www.pexels.com/@dima-krivoy-413413/',
			'Joseph Redfield' => 'https://www.pexels.com/@inforexplore/',
			'Chokniti Khongchum' => 'https://www.pexels.com/@chokniti-khongchum-1197604/',
			'Edward Jenner' => 'https://www.pexels.com/@edward-jenner/',
			'Daniel Frank' => 'https://www.pexels.com/@fr3nks/',
			'Pressmaster' => 'https://www.pexels.com/@pressmaster/',
			'Vadym Alyekseyenko' => 'https://www.pexels.com/@vadym-alyekseyenko-137433856/',
			'Life Of Pix' => 'https://www.pexels.com/@life-of-pix/',
			'Burst' => 'https://www.pexels.com/@burst/',
			'Free Videos' => 'https://www.pexels.com/@free-videos/',
			'CityXcape' => 'https://www.pexels.com/@cityxcape-1143586/',
			'Mikael Blomkvist' => 'https://www.pexels.com/@mikael-blomkvist/'
		);
		?>

		<div class="wrap">
			<h1 style="margin: 0 0 20px 0;">Credits</h1>
			<div style="width: 800px; margin: 0 20px 0 0;">
				<div class="areoi-card active areoi-card-branded" style="background: #7952b3;">
			      
			      <div class="areoi-card-body" style="width: 60%">
			         <p>
			            <img src="<?php echo esc_url( AREOI__PLUGIN_URI . 'assets/img/bootstrap-logo.svg' ) ?>" width="50">
			         </p>
			         <h2>Build fast, responsive sites with Bootstrap.</h2>
			         <p>Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>

			         <a href="https://getbootstrap.com/" target="_blank" class="areoi-button">Learn about Bootstrap</a>
			         <a href="https://getbootstrap.com/docs/5.1/getting-started/introduction/" target="_blank">Docs</a>
			      </div><!-- .areoi-card-body -->

			      <div class="areoi-card-body areoi-card-body-white" style="width: 40%; min-height: 300px;">
			         <h2>Thanks to Bootstrap</h2>
			         <p><strong>All Bootstrap Blocks</strong> is built using Bootstrap. This plugin makes use of the Bootstrap framework and their documentation.</p>
			         <p>Without the hard work from the Bootstrap team this plugin would not have been possible. If you're not familiar with Bootstrap then visit their site to learn more.</p>
			      </div><!-- .areoi-card-body -->
			   </div><!-- .areoi-card -->

			   <div class="areoi-card active areoi-card-branded" style="background: #000;">
			      
			      <div class="areoi-card-body" style="width: 60%">
			         <h2>Media Credits.</h2>
			         <p>All stock photography and video have been taken from pexels.com. The best free stock photos, royalty free images & videos shared by creators. All photos and videos from Pexels can be downloaded and used for free. You can view the license <a href="https://www.pexels.com/license/" target="_blank">here</a></p>

			         <a href="https://www.pexels.com/" target="_blank" class="areoi-button">Visit Pexels</a>
			         <a href="https://www.pexels.com/license/" target="_blank">View license</a>
			      </div><!-- .areoi-card-body -->

			      <div class="areoi-card-body areoi-card-body-white" style="width: 40%; height: 100%; min-height: 300px;">
			         <h2>Creative Credits</h2>
			         <p>
			         	<?php foreach ( $credits as $credit_key => $credit ) : ?>
				            <a style="width: 50%; float: left; display: block; margin: 0;" href="<?php echo $credit ?>" target="_blank"><?php echo $credit_key ?></a>
				        <?php endforeach; ?>
				        <span style="display: block; clear: both;"></span>
			         </p>
			      </div><!-- .areoi-card-body -->
			   </div><!-- .areoi-card -->
			</div>
		</div>

		<?php
	}

	public static function get_settings()
	{	
		// self::generate_settings();

		self::custom_colors();

		$rows = array(
			'name'		=> 'Bootstrap',
			'slug' 		=> AREOI__PREPEND . '-dashboard',
			'icon'		=> 'data:image/svg+xml;base64,PHN2ZyBzdHlsZT0iY29sb3I6ICNmZmY7IiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSIzMiIgY2xhc3M9ImQtYmxvY2sgbXktMSIgdmlld0JveD0iMCAwIDExOCA5NCIgcm9sZT0iaW1nIj48dGl0bGU+Qm9vdHN0cmFwPC90aXRsZT48cGF0aCBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGNsaXAtcnVsZT0iZXZlbm9kZCIgZD0iTTI0LjUwOSAwYy02LjczMyAwLTExLjcxNSA1Ljg5My0xMS40OTIgMTIuMjg0LjIxNCA2LjE0LS4wNjQgMTQuMDkyLTIuMDY2IDIwLjU3N0M4Ljk0MyAzOS4zNjUgNS41NDcgNDMuNDg1IDAgNDQuMDE0djUuOTcyYzUuNTQ3LjUyOSA4Ljk0MyA0LjY0OSAxMC45NTEgMTEuMTUzIDIuMDAyIDYuNDg1IDIuMjggMTQuNDM3IDIuMDY2IDIwLjU3N0MxMi43OTQgODguMTA2IDE3Ljc3NiA5NCAyNC41MSA5NEg5My41YzYuNzMzIDAgMTEuNzE0LTUuODkzIDExLjQ5MS0xMi4yODQtLjIxNC02LjE0LjA2NC0xNC4wOTIgMi4wNjYtMjAuNTc3IDIuMDA5LTYuNTA0IDUuMzk2LTEwLjYyNCAxMC45NDMtMTEuMTUzdi01Ljk3MmMtNS41NDctLjUyOS04LjkzNC00LjY0OS0xMC45NDMtMTEuMTUzLTIuMDAyLTYuNDg0LTIuMjgtMTQuNDM3LTIuMDY2LTIwLjU3N0MxMDUuMjE0IDUuODk0IDEwMC4yMzMgMCA5My41IDBIMjQuNTA4ek04MCA1Ny44NjNDODAgNjYuNjYzIDczLjQzNiA3MiA2Mi41NDMgNzJINDRhMiAyIDAgMDEtMi0yVjI0YTIgMiAwIDAxMi0yaDE4LjQzN2M5LjA4MyAwIDE1LjA0NCA0LjkyIDE1LjA0NCAxMi40NzQgMCA1LjMwMi00LjAxIDEwLjA0OS05LjExOSAxMC44OHYuMjc3Qzc1LjMxNyA0Ni4zOTQgODAgNTEuMjEgODAgNTcuODYzek02MC41MjEgMjguMzRINDkuOTQ4djE0LjkzNGg4LjkwNWM2Ljg4NCAwIDEwLjY4LTIuNzcyIDEwLjY4LTcuNzI3IDAtNC42NDMtMy4yNjQtNy4yMDctOS4wMTItNy4yMDd6TTQ5Ljk0OCA0OS4ydjE2LjQ1OEg2MC45MWM3LjE2NyAwIDEwLjk2NC0yLjg3NiAxMC45NjQtOC4yODEgMC01LjQwNi0zLjkwMy04LjE3OC0xMS40MjUtOC4xNzhINDkuOTQ4eiIgZmlsbD0iY3VycmVudENvbG9yIj48L3BhdGg+PC9zdmc+',
			'priority'	=> 60,
			'children'	=> array(
				AREOI__PREPEND . '-dashboard' => array(
					'name'		=> 'Dashboard',
					'slug' 		=> AREOI__PREPEND . '-dashboard',
					'icon'		=> '',
					'priority'	=> 60,
					'sections'	=> self::load_settings( 'dashboard' )
				),
			)
		);
		if ( areoi2_get_option( 'areoi-dashboard-global-bootstrap-css', 1 ) ) {
			$rows['children'][AREOI__PREPEND . '-customize'] = array(
				'name'		=> 'Customize',
				'slug' 		=> AREOI__PREPEND . '-customize',
				'icon'		=> '',
				'priority'	=> 60,
				'sections'	=> self::load_settings( 'customize' )
			);
			$rows['children'][AREOI__PREPEND . '-layout'] = array(
				'name'		=> 'Layout',
				'slug' 		=> AREOI__PREPEND . '-layout',
				'icon'		=> '',
				'priority'	=> 60,
				'sections'	=> self::load_settings( 'layout' )
			);
			$rows['children'][AREOI__PREPEND . '-content'] = array(
				'name'		=> 'Content',
				'slug' 		=> AREOI__PREPEND . '-content',
				'icon'		=> '',
				'priority'	=> 60,
				'sections'	=> self::load_settings( 'content' )
			);
			$rows['children'][AREOI__PREPEND . '-forms'] = array(
				'name'		=> 'Forms',
				'slug' 		=> AREOI__PREPEND . '-forms',
				'icon'		=> '',
				'priority'	=> 60,
				'sections'	=> self::load_settings( 'forms' )
			);
			$rows['children'][AREOI__PREPEND . '-components'] = array(
				'name'		=> 'Components',
				'slug' 		=> AREOI__PREPEND . '-components',
				'icon'		=> '',
				'priority'	=> 60,
				'sections'	=> self::load_settings( 'components' )
			);

			if ( areoi_is_lightspeed() ) {

				$rows['children'][AREOI__PREPEND . '-lightspeed'] = array(
					'name'		=> 'Lightspeed',
					'slug' 		=> AREOI__PREPEND . '-lightspeed',
					'icon'		=> '',
					'priority'	=> 60,
					'sections'	=> self::load_settings( 'lightspeed' )
				);
			}
		}

		return $rows;
	}

	public static function custom_colors()
    {
    	// Setup array of colors to be added
    	$colors = areoi_get_option_colors();
    	global $_wp_theme_features;
    	
		// Add new colors to wp
		add_theme_support( 'editor-color-palette', $colors );
    }

	public static function load_settings( $section )
	{
		$dir 	= AREOI__PLUGIN_DIR . 'settings/' . $section . '/';

		if ( !file_exists( $dir ) ) {
			return;
		}

		$files 	= scandir( $dir );
		array_shift( $files );
		array_shift( $files );

		$settings = array();

		if ( !empty( $files ) ) {
			foreach ( $files as $file_key => $file ) {
				$path 			= $dir . $file;
				$file_settings 	= require( $path );
				$file_data 		= get_file_data( $path, array( 'Name', 'Slug', 'Description', 'Position', 'Theme' ) );

				// Check theme is AREOI
				if ( $file_data[4] === 'true' ) {
					if ( !AREOI__IS_THEME ) {
					    continue;
					}
				}
				
				$new_section 	= array(
					'name' 			=> !empty( $file_data[0] ) ? $file_data[0] : '',
					'slug' 			=> !empty( $file_data[1] ) ? $file_data[1] : '',
					'description' 	=> !empty( $file_data[2] ) ? $file_data[2] : '',
					'position'		=> !empty( $file_data[3] ) ? $file_data[3] : '',
					'options'		=> $file_settings
				);
				$settings[] = $new_section;
			}
		}

		usort( $settings, function( $item1, $item2 ) {
		    return strcmp( $item1['name'], $item2['name'] );
		});

		return $settings;
	}

	public static function compile_scss()
	{	
		ini_set('max_execution_time', '300');
		
		$css_path 			= AREOI__PLUGIN_DIR . 'assets/css/';
		if ( !file_exists( $css_path ) ) {
			mkdir( $css_path );
		}

		// Update _variables-override.scss file
		$page 				= self::get_settings();
		$var_path 			= AREOI__PLUGIN_DIR . 'src/scss/bootstrap-' . AREOI__BOOTSTRAP_VERSION . '/_variables-override.scss';
		$var_content 		= '';
		$theme_json 		= areoi_get_theme_json();

		// Set default container widths to be overriden where neccessary
		$containers = array(
			'areoi-layout-container-container-max-width-sm' => '540px',
			'areoi-layout-container-container-max-width-md' => '720px',
			'areoi-layout-container-container-max-width-lg' => '960px',
			'areoi-layout-container-container-max-width-xl' => '1140px',
			'areoi-layout-container-container-max-width-xxl' => '1320px',
		);
		$breakpoints = array(
			'areoi-layout-grid-grid-breakpoint-xs' => '0',
			'areoi-layout-grid-grid-breakpoint-sm' => '576px',
			'areoi-layout-grid-grid-breakpoint-md' => '768px',
			'areoi-layout-grid-grid-breakpoint-lg' => '992px',
			'areoi-layout-grid-grid-breakpoint-xl' => '1200px',
			'areoi-layout-grid-grid-breakpoint-xxl' => '1400px',
		);


		foreach ( $page['children'] as $child_key => $child ) {
			if ( empty( $child['sections'] ) ) {
				continue;	
			}
			foreach ( $child['sections'] as $section_key => $section ) {
				
				if ( empty( $section['options'] ) ) {
					continue;	
				}
				foreach ( $section['options'] as $option_key => $option ) {

					if ( empty( $option['variable'] ) ) continue;

					$option_value 	= areoi2_get_option( $option['name'] );
					$is_theme_var 	= false;
					if ( $option_value && strpos( $option_value, 'theme-json-' ) !== false ) {
						$option_value = areoi_get_theme_json_value( $option_value );
						
						if ( $option_value || $option_value === 0 ) {
							$is_theme_var = true;
							$option_value ? $var_content .= $option['variable'] . ': ' . $option_value . ';' : null;
						}
						
					}
					if ( !$is_theme_var ) {
						($option_value || $option_value === '0') ? $var_content .= $option['variable'] . ': ' . $option_value . ';' : null;
					}

					if ( $option_value && !empty( $containers[$option['name']] ) ) {
						$containers[$option['name']] = $option_value;
					}
					if ( $option_value && !empty( $breakpoints[$option['name']] ) ) {
						$breakpoints[$option['name']] = $option_value;
					}
				}
			}
		}

		$var_content .= '$grid-breakpoints: (
		  xs: ' . $breakpoints['areoi-layout-grid-grid-breakpoint-xs'] . ',
		  sm: ' . $breakpoints['areoi-layout-grid-grid-breakpoint-sm'] . ',
		  md: ' . $breakpoints['areoi-layout-grid-grid-breakpoint-md'] . ',
		  lg: ' . $breakpoints['areoi-layout-grid-grid-breakpoint-lg'] . ',
		  xl: ' . $breakpoints['areoi-layout-grid-grid-breakpoint-xl'] . ',
		  xxl: ' . $breakpoints['areoi-layout-grid-grid-breakpoint-xxl'] . '
		);';

		$var_content .= '$container-max-widths: (
		  sm: ' . $containers['areoi-layout-container-container-max-width-sm'] . ',
		  md: ' . $containers['areoi-layout-container-container-max-width-md'] . ',
		  lg: ' . $containers['areoi-layout-container-container-max-width-lg'] . ',
		  xl: ' . $containers['areoi-layout-container-container-max-width-xl'] . ',
		  xxl: ' . $containers['areoi-layout-container-container-max-width-xxl'] . '
		);';

		$var_content .= '$theme-colors: (
		  "primary":    $primary,
		  "secondary":  $secondary,
		  "success":    $success,
		  "info":       $info,
		  "warning":    $warning,
		  "danger":     $danger,
		  "light":      $light,
		  "dark":       $dark
		);

		$primary-text:            shade-color( $primary, 20% );
		$secondary-text:          shade-color( $secondary, 20% );
		$success-text:            shade-color( $success, 20% );
		$info-text:               shade-color( $info, 20% );
		$warning-text:            shade-color( $warning, 20% );
		$danger-text:             shade-color( $danger, 20% );
		$light-text:              shade-color( $light, 20% );
		$dark-text:               shade-color( $dark, 20% );

		$primary-bg-subtle:       tint-color( $primary, 80% );
		$secondary-bg-subtle:     tint-color( $secondary, 80% );
		$success-bg-subtle:       tint-color( $success, 80% );
		$info-bg-subtle:          tint-color( $info, 80% );
		$warning-bg-subtle:       tint-color( $warning, 80% );
		$danger-bg-subtle:        tint-color( $danger, 80% );
		$light-bg-subtle:         tint-color( $light, 80% );
		$dark-bg-subtle:          tint-color( $dark, 80% );

		$primary-border-subtle:   tint-color( $primary, 60% );
		$secondary-border-subtle: tint-color( $secondary, 60% );
		$success-border-subtle:   tint-color( $success, 60% );
		$info-border-subtle:      tint-color( $info, 60% );
		$warning-border-subtle:   tint-color( $warning, 60% );
		$danger-border-subtle:    tint-color( $danger, 60% );
		$light-border-subtle:     shade-color( $light, 20% );
		$dark-border-subtle:      tint-color( $dark, 60% );

		$accordion-button-icon:         url("data:image/svg+xml,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 16 16\' fill=\'#{$accordion-icon-color}\'><path fill-rule=\'evenodd\' d=\'M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z\'/></svg>");
$accordion-button-active-icon:  url("data:image/svg+xml,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 16 16\' fill=\'#{$accordion-icon-active-color}\'><path fill-rule=\'evenodd\' d=\'M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z\'/></svg>");

		';

		// file_put_contents( $var_path, $var_content );
		file_put_contents( $var_path, apply_filters( 'areoi-overwrite-vars', $var_content ) );

		try {
			// Recompile css file
			$existing_path 		= AREOI__PLUGIN_DIR . 'src/scss/bootstrap-' . AREOI__BOOTSTRAP_VERSION . '/bootstrap.scss';
			$existing_content 	= file_get_contents( $existing_path );
			$compiler 			= new Compiler();
			$compiler->setImportPaths( AREOI__PLUGIN_DIR . 'src/scss/bootstrap-' . AREOI__BOOTSTRAP_VERSION );
			$compiler->setOutputStyle( ABB\ScssPhp\ScssPhp\OutputStyle::COMPRESSED );
			$output_content 	= $compiler->compileString($existing_content)->getCss();
			$output_path 		= AREOI__PLUGIN_DIR . 'assets/css/bootstrap.min.css';
			file_put_contents( $output_path, $output_content );

			// Editor css
			$existing_path 		= AREOI__PLUGIN_DIR . 'src/scss/bootstrap-' . AREOI__BOOTSTRAP_VERSION . '/editor-bootstrap.scss';
			$existing_content 	= file_get_contents( $existing_path );
			$output_content 	= $compiler->compileString($existing_content)->getCss();
			$output_path 		= AREOI__PLUGIN_DIR . 'assets/css/editor-bootstrap.min.css';
			file_put_contents( $output_path, $output_content );

			// Save new version number in options table
			$version = areoi2_get_option( 'areoi-bootstrap-version' ) ? ( areoi2_get_option( 'areoi-bootstrap-version' ) + 1 ) : 1;
			update_option( 'areoi-bootstrap-version', $version );
			update_option( 'areoi-theme-json-updated', time() );
		} catch ( \Exception $e ) {
			
			if ( !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
				header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
				echo esc_attr( $e->getMessage() ); die;
			} else {
				add_action('admin_notices', function() use ( $e ) {
					global $pagenow;
					echo '<div class="notice notice-error is-dismissible">
						<p>There was an issue recompiling your Bootstrap CSS. Please check the values in your theme.json that correspond to the following eror message: <code>' . $e->getMessage() . '</code>.</p>
					</div>';
				});
			}
		}
	}
}
