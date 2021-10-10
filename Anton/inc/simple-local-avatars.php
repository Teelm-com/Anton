<?php
/**
 * Class: Simple_Local_Avatars
 * Adds an avatar upload field to user profiles.
 */
class Simple_Local_Avatars {
	private $user_id_being_edited, $avatar_upload_error, $remove_nonce, $avatar_ratings;
	public $options;

	/**
	 * Set up the hooks and default values
	 */
	public function __construct() {
		$this->options        = (array) get_option( 'simple_local_avatars' );
		$this->avatar_ratings = array(
			'G'  => 'G &#8212; 适合所有人',
			'PG' => 'PG &#8212; 可能令人反感，通常针对13岁以上观众',
			'R'  => 'R &#8212; 适用于17岁以上的成人',
			'X'  => 'X &#8212; 比以上更开放',
		);

		$this->add_hooks();
	}

	/**
	 * Register actions and filters.
	 */
	public function add_hooks() {
		add_filter( 'pre_get_avatar_data', array( $this, 'get_avatar_data' ), 10, 2 );

		add_action( 'admin_init', array( $this, 'admin_init' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		add_action( 'show_user_profile', array( $this, 'edit_user_profile' ) );
		add_action( 'edit_user_profile', array( $this, 'edit_user_profile' ) );

		add_action( 'personal_options_update', array( $this, 'edit_user_profile_update' ) );
		add_action( 'edit_user_profile_update', array( $this, 'edit_user_profile_update' ) );
		add_action( 'admin_action_remove-simple-local-avatar', array( $this, 'action_remove_simple_local_avatar' ) );
		add_action( 'wp_ajax_assign_simple_local_avatar_media', array( $this, 'ajax_assign_simple_local_avatar_media' ) );
		add_action( 'wp_ajax_remove_simple_local_avatar', array( $this, 'action_remove_simple_local_avatar' ) );
		add_action( 'user_edit_form_tag', array( $this, 'user_edit_form_tag' ) );

		add_action( 'rest_api_init', array( $this, 'register_rest_fields' ) );
	}

	public function get_avatar( $avatar = '', $id_or_email = '', $size = 96, $default = '', $alt = '', $args = array() ) {
		return apply_filters( 'simple_local_avatar', get_avatar( $id_or_email, $size, $default, $alt, $args ) );
	}

	public function get_avatar_data( $args, $id_or_email ) {
		if ( ! empty( $args['force_default'] ) ) {
			return $args;
		}

		$simple_local_avatar_url = $this->get_simple_local_avatar_url( $id_or_email, $args['size'] );
		if ( $simple_local_avatar_url ) {
			$args['url'] = $simple_local_avatar_url;
		}

		// Local only mode
		if ( ! $simple_local_avatar_url && ! empty( $this->options['only'] ) ) {
			$args['url'] = $this->get_default_avatar_url( $args['size'] );
		}

		if ( ! empty( $args['url'] ) ) {
			$args['found_avatar'] = true;
		}

		return $args;
	}

	public function get_simple_local_avatar_url( $id_or_email, $size ) {
		if ( is_numeric( $id_or_email ) ) {
			$user_id = (int) $id_or_email;
		} elseif ( is_string( $id_or_email ) && ( $user = get_user_by( 'email', $id_or_email ) ) ) {
			$user_id = $user->ID;
		} elseif ( is_object( $id_or_email ) && ! empty( $id_or_email->user_id ) ) {
			$user_id = (int) $id_or_email->user_id;
		} elseif ( $id_or_email instanceof WP_Post && ! empty( $id_or_email->post_author ) ) {
			$user_id = (int) $id_or_email->post_author;
		}

		if ( empty( $user_id ) ) {
			return '';
		}

		// Fetch local avatar from meta and make sure it's properly set.
		$local_avatars = get_user_meta( $user_id, 'simple_local_avatar', true );
		if ( empty( $local_avatars['full'] ) ) {
			return '';
		}

		// check rating
		$avatar_rating = get_user_meta( $user_id, 'simple_local_avatar_rating', true );
		if ( ! empty( $avatar_rating ) && 'G' !== $avatar_rating && ( $site_rating = get_option( 'avatar_rating' ) ) ) {
			$ratings              = array_keys( $this->avatar_ratings );
			$site_rating_weight   = array_search( $site_rating, $ratings );
			$avatar_rating_weight = array_search( $avatar_rating, $ratings );
			if ( false !== $avatar_rating_weight && $avatar_rating_weight > $site_rating_weight ) {
				return '';
			}
		}

		// handle "real" media
		if ( ! empty( $local_avatars['media_id'] ) ) {
			// has the media been deleted?
			if ( ! $avatar_full_path = get_attached_file( $local_avatars['media_id'] ) ) {
				return '';
			}
		}

		$size = (int) $size;

		// Generate a new size.
		if ( ! array_key_exists( $size, $local_avatars ) ) {
			$local_avatars[ $size ] = $local_avatars['full']; // just in case of failure elsewhere

			// allow automatic rescaling to be turned off
			if ( apply_filters( 'simple_local_avatars_dynamic_resize', true ) ) :

				$upload_path = wp_upload_dir();

				// get path for image by converting URL, unless its already been set, thanks to using media library approach
				if ( ! isset( $avatar_full_path ) ) {
					$avatar_full_path = str_replace( $upload_path['baseurl'], $upload_path['basedir'], $local_avatars['full'] );
				}

				// generate the new size
				$editor = wp_get_image_editor( $avatar_full_path );
				if ( ! is_wp_error( $editor ) ) {
					$resized = $editor->resize( $size, $size, true );
					if ( ! is_wp_error( $resized ) ) {
						$dest_file = $editor->generate_filename();
						$saved     = $editor->save( $dest_file );
						if ( ! is_wp_error( $saved ) ) {
							$local_avatars[ $size ] = str_replace( $upload_path['basedir'], $upload_path['baseurl'], $dest_file );
						}
					}
				}

				// save updated avatar sizes
				update_user_meta( $user_id, 'simple_local_avatar', $local_avatars );

			endif;
		}

		if ( 'http' !== substr( $local_avatars[ $size ], 0, 4 ) ) {
			$local_avatars[ $size ] = home_url( $local_avatars[ $size ] );
		}

		return esc_url( $local_avatars[ $size ] );
	}

	/**
	 * Get default avatar url
	 *
	 * @since 2.2.0
	 *
	 * @param int $size Requested avatar size.
	 */
	public function get_default_avatar_url( $size ) {
		if ( empty( $default ) ) {
			$avatar_default = get_option( 'avatar_default' );
			if ( empty( $avatar_default ) ) {
				$default = 'mystery';
			} else {
				$default = $avatar_default;
			}
		}

		$host = is_ssl() ? 'https://secure.gravatar.com' : 'http://0.gravatar.com';

		if ( 'mystery' === $default ) {
			$default = "$host/avatar/ad516503a11cd5ca435acc9bb6523536?s={$size}"; // ad516503a11cd5ca435acc9bb6523536 == md5('unknown@gravatar.com')
		} elseif ( 'blank' === $default ) {
			$default = includes_url( 'images/blank.gif' );
		} elseif ( 'gravatar_default' === $default ) {
			$default = "$host/avatar/?s={$size}";
		} else {
			$default = "$host/avatar/?d=$default&amp;s={$size}";
		}

		return $default;
	}

	/**
	 * Register admin settings.
	 */
	public function admin_init() {
		// upgrade pre 2.0 option
		if ( $old_ops = get_option( 'simple_local_avatars_caps' ) ) {
			if ( ! empty( $old_ops['simple_local_avatars_caps'] ) ) {
				update_option( 'simple_local_avatars', array( 'caps' => 1 ) );
			}

			delete_option( 'simple_local_avatar_caps' );
		}

		register_setting( 'discussion', 'simple_local_avatars', array( $this, 'sanitize_options' ) );
		add_settings_field(
			'simple-local-avatars-only',
			'仅限本地头像',
			array( $this, 'avatar_settings_field' ),
			'discussion',
			'avatars',
			array(
				'key'  => 'only',
				'desc' => '仅允许本地头像（仍使用Gravatar作为默认头像）',
			)
		);
		add_settings_field(
			'simple-local-avatars-caps',
			'本地上传权限',
			array( $this, 'avatar_settings_field' ),
			'discussion',
			'avatars',
			array(
				'key'  => 'caps',
				'desc' => '仅允许具有文件上传功能的用户上传本地头像（作者及更高版本）',
			)
		);
	}

	/**
	 * 将脚本添加到配置文件编辑页面
	 *
	 * @param string $hook_suffix Page hook
	 */
	public function admin_enqueue_scripts( $hook_suffix ) {
		if ( 'profile.php' !== $hook_suffix && 'user-edit.php' !== $hook_suffix ) {
			return;
		}

		if ( current_user_can( 'upload_files' ) ) {
			wp_enqueue_media();
		}

		$user_id = ( 'profile.php' === $hook_suffix ) ? get_current_user_id() : (int) $_GET['user_id'];

		$this->remove_nonce = wp_create_nonce( 'remove_simple_local_avatar_nonce' );

		$script_name_append = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '.dev' : '';
		wp_enqueue_script( 'simple-local-avatars', get_bloginfo('template_url'). '/assets/js/simple-local-avatars' . $script_name_append . '.js', array( 'jquery' ), false, true );
		wp_localize_script(
			'simple-local-avatars',
			'i10n_SimpleLocalAvatars',
			array(
				'user_id'          => $user_id,
				'insertMediaTitle' => '选择头像',
				'insertIntoPost'   => '设置头像',
				'deleteNonce'      => $this->remove_nonce,
				'mediaNonce'       => wp_create_nonce( 'assign_simple_local_avatar_nonce' ),
			)
		);
	}

	/**
	 * 保存前清理新设置字段
	 *
	 * @param  array|string $input Passed input values to sanitize
	 * @return array|string Sanitized input fields
	 */
	public function sanitize_options( $input ) {
		$new_input['caps'] = empty( $input['caps'] ) ? 0 : 1;
		$new_input['only'] = empty( $input['only'] ) ? 0 : 1;
		return $new_input;
	}

	/**
	 * 头像上传功能的设置字段
	 *
	 * @param array $args Field arguments
	 */
	public function avatar_settings_field( $args ) {
		$args = wp_parse_args(
			$args,
			array(
				'key'  => '',
				'desc' => '',
			)
		);

		if ( empty( $this->options[ $args['key'] ] ) ) {
			$this->options[ $args['key'] ] = 0;
		}

		echo '
			<label for="simple-local-avatars-' . esc_attr( $args['key'] ) . '">
				<input type="checkbox" name="simple_local_avatars[' . esc_attr( $args['key'] ) . ']" id="simple-local-avatars-' . esc_attr( $args['key'] ) . '" value="1" ' . checked( $this->options[ $args['key'] ], 1, false ) . ' />
				' . esc_html( $args['desc'] ) . '
			</label>
		';
	}

	/**
	 * 将新的头像字段输出到用户编辑/配置文件屏幕
	 *
	 * @param object $profileuser User object
	 */
	public function edit_user_profile( $profileuser ) {
	?>
	<div id="simple-local-avatar-section">
		<h3>头像设置</h3>

		<table class="form-table">
			<tr class="upload-avatar-row">
				<th scope="row"><label for="simple-local-avatar">上传头像</label></th>
				<td style="width: 50px;" id="simple-local-avatar-photo">
			<?php
			add_filter( 'pre_option_avatar_rating', '__return_null' );     // ignore ratings here
			echo get_simple_local_avatar( $profileuser->ID );
			remove_filter( 'pre_option_avatar_rating', '__return_null' );
			?>
				</td>
				<td>
			<?php
			if ( ! $upload_rights = current_user_can( 'upload_files' ) ) {
				$upload_rights = empty( $this->options['caps'] );
			}

			if ( $upload_rights ) {
				do_action( 'simple_local_avatar_notices' );
				wp_nonce_field( 'simple_local_avatar_nonce', '_simple_local_avatar_nonce', false );
				$remove_url = add_query_arg(
					array(
						'action'   => 'remove-simple-local-avatar',
						'user_id'  => $profileuser->ID,
						'_wpnonce' => $this->remove_nonce,
					)
				);
				?>
				<?php
				// if user is author and above hide the choose file option
				// force them to use the WP Media Selector
				if ( ! current_user_can( 'upload_files' ) ) {
					?>
						<p style="display: inline-block; width: 26em;">
							<span class="description">从您的计算机中选择一个图像：</span><br />
							<input type="file" name="simple-local-avatar" id="simple-local-avatar" class="standard-text" />
							<span class="spinner" id="simple-local-avatar-spinner"></span>
						</p>
				<?php } ?>
						<p>
						<?php if ( current_user_can( 'upload_files' ) && did_action( 'wp_enqueue_media' ) ) : ?>
							<a href="#" class="button hide-if-no-js" id="simple-local-avatar-media">从媒体库中选择</a> &nbsp;
						<?php endif; ?>
							<a
								href="<?php echo esc_url( $remove_url ); ?>"
								class="button item-delete submitdelete deletion"
								id="simple-local-avatar-remove"
								<?php echo empty( $profileuser->simple_local_avatar ) ? ' style="display:none;"' : ''; ?>
							>
							删除本地头像
							</a>
						</p>
				<?php
			} else {
				if ( empty( $profileuser->simple_local_avatar ) ) {
					echo '<span class="description">未设置本地头像。 在Gravatar.com上设置您的头像。</span>';
				} else {
					echo '<span class="description">您没有媒体管理权限。 要更改您的本地头像，请与博客管理员联系。</span>';
				}
			}
			?>
				</td>
			</tr>
			<tr class="ratings-row">
				<th scope="row">评分</th>
				<td colspan="2">
					<fieldset id="simple-local-avatar-ratings" <?php disabled( empty( $profileuser->simple_local_avatar ) ); ?>>
						<legend class="screen-reader-text"><span>评分</span></legend>
					<?php
					if ( empty( $profileuser->simple_local_avatar_rating ) || ! array_key_exists( $profileuser->simple_local_avatar_rating, $this->avatar_ratings ) ) {
						$profileuser->simple_local_avatar_rating = 'G';
					}

					foreach ( $this->avatar_ratings as $key => $rating ) :
						echo "\n\t<label><input type='radio' name='simple_local_avatar_rating' value='" . esc_attr( $key ) . "' " . checked( $profileuser->simple_local_avatar_rating, $key, false ) . "/> $rating</label><br />";
					endforeach;
					?>
						<p class="description">如果本地头像不适用于此站点，将尝试使用Gravatar。</p>
					</fieldset></td>
			</tr>
		</table>
	</div>
	<?php
	}

	/**
	 * Ensure that the profile form has proper encoding type
	 */
	public function user_edit_form_tag() {
		echo 'enctype="multipart/form-data"';
	}

	/**
	 * Saves avatar image to a user
	 *
	 * @param int|string $url_or_media_id Local URL for avatar or ID of attachment
	 * @param int        $user_id         ID of user to assign image to
	 */
	public function assign_new_user_avatar( $url_or_media_id, $user_id ) {
		// delete the old avatar
		$this->avatar_delete( $user_id );    // delete old images if successful

		$meta_value = array();

		// set the new avatar
		if ( is_int( $url_or_media_id ) ) {
			$meta_value['media_id'] = $url_or_media_id;
			$url_or_media_id        = wp_get_attachment_url( $url_or_media_id );
		}

		$meta_value['full'] = $url_or_media_id;

		update_user_meta( $user_id, 'simple_local_avatar', $meta_value );    // save user information (overwriting old)
	}

	/**
	 * Save any changes to the user profile
	 *
	 * @param int $user_id ID of user being updated
	 */
	public function edit_user_profile_update( $user_id ) {
		// check nonces
		if ( empty( $_POST['_simple_local_avatar_nonce'] ) || ! wp_verify_nonce( $_POST['_simple_local_avatar_nonce'], 'simple_local_avatar_nonce' ) ) {
			return;
		}

		// check for uploaded files
		if ( ! empty( $_FILES['simple-local-avatar']['name'] ) ) :

			// need to be more secure since low privelege users can upload
			if ( false !== strpos( $_FILES['simple-local-avatar']['name'], '.php' ) ) {
				$this->avatar_upload_error = '出于安全原因，扩展名“ .php”不能位于您的文件名中。';
				add_action( 'user_profile_update_errors', array( $this, 'user_profile_update_errors' ) );
				return;
			}

			// front end (theme my profile etc) support
			if ( ! function_exists( 'media_handle_upload' ) ) {
				include_once ABSPATH . 'wp-admin/includes/media.php';
			}

			// allow developers to override file size upload limit for avatars
			add_filter( 'upload_size_limit', array( $this, 'upload_size_limit' ) );

			$this->user_id_being_edited = $user_id; // make user_id known to unique_filename_callback function
			$avatar_id                  = media_handle_upload(
				'simple-local-avatar',
				0,
				array(),
				array(
					'mimes'                    => array(
						'jpg|jpeg|jpe' => 'image/jpeg',
						'gif'          => 'image/gif',
						'png'          => 'image/png',
					),
					'test_form'                => false,
					'unique_filename_callback' => array( $this, 'unique_filename_callback' ),
				)
			);

			remove_filter( 'upload_size_limit', array( $this, 'upload_size_limit' ) );

			if ( is_wp_error( $avatar_id ) ) { // handle failures.
				$this->avatar_upload_error = '<strong>上传头像时出错：</strong> ' . esc_html( $avatar_id->get_error_message() );
				add_action( 'user_profile_update_errors', array( $this, 'user_profile_update_errors' ) );
				return;
			}

			$this->assign_new_user_avatar( $avatar_id, $user_id );

		endif;

		// Handle ratings
		if ( isset( $avatar_id ) || $avatar = get_user_meta( $user_id, 'simple_local_avatar', true ) ) {
			if ( empty( $_POST['simple_local_avatar_rating'] ) || ! array_key_exists( $_POST['simple_local_avatar_rating'], $this->avatar_ratings ) ) {
				$_POST['simple_local_avatar_rating'] = key( $this->avatar_ratings );
			}

			update_user_meta( $user_id, 'simple_local_avatar_rating', $_POST['simple_local_avatar_rating'] );
		}
	}

	/**
	 * Allow developers to override the maximum allowable file size for avatar uploads
	 *
	 * @param  int $bytes WordPress default byte size check
	 * @return int Maximum byte size
	 */
	public function upload_size_limit( $bytes ) {
		return apply_filters( 'simple_local_avatars_upload_limit', $bytes );
	}

	/**
	 * Runs when a user clicks the Remove button for the avatar
	 */
	public function action_remove_simple_local_avatar() {
		if ( ! empty( $_GET['user_id'] ) && ! empty( $_GET['_wpnonce'] ) && wp_verify_nonce( $_GET['_wpnonce'], 'remove_simple_local_avatar_nonce' ) ) {
			$user_id = (int) $_GET['user_id'];

			if ( ! current_user_can( 'edit_user', $user_id ) ) {
				wp_die( '您无权编辑此用户。' );
			}

			$this->avatar_delete( $user_id );    // delete old images if successful

			if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
				echo get_simple_local_avatar( $user_id );
			}
		}

		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			die;
		}
	}

