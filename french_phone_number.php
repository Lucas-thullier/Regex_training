<?php 
if (preg_match("#^0[1-68]([ -.]?\d{2}){4}$#", "06-53.06975-33"))  // 1ere itération "#^0[1-68]\d{8}$#"
{
	echo "gg";
}
else
{
	echo "fail";
}