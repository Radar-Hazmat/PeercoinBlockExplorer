<?php

/**
* Output the site header HTML
*
* @param	string	$title	Page title
*/
function site_header ($title, $auth_list="")
{
	include('views/site_header.php');
}


/**
* Output the site footer HTML
*/
function site_footer ()
{
	include('views/site_footer.php');
	exit;
}

function site_stats ()
{
	include('views/site_stats.php');
}


/**
* Output the block detail information HTML/PHP code
*
* @param	int		$block_id
* @param	bool	$hash
*/
function block_detail($block_id, $hash=FALSE)
{
	if ($hash == TRUE) {
		$raw_block = getblock ($block_id);
	}
	else {
		$block_hash = getblockhash(intval ($block_id));
		$raw_block = getblock($block_hash);
	}

	include('views/block_detail.php');
}


/**
* Output trasnaction details via HTML code
*
* @param	string	$tx_id
*/	
function tx_detail ($tx_id)
{
	$raw_tx = gettransaction ($tx_id);

	section_head ("Transaction: ".$raw_tx["txid"]);
	
	section_subhead ("Detailed Description");
	
	detail_display ("TX Time", date ("F j, Y, H:i:s", $raw_tx["time"]));
	
	detail_display ("Amount", $raw_tx["amount"]);
	
	detail_display("Fee", $raw_tx["fee"]);

	detail_display ("Confirmations", $raw_tx["confirmations"]);
		
	if($raw_tx["confirmations"])
	{
		detail_display ("Block Hash", blockhash_link ($raw_tx["blockhash"]));
		detail_display ("Block Index",$raw_tx["blockindex"]);
	}
	
	
	
//	Florin Coin Feature
	if (isset ($raw_tx["tx-comment"]) && $raw_tx["tx-comment"] != "")
	{
		detail_display ("TX Message", htmlspecialchars ($raw_tx["tx-comment"]));
	}
	
	section_head ("Raw Transaction Detail");
	
	echo "	<textarea name=\"rawtrans\" rows=\"25\" cols=\"80\" style=\"text-align:left;\">\n";
	print_r ($raw_tx);
	echo "	\n</textarea><br><br>\n";
}



/**
* Output a detail element on the page
*
* @param	string	$title		Title/name of detail
* @param	string	$data		Detail data
* @param	int		$wordwrap	Word-wrap maximum length
*/
function detail_display ($title, $data, $wordwrap=0)
{
	include('views/detail_display.php');
}


/**
* Output a link to view a transaction ID
*
* @param	string	$tx_id
*/
function tx_link ($tx_id)
{
	return "<a href=\"?transaction=".$tx_id."\" title=\"View Transaction Details\">".$tx_id."</a>\n";
}


/**
* Output a link to view a block with a certain height
*
* @param	int		$block_height
*/
function blockheight_link ($block_height)
{
	return "<a href=\"".$_SERVER["PHP_SELF"]."?block_height=".$block_height."\" title=\"View Block Details\">".$block_height."</a>\n";
}


/**
* Output a link to view a block hash
*
* @param	int		$block_hash
*/
function blockhash_link ($block_hash)
{
	return "<a href=\"".$_SERVER["PHP_SELF"]."?block_hash=".$block_hash."\" title=\"View Block Details\">".$block_hash."</a>\n";
}


/**
* Output the HTML for a section heading
*
* @param	string	$heading
*/
function section_head ($heading)
{
	echo "		<div class=\"section_head\">\n";
	echo "			".$heading."\n";
	echo "		</div>\n";
	echo "\n";
}


/**
* Output the HTML for a section subheading
*
* @param	string	$heading
*/
function section_subhead ($heading)
{
	echo "		<div class=\"section_subhead\">\n";
	echo "			".$heading."\n";
	echo "		</div>\n";
	echo "\n";
}
	
/******************************************************************************
	This script is Copyright � 2013 Jake Paysnoe.
	I hereby release this script into the public domain.
	Jake Paysnoe Jun 26, 2013
******************************************************************************/
?>