	/**
	 * AJAX callback for assigning media ID fetched from media library to user
	 */
	public function ajax_assign_simple_local_avatar_media() {
		// check required information and permissions
		if ( empty( $_POST['user_id'] ) || empty( $_POST['media_id'] ) || ! current_user_can( 'upload_files' ) || ! current_user_can( 'edit_user', $_POST['user_id'] ) || empty( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'assign_simple_local_avatar_nonce' ) ) {
			die;
		}

		$media_id = (int) $_POST['media_id'];
		$user_id  = (int) $_POST['user_id'];

		// ensure the media is real is an image
		if ( wp_attachment_is_image( $media_id ) ) {
			$this->assign_new_user_avatar( $media_id, $user_id );
		}

		echo get_simple_local_avatar( $user_id );

		die;
	}

	public function avatar_delete( $user_id ) {

	/**
	 * Delete avatars based on a user_id
	 */
		$old_avatars = (array) get_user_meta( $user_id, 'simple_local_avatar', true );

		if ( empty( $old_avatars ) ) {
			return;
		}

		// if it was uploaded media, don't erase the full size or try to erase an the ID
		if ( array_key_exists( 'media_id', $old_avatars ) ) {
			unset( $old_avatars['media_id'], $old_avatars['full'] );
		}

		if ( ! empty( $old_avatars ) ) {
			$upload_path = wp_upload_dir();

			foreach ( $old_avatars as $old_avatar ) {
				// derive the path for the file based on the upload directory
				$old_avatar_path = str_replace( $upload_path['baseurl'], $upload_path['basedir'], $old_avatar );
				if ( file_exists( $old_avatar_path ) ) {
					unlink( $old_avatar_path );
				}
			}
		}

		delete_user_meta( $user_id, 'simple_local_avatar' );
		delete_user_meta( $user_id, 'simple_local_avatar_rating' );
	}

