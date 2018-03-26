<?php
defined('APP_PATH') or exit();

/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/3/4
 * Time: 17:19
 */
class Rule
{
    public $id = null;
    public $data = null;
    public $bianhao = null;
    public $errorMsg = [];
    public $findCache = null;
    public $logicCache = [];

    const RULE_ALL = 'fwm_rule';
    const RULE_FIND = 'rule_find';
    const RULE_UNDEFINDED = 'rule_undefinded';
    const RULE_WARNING = 'rule_warning';

    static public function timeCondition()
    {
        return [
            'first' => lang('base_first_time'),
            'last'  => lang('base_last_time'),
        ];
    }

    static public function regionCondition()
    {
        return [
            'first' => lang('base_first_time'),
            'last'  => lang('base_last_time'),
        ];
    }

    static public function hitsCondition()
    {
        return [
            'eq' => lang('base_eq'),
            'gt' => lang('base_gt'),
            'lt' => lang('base_lt'),
        ];
    }

    public function config()
    {
        return [
            'name'           => '',
            'id'             => '',
            'if_find'        => 1,
            'if_ip'          => 0,
            'ip_config'      => [],
            'if_hits'        => 1,
            'hits_config'    => [
                'condition' => 'eq',
                'value'     => '1',
            ],
            'if_region'      => 0,
            'region_config'  => [],
            'if_time'        => 0,
            'time_config'    => [],
            'if_warning'     => 0,
            'warning_config' => [],
            'sort'           => 10,
            'if_pro'         => 1,
//            'if_lc'          => 1,
            'if_agent'       => 0,
            'if_update'      => 1,
            'if_enable'      => 1,
            'if_view'        => 1,
            'view_config'    => '',
        ];
    }

    public function get()
    {
        if ($this->id === null) {
            return $this->config();
        }
        $sql = 'SELECT * FROM `tgs_tmp_rule` WHERE id=' . $this->id . ' LIMIT 1';
        $res = mysql_query($sql);
        $arr = mysql_fetch_array($res, MYSQL_ASSOC);
        $arr['ip_config'] = json_decode($arr['ip_config'], true);
        $arr['hits_config'] = json_decode($arr['hits_config'], true);
        $arr['region_config'] = json_decode($arr['region_config'], true);
        $arr['time_config'] = json_decode($arr['time_config'], true);
        $arr['warning_config'] = json_decode($arr['warning_config'], true);
        return $arr;
    }

