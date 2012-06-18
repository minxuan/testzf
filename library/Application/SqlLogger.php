<?php
class Application_SqlLogger extends \Zend_Log implements \Doctrine\DBAL\Logging\SQLLogger
{
    /**
     * Logs a SQL statement somewhere.
     *
     * @param string $sql The SQL to be executed.
     * @param array $params The SQL parameters.
     * @param float $executionMS The microtime difference it took to execute this query.
     * @return void
     */
    public function startQuery($sql, array $params = null, array $types = null)
    {
        $message = $sql;
        if (!is_null($params) and count($params) > 0) {
            $message .= "\nParams : " . var_export($params, true);
        }
        if (!is_null($types) and count($types) > 0) {
            $message .= "\nTypes : " . var_export($types, true);
        }
        $message .= "\n---------------------------\n";
        $this->debug($message);
    }

    /**
     * Mark the last started query as stopped. This can be used for timing of queries.
     *
     * @return void
     */
    public function stopQuery()
    {
        
    }
}
