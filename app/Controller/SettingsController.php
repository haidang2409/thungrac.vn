<?php
class SettingsController extends AppController
{
    /////
//    Admin
    function admin_index()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }


    }
    function admin_database_mysql_dump($tables = '*') {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $return = '';
        $modelName = $this->modelClass;
        $dataSource = $this->{$modelName}->getDataSource();
        $databaseName = $dataSource->getSchemaName();
        // Do a short header
        $return .= '-- Database: `' . $databaseName . '`' . "\n";
        $return .= '-- Generation time: ' . date('D jS M Y H:i:s') . "\n\n\n";
        if ($tables == '*') {
            $tables = array();
            $result = $this->{$modelName}->query('SHOW TABLES');
            foreach($result as $resultKey => $resultValue){
                $tables[] = current($resultValue['TABLE_NAMES']);
            }
        } else {
            $tables = is_array($tables) ? $tables : explode(',', $tables);
        }
        // Run through all the tables
        foreach ($tables as $table) {
            $tableData = $this->{$modelName}->query('SELECT * FROM ' . $table);

            $return .= 'DROP TABLE IF EXISTS ' . $table . ';';
            $createTableResult = $this->{$modelName}->query('SHOW CREATE TABLE ' . $table);
            $createTableEntry = current(current($createTableResult));
            $return .= "\n\n" . $createTableEntry['Create Table'] . ";\n\n";
            // Output the table data
            foreach($tableData as $tableDataIndex => $tableDataDetails) {
                $return .= 'INSERT INTO ' . $table . ' VALUES(';
                foreach($tableDataDetails[$table] as $dataKey => $dataValue) {
                    if(is_null($dataValue)){
                        $escapedDataValue = 'NULL';
                    }
                    else {
                        // Convert the encoding
                        $escapedDataValue = mb_convert_encoding( $dataValue, "UTF-8");//, "ISO-8859-1" );
                        // Escape any apostrophes using the datasource of the model.
                        $escapedDataValue = $this->{$modelName}->getDataSource()->value($escapedDataValue);
                    }
                    $tableDataDetails[$table][$dataKey] = $escapedDataValue;
                }
                $return .= implode(',', $tableDataDetails[$table]);

                $return .= ");\n";
            }

            $return .= "\n\n\n";
        }
        // Set the default file name
        $fileName = $databaseName . date('Y-m-d_H-i-s') . '.sql';
        // Serve the file as a download
        $this->autoRender = false;
        $this->response->type('Content-Type: text/x-sql');
        $this->response->download($fileName);
        $this->response->body($return);
    }
}