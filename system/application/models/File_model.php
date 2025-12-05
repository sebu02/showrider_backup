<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class File_model extends CI_Model {

    function __construct() {
        parent::__construct();
        //$this->output->enable_profiler(FALSE);
        $this->tree = array();
        $this->parent = '';
        $this->arr = array();
        $this->arr2 = array();
        $this->arrz = array();
        $this->arrs = array();
        $this->arrow = '|';
        $this->arrzz = array();

        date_default_timezone_set('Asia/Calcutta');
    }

    /*
     * clean image
     */

    function clean($string) {
        $string = str_replace(" ", "-", $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
        return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
    }

    /*
     * End of clean image
     */

    function DeleteById($table, $id, $field) {
        //echo $id;
        $this->db->where(array($field => $id));
        $this->db->delete($table);
    }

    function TrashById($table, $id, $field) {
        $data = array(
            'trash_status' => 'yes',
            'active_status' => 'd',
            'date_deleted' => date("Y-m-d H:i:s")
        );

        $this->db->where(array($field => $id));
        $this->db->update($table, $data);
    }

    function RestoreById($table, $id, $field) {
        $data = array(
            'trash_status' => 'no',
            'active_status' => 'a',
            'date_restored' => date("Y-m-d H:i:s")
        );

        $this->db->where(array($field => $id));
        $this->db->update($table, $data);
    }

    function Get_all($table) {

        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get($table)->result();
    }

    function GetByRow($table, $eventid, $field) {

        $this->db->where(array($field => $eventid));
        return $result = $this->db->get($table)->row();
    }

    /*
     *  Check suffix already exist or not
     */

    function select_suffix() {



        $suffix = $this->input->post('suffix');
        foreach ($suffix as $suffixes) {

            if (strpos($suffixes, '.') !== false) {

                $suffixes = str_replace('.', '', $suffixes);
            }

            $this->db->where('suffix', $suffixes);
            return $this->db->get('cms_mime_types')->row();
        }
    }

    /*
     * End of Check suffix already exist or not
     */

    /*
     *  Add addExtension values
     */

    function addExtension() {
        $suffix = $this->input->post('suffix');
        $mediatype = $this->input->post('mediatype');
        $i = 0;
        foreach ($suffix as $suffixes) {

            if (strpos($suffixes, '.') !== false) {

                $suffixes = str_replace('.', '', $suffixes);
            }

            $data = array(
                'suffix' => $suffixes,
                'mediatype' => $mediatype[$i],
                'trash_status' => 'no',
                'active_status' => 'a'
            );
            $this->db->insert('cms_mime_types', $data);

            $i++;
        }
    }

    /*
     * End of Add addExtension values
     */

    /*
     *  view Extension details
     */

    function countExtension() {
        if ($this->uri->segment(3) != '0' && $this->uri->segment(3) != '') {
            $sess_val = $this->uri->segment(3);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('suffix', $s_a);
            $this->db->or_like('mediatype', $s_a);
        }

        $this->db->order_by('id', 'ASC');
        $this->db->where('trash_status', 'no');
        $numrow = $this->db->get('cms_mime_types');
        return $numrow->num_rows();
    }

    function get_allExtension($perpage, $rec_from) {
        if ($this->uri->segment(3) != '0' && $this->uri->segment(3) != '') {

            $sess_val = $this->uri->segment(3);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('suffix', $s_a);
            $this->db->or_like('mediatype', $s_a);
        }

        $this->db->order_by('id', 'ASC');
        $this->db->where('trash_status', 'no');
        $this->db->limit($perpage, $rec_from);
        return $this->db->get('cms_mime_types')->result();
    }

    /*
     *  End of view Extension details
     */

    /*
     *  check extension data exist or not (Edit)
     */

    function select_editsuffix() {

        $id = $this->uri->segment(3);

        $suffix = $this->input->post('suffix');
        if (strpos($suffix, '.') !== false) {

            $suffix = str_replace('.', '', $suffix);
        }
        $this->db->where('suffix', $suffix);
        $this->db->where('id !=', $id);
        return $this->db->get('cms_mime_types')->row();
    }

    /*
     *  End of check extension data exist or not (Edit)
     */

    /*
     *  Edit extension values
     */

    function editExtension($id) {

        $suffix = $this->input->post('suffix');
        if (strpos($suffix, '.') !== false) {

            $suffix = str_replace('.', '', $suffix);
        }

        $data = array(
            'suffix' => $suffix,
            'mediatype' => $this->input->post('mediatype'),
            'trash_status' => 'no',
            'active_status' => 'a'
        );

        $this->db->where('id', $id);
        $this->db->update('cms_mime_types', $data);
    }

    /*
     *  End of Edit extension values
     */

    /*
     * removeExtid from uploadtype
     */

    function removeExtid($id) {

        $this->db->order_by('id', 'ASC');
        $uploadData = $this->db->get('cms_upload_types')->result();

        foreach ($uploadData as $data) {

            $uploadID = $data->id;
            $preferences = $data->preferences;
            $preferences = json_decode($preferences);

            $allowed_types = $preferences->allowed_types;
            $file_name = $preferences->file_name;
            $overwrite = $preferences->overwrite;
            $max_size = $preferences->max_size;
            $max_width = $preferences->max_width;
            $max_height = $preferences->max_height;
            $max_filename = $preferences->max_filename;
            $encrypt_name = $preferences->encrypt_name;
            $remove_spaces = $preferences->remove_spaces;

            $newAllowedtypes = array_diff($allowed_types, array($id));
            $newAllowedtypes = implode($newAllowedtypes, ',');

            $prefernce_array = array(
                'allowed_types' => $newAllowedtypes,
                'file_name' => $file_name,
                'overwrite' => $overwrite,
                'max_size' => $max_size,
                'max_width' => $max_width,
                'max_height' => $max_height,
                'max_filename' => $max_filename,
                'encrypt_name' => $encrypt_name,
                'remove_spaces' => $remove_spaces
            );
            $prefernce_encode = json_encode($prefernce_array);

            $data = array(
                'preferences' => $prefernce_encode
            );

            $this->db->where('id', $uploadID);
            $this->db->update('cms_upload_types', $data);
        }
    }

    /*
     * End of removeExtid from uploadtype
     */

    /*
     *  view trash details
     */

    function trash_countExtension() {

        if ($this->uri->segment(3) != '0' && $this->uri->segment(3) != '') {

            $sess_val = $this->uri->segment(3);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('suffix', $s_a);
            $this->db->or_like('mediatype', $s_a);
        }

        $this->db->where('trash_status', 'yes');
        $this->db->order_by('id', 'ASC');
        $numrow = $this->db->get('cms_mime_types');
        return $numrow->num_rows();
    }

    function trash_get_allExtension($perpage, $rec_from) {

        if ($this->uri->segment(3) != '0' && $this->uri->segment(3) != '') {

            $sess_val = $this->uri->segment(3);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('suffix', $s_a);
            $this->db->or_like('mediatype', $s_a);
        }

        $this->db->where('trash_status', 'yes');
        $this->db->order_by('date_deleted', 'DESC');
        $this->db->order_by('id', 'ASC');
        $this->db->limit($perpage, $rec_from);
        return $this->db->get('cms_mime_types')->result();
    }

    /*
     *  End of view trash details
     */

    /*
     *  check typename already exist or not
     */

    function select_typename() {

        $typename = $this->input->post('typename');

        $this->db->where('type_name', $typename);
        return $this->db->get('cms_upload_types')->row();
    }

    /*
     *  End of check typename already exist or not
     */

    /*
     *  add upload type details
     */

    function addUpload_type() {
        $file_type = $this->input->post('file_type');
        $file_name = "image";
        $extid = array("1","2","9","13");
        
        if($file_type == "brochure"){
            $file_name = "doc";
            $extid = array("2","5","6","8","9","10","11","12");
        }               

        $prefernce_array = array(
            'allowed_types' => $extid,
            'file_name' => $file_name,
            'overwrite' => "FALSE",
            'max_size' => "2",
            'max_width' => $this->input->post('max_width'),
            'max_height' => $this->input->post('max_height'),
            'max_filename' => "0",
            'encrypt_name' => "FALSE",
            'remove_spaces' => "TRUE"
        );

        $prefernce_encode = json_encode($prefernce_array);

        $data = array(
            'type_name' => $this->input->post('typename'),
            'preferences' => $prefernce_encode,
            'manipulation_status' => $this->input->post('manipualtion'),
            'trash_status' => 'no',
            'active_status' => 'a',
            'file_type' => $file_type
        );

        $this->db->insert('cms_upload_types', $data);
		
	$insert_id = $this->db->insert_id();

        return $insert_id;		
		
    }

    /*
     *  End of add upload type details
     */

    /*
     *  view Upload Type details
     */

    function countUpload_type() {

        if ($this->uri->segment(3) != '0' && $this->uri->segment(3) != '') {

            $sess_val = $this->uri->segment(3);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('type_name', $s_a);
            $this->db->or_like('manipulation_status', $s_a);
        }

        $this->db->order_by('id', 'ASC');
        $this->db->where('trash_status', 'no');
        $numrow = $this->db->get('cms_upload_types');
        return $numrow->num_rows();
    }

    function get_allUpload_type($perpage, $rec_from) {

        if ($this->uri->segment(3) != '0' && $this->uri->segment(3) != '') {

            $sess_val = $this->uri->segment(3);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('type_name', $s_a);
            $this->db->or_like('manipulation_status', $s_a);
        }

        $this->db->order_by('id', 'ASC');
        $this->db->where('trash_status', 'no');
        $this->db->limit($perpage, $rec_from);
        return $this->db->get('cms_upload_types')->result();
    }

    /*
     *  End of Upload Type details
     */

    /*
     *  check typename already exist or not (edit)
     */

    function select_edit_typename() {

        $id = $this->uri->segment(3);

        $typename = $this->input->post('typename');
        $this->db->where('id !=', $id);
        $this->db->where('type_name', $typename);
        return $this->db->get('cms_upload_types')->row();
    }

    /*
     *  End of check typename already exist or not (edit)
     */

    /*
     *  get allowed types
     */

    function getAllowedtypes($id) {


        $this->db->where('id ', $id);
        return $this->db->get('cms_mime_types')->row();
    }

    /*
     * end of get allowed types
     */

    /*
     *  edit upload type details
     */

    function editUpload_type($id) {
             
        $file_type = $this->input->post('file_type');
        $file_name = "image";
        $extid = array("1","2","9","13");
        
        if($file_type == "brochure"){
            $file_name = "doc";
            $extid = array("2","5","6","8","9","10","11","12");
        }               

        $prefernce_array = array(
            'allowed_types' => $extid,
            'file_name' => $file_name,
            'overwrite' => "FALSE",
            'max_size' => "2",
            'max_width' => $this->input->post('max_width'),
            'max_height' => $this->input->post('max_height'),
            'max_filename' => "0",
            'encrypt_name' => "FALSE",
            'remove_spaces' => "TRUE"
        );

        $prefernce_encode = json_encode($prefernce_array);

        $data = array(
            'type_name' => $this->input->post('typename'),
            'preferences' => $prefernce_encode,
            'manipulation_status' => $this->input->post('manipualtion'),
            'trash_status' => 'no',
            'active_status' => 'a',
            'file_type' => $file_type
        );              

        $this->db->where('id', $id);
        $this->db->update('cms_upload_types', $data);
    }

    /*
     *  End of edit upload type details
     */

    /*
     *  view trashUpload_type details
     */

    function trash_countUpload_type() {

        if ($this->uri->segment(3) != '0' && $this->uri->segment(3) != '') {

            $sess_val = $this->uri->segment(3);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('type_name', $s_a);
            $this->db->or_like('manipulation_status', $s_a);
        }

        $this->db->where('trash_status', 'yes');
        $this->db->order_by('id', 'ASC');
        $numrow = $this->db->get('cms_upload_types');
        return $numrow->num_rows();
    }

    function trash_get_allUpload_type($perpage, $rec_from) {

        if ($this->uri->segment(3) != '0' && $this->uri->segment(3) != '') {

            $sess_val = $this->uri->segment(3);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('type_name', $s_a);
            $this->db->or_like('manipulation_status', $s_a);
        }

        $this->db->where('trash_status', 'yes');
        $this->db->order_by('date_deleted', 'DESC');
        $this->db->order_by('id', 'ASC');
        $this->db->limit($perpage, $rec_from);
        return $this->db->get('cms_upload_types')->result();
    }

    /*
     *  End of view trashUpload_type details
     */

    /*
     *  Check manipulation data exist or not
     */

    function select_manipulation_name() {

        $manipulation_name = $this->input->post('manipulation_name');
        $this->db->where('manipulation_name', $manipulation_name);
        return $this->db->get('cms_image_manipulation')->row();
    }

    /*
     *  End Of Check manipulation data exist or not
     */

    /*
     *  Check size_name data exist or not
     */

    function check_size_name() {

        $size_name = $this->input->post('size_name');
        $manipulations = $this->Get_all('cms_image_manipulation');
        foreach ($manipulations as $manipulation) {
            $size_details = $manipulation->size_details;
            $size_details = json_decode($size_details, true);


            for ($i = 1; $i <= count($size_details); $i++) {

                if ($size_details['size_name'][$i] == $size_name) {


                    echo 'yes';
                    break;
                } else {

                    echo 'no';
                }
            }
        }
    }

    /*
     *  End Of Check size_name data exist or not
     */

    /*
     *  addManipulation values
     */

    function addManipulation() {
        $original_width = $this->input->post('original_width');
        $original_height = $this->input->post('original_height');

        $size_array[] = array("size_name" => "original" , "width" => $original_width , "height" => $original_height); 
        $size_array_encode = json_encode($size_array);

        $data = array(
            'manipulation_name' => $this->input->post('manipulation_name'),
            'maintain_ratio' => "FALSE",
            'size_details' => $size_array_encode,
            'trash_status' => 'no',
            'active_status' => 'a'
        );

        $this->db->insert('cms_image_manipulation', $data);
		
	$insert_id = $this->db->insert_id();
        return $insert_id;
		
    }

    /*
     *  End of addManipulation values
     */

    /*
     *  view Manipulation details
     */

    function count_allManipulation() {

        if ($this->uri->segment(3) != '0' && $this->uri->segment(3) != '') {

            $sess_val = $this->uri->segment(3);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('manipulation_name', $s_a);
        }

        $this->db->order_by('id', 'ASC');
        $this->db->where('trash_status', 'no');
        $numrow = $this->db->get('cms_image_manipulation');
        return $numrow->num_rows();
    }

    function get_allManipulation($perpage, $rec_from) {

        if ($this->uri->segment(3) != '0' && $this->uri->segment(3) != '') {

            $sess_val = $this->uri->segment(3);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('manipulation_name', $s_a);
        }

        $this->db->order_by('id', 'ASC');
        $this->db->where('trash_status', 'no');
        $this->db->limit($perpage, $rec_from);
        return $this->db->get('cms_image_manipulation')->result();
    }

    /*
     *  End of view Manipulation details
     */

    /*
     *  check manipulation data exist or not (Edit)
     */

    function select_editmanipulation_name() {

        $id = $this->uri->segment(3);

        $manipulation_name = $this->input->post('manipulation_name');
        $this->db->where('manipulation_name', $manipulation_name);
        $this->db->where('id !=', $id);
        return $this->db->get('cms_image_manipulation')->row();
    }

    /*
     *  End of check manipulation data exist or not (Edit)
     */

    /*
     *  Edit manipulation values
     */

    function editManipulation($id) {
             
        $original_width = $this->input->post('original_width');
        $original_height = $this->input->post('original_height');

        $size_array[] = array("size_name" => "original" , "width" => $original_width , "height" => $original_height); 
        $size_array_encode = json_encode($size_array);

        $data = array(
            'manipulation_name' => $this->input->post('manipulation_name'),
            'maintain_ratio' => "FALSE",
            'size_details' => $size_array_encode,
            'trash_status' => 'no',
            'active_status' => 'a'
        );      
        
        $this->db->where('id', $id);
        $this->db->update('cms_image_manipulation', $data);
    }

    /*
     *  End of Edit manipulation values
     */


    /*
     *  view trashUpload_type details
     */

    function trash_countManipulation() {

        if ($this->uri->segment(3) != '0' && $this->uri->segment(3) != '') {

            $sess_val = $this->uri->segment(3);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('manipulation_name', $s_a);
        }

        $this->db->where('trash_status', 'yes');
        $this->db->order_by('id', 'ASC');
        $numrow = $this->db->get('cms_image_manipulation');
        return $numrow->num_rows();
    }

    function trash_get_allManipulation($perpage, $rec_from) {

        if ($this->uri->segment(3) != '0' && $this->uri->segment(3) != '') {

            $sess_val = $this->uri->segment(3);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('manipulation_name', $s_a);
        }

        $this->db->where('trash_status', 'yes');
        $this->db->order_by('date_deleted', 'DESC');
        $this->db->order_by('id', 'ASC');
        $this->db->limit($perpage, $rec_from);
        return $this->db->get('cms_image_manipulation')->result();
    }

    /*
     *  End of view trashUpload_type details
     */

    /*
     *  find Manipulation based usertype
     */

    function fetchManipulation() {

        $id = $this->input->post('upload_typeid');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->where('id', $id);
        $uploadType = $this->db->get('cms_upload_types')->row();

        if ($uploadType->manipulation_status == 'Yes') {

            $manipulations = $this->Get_all('cms_image_manipulation');

            echo '<label class="form-label span4" for="manipulation">Manipulation</label>'
            . '<div class="span8 controls" >'
            . '<select name="manipulation"  id="manipulation" class="manipulation" >'
            . '<option value="">Select Manipulation</option>';
            foreach ($manipulations as $data) {
                echo '<option value="' . $data->id . '">' . $data->manipulation_name . '</option>';
            }
            echo'</select>'
            . '</div>';
        } else {

            return FALSE;
        }
    }

    /*
     *  End of find Manipulation based usertype
     */

    function fetchManipulation_data() {

        $id = $this->input->post('manipulation_id');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->where('id', $id);
        $manipulationdata = $this->db->get('cms_image_manipulation')->row();
        $size_details = $manipulationdata->size_details;
        $manipulation_data = json_decode($size_details, true);

        echo "<table class='table table-borderd dynamicTable'  border='1'>
                    <thead>
                      <tr>
                        <th>Size Name</th>
                        <th>Width</td>
                        <th>Height</th>
                      </tr>
                      </thead><tbody>";
        foreach ($manipulation_data as $manipulation) {
            //  echo $manipulation['size_name'];
            if ($manipulation['width'] != '') {
                echo "<tr>
                                       <td>" . ucfirst($manipulation['size_name']) . "</td>
                                       <td>" . $manipulation['width'] . "Px</td>
                                       <td>" . $manipulation['height'] . "Px</td>
                                 </tr>";
            }
        }
        echo '</tbody>
                  </table>
              </div>';
    }

    /*
     *  Check combo data exist or not
     */

    function select_combo_name() {

        $combo_name = $this->input->post('combo_name');
        $this->db->where('combo_name', $combo_name);
        return $this->db->get('cms_image_combo')->row();
    }

    /*
     *  End Of Check combo data exist or not
     */

    /*
     *  addcombo values
     */

    function addCombo() {
		
        $manipulation = 0;
        if (isset($_POST['manipulation'])) {
            $manipulation = $_POST['manipulation'];
        }

        $data = array(
            'combo_name' => $this->input->post('combo_name'),
            'upload_type' => $this->input->post('uploadtype'),
            'manipulation' => $manipulation,
            'manipulation_types' => 'Resize',
            'trash_status' => 'no',
            'active_status' => 'a'
        );

        $this->db->insert('cms_image_combo', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    /*
     *  End of addcombo values
     */

    /*
     *  view Manipulation details
     */

    function count_allCombo() {

        if ($this->uri->segment(3) != '0' && $this->uri->segment(3) != '') {

            $sess_val = $this->uri->segment(3);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('combo_name', $s_a);
        }

        $this->db->order_by('id', 'ASC');
        $this->db->where('trash_status', 'no');
        $numrow = $this->db->get('cms_image_combo');
        return $numrow->num_rows();
    }

    function get_allCombo($perpage, $rec_from) {

        if ($this->uri->segment(3) != '0' && $this->uri->segment(3) != '') {

            $sess_val = $this->uri->segment(3);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('combo_name', $s_a);
        }

        $this->db->order_by('id', 'ASC');
        $this->db->where('trash_status', 'no');
        $this->db->limit($perpage, $rec_from);
        return $this->db->get('cms_image_combo')->result();
    }

    /*
     *  End of view Manipulation details
     */

    /*
     *  check Combo data exist or not (Edit)
     */

    function select_editCombo_name() {

        $id = $this->uri->segment(3);

        $combo_name = $this->input->post('combo_name');
        $this->db->where('combo_name', $combo_name);
        $this->db->where('id !=', $id);
        return $this->db->get('cms_image_combo')->row();
    }

    /*
     *  End of check Combo data exist or not (Edit)
     */

    /*
     *  edit combo values
     */

    function editCombo($id) {
		
        $manipulation = 0;
        if (isset($_POST['manipulation'])) {
            $manipulation = $_POST['manipulation'];
        }

        $data = array(
            'combo_name' => $this->input->post('combo_name'),
            'upload_type' => $this->input->post('uploadtype'),
            'manipulation' => $manipulation,
            'manipulation_types' => 'Resize',
            'trash_status' => 'no',
            'active_status' => 'a'
        );

        $this->db->where('id', $id);
        $this->db->update('cms_image_combo', $data);
    }

    /*
     *  End of edit combo values
     */

    /*
     *  view trashCombo details
     */

    function trash_countCombo() {

        if ($this->uri->segment(3) != '0' && $this->uri->segment(3) != '') {

            $sess_val = $this->uri->segment(3);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('combo_name', $s_a);
        }

        $this->db->where('trash_status', 'yes');
        $this->db->order_by('id', 'ASC');
        $numrow = $this->db->get('cms_image_combo');
        return $numrow->num_rows();
    }

    function trash_get_allCombo($perpage, $rec_from) {

        if ($this->uri->segment(3) != '0' && $this->uri->segment(3) != '') {

            $sess_val = $this->uri->segment(3);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('combo_name', $s_a);
        }

        $this->db->where('trash_status', 'yes');
        $this->db->order_by('date_deleted', 'DESC');
        $this->db->order_by('id', 'ASC');
        $this->db->limit($perpage, $rec_from);
        return $this->db->get('cms_image_combo')->result();
    }

    /*
     *  End of view trashCombo details
     */

    function array_push_assoc($array, $key, $value) {
        $array[$key] = $value;
        return $array;
    }

    function edit_combo_img($id) {

        if ($this->input->post('seo_alt') != "") {

            $seo_alt = $this->input->post('seo_alt');
        }
        if ($this->input->post('seo_title') != "") {

            $seo_title = $this->input->post('seo_title');
        }

        /** combo image file control */
        $banner_images_str = $this->input->post('final_images');
        $banner_images = explode(',', $banner_images_str);
        $mediaID = $this->input->post('mediaID');
        $data = array();
        $image_option = '';
        if ($banner_images_str != "") {

            $data_mediaID = array(
                'type_trash' => 'yes'
            );
            if (!empty($mediaID)) {
                $this->db->where('id', $mediaID);
                $this->db->update('cms_media', $data_mediaID);
            }


            $image_array = array();

            foreach ($banner_images as $banner) {

                $image_array[] = array(
                    'image' => $banner,
                    'combo' => $this->input->post('combo'),
                    'seo_alt' => $seo_alt,
                    'seo_title' => $seo_title,
                );
            }

            $image_encode = json_encode($image_array);

            $data_media = array(
                'type' => 'combo_image',
                'type2' => 'combo_no_image',
                'type_trash' => 'no',
                'images' => $image_encode
            );

            $this->db->insert('cms_media', $data_media);
            $bannerID = $this->db->insert_id();

            $image_array1 = array();

            foreach ($banner_images as $banner) {

                $image_array1[] = array(
                    'image' => $banner,
                    'combo' => $this->input->post('combo'),
                    'media_id' => $bannerID,
                    'seo_alt' => $seo_alt,
                    'seo_title' => $seo_title,
                );
            }

            $image_option = $image_encode1 = json_encode($image_array1);

            $data = $this->file_model->array_push_assoc($data, 'combo_no_image', $image_encode1);
        } else {

            if (!empty($mediaID)) {
                $image_detail_a = $this->file_model->GetByRow('cms_media', $mediaID, 'id');
                $exist_image_detail_a = json_decode($image_detail_a->images, TRUE);

                $image_array_a[] = array(
                    'image' => $exist_image_detail_a[0]['image'],
                    'combo' => $exist_image_detail_a[0]['combo'],
                    'seo_alt' => $seo_alt,
                    'seo_title' => $seo_title,
                );
                $image_encode_a = json_encode($image_array_a);
                $data_a = array();
                $data_a = $this->file_model->array_push_assoc($data_a, 'images', $image_encode_a);
                $this->db->where('id', $mediaID);
                $this->db->update('cms_media', $data_a);
            }
            
            $image_detail = $this->file_model->GetByRow('cms_image_combo', $id, 'id');
            $exist_image_detail = json_decode($image_detail->combo_no_image, TRUE);
            if (!empty($exist_image_detail)) {
                $image_array[] = array(
                    'image' => $exist_image_detail[0]['image'],
                    'combo' => $exist_image_detail[0]['combo'],
                    'media_id' => $exist_image_detail[0]['media_id'],
                    'seo_alt' => $seo_alt,
                    'seo_title' => $seo_title,
                );
                $image_option = $image_encode = json_encode($image_array);
                $data = $this->file_model->array_push_assoc($data, 'combo_no_image', $image_encode);
            }
        }

        /** EOF combo image file control */
        if (!empty($data)) {
            $this->db->where('id', $id);
            $this->db->update('cms_image_combo', $data);
        }
        
        
        $combo_no_image_opt_arr = array();
        $combo_no_image_opt_str = $this->common_model->option->combo_no_image;
        $combo_no_image_opt_arr = json_decode($combo_no_image_opt_str, TRUE);
        if(!empty($combo_no_image_opt_arr)){
            if(isset($combo_no_image_opt_arr[$id])){
                $combo_no_image_opt_arr[$id] = $image_option;
            } else {
                $combo_no_image_opt_arr = $this->file_model->array_push_assoc($combo_no_image_opt_arr, $id, $image_option);
            }
        } else {
            $combo_no_image_opt_arr = array($id=>$image_option);
        }
        
        
        $combo_no_image_opt_str = json_encode($combo_no_image_opt_arr);
		
		//{oldoption}
       // $data_opt = array('combo_no_image'=>$combo_no_image_opt_str);
	   //{oldoption}
	   
	   $data_opt = array('value'=>$combo_no_image_opt_str);
		
		
		//{oldoption}
        //$this->db->where('id', $this->common_model->option->id);
       // $this->db->update('cms_options2', $data_opt);
	   //{oldoption}
	   
	   $this->db->where('columnlabel', 'combo_no_image');
        $this->db->update('cms_options_setting', $data_opt);
		
    }
}
?>