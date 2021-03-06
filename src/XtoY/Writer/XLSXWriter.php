<?php

namespace XtoY\Writer;

/**
 * A simple of XLSXWriter
 *
 * @author Sébastien Thibault <contact@sebastien-thibault.com>
 */
class XLSXWriter  extends FileWriter
{
    protected $data;

   public function __construct($options)
   {
       parent::__construct();
        $this->data = array();
        $this->addOption('worksheet','default');
        $this->getOptionManager()->init($options);

   }

   public function open()
   {
       if (!isset($this->document)) {
        parent::open();
          $this->document =  new \XLSXWriter();
       }

   }

   public function close()
   {
      if (isset($this->document)) {
          $this->document->writeToFile($this->getDDN());

      }
   }

    public function write($line)
    {
        $this->data[] = $line;
        if ($this->reporter) {
            $this->reporter->setWrittenLines(++$this->line);
        }
    }

    public function writeAll($table)
    {
        $this->data = $table;
       if ($this->reporter) {
            $this->reporter->setWrittenLines(count(array_keys($this->data)));
        }
    }

    public function postprocessing()
    {
        $options = $this->getOptions();
        $header_types = $this->getHeadersType();
        $this->document->writeSheet($this->data,$options['worksheet'],$header_types);
        unset($this->data);

    }
    
    private  function getHeadersType() {
        
        $header_types = array();
        $first = current($this->data);
        foreach($first as $k=>$v) {
            $header_types[$k] = 'string';
        }
        return $header_types;
    }

}
