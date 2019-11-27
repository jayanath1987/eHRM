<div class="outerbox" style="background-color:#ffffff">
    <div class="maincontent">
<div align="center" >
    <br>

<br>
<div id="error" class="customErrormsg" style="font-size: 30px;">
    
    <?php
   $html =	'';
	$user = sfContext::getInstance()->getUser();
	if($user->hasFlash('messageType') && $user->hasFlash('message') )
	{
		$class	=	'';
		switch( $user->getFlash('messageType') )
		{
			case 'SUCCESS':
				$class	=	'messageBalloon_success';
			break;

			case 'NOTICE':
				$class	=	'messageBalloon_notice';
			break;

			case 'WARNING':
				$class	=	'messageBalloon_warning';
			break;
		}
		$html .=	"<div id='".$class."' class='".$class."' style='font-size: 20px;'>";
		$html	.=	"<ul>";
            $messageList = $user->getFlash('message');
			foreach( $messageList as $message)
			{
				$html .= "<li>".$message."</li>";
			}
		$html	.=	"</ul>";
		$html	.=	"</div>";
        }
        echo $html;
    ?>
  <br><br>
  
</div>
</div>
</div>
</div>
<style>

</style>