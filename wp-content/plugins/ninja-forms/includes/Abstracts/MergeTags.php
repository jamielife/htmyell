<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class NF_Abstracts_MergeTags
 */
abstract class NF_Abstracts_MergeTags
{
    protected $id = '';

    protected $title = '';

    protected $merge_tags = array();

    protected $_default_group = TRUE;

    public function __construct()
    {
        add_filter( 'kbj_test', array( $this, 'replace' ) );

        add_filter( 'ninja_forms_render_default_value', array( $this, 'replace' ) );

        add_filter( 'ninja_forms_run_action_settings',  array( $this, 'replace' ) );
        add_filter( 'ninja_forms_run_action_settings_preview',  array( $this, 'replace' ) );

        add_filter( 'ninja_forms_calc_setting',  array( $this, 'replace' ) );

        /* Manually trigger Merge Tag replacement */
        add_filter( 'ninja_forms_merge_tags', array( $this, 'replace' ) );
    }

    public function replace( $subject )
    {
        if( is_array( $subject ) ){
            foreach( $subject as $i => $s ){
                $subject[ $i ] = $this->replace( $s );
            }
            return $subject;
        }

        preg_match_all("/{([^}]*)}/", $subject, $matches );

        if( empty( $matches[0] ) ) return $subject;

        foreach( $this->merge_tags as $merge_tag ){
            if( ! isset( $merge_tag[ 'tag' ] ) || ! in_array( $merge_tag[ 'tag' ], $matches[0] ) ) continue;

            if( ! isset($merge_tag[ 'callback' ])) continue;

            // Remove static callback potential
            if( is_string( $merge_tag['callback'] ) &&
                false !== strpos( $merge_tag['callback'], '::' ) ) {
                    $merge_tag['callback'] = NULL;
            } // Remove class initializtion potential
            elseif( is_array( $merge_tag['callback'] )
                    && is_string( $merge_tag['callback'][0] )
                    && 0 === strpos( trim( $merge_tag['callback'][0] ), 'new' ) ) {
                $merge_tag['callback'] = NULL;
            }

            if ( is_callable( array( $this, $merge_tag[ 'callback' ] ) ) ) {
				$replace = $this->{$merge_tag[ 'callback' ]}();
			} elseif ( is_callable( $merge_tag[ 'callback' ] ) ) {
				$replace = $merge_tag[ 'callback' ]();
			} else {
				$replace = '';
			}
            
            $subject = str_replace( $merge_tag[ 'tag' ], $replace, $subject );
        }

        return $subject;
    }

    public function get_id()
    {
        return $this->id;
    }

    public function get_title()
    {
        return $this->title;
    }

    public function get_merge_tags()
    {
        return $this->merge_tags;
    }

    public function is_default_group()
    {
        return $this->_default_group;
    }


} // END CLASS NF_Abstracts_MergeTags
