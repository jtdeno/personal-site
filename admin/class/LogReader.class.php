<?php

class LogReader extends base {
    protected $_fileContents;
    protected $_linesToRead = 200;
    protected $_logPath;
    protected $_searchArray = array();

    public function prettyPrint() {
        if (!isset($this->_fileContents)) { $this->_setFileContents(); }

        $output = implode($this->_fileContents, '<br />');

        foreach ($this->_searchArray as $wordsToColor) {
            $output = str_replace(  $wordsToColor['string'],
                                    '<span style="color: ' . $wordsToColor['color'] . ';">' . $wordsToColor['string'] . '</span>',
                                    $output);
        }

        echo $output;
    }

    public function setLogFile($_logPath) {
        $this->_logPath = str_replace('\\', '/', $_logPath);
    }

    public function setSearch($string, $color) {
        $this->_searchArray[] = array('string' => $string, 'color' => $color);
    }

    private function _setFileContents() {
        $handle = fopen($this->_logPath, "r");
        if ($handle) {
            $linecounter = $this->_linesToRead;
            $pos = -2;
            $beginning = false;
            $text = array();
            while ($linecounter > 0) {
                $t = " ";
                while ($t != "\n") {
                    if(fseek($handle, $pos, SEEK_END) == -1) {
                        $beginning = true;
                        break;
                    }
                    $t = fgetc($handle);
                    $pos --;
                }
                $linecounter --;
                if ($beginning) {
                    rewind($handle);
                }
                $text[$this->_linesToRead - $linecounter - 1] = fgets($handle);
                if ($beginning) break;
            }
            fclose ($handle);
            $this->_fileContents = $text;
        } else {
            $this->_fileContents = false;
        }
    }
}