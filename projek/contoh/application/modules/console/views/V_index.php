<div id="page-wrapper" >
    <div id="page-inner">

        <h2>Console</h2>
		<br><br>
		<?php
		if($vmid != null){
			require(getcwd()."/pve2_api.class.php");
			$pve2 = new PVE2_API("10.0.12.245", "root", "pam", "t425k19j11");
			if ($pve2->login()){
				$pve2->setCookie(); # this is the function I added to the php API client
				$nodes = $pve2->get_node_list();
				$first_node = $nodes[0];
		?>
			<iframe  src="https://10.0.12.245:8006/?console=lxc&novnc=1&vmid=<?=$vmid?>&node=<?=$first_node?>" frameborder="0" scrolling="yes" width="1024px" height="500px"></iframe>
		<?php
			}else{
				print("Login to Proxmox Host failed.\n");
				exit;
			}
			// print_r($pve2);die;

		}
		?>

    </div>
</div>