    public function check()
    {
        $check = true;
        $this->clearError();
        if ($this->data['sort'] == null) {
            $this->setError(lang('rule_sort_not_exist'));
            $check = false;
        }
        if ($this->data['sort'] < 0 || $this->data['sort'] > 127) {
            $this->setError(lang('rule_sort_error'));
            $check = false;
        } else {
            $sql = 'SELECT `id` FROM `tgs_tmp_rule` WHERE `sort`=' . $this->data['sort'] . ' limit 1';
            $res = mysql_query($sql);
            $arr = mysql_fetch_array($res);

            if ($this->data['id']) {   //修改式忽略自己
                if ($this->data['id'] != $arr['id'] && $arr['id']) {
                    $this->setError(lang('rule_sort_error_repeat_update'));
                    $check = false;
                }
            } else {
                if (isset($arr['id'])) {
                    $this->setError(lang('rule_sort_error_repeat_add'));
                    $check = false;
                }
            }
        }
        if (!$this->data['name']) {
            $this->setError(lang('rule_name_not_exist'));
            $check = false;
        }

        if ($this->data['if_find']) {
            $this->data['if_find'] = 1;  //找到时规则
            if (($this->data['if_hits'] + $this->data['if_ip'] + $this->data['if_region'] + $this->data['if_time']) < 1) {
                $this->setError(lang('rule_not_null'));
                $check = false;
            }
            if (($this->data['if_view'] + $this->data['if_pro'] + $this->data['if_lc'] + $this->data['if_agent']) < 1) {
                $this->setError(lang('view_not_null'));
                $check = false;
            }
            if ($this->data['if_hits'] == 1) {
                if (!isset(static::hitsCondition()[$this->data['hits_config']['condition']])) {
                    $this->setError(lang('hits_condition_error'));
                    $check = false;
                }
                if ($this->data['hits_config']['value'] == null) {
                    $this->setError(lang('hits_value_not_null'));
                    $check = false;
                } else if (!is_numeric($this->data['hits_config']['value'])) {
                    $this->setError(lang('hits_value_must_int'));
                    $check = false;
                }
            }
            if ($this->data['if_time'] == 1) {
                if (!isset(static::timeCondition()[$this->data['time_config']['condition']])) {
                    $this->setError(lang('time_condition_error'));
                    $check = false;
                }
                if ($this->data['time_config']['value'] == null) {
                    $this->setError(lang('time_value_not_null'));
                    $check = false;
                } else if (!is_numeric($this->data['time_config']['value']) || $this->data['time_config']['value'] < 1) {
                    $this->setError(lang('time_value_must_int'));
                    $check = false;
                }
            }
            if ($this->data['if_region'] == 1) {
                if (!isset(static::regionCondition()[$this->data['region_config']['condition']])) {
                    $this->setError(lang('region_condition_error'));
                    $check = false;
                }
            }
        } else {
            $this->data['if_find'] = 0;
            $this->data['if_ip'] = 0;
            $this->data['if_hits'] = 0;
            $this->data['if_region'] = 0;
            $this->data['if_time'] = 0;
            $this->data['if_warning'] = 0;
            $this->data['if_pro'] = 0;
            $this->data['if_lc'] = 0;
            $this->data['if_agent'] = 0;
            $this->data['ip_config'] = [];
            $this->data['hits_config'] = [];
            $this->data['region_config'] = [];
            $this->data['time_config'] = [];
            $this->data['warning_config'] = [];
        }
        return $check;
    }

    public function clearError()
    {
        $this->errorMsg = [];
    }

    public function setError($msg)
    {
        array_push($this->errorMsg, $msg);
    }

    public function getErrorMsg()
    {
        return $this->errorMsg;
    }

    public function save()
    {
        if (!$this->check()) {
            return false;
        }
        $result = $this->data['id'] ? $this->update() : $this->create();
        if ($result == '1') {
            $this->updateCache();
        }
        if ($result >= 0) {
            return true;
        }
        $this->setError(lang('base_save_failed'));
        return false;
    }

    public function update()
    {
        $saveData = $this->data;
        $id = $saveData['id'];
        unset($saveData['id']);
        $saveData['ip_config'] = json_encode($this->data['ip_config']);
        $saveData['hits_config'] = json_encode($this->data['hits_config']);
        $saveData['region_config'] = json_encode($this->data['region_config']);
        $saveData['time_config'] = json_encode($this->data['time_config']);
        $saveData['warning_config'] = json_encode($this->data['warning_config']);
        $saveData['view_config'] = trim($this->data['view_config']);
        $savesql = create_update_sql($saveData);
        $sql = 'UPDATE `tgs_tmp_rule` SET ' . $savesql . ' WHERE `id`=' . $id;
        mysql_query($sql);
        return mysql_affected_rows();
    }

    public function create()
    {
        $saveData = $this->data;
        unset($saveData['id']);
        $saveData['ip_config'] = json_encode($this->data['ip_config']);
        $saveData['hits_config'] = json_encode($this->data['hits_config']);
        $saveData['region_config'] = json_encode($this->data['region_config']);
        $saveData['time_config'] = json_encode($this->data['time_config']);
        $saveData['warning_config'] = json_encode($this->data['warning_config']);
        $saveData['view_config'] = trim($this->data['view_config']);
        $savesql = create_insert_sql($saveData);
        $sql = 'INSERT INTO `tgs_tmp_rule` ' . $savesql;
        mysql_query($sql);
        return mysql_affected_rows();
    }

