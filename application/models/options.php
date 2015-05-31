<?php
class Options extends CI_Model
{
	/**
	 * Set option
	 *
	 * Save quickly option to database
	 * 
	 * @access : public
	 * @param : string
	 * @param : vars
	 * @param : int user_id
	 * @param : string script context ([app_namespace]/[app_type]), example : 'blogster/module' , 'avera/theme'
	 * @return : void
	**/
	
	function set( $key , $value , $autoload = false , $user = 0 , $app = 'system' )
	{
		// get option if exists
		$query		=	$this->db->where( 'key' , $key )->get( 'options' );		
		$options	=	$query->result_array();
		$value		=	is_array( $value ) ? json_encode( $value ) : $value; // converting array to JSON
		$value		=	is_bool( $value ) ? $value === true ? 'true' : 'false' : $value; // Converting Bool to string
		if( $options )
		{
			$this->db->where( 'key' , $key )->update( 'options' , array(
				'key'		=>	$key,
				'value'		=>	$value,
				'autoload'	=>	$autoload,
				'user'		=>	$user,
				'app'		=>	$app
			) );
		}
		else
		{
			$this->db->insert( 'options' , array( 
				'key'	=>	$key,
				'value'	=>	$value,
				'autoload'	=>	$autoload,
				'user'		=>	$user,
				'app'		=>	$app
			) );
		}
	}
	
	/**
	 * Get option
	 * 
	 * Get option from database
	 *
	 * @access : public
	 * @param : string
	 * @param : int user id
	 * @return : var (can return null if key is not set)
	**/
	
	function get( $key , $user_id = NULL )
	{
		// get only data from user
		if( $user_id != NULL ): $this->db->where( 'user' , $user_id ); endif;
		
		// fetch data
		$query		=	$this->db->where( 'key' , $key )->get( 'options' );
		$option	=	$query->result_array();

		// if there is any result
		if( $option	)
		{
			$value	=	riake( 'value' , farray( $option ) );
			$value		=	is_array( $array	=	json_decode( $value , true ) ) ? $array : $value; // converting array to JSON
			$value		=	in_array( $value , array( 'true' , 'false' ) ) ? $value === 'true' ? true : false : $value; // Converting Bool to string
			return $value;
		}
		return NULL;
	}
}