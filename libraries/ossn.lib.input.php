<?php
/**
 * Boatable Technologies LLC
 *
 * @package   Boatable Technologies LLC
 * @author    Boatable Technologies LLC Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Boatable Technologies LLC License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
/**
 * Escape input string
 *
 * @param string $str A valid string in which you want to restore lines.
 * @param boolean $newlines If you also want to escape new lines , default settings will replace it
 *
 * @return string
 */
function ossn_input_escape($str, $newlines = true) {
		$replacements = array(
				"\x00" => '\x00',
				"\n" => '\n',
				"'" => "\'",
				'"' => '\"',
				"\x1a" => '\x1a'
		);
		if ($newlines === true) {
				$newline      = array(
						"\r" => '\r',
						"\\" => '\\\\'
				);
				$replacements = array_merge($replacements, $newline);
		}
		if (strlen($str) > 0) {
				return strtr($str, $replacements);
		}
		return false;
}
/*
 * Encode the emojiis before it goes it database. 
 *
 * UTF-32's hex encoding is the same as HTML's hex encoding.
 * So, by converting the emoji from UTF-8 to UTF-32, we magically
 * get the correct hex encoding.
 *
 * The below function is taken from wordpress , please use it under following license :
 * https://wordpress.org/about/license/
 * 
 * @param string $content The content to encode.
 * @return string The encoded content
 */
function ossn_emojis_to_entites($content) {
		if (function_exists('mb_convert_encoding')) {
				$regex = '/(
		     \x23\xE2\x83\xA3               # Digits
		     [\x30-\x39]\xE2\x83\xA3
		   | \xF0[\x90-\xBF][\x80-\xBF][\x80-\xBF]            # range x10000 - x3FFFF
		   | [\xF1-\xF3][\x80-\xBF][\x80-\xBF][\x80-\xBF]     # range x40000 - xFFFFF
		)/x';
				
				$matches = array();
				if (preg_match_all($regex, $content, $matches)) {
						if (!empty($matches[1])) {
								foreach ($matches[1] as $emoji) {
										
										$unpacked = unpack('H*', mb_convert_encoding($emoji, 'UTF-32', 'UTF-8'));
										if (isset($unpacked[1])) {
												$entity  = '&#x' . ltrim($unpacked[1], '0') . ';';
												$content = str_replace($emoji, $entity, $content);
										}
								}
						}
				}
		}
		
		return $content;
}
/**
 * Get input from user; using secure method;
 *
 * @param string  $input Name of input;
 * @param integer $noencode If you don't want to encode to html entities then add 1 as second arg in function.
 * @param boolean $strip Remove spaces from start and end of input
 *
 * @last edit: $arsalanshah
 * @reason: fix docs;
 * @return false|string
 */
function input($input, $noencode = '', $default = false, $strip = true) {
		$str  = false;
		//#1230 breaks when array is input #1474
		if(isset($_REQUEST[$input]) && !is_array($_REQUEST[$input])){
			$data_hook = ((strlen($_REQUEST[$input]) > 0) ? preg_replace('/\x20+/', ' ', $_REQUEST[$input]) : null);
		} else {
			if(!empty($_REQUEST[$input])){
				$data_hook = preg_replace('/\x20+/', ' ', $_REQUEST[$input]); 	
			} else {
				$data_hook = null;	
			}
		}
		$hook = ossn_call_hook('ossn', 'input', false, array(
				'input' => $input,
				'noencode' => $noencode,
				'default' => $default,
				'strip' => $strip,
				'data' => $data_hook,
		));
		if ($hook) {
				$input    = $hook['input'];
				$noencode = $hook['noencode'];
				$default  = $hook['default'];
				$strip    = $hook['strip'];
				if (isset($hook['data']) && is_array($hook['data'])) {
						foreach ($hook['data'] as $key => $value) {
								$hook['data'][$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
						}
						return $hook['data'];
				}
				if (!isset($hook['data']) && $default) {
						return $default;
				}
				if (isset($hook['data']) && empty($noencode)) {
						$data = htmlspecialchars($hook['data'], ENT_QUOTES, 'UTF-8');
						$str  = $data;
				} elseif ($noencode == true) {
						$str = $data;
				}
				if (strlen($str) > 0) {
						$str = ossn_emojis_to_entites($str);
						if ($strip) {
								return trim(ossn_input_escape($str));
						} else {
								return ossn_input_escape($str);
						}
				}
		}
		return false;
}
/**
 * Ossn Restore New Lines
 * Restore \n\r from the string to new line
 *
 * @param string $string A valid string in which you want to restore lines.
 * @param boolean $br If you want newlines to replaced by html <br /> tag.
 *
 * @return string
 */
function ossn_restore_new_lines($string, $br = false) {
		if (strlen($string) == 0) {
				return false;
		}
		$replacements = array(
				"\n" => '\n',
				"\r" => '\r'
		);
		$replacements = array_flip($replacements);
		$result       = strtr($string, $replacements);
		if ($br === true) {
				$result = nl2br($result);
		}
		return $result;
}
/**
 * Set a value for input
 *
 * @param string $name Name of input
 * @param string $value Value of input
 * 
 * @return void
 */
function ossn_set_input($name, $value) {
		if (isset($name) && isset($value)) {
				$_REQUEST[$name] = $value;
		}
}
