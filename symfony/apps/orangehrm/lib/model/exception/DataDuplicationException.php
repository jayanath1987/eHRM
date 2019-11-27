<?php
/**
 * Class designed to inform controllers in case the database contains duplicate data
 * you should use it in the higher scope not inside DAO but highly in controllers and only
 * in services if REQUIRED
 *
 * @author sujith
 */
class DataDuplicationException extends Exception
{

}
?>
