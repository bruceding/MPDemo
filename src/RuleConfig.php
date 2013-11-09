<?php
require ROOT_PATH . '/src/Rule.php';

class RuleConfig {

    /**
     * _wxid
     * 商家的微信id 
     * 
     */
    private $_wxid;

    /**
     * _config_file 
     * 配置文件所在目录 
     */
    private $_config_dir; 

    private $_config_file;

    public function __construct($wxid) {
        
        if (!$wxid) {
            throw new InvalidArgumentException('wxid not empty');
        } 

        $this->_wxid = $wxid;
        $this->_config_dir = ROOT_PATH . '/' . RULE_CONFIG_DIR;

        if (!file_exists($this->_config_dir)) {
            mkdir($this->_config_dir, 0777, true);
        } 
        
        $this->_config_file = $this->_config_dir . '/' . $wxid . '_rules.config';
    }

    public function addRule(Rule $rule) {
       $rule->allRules = $this->readConfig();

       $this->writeConfig($rule->getRules()); 
    }

    public function writeConfig($rules) {
         
        file_put_contents($this->_config_file, var_export($rules, true));
    }

    public function readConfig() {

        if (!file_exists($this->_config_file)) {
            return array();        
        }

        $str = file_get_contents($this->_config_file);

        eval("\$rules=$str;");

        return $rules;
    }

    public function getRules() {

        return $this->readConfig();
    }
}
