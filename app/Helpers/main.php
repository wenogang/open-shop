<?php

if(!function_exists('nb_produit')) {
    function nb_produit($nb)
    {
       if($nb>1)
       return $nb.'produits';
       else
       return $nb.'produit';
    }
}
   if(!function_exists('separateur_fcfa')){
    function separateur_fcfa($nb)
    {
        return number_format($nb,0,',','').'F CFA';
    }
    }