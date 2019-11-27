<?php
require_once ROOT_PATH . '/lib/dao/MySQLClass.php';
require_once ROOT_PATH . '/lib/confs/Conf.php';
/**
 * Generate HTML for multi-dimensional menu from MySQL database
 * with ONE QUERY and WITHOUT RECURSION
 * @author J. Bruni
 */
//print_r($_SESSION['symfony/user/sfUser/culture']);die;
class MenuBuilder
{
	/**
	 * MySQL connection
	 */
	var $conn;

	/**
	 * Menu items
	 */
	var $items = array();

	/**
	 * HTML contents
	 */
	var $html  = array();

        //var $culture = $_SESSION['symfony/user/sfUser/culture'];
        var $culture;
        var $columnName;
	/**
	 * Create MySQL connection
	 */
	function MenuBuilder()
	{
        $conf = new Conf();
            $db=new MySQLClass($conf);
           $this->conn = mysql_connect($db->myHost .':'.$db->myHostPort, $db->userName, $db->userPassword);

           $this->culture=$_SESSION['language'];
               
	}

	/**
	 * Perform MySQL query and return all results
	 */
	function fetch_assoc_all( $sql )
	{
                if($this->culture=="en"){
                $this->columnName='sm_mnuitem_name';

                }else{
                    $this->columnName='sm_mnuitem_name_'.$this->culture;
                }
                //die(print_r($_SESSION));
                if($_SESSION['user']=="USR001"){
                $query="SELECT sm_mnuitem_id, sm_mnuitem_parent, ".$this->columnName.", sm_mnuitem_webpage_url, sm_mnuitem_position FROM hs_hr_sm_mnuitem ORDER BY sm_mnuitem_parent, sm_mnuitem_position;";
                }
                else{
                    $query="select * from hs_hr_sm_mnuitem m left join hs_hr_sm_mnucapability c on m.sm_mnuitem_id=c.sm_mnuitem_id left join hs_hr_users u on u.sm_capability_id=c.sm_capability_id where u.id='".$_SESSION['user']."' ORDER BY m.sm_mnuitem_parent, m.sm_mnuitem_position;";
                }
		//$result = mysql_query("SELECT sm_mnuitem_id, sm_mnuitem_parent, ".$this->columnName.", sm_mnuitem_webpage_url, sm_mnuitem_position FROM hs_hr_sm_mnuitem ORDER BY sm_mnuitem_parent, sm_mnuitem_position;",$this->conn);
                $result = mysql_query($query,$this->conn);

		if ( !$result ){
                    
			return false;

                }

		$assoc_all = array();

		while( $fetch = mysql_fetch_assoc( $result ) ){
			$assoc_all[] = $fetch;
                }
                //die(print_r($assoc_all));
		mysql_free_result( $result );

		return $assoc_all;

	}

	/**
	 * Get all menu items from database
	 */
	function get_menu_items()
	{
		// Change the field names and the table name in the query below to match tour needs
		$sql = 'SELECT sm_mnuitem_id, sm_mnuitem_parent, sm_mnuitem_name, sm_mnuitem_webpage_url, sm_mnuitem_position FROM hs_hr_sm_mnuitem ORDER BY s_mnuitem_parent, sm_mnuitem_position;';

		return $this->fetch_assoc_all( $sql );
	}

