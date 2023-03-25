<?php
/**
 * Validation Class
 *
 * @category  Validation
 * @package   Validation
 * @author    Silvio Heim <kontakt@silvio-heim.de>
 * @copyright Copyright (c) 2023
 * @link      https://codigoworks.com/
 * @version   1.0.0
 */

class Validation
{

    /**
     * All params from GET, POST and FILES
     *
     * @var params
     */
    protected $params = array();

    public function __construct()
    {
      // Get all parameters and store them in $params array
      foreach ($_GET as $key => $value) {
        $this->params[$key] = $value;
      }
      foreach ($_POST as $key => $value) {
        $this->params[$key] = $value;
      }
      foreach ($_FILES as $key => $value) {
        $this->params[$key] = $value;
      }
    }

    public function getParam($key, $default = null, $filters = null, $options = null)
    {
        $value = $default;

        if (isset($this->params[$key])) {
            $value = $this->params[$key];
        }

        if ($filters !== null) {
            if (!is_array($filters)) {
                $filters = array($filters);
            }

            foreach ($filters as $filter) {
                if (function_exists($filter)) {
                    $value = call_user_func($filter, $value, $options);
                }
            }
        }

        return $value;
    }

    public function validate($rules)
    {
      $errors = array();

      foreach ($rules as $key => $rule) {
        $value = $this->getParam($key);

        if (isset($rule['required']) && $rule['required'] && empty($value)) {
          $errors[$key][] = 'This field is required';
        }

        if (isset($rule['min_length']) && strlen($value) < $rule['min_length']) {
          $errors[$key][] = 'This field must be at least ' . $rule['min_length'] . ' characters long';
        }

        if (isset($rule['max_length']) && strlen($value) > $rule['max_length']) {
          $errors[$key][] = 'This field must be no more than ' . $rule['max_length'] . ' characters long';
        }

        if (isset($rule['email']) && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
          $errors[$key][] = 'Invalid email address';
        }

        // Add more rules as needed...
      }

      return $errors;
    }
}
?>