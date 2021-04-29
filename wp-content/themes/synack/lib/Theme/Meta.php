<?php

/**
 * 
 * Helper Class to get Post Meta
 * 
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since   1.0
 */
class SYNMeta
{

    /**
     * The post ID
     *
     * @since 1.0
     */
    protected $_thePostID = null;

    /**
     * Constructor
     * Assign the post ID to the protected var
     *
     * @since 1.0
     */
    public function __construct($postID)
    {
        if (intval($postID)) {
            $this->_thePostID = $postID;
        } elseif (is_object($postID) && isset($postID->ID)) {
            $this->_thePostID = $postID->ID;
        } else {
            return;
        }

        $this->init();
    }

    /**
     * Initializer
     *
     * @since 1.0
     */
    public function init()
    {
        return $this->parseMeta();
    }

    /**
     * Parses the meta of the given post.
     * Establishes the parameters of the object based
     * on these meta values in the array retrieved.
     *
     * @return SYNMeta
     * @since 1.0.0
     */
    private function parseMeta()
    {
        $meta = get_post_meta($this->_thePostID);

        foreach ($meta as $key => $value) {
            if (substr($key, 0, 1) === "_") {
                continue;
            }

            $fieldObject = get_field_object($key, $this->_thePostID);

            if (empty($fieldObject['key'])) {
                continue;
            }

            if ($fieldObject['class'] === 'repeater') {
                $value = $fieldObject['value'];
            } else if (is_array($value)) {
                $value = $value[0];
            }

            $this->$key = is_serialized($value)
                ? unserialize($value)
                : $value;
        }

        return $this;
    }

    /**
     * Gets the unparsed meta field name.
     *
     * @param string $field Meta Field Name
     * @return mixed
     * @since 1.0
     */
    public function getMeta($field)
    {
        return (isset($this->{$field}) && !empty($this->{$field}))
            ? $this->{$field}
            : false;
    }


    /**
     * Parses a ACF Repeater field 
     * 
     * @param  string $field    The name of the repeater
     * @param  array $subfields The subfield names
     * @return array Data
     * @since 1.0
     */
    public function parseRepeater($field, $subfields)
    {

        $c         = $this->getMeta($field);//get all the data
        $i         = 0;
        $dataArray = array();

        while($c > $i) {
            $newData = array();
            foreach($subfields as $subfield){

                if($this->getMeta($field.'_'.$i.'_'.$subfield)){
                    $newData[$subfield] = $this->getMeta($field.'_'.$i.'_'.$subfield); //ACF saves repeaters in a name format like field_1_subfield
                }
                
                
            }
            $dataArray[] = $newData;
            
            $i++;
        }

        return $dataArray;
    }


}
