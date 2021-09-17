<?php

namespace App\Service;


class GeneratePassword
{
     /**
     * Méthode qui prend un entier en paramètre et qui renvoie un mot de passe
     * 
     * @param $size int
     * @return @string
     */
    public function generatePassword( int $size = 8 ): string
    {
        // Génération du mot de passe
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    	$count = mb_strlen($alphabet);
    	
        for ($i = 0, $result = ''; $i < $size; $i++) 
        {
        	$index = mt_rand(0, $count - 1);
        	$result .= mb_substr($alphabet, $index, 1);
    	}
    	return $result;
    }
}