<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class NF_Abstracts_Batch_Process
 */
abstract class NF_Abstracts_BatchProcess
{

    /**
     * Constructor
     */
    public function __construct( $data = array() )
    {
        //Bail if we aren't in the admin.
        if ( ! is_admin() ||
             ! is_user_logged_in() ||
             ! current_user_can( apply_filters('ninja_forms_admin_all_forms_capabilities', 'manage_options') ) )
        {
            return false;
        }
    }


    /**
     * Function to loop over the batch.
     */
    public function process()
    {
        /**
         * This function intentionlly left empty.
         */
    }


    /**
     * Function to run any setup steps necessary to begin processing.
     */
    public function startup()
    {
        /**
         * This function intentionally left empty.
         */
    }


    /**
     * Function to cleanup any lingering temporary elements of a batch process after completion.
     */
    public function cleanup()
    {
        /**
         * This function intentionally left empty.
         */
    }

}