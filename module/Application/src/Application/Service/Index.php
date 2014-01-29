<?php

namespace Application\Service;

use Sglib\Service\AbstractService;

class Index extends AbstractService
{
    public function readFile()
    {
        $handle = fopen(getcwd().'/data/inputfile.txt', 'r');
        if ($handle) {
            $output = '';
            $start = 0;

            while (($line = fgets($handle)) !== false) {
                $words = explode(' ', $line);
                $word = $words[0];
                $num = $words[1];

                switch ($word) {
                    case 'apply':
                        $output = $this->convert($num, $output, $start);
                        $start = 0;
                        break;
                    case 'add':
                        $output = $this->convert($num, $output, $start);
                        $output = $output.'+';
                        $start++;
                        break;
                    case 'minus':
                        $output = $this->convert($num, $output, $start);
                        $output = $output.'-';
                        $start++;
                        break;
                    case 'multiply':
                        $output = $this->convert($num, $output, $start);
                        $output = $output.'*';
                        $start++;
                        break;
                    case 'divide':
                        $output = $this->convert($num, $output, $start);
                        $output = $output.'/';
                        $start++;
                        break;
                    default:
                        $output = $this->convert($num, $output, $start);
                        $start = 0;
                        break;
                }
            }

            return $output;
            //var_dump($output);
        } else {
            return false;
        }
    }


    private function convert($num, $output, $start=0)
    {
        if ($start > 0) {
            $res = $output.$num;
            eval('$output = '.$res.';');
        } else {
            $output = $num;
        }

        return $output;
    }
}
