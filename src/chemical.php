<?php
class Chemical {
    
    private $mendeleevElements = array();

    private $formula;
    private $elements = array();

    public function __construct($formula = NULL) 
    {
        $this->loadConfig();

        if ( ! is_null($formula))
        {
            $this->formula = $this->clear($formula);
            $this->parseFormula($this->formula);    
        }
    }

    private function loadConfig()
    {
        $config = include('config/mendeleevElements.php');
        
        $this->mendeleevElements = $config;
    }
    
    public function getMendeleevElements()
    {
        return $this->mendeleevElements;
    }

    private function addElement($element, $count = 1)
    {
        $this->elements[] = array($element, $count);
    }

    private function findElements($formula, $offset = 1)
    {
        $saved = '';
        
        for ($i=0; $i<strlen($formula); $i++)
        {
            $current = $formula[$i];
            $next = (isset($formula[$i+1])) ? $formula[$i+1] : FALSE;
            
            //Если число
            if (is_numeric($current)) 
            {
                $num = $current;

                if ($next !== FALSE AND is_numeric($next))
                {
                    $num =  $current.$next;                 
                }

                if ($saved)
                {
                    //Если цифра - сохраняем с цифрой
                    $this->addElement($saved, $num * $offset);
                }

                $saved = '';
            } 
            //Если это первый символ элемента из двух символов
            else if ($this->isUpper($current) AND $next AND $this->isLower($next) AND !is_numeric($next)) 
            {
                if (!empty($saved)) 
                {
                    $this->addElement($saved, $offset);
                    $saved = '';
                }
                
                //замоминаем элемент из двух символов
                $saved = $current;
            }
            //Если это одиночный либо последний
            else if ($this->isUpper($current) AND (($next AND $this->isUpper($next)) OR !$next))
            {
                if (!empty($saved)) 
                {
                    $this->addElement($saved, $offset);
                    $saved = '';
                }
                
                $saved = $current;
                
                //если совсем последний элемент, то сохраняем
                if (!$next) 
                {
                    $this->addElement($saved, $offset);
                    $saved = '';
                }
            }
            //Если второй символ
            else if($this->isLower($current))
            {
                //если это последний элемент или следущее НЕ число или следущая большая
                if (!$next AND (!is_numeric($next) OR $this->isUpper($next)))
                {
                    if (!empty($saved)) 
                    {
                        $this->addElement($saved.$current, $offset);
                        $saved = '';
                    }
                }
                else
                {
                    $saved .= $current; 
                }
                
            }
        }
    }

    private function parseFormula($formula)
    {
        $saved = '';
        $skip = 0;
        for ($i=0; $i<strlen($formula); $i++)
        {
            $current = $formula[$i];
            //открывается скобка, отправляем парсить все что до и начинаем сохранять содержимое скобок
            if ($current == '(')
            {
                if ($saved)
                {
                    $this->findElements($saved);
                }

                $saved = '';
            }
            //закрываются скобки, ищем цифры после, отправляем на парсинг содержимое скобок, обнуляем сохранялку
            else if ($current == ')')
            {
                $next = (isset($formula[$i+1])) ? $formula[$i+1] : FALSE;
                $nextNext = (isset($formula[$i+2])) ? $formula[$i+2] : FALSE;

                $num = 1;

                if ($next)
                {
                    if (is_numeric($next))
                    {
                        $num = $next;
                        $skip = 1;

                        if ($nextNext AND is_numeric($nextNext))
                        {
                            $num .= $next;
                            $skip = 2;
                        }
                    }
                }
                    
                $this->findElements($saved, $num);      
                $saved = '';
            }
            //елси пропусков изза цифр после скобок нет, то сохраняем
            else
            {
                if ( ! $skip)
                {
                    $saved .= $current; 
                }
                else
                {
                    $skip--;
                }           
            }
        }
        
        if ($saved)
        {
            $this->findElements($saved);    
        }
    }
    
    public function getMolarMass() 
    {
        $molarMass = 0;
                
        foreach ($this->elements as $item) 
        {
            $element = $item[0];
            $count   = $item[1];
            $molarMass += $this->mendeleevElements[$element] * $count;
        }
        
        return $molarMass;
    }

    public function getFoundElements()
    {
        $result = array();
        foreach ($this->elements as $item)
        {
            $element = $item[0];
            $count   = $item[1];

            if ( ! isset($result[$element]))
            {
                $result[$element] = 0;
            }

            $result[$element] += $count;
        }

        ksort($result);

        return $result;
    }
    
    private function isUpper ($string)
    {
        return($string === strtoupper($string) ? true : false);
    }
    
    private function isLower ($string)
    {
        return($string === strtolower($string) ? true : false);
    }

    private function clear($string)
    {
        $string = trim($string);
        $string = strip_tags($string);
        $string = preg_replace('/\s+/', '', $string);

        return $string;
    }
}
?>