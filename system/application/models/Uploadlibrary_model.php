<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Uploadlibrary_model extends CI_Model {
        
     /*
     *  Get file details
     */

      public function Get_fileData(){
            
            $this->db->select("file_combo.combo_name,upload_types.manipulation_status,
                                    file_combo.id as fid, upload_types.id as upid, upload_types.preferences");
            $this->db->join("cms_upload_types upload_types", "upload_types.id = file_combo.upload_type", "inner");
            $this->db->where("upload_types.trash_status", "no");
            $this->db->where("upload_types.active_status", "a");
            $this->db->where("file_combo.trash_status", "no");
            $this->db->where("file_combo.active_status", "a");
            $this->db->order_by("file_combo.id", "asc");
            $query = $this->db->get('cms_image_combo file_combo');
            return $query->result();
        }
    /*
     * end of Get file details
     */
        
        
     /*
     *  Get row file details
     */

      public function getFile($id){
            
            $this->db->select("file_combo.combo_name,file_combo.manipulation, upload_types.preferences,upload_types.manipulation_status,
                                    file_combo.id as fid, upload_types.id as upid");
            $this->db->join("cms_upload_types upload_types", "upload_types.id = file_combo.upload_type", "inner");
            $this->db->where("upload_types.trash_status", "no");
            $this->db->where("upload_types.active_status", "a");
            $this->db->where("file_combo.trash_status", "no");
            $this->db->where("file_combo.active_status", "a");
            $this->db->where("file_combo.id", $id);
            $query = $this->db->get('cms_image_combo file_combo');
            return $query->row();
        }
    /*
     * end of Get row file details
     */
        

        
    /*
     *  get allowed types
     */
    
       public function getAllowedtypes($id){
           
               
                $this->db->where('id ', $id);
                return $this->db->get('cms_mime_types')->row();
           

        }
    
    /*
     * end of get allowed types
     */ 
        
        
     /*
      *  get manipulation 
      */ 
       public function getManipulation($id) {
           
           $this->db->where('id ', $id);
           return $this->db->get('cms_image_manipulation')->row();
           
       }
        
       /*
        * end of get manipulation
        */ 
        
    /*
     *  Image Upload functions
     */    
       public function uploadLibrary($fileName,$comboID) {


            $comboDetails = $this->getFile($comboID);

            $prefernce = json_decode($comboDetails->preferences);

            $myfiles = $this->diverse_array($_FILES[$fileName]);

            $allowed_types = $prefernce->allowed_types;
            $maxSize = $prefernce->max_size;
            $overwrite = $prefernce->overwrite;
            $max_width = $prefernce->max_width;
            $max_height = $prefernce->max_height;
            $max_filename = $prefernce->max_filename;
            $encrypt_name = $prefernce->encrypt_name;
            $remove_spaces = $prefernce->remove_spaces;
            $file_name_without_project_name = $prefernce->file_name;
            $file_name=$this->common_model->option->project_name."-".$file_name_without_project_name;
            $manipulation_status = $comboDetails->manipulation_status;
            $manipulationID = $comboDetails->manipulation;

            
            $allowedtypes = array();
            $allowedtypes2 = array();
      
            foreach($allowed_types as $id){
                
                    $getallowedtype=$this->getAllowedtypes($id);
                   
                        array_push($allowedtypes,$getallowedtype->mediatype);
                        array_push($allowedtypes2,$getallowedtype->mediatype);
                        
                   

                 }

                 
                 
            $typecheck = 0;
            $imagecheck = 0;
            $sizecheck = 0;
            $sizeval = 0;
            

    
            foreach ($myfiles as $row) {

                //type check for file upload	
                    if (in_array($row['type'], $allowedtypes)) {

                        $typeval = 0;
                    } else {
                        $typeval = 1;

                    }

                    $typecheck += $typecheck + $typeval;
                //End of type check for file upload	

    
                // Check image or not
                    if ($manipulation_status == 'Yes') {

                        if (in_array($row['type'], $allowedtypes2)) {
                            //image
                            $imgcheck = getimagesize($row["tmp_name"]);
                            if ($imgcheck !== false) {

                                $imageval = 0;
                            } else {
                                $imageval = 1;
                            }

                            $imagecheck += $imagecheck + $imageval;

                            //image
                        }
                    } else {

                        $imagecheck = 0;
                    }
                 // End of Check image or not
                

            }

            
            // check file size
            // for ($i = 0; $i <= count($myfiles);$i++) {

            $sizecheck_arr = array();    
            foreach ($myfiles as $row) {    
                
                $fileSize = $maxSize * 1048576;
                
                    if ($row["size"] <= $fileSize){
  
                     $sizecheck=0;   
                     array_push($sizecheck_arr , 0);                   
                        
                    }else{

                      $sizecheck = 1;  
                      array_push($sizecheck_arr , 1);  
                    }
                }


            //End of  check file size


            if ($typecheck == 0 && $imagecheck == 0 && $sizecheck == 0 && !(in_array(1 , $sizecheck_arr))) {

                if (!empty($file_name)) {

                    $product_name = $file_name;
                } else {

                    $product_name = 'file';
                }

                $product_name_cleaned = $this->clean($product_name);

                
                
                //upload function start	          
                $imgcount = count($_FILES[$fileName]['name']);
                if (isset($_FILES[$fileName]['name'])) {
                    if ($_FILES[$fileName]['name']) {

                        $config['upload_path'] = 'media_library/';


                        /*
                         * allowed_types in config
                         */
                        $config_allowedtypes = '';
                        $numExtension = count($allowed_types);
                        $i = 0;
                        foreach ($allowed_types as $id) {

                            $getallowedtype = $this->getAllowedtypes($id);
                            
                            if (++$i === $numExtension) {
                                
                                $config_allowedtypes .= $getallowedtype->suffix;
                                
                            } else {

                                $config_allowedtypes .= $getallowedtype->suffix . '|';
                            }
                        }
                        $config['allowed_types'] = $config_allowedtypes; // by extension, will check for whether it is an image

                        /*
                         * End of allowed_types in config
                         */

                        
                        /*
                         * max file size in config
                         */
                            $config_fileSize = $maxSize * 1024;
                            $config['max_size'] = (int) $config_fileSize; // in kb 2048
                        /*
                         * End of max file size in config
                         */


                        /*
                         * max width and height in config
                         */
                        
//                        if (empty($max_width)) {
//
//                            $config['max_width'] = 0;
//                        } else {
//
//                            $config['max_width'] = (int)$max_width;
//                        }


//                        if (empty($max_height)) {
//
//                            $config['max_height'] = 0;
//                        } else {
//
//                            $config['max_height'] = (int)$max_height;
//                        }

                        /*
                         * End of max width and height in config
                         */

                            
                            
                        /*
                         *  other configurations
                         */
                        
                        $config['overwrite'] = $overwrite;
                        $config['max_filename'] = (int)$max_filename;
                        $config['encrypt_name'] = $encrypt_name;
                        $config['remove_spaces'] = $remove_spaces;
                        
                        /*
                         *  End of other configurations
                         */

                        
                        
                        $this->load->library('upload', $config);
                        $this->load->library('Multi_upload');
                        $filess = $this->multi_upload->go_upload($fileName, $product_name_cleaned);

                        if (!$filess) {

                            //$error = $this->upload->display_errors();

                            echo '***';
                        } else {


                            /*
                             *  Image manipulation
                             */
                            if ($manipulation_status == 'Yes') {

                                $manipulationData = $this->getManipulation($manipulationID);
                                $this->imageManipulation($filess, $manipulationData);
                            }
                            /*
                             *  End of Image manipulation
                             */

                            $data = array('upload_data' => $filess);

                             $file_names = '';
                                foreach ($filess as $img) {
                                    $file_names .= $img['name'] . ",";
                                }

                            $file_names = substr($file_names, 0, -1);
                            echo $file_names;
                        }
                    }
                }

                //End of upload function
            }
        }
    

    public function imageManipulation($uploaddata, $manipulationData) {
        
        if($manipulationData!=NULL) {
            
        
            $manipulation_data = json_decode($manipulationData->size_details, true);
            $maintain_ratio=$manipulationData->maintain_ratio;
            if($manipulation_data!=NULL) {
                
            
                foreach ($uploaddata as $upl) {


                    // create resized image
                    foreach($manipulation_data as $manipulation){ 

                        if ($manipulation['width']!='') {

                          $config = array();

                          $config['image_library'] = 'GD2';
                          $config['source_image'] = $upl['file'];
                          $config['new_image'] = 'media_library/' . $manipulation['size_name'].'_' . $upl['name'];
                          $config['create_thumb'] = false;
                          $config['maintain_ratio'] = $maintain_ratio;
                          $config['width'] = $manipulation['width'];
                          $config['height'] = $manipulation['height'];

                          $this->load->library('image_lib');
                          // Set your config up
                          $this->image_lib->initialize($config);
                          $this->image_lib->resize();
                          // Do your manipulation
                          $this->image_lib->clear();




          //                  $this->image_lib->display_errors();

                        }
                    }
                }
            }
        }
    }
    
    
    public function diverse_array($vector) {
        $result = array();
        foreach ($vector as $key1 => $value1)
            foreach ($value1 as $key2 => $value2)
                $result[$key2][$key1] = $value2;
        return $result;
    }

    public function clean($string) {
        $string = str_replace(" ", "-", $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
        return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
    }

        
    /*
     *  End of Image Upload functions
     */    
    


    /*
     *  Delete upload images
     */

    public function delete_upload_image($img) {

        $output_dir = "media_library/";
        if (isset($img)) {
        
            if ($img) {
                $fileName = $img;
                $filePath = $output_dir . $fileName;
                $a=array_map('unlink', glob($output_dir.'*'.$fileName)); 
                echo 'yes';
            }
        }
    }

    
    public function deleteFilechange($finalFiles){
        
        $output_dir = "media_library/";
        if (isset($finalFiles)) {

            if ($finalFiles) {
                
                $finalFiles=explode(',',$finalFiles);
                
                foreach ($finalFiles as $file){
                    
                    $fileName = $file;
                    $filePath = $output_dir . $fileName;
                    array_map('unlink', glob($output_dir . '*' . $fileName));
                }

               
                echo 'yes';
            }
        }
    }

    public function fetchManipdata($comboid){
        
            $this->db->select("image_manipulation.size_details");
            $this->db->join("cms_image_manipulation image_manipulation", "image_manipulation.id = file_combo.manipulation", "inner");
            $this->db->where("image_manipulation.trash_status", "no");
            $this->db->where("image_manipulation.active_status", "a");
            $this->db->where("file_combo.trash_status", "no");
            $this->db->where("file_combo.active_status", "a");
            $this->db->where("file_combo.id", $comboid);
            $query = $this->db->get('cms_image_combo file_combo');
            $manipulationdata=$query->row();
            
            if($manipulationdata!=NULL) {
                
            
                $size_details =$manipulationdata->size_details;
                $manipulation_data=json_decode($size_details,true);

                    if($manipulation_data!=NULL) {


                        echo "<table class='table table-borderd dynamicTable'  border='1'>
                                <thead>
                                  <tr>
                                    <th>Size Name</th>
                                    <th>Width</td>
                                    <th>Height</th>
                                  </tr>
                                  </thead><tbody>";
                              foreach($manipulation_data as $manipulation){  
                                    if ($manipulation['width']!='') {

                                        echo "<tr>
                                                   <td>".ucfirst($manipulation['size_name'])."</td>
                                                   <td>".$manipulation['width']."Px</td>
                                                   <td>".$manipulation['height']."Px</td>
                                             </tr>";

                                    }
                              }
                              echo  '</tbody>
                              </table>
                          </div>';
                  }

            }

    }
    /*
     * End of Delete upload images
     */   
    
}