	/**
	 * Creates a unique, meaningful file name for uploaded avatars.
	 */
	public function unique_filename_callback( $dir, $name, $ext ) {
		$user = get_user_by( 'id', (int) $this->user_id_being_edited );
		$name = $base_name = sanitize_file_name( $user->display_name . '_avatar_' . time() );

		// ensure no conflicts with existing file names
		$number = 1;
		while ( file_exists( $dir . "/$name$ext" ) ) {
			$name = $base_name . '_' . $number;
			$number++;
		}

		return $name . $ext;
	}

	/**
	 * Adds errors based on avatar upload problems.
	 *
	 * @param WP_Error $errors Error messages for user profile screen.
	 */
	public function user_profile_update_errors( WP_Error $errors ) {
		$errors->add( 'avatar_error', $this->avatar_upload_error );
	}

	/**
	 * Registers the simple_local_avatar field in the REST API.
	 */
	public function register_rest_fields() {
		register_rest_field(
			'user',
			'simple_local_avatar',
			array(
				'get_callback'    => array( $this, 'get_avatar_rest' ),
				'update_callback' => array( $this, 'set_avatar_rest' ),
				'schema'          => array(
					'description' => 'The users simple local avatar',
					'type'        => 'object',
				),
			)
		);
	}

	/**
	 * Returns the simple_local_avatar meta key for the given user.
	 *
	 * @param object $user User object
	 */
	public function get_avatar_rest( $user ) {
		$local_avatar = get_user_meta( $user['id'], 'simple_local_avatar', true );
		if ( empty( $local_avatar ) ) {
			return;
		}
		return $local_avatar;
	}

	/**
	 * Updates the simple local avatar from a REST request.
	 *
	 * Since we are just adding a field to the existing user endpoint
	 * we don't need to worry about ensuring the calling user has proper permissions.
	 * Only the user or an administrator would be able to change the avatar.
	 *
	 * @param array  $input Input submitted via REST request.
	 * @param object $user  The user making the request.
	 */
	public function set_avatar_rest( $input, $user ) {
		$this->assign_new_user_avatar( $input['media_id'], $user->ID );
	}

}




function get_simple_local_avatar( $id_or_email, $size = 96, $default = '', $alt = '', $args = array() ) {
	return apply_filters( 'simple_local_avatar', get_avatar( $id_or_email, $size, $default, $alt, $args ) );
}
