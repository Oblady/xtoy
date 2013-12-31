<?php

namespace XtoY\Writer;
/**
 * Description of WriterInterface
 *
 * @author sebastien
 */
interface WriterInterface {
   
    
   public function setDDN($ddn);  
   public function write($line);
   public function writeAll($table);
   public function postprocessing();   
   public function preprocessing();   
   public function open();
   public function close(); 
}