    public function delete($arr)
    {
        $rows = 0;
        if (!empty($arr)) {
            $sql = 'DELETE FROM `tgs_tmp_rule` WHERE id in (' . implode(',', $arr) . ') and if_update=1';
            mysql_query($sql);
            $rows = mysql_affected_rows();
            if ($rows > 0) {
                $this->updateCache();
            }
        }
        return $rows;
    }

    public function updateCache()
    {
        $sql = 'SELECT * FROM `tgs_tmp_rule` WHERE `if_enable`=1 ORDER BY `sort` ';
        $res = mysql_query($sql);
        $result = []; //全部规则
        $find = [];   //有数据规则
        $undefinded = [];  //无数据规则
        $warning = [];  //无数据规则
        $data = [];
        while ($arr = mysql_fetch_array($res, MYSQL_ASSOC)) {
            $data = [
                'id'        => $arr['id'],
                'name'      => $arr['name'],
                'sort'      => $arr['sort'],
                'condition' => [],
                'view'      => [],
            ];
            if ($arr['if_find']) {
                if ($arr['if_ip'] && $arr['ip_config']) {
                    $data['condition']['if_ip'] = json_decode($arr['ip_config'], true);
                };
                if ($arr['if_hits'] && $arr['hits_config']) {
                    $data['condition']['if_hits'] = json_decode($arr['hits_config'], true);
                };
                if ($arr['if_region'] && $arr['region_config']) {
                    $data['condition']['if_region'] = json_decode($arr['region_config'], true);
                };
                if ($arr['if_time'] && $arr['time_config']) {
                    $data['condition']['if_time'] = json_decode($arr['time_config'], true);
                };
                if ($arr['if_view']) {
                    $data['view']['if_view'] = $arr['view_config'];
                };
                if ($arr['if_pro']) {
                    $data['view']['if_pro'] = 1;
                };
//                if ($arr['if_lc']) {
//                    $data['view']['if_lc'] = 1;
//                };
                if ($arr['if_agent']) {
                    $data['view']['if_agent'] = 1;
                };
                if ($arr['if_warning'] && $arr['warning_config']) {
                    $data['if_warning'] = json_decode($arr['warning_config'], true);
                    $warning[$arr['id']] = $data;
                };
                $find[$arr['id']] = $data;
            } else {
                $data['condition']['if_find'] = 1;
                $data['view']['if_view'] = $arr['view_config'];
                $undefinded[$arr['id']] = $data;
            }
            $result[$arr['id']] = $data;
        }
        cache()->set(static::RULE_FIND, $find);
        cache()->set(static::RULE_WARNING, $warning);
        cache()->set(static::RULE_UNDEFINDED, $undefinded);
        cache()->set(static::RULE_ALL, $result);
    }

    public function getCache($cacheName = null)
    {
        if ($cacheName === null) {
            $cacheName = static::RULE_ALL;
        }
        $data = cache()->get($cacheName);
        if (empty($data)) {
            $this->updateCache();
            $data = cache()->get($cacheName);
        }
        return $data;
    }

    public function getCacheConfigById($id)
    {
        $data = $this->getCache();
        if (!empty($data)) {
            return $data[$id];
        }
        return [];
    }

    /*
     * @parma $data tgs_code
     */
    public function getCacheConfigByBianhao($data, $warning = false)
    {
        if (empty($data)) {  //未找到数据
            $config = $this->undefindedLogic();
        } else {
            $config = $this->findLogic($data, $warning);
        }
        return $config;
    }

