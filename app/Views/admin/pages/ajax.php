<?php
switch($action)
	{
		case "activate":
			?>
			
			    <a onclick="changeStatus('<?= $mode; ?>','deactivate',<?= $rowid; ?>)" class="badge bg-success" style="cursor:pointer">Active</a>

			<?php
		break;
						
		case "deactivate":
            ?>

               <a onclick="changeStatus('<?= $mode; ?>','activate',<?= $rowid; ?>)" class="badge bg-danger" style="cursor:pointer">Inactive</a>

			<?php
		break;
    }
?>