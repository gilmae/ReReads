<?php
   class Repository
   {
     public static function get_connection()
     {
        return new medoo($GLOBALS['connections'][$GLOBALS["environment"]]);
     }

     public function save($model)
     {
       $conn = Repository::get_connection();

       if ($model->is_new())
       {
         $model->inserting();
         $fields = array("created_at"=>$model->created_at, "updated_at"=>$model->updated_at);
         $fields = array_merge($fields, $model->insert_fields());

         $model->id = $conn->insert(get_class($model), $fields);
       }
       else
       {
         $model->updating();
         $fields = array("created_at"=>$model->created_at, "updated_at"=>$model->updated_at);
         array_merge($fields, $model->update_fields());

         $conn->update(get_class($model), $fields, ["id"=>$model->id]);
       }
       //echo($conn->last_query());
     }

     public static function build_first($array, $klass)
     {
        if (empty($array) || count($array) == 0)
        {
          return null;
        }

        $model = new $klass();
        $model->from_array($array[0]);
        return $model;
     }

     public static function build_all($array, $klass)
     {
        $models = [];
        foreach($array as $item)
        {
          $model = new $klass();
          $model->from_array($item);
          array_push($models, $model);
        }
        return $models;
     }

   }
?>