    protected function findLogic($data, $warning = false)
    {
        $return = [];
        if ($data['hits'] == 0) {  //未查询直接跳过
            return $return;
        }
        if ($this->findCache === null) {
            if ($warning) {
                $this->findCache = $this->getCache(static::RULE_WARNING);
            } else {
                $this->findCache = $this->getCache(static::RULE_FIND);
            }
        }
        $this->logicCache = [];
        foreach ($this->findCache as $rule) {
            $accord = true;
            if (!empty($rule['condition'])) {
                foreach ($rule['condition'] as $conditionName => $conditionValue) {
                    if (!$this->conditionLogic($conditionName, $conditionValue, $data)) {
                        $accord = false;
                        break;
                    }
                }
            } else {
                continue;
            }
            if ($accord === true) {
                $return = $rule;
                break;
            }
        }
        return $return;
    }

    protected function undefindedLogic()
    {
        $config = [];
        foreach ($this->getCache(static::RULE_UNDEFINDED) as $v) {
            $config = $v;
            break;
        }
        return $config;
    }

    protected function conditionLogic($conditionName, $conditionValue, $data)
    {
        $result = false;
        switch ($conditionName) {
            case 'if_hits':
                $result = $this->hitsLogic($conditionValue['condition'], $conditionValue['value'], $data['hits']);
                break;
            case 'if_ip':
                $result = $this->ipLogic();
                break;
            case 'if_region':
                $result = $this->regionLogic($conditionValue['condition'], $data['bianhao']);
                break;
            case 'if_time':
                $result = $this->timeLogic($conditionValue['condition'], $conditionValue['value'], $data['bianhao']);
                break;
        }
        return $result;
    }

    protected function hitsLogic($condition, $value, $hits)
    {
        $result = false;
        switch ($condition) {
            case 'lt':
                $result = $hits < $value;
                break;
            case 'gt':
                $result = $hits > $value;
                break;
            case 'eq':
                $result = $hits == $value;
                break;
        }
        return $result;
    }

    protected function ipLogic()
    {
        return false;
    }

    protected function regionLogic($condition, $bianhao)
    {
        $data = $this->getLastHistory($bianhao);//用于比较
        switch ($condition) {
            case 'first':
                $other = $this->getFirstHistory($bianhao);
                break;
            case 'last':
                $other = $this->getLastButOneHistory($bianhao);
                break;
        }
        if (empty($other) || empty($data)) {
            return false;
        }
        return $data['city_code'] != $other['city_code'] ? true : false;
    }

    protected function timeLogic($condition, $value, $bianhao)
    {
        $second = $value * 86400;
        $data = $this->getLastHistory($bianhao);//用于比较
        switch ($condition) {
            case 'first':
                $other = $this->getFirstHistory($bianhao);
                break;
            case 'last':
                $other = $this->getLastButOneHistory($bianhao);
                break;
        }
        return strtotime($data['addtime']) - strtotime($other['addtime']) > $second ? true : false;
    }

    protected function getFirstHistory($bianhao)
    {
        $sql = 'SELECT * FROM `tgs_history` WHERE results in (1,4,7) and keyword=\'' . $bianhao . '\' ORDER BY id LIMIT 1';
        return $this->getHistory($sql, 'first');
    }

    protected function getLastHistory($bianhao)
    {
        $sql = 'SELECT * FROM `tgs_history` WHERE  keyword=\'' . $bianhao . '\' ORDER BY id DESC LIMIT 1';
        return $this->getHistory($sql, 'last');
    }

    protected function getLastButOneHistory($bianhao)
    {
        $sql = 'SELECT * FROM `tgs_history` WHERE  keyword=\'' . $bianhao . '\' ORDER BY id DESC LIMIT 1,1';
        return $this->getHistory($sql, 'last_but_one');
    }

    protected function getHistory($sql, $key)
    {
        if (isset($this->logicCache[$key])) {
            return $this->logicCache[$key];
        }
        $res = mysql_query($sql);
        $arr = mysql_fetch_array($res, MYSQL_ASSOC);
        $this->logicCache[$key] = $arr;
        return $arr;
    }

}