	/**
	 * Build the HTML for the menu
	 */
	function get_menu_html( $root_id = 0 )
	{
		$this->html  = array();
		$this->items = $this->get_menu_items();
                //print_r($this->items);die("");

		foreach ( $this->items as $item )
			$children[$item['sm_mnuitem_parent']][] = $item;

		// loop will be false if the root has no children (i.e., an empty menu!)
		$loop = !empty( $children[$root_id] );

		// initializing $parent as the root
		$parent = $root_id;
		$parent_stack = array();

		// HTML wrapper for the menu (open)
                //$this->html[] = '<div>';
		$this->html[] = '<ul id="qm0" class="qmmc">';

		while ( $loop && ( ( $option = each( $children[$parent] ) ) || ( $parent > $root_id ) ) )
		{
			if ( $option === false )
			{
				$parent = array_pop( $parent_stack );

				// HTML for menu item containing childrens (close)
				$this->html[] = str_repeat( "\t", ( count( $parent_stack ) + 1 ) * 2 ) . '</ul>';
				$this->html[] = str_repeat( "\t", ( count( $parent_stack ) + 1 ) * 2 - 1 ) . '</li>';
			}
			elseif ( !empty( $children[$option['value']['sm_mnuitem_id']] ) )
			{
				$tab = str_repeat( "\t", ( count( $parent_stack ) + 1 ) * 2 - 1 );

				// HTML for menu item containing childrens (open)
                $url="";
                if($option['value']['sm_mnuitem_webpage_url']=="#"){
                    $url="javascript:void(0);";
                }else{
                    $url=$option['value']['sm_mnuitem_webpage_url'];
                }               
                                $abc= $option['value']['sm_mnuitem_id'];
                                //$Val = '%1$s<li><a class="qmparent" href="%2$s">%3$s</a>';
                                $Val= '%1$s<li><a  id="'.$abc;
                                $Val.= '" class="qmparent" href="%2$s">%3$s</a>';
				$this->html[] = sprintf(
					$Val,
					$tab,   // %1$s = tabulation
					//$option['value']['sm_mnuitem_webpage_url'],   // %2$s = link (URL)
                    $url,
					$option['value'][$this->columnName]   // %3$s = title
				);
				$this->html[] = $tab . "\t" . '<ul>';

				array_push( $parent_stack, $option['value']['sm_mnuitem_parent'] );
				$parent = $option['value']['sm_mnuitem_id'];
			}
			else{ 
                           
				// HTML for menu item with no children (aka "leaf")
                             if($_SESSION['user']!="USR001"){
                            if($option['value']['sm_mnuitem_webpage_url']!="#"){ 
                                $abc= $option['value']['sm_mnuitem_id'];
                                $Val = '%1$s<li><a  id="'.$abc;
                                $Val.= '" target="rightMenu" class="subClickMenu" href="%2$s">%3$s</a></li>';
                                //$Val = '%1$s<li><a target="rightMenu" class="subClickMenu" href="%2$s">%3$s</a></li>';
				$this->html[] = sprintf(
					$Val,
					str_repeat( "\t", ( count( $parent_stack ) + 1 ) * 2 - 1 ),   // %1$s = tabulation
					$option['value']['sm_mnuitem_webpage_url'],   // %2$s = link (URL)
					$option['value'][$this->columnName]   // %3$s = title
				);
                            }
                             }else{  
                                    $abc= $option['value']['sm_mnuitem_id'];
                                    $Val = '%1$s<li><a target="rightMenu" id="'.$abc.'"';
                                    $Val.= 'class="subClickMenu" href="%2$s">%3$s</a></li>';
                                 $this->html[] = sprintf(
					$Val,
					str_repeat( "\t", ( count( $parent_stack ) + 1 ) * 2 - 1 ),   // %1$s = tabulation
					$option['value']['sm_mnuitem_webpage_url'],   // %2$s = link (URL)
					$option['value'][$this->columnName]   // %3$s = title
				);
                             }
                        }
		}

		// HTML wrapper for the menu (close)
		$this->html[] = '</ul>';
                //$this->html[] = '</div>';
                //die(print_r($this->html));
		return implode( "\r\n", $this->html );
	}
}





?>
<script type="text/javascript" src="scripts/jquery/jquery.min.js"></script>
<style>
a:link {
    
/*    color: #fff;*/
    
}

a.selectedLink {
    color: #000 !important;
    outline-color: #FF7F00;
    font-weight:bold;
    border:solid 1px #cd8500;
background-color:#EAF5AE;

    
}

</style>
<script type="text/javascript">
function roundAccuracy(num, accuracy){
            var factor=Math.pow(10,accuracy);
            return Math.round(num*factor)/factor;
        }
        
$(document).ready(function() {
var menuid= "<?php print $_SESSION['validCurrnetMenuID']; ?>";
var menuparent= roundAccuracy(menuid, -3);
//alert(menuparent);
 //$("#"+menuid).removeClass('selectedLink');

//$("#"+menuparent).addClass('qmfv'); 

///$("#"+menuparent).addClass('qmfv qmparent qmactive'); 
///$("#"+menuid).parent().addClass('qmfv');
///$("#"+menuid).addClass('selectedLink');

//$("#"+menuid).parent().addClass('qmfv');
    
    
 $('.subClickMenu').click(
    function(){
        ///$("#"+menuparent).removeClass('qmfv qmparent qmactive');
        //$("#"+menuid).parent().removeClass('qmfv')
        $('.selectedLink').removeClass('selectedLink');
        $(this).addClass('selectedLink');
        
    });

 });
</script>

